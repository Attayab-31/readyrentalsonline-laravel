<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use App\Http\Helpers\Email_functions;

class StripeWebhookController extends Controller
{
    // Payment status constants
    const PAYMENT_STATUS_PENDING = 'pending';
    const PAYMENT_STATUS_FAILED = 'failed';
    const PAYMENT_STATUS_REQUIRES_VERIFICATION = 'requires_verification';
    const PAYMENT_STATUS_SUCCEEDED = 'succeeded';
    
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook_secret');

        if (! is_string($endpointSecret) || $endpointSecret === '') {
            Log::critical('Stripe webhook signing secret is not configured.');
            return response()->json(['error' => 'Webhook is not configured.'], 503);
        }

        try {
            $event = Webhook::constructEvent(
                $payload, 
                $sigHeader, 
                $endpointSecret
            );
        } catch (SignatureVerificationException $e) {
            Log::error('Stripe webhook signature verification failed', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid signature'], 403);
        } catch (\Throwable $e) {
            Log::error('Stripe webhook processing error', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Webhook processing failed'], 400);
        }

        // Log the event for debugging
        Log::info('Stripe Webhook Received', ['type' => $event->type]);

        try {
            DB::beginTransaction();
            $alreadyProcessed = DB::table('stripe_webhook_events')->insertOrIgnore([
                'event_id' => $event->id,
                'event_type' => $event->type,
                'created_at' => now(),
                'updated_at' => now(),
            ]) === 0;

            if ($alreadyProcessed) {
                DB::rollBack();
                return response()->json(['status' => 'already_processed']);
            }

            $paymentIntent = $event->data->object ?? null;
            $invoice = null;

            switch ($event->type) {
                case 'payment_intent.succeeded':
                    $invoice = $this->handlePaymentIntentSucceeded($paymentIntent);
                    break;
                    
                case 'payment_intent.processing':
                    $invoice = $this->handlePaymentIntentProcessing($paymentIntent);
                    break;
                    
                case 'payment_intent.payment_failed':
                    $invoice = $this->handlePaymentIntentFailed($paymentIntent);
                    break;
                    
                case 'payment_intent.requires_action':
                    $invoice = $this->handlePaymentIntentRequiresAction($paymentIntent);
                    break;
                    
                case 'payment_intent.created':
                case 'payment_intent.canceled':
                case 'payment_intent.amount_capturable_updated':
                    // Log these events but no action needed
                    Log::debug('Stripe event received', [
                        'type' => $event->type,
                        'payment_intent' => $paymentIntent->id ?? null,
                        'status' => $paymentIntent->status ?? null
                    ]);
                    break;
                    
                default:
                    Log::debug('Unhandled Stripe event type', ['type' => $event->type]);
            }

            if ($paymentIntent) {
                Log::debug('Stripe Webhook Processed', [
                    'event_type' => $event->type,
                    'payment_intent' => $paymentIntent->id ?? null,
                    'status' => $paymentIntent->status ?? null,
                    'invoice_id' => $invoice->i_invoice_number ?? null
                ]);
            }

            DB::commit();
            return response()->json(['status' => 'success']);

        } catch (\Throwable $e) {
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }
            Log::error('Stripe webhook handler error', [
                'error' => $e->getMessage(),
                'event_type' => $event->type ?? null,
                'payment_intent' => $paymentIntent->id ?? null
            ]);
            return response()->json(['error' => 'Handler processing failed'], 500);
        }
    }

