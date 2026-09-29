<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Invoice;
use Stripe\PaymentIntent;
use Stripe\StripeClient;
use Stripe\SetupIntent;

class InvoicePaymentController extends Controller
{
    // Stripe API keys
    
    // Set this to false for test mode, true for live mode
    
    // Webhook secret (if needed in this controller)
    
    public function __construct()
    {
        // Set Stripe API key based on mode
        Stripe::setApiKey(config('services.stripe.secret'));
    }
     
    public function pay_invoice(Request $request, $i_invoice_number)
    {
        $invoice = Invoice::with('tenant')->where('i_invoice_number', $i_invoice_number)->first();
        if(!$invoice){
            abort(404);
        } 
 
        $page_meta_data = array(
            'page_title' => 'Invoice Payment '.env('APP_NAME'),
            'stripe_mode' => config('services.stripe.mode', 'test')
        ); 
        
        return view('invoices.pay_invoice', compact('invoice'))->with($page_meta_data);
    }

    public function createIntentForACHPayment(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|exists:invoices,i_invoice_number',
            'name' => 'required|string',
            'email' => 'required|email',
            'amount' => 'required|numeric|min:0.50',
            'routingNumber' => 'required|string',
            'accountNumber' => 'required|string',
            'accountType' => 'required|in:checking,savings',
            'accountHolderType' => 'required|in:individual,company'
        ]);

        $invoice = Invoice::where('i_invoice_number', $validated['invoice_number'])->first();

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $validated['amount'] * 100, // Convert to cents
                'currency' => 'usd',
                'payment_method_types' => ['us_bank_account'],
                'payment_method_options' => [
                    'us_bank_account' => [
                        'verification_method' => 'automatic',
                    ],
                ],
                'metadata' => [
                    'invoice_id' => $invoice->invoice_id,
                    'invoice_number' => $invoice->i_invoice_number,
                    'customer_name' => $validated['name'],
                    'customer_email' => $validated['email'],
                    'mode' => config('services.stripe.mode', 'test') // Track mode in metadata
                ],
            ]);

            // Update invoice with payment intent ID
            $invoice->update([
                'i_payment_intent_id' => $paymentIntent->id,
                'i_payment_method' => Invoice::PAYMENT_METHOD_ACH,
                'i_payment_status' => Invoice::PAYMENT_STATUS_PENDING,
                'i_payment_mode' => config('services.stripe.mode', 'test')
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
                'paymentIntentId' => $paymentIntent->id,
                'mode' => config('services.stripe.mode', 'test')
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function verifyMicrodeposits_for_ACH(Request $request)
    {
        try {
            $paymentIntent = PaymentIntent::retrieve($request->paymentIntentId);
            
            $paymentIntent->verifyMicrodeposits([
                'amounts' => $request->amounts, // [32, 45] for test mode
            ]);

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        }
    }
 

    public function processCardPayment(Request $request)
    {
        $validated = $request->validate([
            'payment_method_id' => 'required|string',
            'invoice_number' => 'required|exists:invoices,i_invoice_number',
            'amount' => 'required|numeric|min:0.50',
            'email' => 'required|email',
            'name' => 'required|string'
        ]);

        $invoice = Invoice::where('i_invoice_number', $validated['invoice_number'])->first();

        try {
            // Create PaymentIntent with automatic payment methods
            $paymentIntent = PaymentIntent::create([
                'amount' => $validated['amount'] * 100, // Convert to cents
                'currency' => 'usd',
                'payment_method_types' => ['card'], // Explicitly specify card payments only
                'payment_method' => $validated['payment_method_id'],
                'confirm' => true,
                'metadata' => [
                    'invoice_id' => $invoice->invoice_id,
                    'invoice_number' => $invoice->i_invoice_number,
                    'customer_name' => $validated['name'],
                    'customer_email' => $validated['email'],
                    'mode' => config('services.stripe.mode', 'test')
                ],
                'receipt_email' => $validated['email'],
                'return_url' => url('/invoices/pay/' . $invoice->i_invoice_number . '?payment_status=completed'),
                'use_stripe_sdk' => true // This enables handling 3D Secure within your page
            ]);

            // Update invoice with payment intent ID
            $invoice->update([
                'i_payment_intent_id' => $paymentIntent->id,
                'i_payment_method' => 'card',
                'i_payment_status' => $paymentIntent->status,
                'i_payment_mode' => config('services.stripe.mode', 'test')
            ]);

            // If payment requires additional action (3D Secure)
            if ($paymentIntent->status === 'requires_action') {
                return response()->json([
                    'requiresAction' => true,
                    'clientSecret' => $paymentIntent->client_secret
                ]);
            }

            // If payment succeeded
            if ($paymentIntent->status === 'succeeded') {
                $invoice->update([
                    'i_status' => 'paid',
                    'i_payment_date' => now()
                ]);

                return response()->json([
                    'success' => true,
                    'clientSecret' => $paymentIntent->client_secret
                ]);
            }

            // For other statuses
            return response()->json([
                'error' => 'Payment processing failed. Status: ' . $paymentIntent->status
            ], 400);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }








}