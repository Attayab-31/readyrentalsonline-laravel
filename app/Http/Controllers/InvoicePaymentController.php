<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class InvoicePaymentController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey((string) config('services.stripe.secret'));
    }

    public function pay_invoice(Request $request, $i_invoice_number)
    {
        abort_unless($this->stripeConfigurationIsValid(), 503, 'Invoice payments are temporarily unavailable.');
        $invoice = Invoice::with('tenant')->where('i_invoice_number', $i_invoice_number)->firstOrFail();

        return view('invoices.pay_invoice', compact('invoice'))->with([
            'page_title' => 'Invoice Payment '.config('app.name'),
            'stripe_mode' => config('services.stripe.mode', 'test'),
        ]);
    }

    public function createIntentForACHPayment(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|exists:invoices,i_invoice_number',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'accountType' => 'required|in:checking,savings',
            'accountHolderType' => 'required|in:individual,company',
            'payment_request_id' => 'required|uuid',
        ]);

        return $this->createInvoicePaymentIntent($validated, Invoice::PAYMENT_METHOD_ACH);
    }

    public function verifyMicrodeposits_for_ACH(Request $request)
    {
        if (! $this->stripeConfigurationIsValid()) {
            return response()->json(['error' => 'Invoice payments are temporarily unavailable.'], 503);
        }

        $validated = $request->validate([
            'invoice_number' => 'required|string|exists:invoices,i_invoice_number',
            'paymentIntentId' => 'required|string|regex:/^pi_[A-Za-z0-9]+$/',
            'amounts' => 'required|array|size:2',
            'amounts.*' => 'required|integer|min:1|max:99',
        ]);

        $invoice = Invoice::where('i_invoice_number', $validated['invoice_number'])->firstOrFail();
        if ($invoice->i_payment_intent_id !== $validated['paymentIntentId']) {
            return response()->json(['error' => 'Payment session does not match this invoice.'], 409);
        }

        try {
            $paymentIntent = PaymentIntent::retrieve($validated['paymentIntentId']);
            if (($paymentIntent->metadata->invoice_id ?? null) != $invoice->invoice_id
                || ($paymentIntent->metadata->invoice_number ?? null) !== $invoice->i_invoice_number) {
                return response()->json(['error' => 'Payment session does not match this invoice.'], 409);
            }

            $paymentIntent->verifyMicrodeposits(['amounts' => $validated['amounts']]);

            return response()->json(['success' => true]);
        } catch (ApiErrorException $e) {
            Log::warning('Stripe ACH microdeposit verification failed', [
                'invoice_number' => $invoice->i_invoice_number,
                'payment_intent' => $validated['paymentIntentId'],
                'stripe_error_code' => $e->getStripeCode(),
                'http_status' => $e->getHttpStatus(),
            ]);

            return response()->json(['error' => 'Verification failed. Check the amounts and try again.'], 422);
        }
    }

    public function processCardPayment(Request $request)
    {
        $validated = $request->validate([
            'payment_method_id' => 'required|string|regex:/^pm_[A-Za-z0-9]+$/',
            'invoice_number' => 'required|string|exists:invoices,i_invoice_number',
            'email' => 'required|email|max:255',
            'name' => 'required|string|max:255',
            'payment_request_id' => 'required|uuid',
        ]);

        return $this->createInvoicePaymentIntent($validated, Invoice::PAYMENT_METHOD_CARD);
    }

    private function createInvoicePaymentIntent(array $validated, string $paymentMethod): \Illuminate\Http\JsonResponse
    {
        if (! $this->stripeConfigurationIsValid()) {
            return response()->json(['error' => 'Invoice payments are temporarily unavailable.'], 503);
        }

        $invoice = Invoice::where('i_invoice_number', $validated['invoice_number'])->firstOrFail();

        if ($invoice->i_status === 'paid') {
            return response()->json(['error' => 'This invoice has already been paid.'], 409);
        }

        // The amount is always derived from the saved invoice, never from browser input.
        $amount = (int) round(((float) $invoice->i_total) * 100);
        if ($amount < 50) {
            return response()->json(['error' => 'Invoice amount must be at least $0.50.'], 422);
        }

        try {
            $intentParams = [
                'amount' => $amount,
                'currency' => 'usd',
                'payment_method_types' => [$paymentMethod === Invoice::PAYMENT_METHOD_ACH ? 'us_bank_account' : 'card'],
                'metadata' => [
                    'invoice_id' => (string) $invoice->invoice_id,
                    'invoice_number' => (string) $invoice->i_invoice_number,
                    'customer_name' => $validated['name'],
                    'customer_email' => $validated['email'],
                    'mode' => config('services.stripe.mode', 'test'),
                ],
                'receipt_email' => $validated['email'],
                'return_url' => route('invoices.pay', ['i_invoice_number' => $invoice->i_invoice_number]),
            ];

            if ($paymentMethod === Invoice::PAYMENT_METHOD_CARD) {
                $intentParams['payment_method'] = $validated['payment_method_id'];
            } else {
                $intentParams['payment_method_options'] = [
                    'us_bank_account' => ['verification_method' => 'automatic'],
                ];
            }

            $paymentIntent = PaymentIntent::create($intentParams, [
                'idempotency_key' => 'invoice-'.$invoice->invoice_id.'-'.$paymentMethod.'-'.$validated['payment_request_id'],
            ]);

            $invoice->i_payment_intent_id = $paymentIntent->id;
            $invoice->i_payment_method = $paymentMethod;
            $invoice->i_payment_status = match ($paymentIntent->status) {
                'succeeded' => Invoice::PAYMENT_STATUS_SUCCEEDED,
                'processing' => 'processing',
                'canceled' => Invoice::PAYMENT_STATUS_FAILED,
                'requires_action' => $paymentMethod === Invoice::PAYMENT_METHOD_ACH
                    && ($paymentIntent->next_action->type ?? null) === 'verify_with_microdeposits'
                        ? Invoice::PAYMENT_STATUS_REQUIRES_VERIFICATION
                        : Invoice::PAYMENT_STATUS_PENDING,
                default => Invoice::PAYMENT_STATUS_PENDING,
            };
            $invoice->save();

            if ($paymentIntent->status === 'succeeded') {
                $invoice->i_payment_status = Invoice::PAYMENT_STATUS_SUCCEEDED;
                $invoice->i_payment_date = now();
                $invoice->i_amount_paid = $invoice->i_total;
                $invoice->save();
                return response()->json(['success' => true, 'paymentIntentId' => $paymentIntent->id]);
            }

            if ($paymentIntent->status === 'requires_action') {
                return response()->json([
                    'requiresConfirmation' => true,
                    'clientSecret' => $paymentIntent->client_secret,
                    'paymentIntentId' => $paymentIntent->id,
                ]);
            }

            if ($paymentMethod === Invoice::PAYMENT_METHOD_CARD && $paymentIntent->status === 'requires_confirmation') {
                return response()->json([
                    'requiresConfirmation' => true,
                    'clientSecret' => $paymentIntent->client_secret,
                    'paymentIntentId' => $paymentIntent->id,
                ]);
            }

            return response()->json([
                'success' => false,
                'status' => $paymentIntent->status,
                'paymentIntentId' => $paymentIntent->id,
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (ApiErrorException $e) {
            Log::warning('Stripe invoice payment creation failed', [
                'invoice_number' => $invoice->i_invoice_number,
                'payment_method' => $paymentMethod,
                'stripe_error_code' => $e->getStripeCode(),
                'http_status' => $e->getHttpStatus(),
            ]);

            return response()->json(['error' => 'Payment could not be started. Please check the payment details and try again.'], 422);
        }
    }

    private function stripeConfigurationIsValid(): bool
    {
        $mode = config('services.stripe.mode', 'test');
        if (! in_array($mode, ['test', 'live'], true)) {
            return false;
        }

        $prefix = $mode === 'live' ? 'live' : 'test';
        $publishableKey = (string) config('services.stripe.key');
        $secretKey = (string) config('services.stripe.secret');

        return str_starts_with($publishableKey, 'pk_'.$prefix.'_')
            && str_starts_with($secretKey, 'sk_'.$prefix.'_');
    }
}