    protected function handlePaymentIntentSucceeded($paymentIntent)
    {
        if (!$paymentIntent) {
            Log::error('PaymentIntent is null in handlePaymentIntentSucceeded');
            return null;
        }

        $invoice = Invoice::where('i_payment_intent_id', $paymentIntent->id)
            ->where('invoice_id', $paymentIntent->metadata->invoice_id ?? null)
            ->where('i_invoice_number', $paymentIntent->metadata->invoice_number ?? null)
            ->first();

        if ($invoice && ((int) $paymentIntent->amount !== (int) round(((float) $invoice->i_total) * 100)
            || (isset($paymentIntent->amount_received) && (int) $paymentIntent->amount_received !== (int) round(((float) $invoice->i_total) * 100))
            || strtolower((string) $paymentIntent->currency) !== 'usd'
            || (bool) $paymentIntent->livemode !== (config('services.stripe.mode', 'test') === 'live'))) {
            Log::critical('Stripe payment does not match invoice amount, currency, or configured mode.', [
                'invoice_number' => $invoice->i_invoice_number,
                'payment_intent' => $paymentIntent->id,
                'currency' => $paymentIntent->currency ?? null,
                'mode' => ! empty($paymentIntent->livemode) ? 'live' : 'test',
            ]);

            return null;
        }
        
        if ($invoice && $invoice->i_status !== 'paid') {
            $updateData = [
                'i_status' => 'paid',
                'i_payment_status' => self::PAYMENT_STATUS_SUCCEEDED,
                'i_payment_date' => now(),
                'i_amount_paid' => $invoice->i_total,
                'i_payment_method' => $paymentIntent->payment_method_types[0] ?? 'us_bank_account',
                'i_microdeposit_verified' => $this->wasMicrodepositVerified($paymentIntent)
            ];

            // Store relevant payment intent data without sensitive info
            $updateData['i_payment_metadata'] = [
                'amount' => $paymentIntent->amount,
                'currency' => $paymentIntent->currency,
                'payment_method_type' => $paymentIntent->payment_method_types[0] ?? null,
                'verification_method' => $paymentIntent->payment_method->us_bank_account->verification_method ?? null,
                'bank_name' => $paymentIntent->payment_method->us_bank_account->bank_name ?? null,
                'last4' => $paymentIntent->payment_method->us_bank_account->last4 ?? null
            ];

            $invoice->update($updateData);
            
            // Send payment success email
            $this->sendPaymentSuccessEmail($invoice, $paymentIntent);
        }
        
        return $invoice;
    }

    protected function handlePaymentIntentProcessing($paymentIntent)
    {
        if (!$paymentIntent) {
            Log::error('PaymentIntent is null in handlePaymentIntentProcessing');
            return null;
        }

        $invoice = Invoice::where('i_payment_intent_id', $paymentIntent->id)->first();
        
        if ($invoice && $invoice->i_status !== 'paid') {
            $invoice->update([
                'i_payment_status' => self::PAYMENT_STATUS_PENDING,
                'i_payment_metadata' => [
                    'status' => 'processing',
                    'expected_completion' => now()->addDays(2)->toDateTimeString()
                ]
            ]);
            
            // Send processing notification email
            $this->sendPaymentProcessingEmail($invoice, $paymentIntent);
        }
        
        return $invoice;
    }

    protected function handlePaymentIntentFailed($paymentIntent)
    {
        if (!$paymentIntent) {
            Log::error('PaymentIntent is null in handlePaymentIntentFailed');
            return null;
        }

        $invoice = Invoice::where('i_payment_intent_id', $paymentIntent->id)->first();
        
        if ($invoice && $invoice->i_status !== 'paid') {
            $failureMessage = $paymentIntent->last_payment_error->message ?? 'Payment failed';
            
            $invoice->update([
                'i_payment_status' => self::PAYMENT_STATUS_FAILED,
                'i_payment_metadata' => [
                    'failure_reason' => $failureMessage,
                    'failure_code' => $paymentIntent->last_payment_error->code ?? null,
                    'payment_method_type' => $paymentIntent->payment_method_types[0] ?? null
                ]
            ]);
            
            // Send payment failed email
            $this->sendPaymentFailedEmail($invoice, $paymentIntent, $failureMessage);
        }
        
        return $invoice;
    }

    protected function handlePaymentIntentRequiresAction($paymentIntent)
    {
        if (!$paymentIntent) {
            Log::error('PaymentIntent is null in handlePaymentIntentRequiresAction');
            return null;
        }

        $invoice = Invoice::where('i_payment_intent_id', $paymentIntent->id)->first();
        
        if ($invoice) {
            $verification = $paymentIntent->next_action->verify_with_microdeposits ?? null;
            $isAchMicrodepositVerification = in_array('us_bank_account', $paymentIntent->payment_method_types ?? [], true)
                && ($paymentIntent->next_action->type ?? null) === 'verify_with_microdeposits'
                && $verification !== null;

            // A card requiring 3DS also emits requires_action. It is not an ACH
            // microdeposit flow and must not trigger the bank verification email.
            if (! $isAchMicrodepositVerification) {
                if ($invoice->i_status !== 'paid') {
                    $invoice->update([
                        'i_payment_status' => self::PAYMENT_STATUS_PENDING,
                        'i_payment_metadata' => ['status' => 'requires_action'],
                    ]);
                }

                return $invoice;
            }

            $verificationUrl = $verification->hosted_verification_url ?? null;
            $arrivalDate = $verification->arrival_date ?? null;

            $updateData = [
                'i_payment_status' => self::PAYMENT_STATUS_REQUIRES_VERIFICATION,
                'i_payment_metadata' => [
                    'verification_url' => $verificationUrl,
                    'arrival_date' => $arrivalDate ? date('Y-m-d H:i:s', $arrivalDate) : null,
                    'microdeposit_type' => $verification->microdeposit_type ?? null
                ]
            ];

            $invoice->update($updateData);
            
            // Send verification required email
            $this->sendVerificationRequiredEmail($invoice, $paymentIntent, $verificationUrl);
        }
        
        return $invoice;
    }

    protected function wasMicrodepositVerified($paymentIntent)
    {
        return isset($paymentIntent->payment_method_details->us_bank_account->verification_method) &&
            $paymentIntent->payment_method_details->us_bank_account->verification_method === 'automatic';
    }

    // Email Notification Methods
protected function sendPaymentSuccessEmail($invoice, $paymentIntent)
{
    try {
        $customerEmail = $paymentIntent->metadata->customer_email ?? $invoice->tenant->email;
        $customerName = $paymentIntent->metadata->customer_name ?? $invoice->tenant->name;
        $amount = '$' . number_format($paymentIntent->amount / 100, 2);
        $paymentMethod = $this->getPaymentMethodName($paymentIntent->payment_method_types[0] ?? '');

        $emailResponse = Email_functions::sendNewEmail_For_Webhook(
            $customerEmail,
            'Payment Received - Thank You',
            'email_templates.Invoice_Alert_Email',
            [],
            'notification@readyrentalsonline.com',
            config('app.name') . ' System',
            [
                'title' => 'Payment Received',
                'heading' => 'Payment Successful',
                'status' => 'paid',
                'statusText' => 'Payment Received',
                'content' => "
                    <p>Hello $customerName,</p>
                    <p>We've successfully received your payment of <strong>$amount</strong> for invoice <strong>{$invoice->i_invoice_number}</strong>.</p>
                    
                    <p><strong>Payment Details:</strong></p>
                    <ul>
                        <li>Payment Method: $paymentMethod</li>
                        <li>Date: " . now()->format('M j, Y') . "</li>
                        <li>Transaction ID: {$paymentIntent->id}</li>
                    </ul>
                    
                    <p>Thank you for your payment!</p>
                ",
                'actionUrl' => url('/invoices/pay/' . $invoice->i_invoice_number),
                'actionText' => 'View Invoice Details'
            ]
        );

        Log::info('Attempting to send payment success email', [
            'invoice_id' => $invoice->i_invoice_number,
            'recipient' => $customerEmail,
            'payment_intent' => $paymentIntent->id
        ]);

        Log::debug('Payment success email response', [
            'response' => $emailResponse,
            'email_details' => [
                'to' => $customerEmail,
                'subject' => 'Payment Received - Thank You',
                'from' => 'notification@readyrentalsonline.com'
            ]
        ]);

        if ($emailResponse['res_code'] === 200) {
            Log::info('Payment success email sent successfully', [
                'invoice_id' => $invoice->i_invoice_number,
                'recipient' => $customerEmail
            ]);
            return true;
        } else {
            Log::error('Failed to send payment success email', [
                'invoice_id' => $invoice->i_invoice_number,
                'recipient' => $customerEmail,
                'response' => $emailResponse
            ]);
            return false;
        }

    } catch (\Exception $e) {
        Log::error('Error sending payment success email', [
            'error' => $e->getMessage(),
            'invoice_id' => $invoice->i_invoice_number ?? null,
            'payment_intent' => $paymentIntent->id ?? null,
            'trace' => $e->getTraceAsString()
        ]);
        return false;
    }
}

protected function sendPaymentProcessingEmail($invoice, $paymentIntent)
{
    try {
        $customerEmail = $paymentIntent->metadata->customer_email ?? $invoice->tenant->email;
        $customerName = $paymentIntent->metadata->customer_name ?? $invoice->tenant->name;

        $emailResponse = Email_functions::sendNewEmail_For_Webhook(
            $customerEmail,
            'Payment Processing',
            'email_templates.Invoice_Alert_Email',
            [],
            'notification@readyrentalsonline.com',
            config('app.name') . ' System',
            [
                'title' => 'Payment Processing',
                'heading' => 'Payment Processing',
                'status' => 'pending',
                'statusText' => 'Processing',
                'content' => "
                    <p>Hello $customerName,</p>
                    <p>Your payment for invoice <strong>{$invoice->i_invoice_number}</strong> is currently being processed.</p>
                    
                    <p>This typically takes 1-2 business days to complete. You'll receive another notification once the payment has been successfully processed.</p>
                    
                    <p>Thank you for your patience.</p>
                ",
                'actionUrl' => url('/invoices/pay/' . $invoice->i_invoice_number),
                'actionText' => 'View Invoice Details'
            ]
        );

        Log::info('Attempting to send payment processing email', [
            'invoice_id' => $invoice->i_invoice_number,
            'recipient' => $customerEmail
        ]);

        Log::debug('Payment processing email response', [
            'response' => $emailResponse,
            'email_details' => [
                'to' => $customerEmail,
                'subject' => 'Payment Processing',
                'from' => 'notification@readyrentalsonline.com'
            ]
        ]);

        if ($emailResponse['res_code'] === 200) {
            Log::info('Payment processing email sent successfully', [
                'invoice_id' => $invoice->i_invoice_number,
                'recipient' => $customerEmail
            ]);
            return true;
        } else {
            Log::error('Failed to send payment processing email', [
                'invoice_id' => $invoice->i_invoice_number,
                'recipient' => $customerEmail,
                'response' => $emailResponse
            ]);
            return false;
        }

    } catch (\Exception $e) {
        Log::error('Error sending payment processing email', [
            'error' => $e->getMessage(),
            'invoice_id' => $invoice->i_invoice_number ?? null,
            'trace' => $e->getTraceAsString()
        ]);
        return false;
    }
}

protected function sendPaymentFailedEmail($invoice, $paymentIntent, $failureMessage)
{
    try {
        $customerEmail = $paymentIntent->metadata->customer_email ?? $invoice->tenant->email;
        $customerName = $paymentIntent->metadata->customer_name ?? $invoice->tenant->name;

        $emailResponse = Email_functions::sendNewEmail_For_Webhook(
            $customerEmail,
            'Payment Failed - Action Required',
            'email_templates.Invoice_Alert_Email',
            [],
            'notification@readyrentalsonline.com',
            config('app.name') . ' System',
            [
                'title' => 'Payment Failed',
                'heading' => 'Payment Failed',
                'status' => 'failed',
                'statusText' => 'Payment Failed',
                'content' => "
                    <p>Hello $customerName,</p>
                    <p>We couldn't process your payment for invoice <strong>{$invoice->i_invoice_number}</strong>.</p>
                    
                    <p><strong>Reason:</strong> $failureMessage</p>
                    
                    <p>Please try again or contact our support team at 
                        <a href=\"mailto:support@readyrentalsonline.com\">support@readyrentalsonline.com</a> 
                        for assistance.
                    </p>
                ",
                'actionUrl' => url('/invoices/pay/' . $invoice->i_invoice_number),
                'actionText' => 'Try Payment Again',
                'actionStyle' => 'background-color: #EF8354; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block; font-weight: bold;'
            ]
        );

        Log::info('Attempting to send payment failed email', [
            'invoice_id' => $invoice->i_invoice_number,
            'recipient' => $customerEmail,
            'failure_reason' => $failureMessage
        ]);

        Log::debug('Payment failed email response', [
            'response' => $emailResponse,
            'email_details' => [
                'to' => $customerEmail,
                'subject' => 'Payment Failed - Action Required',
                'from' => 'notification@readyrentalsonline.com'
            ]
        ]);

        if ($emailResponse['res_code'] === 200) {
            Log::info('Payment failed email sent successfully', [
                'invoice_id' => $invoice->i_invoice_number,
                'recipient' => $customerEmail
            ]);
            return true;
        } else {
            Log::error('Failed to send payment failed email', [
                'invoice_id' => $invoice->i_invoice_number,
                'recipient' => $customerEmail,
                'response' => $emailResponse
            ]);
            return false;
        }

    } catch (\Exception $e) {
        Log::error('Error sending payment failed email', [
            'error' => $e->getMessage(),
            'invoice_id' => $invoice->i_invoice_number ?? null,
            'trace' => $e->getTraceAsString()
        ]);
        return false;
    }
}

protected function sendVerificationRequiredEmail($invoice, $paymentIntent, $verificationUrl)
{
    try {
        $customerEmail = $paymentIntent->metadata->customer_email ?? $invoice->tenant->email;
        $customerName = $paymentIntent->metadata->customer_name ?? $invoice->tenant->name;
        $arrivalDate = $paymentIntent->next_action->verify_with_microdeposits->arrival_date ?? '1-2 business days';

        $emailResponse = Email_functions::sendNewEmail_For_Webhook(
            $customerEmail,
            'Action Required: Verify Your Bank Account',
            'email_templates.Invoice_Alert_Email',
            [],
            'notification@readyrentalsonline.com',
            config('app.name') . ' System',
            [
                'title' => 'Bank Account Verification Required',
                'heading' => 'Verification Required',
                'status' => 'verification',
                'statusText' => 'Verification Needed',
                'content' => "
                    <p>Hello $customerName,</p>
                    <p>Your payment for invoice <strong>{$invoice->i_invoice_number}</strong> requires verification.</p>
                    
                    <p>We've sent two small deposits to your bank account (they should arrive within $arrivalDate).</p>
                ",
                'actionUrl' => $verificationUrl,
                'actionText' => 'Verify Bank Account',
                'actionStyle' => 'background-color: #414EF9; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block; font-weight: bold;'
            ]
        );

        Log::info('Attempting to send verification required email', [
            'invoice_id' => $invoice->i_invoice_number,
            'recipient' => $customerEmail,
            'verification_url' => $verificationUrl
        ]);

        Log::debug('Verification required email response', [
            'response' => $emailResponse,
            'email_details' => [
                'to' => $customerEmail,
                'subject' => 'Action Required: Verify Your Bank Account',
                'from' => 'notification@readyrentalsonline.com'
            ]
        ]);

        if ($emailResponse['res_code'] === 200) {
            Log::info('Verification required email sent successfully', [
                'invoice_id' => $invoice->i_invoice_number,
                'recipient' => $customerEmail
            ]);
            return true;
        } else {
            Log::error('Failed to send verification required email', [
                'invoice_id' => $invoice->i_invoice_number,
                'recipient' => $customerEmail,
                'response' => $emailResponse
            ]);
            return false;
        }

    } catch (\Exception $e) {
        Log::error('Error sending verification required email', [
            'error' => $e->getMessage(),
            'invoice_id' => $invoice->i_invoice_number ?? null,
            'trace' => $e->getTraceAsString()
        ]);
        return false;
    }
}

    protected function getPaymentMethodName($paymentMethodType)
    {
        $types = [
            'us_bank_account' => 'Bank Account (ACH)',
            'card' => 'Credit/Debit Card'
        ];
        
        return $types[$paymentMethodType] ?? ucfirst(str_replace('_', ' ', $paymentMethodType));
    }
}
