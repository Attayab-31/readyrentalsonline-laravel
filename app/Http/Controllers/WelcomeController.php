<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log; // Ensure this is imported at the top

use Illuminate\Http\Request;
use App\Http\Helpers\Email_functions;

use App\Models\User;
use App\Models\AppSetting;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyAmenity;
use App\Models\Invoice;

use App\Models\Message;
use App\Mail\ContactInquiryMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
 
use Stripe;

class WelcomeController extends Controller
{


    public function data_migration()
    {

        // ALTER TABLE `property_applications` ADD `pa_additional_documents` TEXT NULL DEFAULT NULL AFTER `pa_application_terms_agreement`;
        
        // ALTER TABLE `property_applications` ADD `e_sign` VARCHAR(500) NULL DEFAULT NULL AFTER `pa_additional_documents`;



    }



 
public static function deleteDirectory($directory)
{
    if (!is_dir($directory)) {
        return;
    }

    $files = array_diff(scandir($directory), array('.', '..'));

    foreach ($files as $file) {
        $filePath = $directory . DIRECTORY_SEPARATOR . $file;

        if (is_dir($filePath)) {
            self::deleteDirectory($filePath);
        } else {
            unlink($filePath);
        }
    }

    rmdir($directory);
}

  




    public function index()
    {   
 
        $db_data['Property'] = Property::where('p_active_status' , 'active')->get();
             
        $page_meta_data = array(
                                'page_title'=>'Welcome to '.config('app.name'),
                                ); 

        return view('welcome' ,compact('db_data'))->with($page_meta_data);
    }



    public function about_us()
    {   

        $db_data['User_Count'] = User::count();
        $db_data['Property_Count'] = Property::count();
            
        $page_meta_data = array(
                                'page_title'=>'learn more about us | '.config('app.name'),
                                ); 

        return view('about_us' ,compact('db_data'))->with($page_meta_data);
    }



    public function contact_us()
    {   

        $db_data['User_Count'] = User::count();
        $db_data['Property_Count'] = Property::count();
            
        $page_meta_data = array(
                                'page_title'=>'Get in touch with Us | '.config('app.name'),
                                ); 

        return view('contact_us' ,compact('db_data'))->with($page_meta_data);
    }


    public function process_form(Request $request)
    {   

        $messages = [
                    ];

        $attributes = [
                       'full_name' => 'Full name',
                       'email' => 'Email address',
                       'service_type' => 'Service type',
                       'phone_number' => 'Phone number',
                       'message' => 'Message',
                      ];
        $Rules= [
                'full_name' => 'required',
                'email' => 'required|email',
                'service_type' => 'required',
                'phone_number' => 'required',
                'message' => 'required',
                ];

        $validatedData = $request->validate($Rules, $messages, $attributes);
        $settings = AppSetting::find(1);
        $recipients = collect(explode(',', (string) ($settings?->as_contact_us_email_recipients ?: config('mail.contact_recipients', ''))))
            ->map(fn ($email) => trim($email))
            ->filter(fn ($email) => filter_var($email, FILTER_VALIDATE_EMAIL))
            ->unique()
            ->values()
            ->all();

        $email_res = ['res_code' => 500];

        if ($recipients !== []) {
            try {
                $mailerName = config('mail.default');
                $smtpReady = $settings
                    && filled($settings->as_smtp_host)
                    && filled($settings->as_smtp_port);

                if ($smtpReady) {
                    $mailerName = 'contact_form_smtp';
                    Config::set("mail.mailers.{$mailerName}", [
                        'transport' => 'smtp',
                        'host' => $settings->as_smtp_host,
                        'port' => (int) $settings->as_smtp_port,
                        'encryption' => $settings->as_smtp_security_protocol ?: null,
                        'username' => $settings->as_smtp_username,
                        'password' => $settings->as_smtp_password,
                        'timeout' => 15,
                        'local_domain' => parse_url(config('app.url'), PHP_URL_HOST),
                    ]);
                    Config::set("mail.mailers.{$mailerName}.from", [
                        'address' => $settings->as_smtp_send_from ?: config('mail.from.address'),
                        'name' => config('mail.from.name', config('app.name')),
                    ]);
                }

                Mail::mailer($mailerName)
                    ->to($recipients)
                    ->send(new ContactInquiryMail($validatedData));

                $email_res = ['res_code' => 200];
            } catch (\Throwable $exception) {
                Log::error('Contact inquiry email could not be sent.', [
                    'exception' => $exception->getMessage(),
                    'recipient_count' => count($recipients),
                ]);
            }
        } else {
            Log::error('Contact inquiry email could not be sent because no valid recipients are configured.');
        }


        if($email_res['res_code'] == 200)
        {
            $res = array(
                        'res_code' => 200,
                        'res_msg_markup' =>'<div class="alert alert-success" role="alert"><b><i class="fas fa-check"></i> Inquiry Recieved!</b><br>
                                                Thank You! We have recieved your message and we will try to get back to you as soon as possible.</div>
                                           '
                        );
        }
        else
        {
            $res = array(
                        'res_code' => 100,
                        'res_msg_markup' =>'<div class="alert alert-danger" role="alert"><b><i class="fas fa-times"></i> Email not sent!</b><br>
                                                Something went wrong. Please try again later.</div>'
                        );
        }

        $success = $res['res_code'] === 200;
        $res['res_msg_markup'] = view('partials.contact_submission_status', ['success' => $success])->render();

        if ($request->expectsJson()) {
            return response()->json($res);
        }

        return redirect('/contact-us')
            ->with('contact_submission_status', $success ? 'success' : 'error')
            ->withInput($success ? [] : $request->except('_token'));

    }    



    public function pay_invoice($i_invoice_number="")
    {
    
        $invoice = Invoice::with('tenant')->where('i_invoice_number', $i_invoice_number)->first();
        if(!$invoice){
            abort(404);
        }   
        
        $page_meta_data = array(
                                'page_title'=>'Pay Invoice | '.config('app.name'),
                                ); 

        return view('pay_invoice' , compact('invoice'))->with($page_meta_data);
    }





    public function process_invoice_payment(Request $request, $i_invoice_number="")
    {  
 
        $validatedData = $request->validate([
            'card_holder_name' => 'required|max:255',
            'card_number' => 'required|min:13|numeric',
            'expiry_month' => 'required|numeric|min:1|min:2',
            'expiry_year' => 'required|digits:4',
            'cvc' => 'required|digits:3',
            'stripeToken' => 'required',
            ]);

        $card_name = $request->card_holder_name;
        $cardnumber = $request->card_number;
        $expiry_month = $request->expiry_month;
        $expiry_year = $request->expiry_year;
        $cardcvc = $request->cvc;
        $stripeToken = $request->stripeToken;
            


    
        $invoice = Invoice::where('i_invoice_number', $i_invoice_number)->first();
        if(!$invoice)
        {
            echo "Invoice Not Found";
            die;
            // return redirect()-back()->with('failure', 'Invoice not found.');
        }

        $amount = $invoice->i_total;


        if($amount > 0)
        {
            Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            try
            {    
                $curreny_symbol = 'usd';
                $description = "Invoice Payment";

                $res = \Stripe\Charge::create([
                        "amount" => $amount * 100,
                        "currency" => "usd",
                        "source"   => $stripeToken, // obtained with Stripe.js
                        "receipt_email"   => 'Readyrentals1@gmail.com', // Send reciept to this address
                        "description" => $description
                        ]);

                        
                $vendor_payment_id = $res['id'];
                $paid_status = $res['paid'];
                $receipt_url = $res['receipt_url'];
 

                $invoice->i_status = "paid";
                $invoice->i_vendor_response = $res;
                $invoice->i_payment_method = 'STRIPE';
                $invoice->save();
 
    

                // Send Alert to the Admin About Invoide Payment 
                $to = "Readyrentals1@gmail.com";
                $subject = $invoice->tenant->first_name.' '.$invoice->tenant->last_name." has paid the Invoice!";

                $result = Email_functions::sendNewEmail_For_Webhook(
                    $to,
                    $subject,
                    'email_templates.Invoice_Alert_Email',
                    [],
                    'notification@readyrentalsonline.com',
                    'Ready Rentals Online',
                    [
                        'heading' => 'Invoice payment received',
                        'status' => 'paid',
                        'statusText' => 'Payment received',
                        'content' => '<p>' . e(trim($invoice->tenant->first_name . ' ' . $invoice->tenant->last_name))
                            . ' paid invoice <strong>' . e($invoice->i_invoice_number)
                            . '</strong> in the amount of <strong>$' . number_format((float) $invoice->i_total, 2) . '</strong>.</p>',
                        'actionUrl' => url('/accounts/invoices'),
                        'actionText' => 'View invoices',
                    ]
                );


                return redirect()->back()->with('success','booking-confirmed');
            }
            catch(Exception $e)
            {
                $stripe_data['status'] = 0;
                $stripe_data['response'] = $e->getMessage();
                echo $stripe_data['response'] = $e->getMessage();
            }
        }
        else{
            echo "Your cart is Empty";

        }

    }
    
    
    
    
    public function createPaymentIntent(Request $request)
    {
        try {
            // Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            
            \Log::info('Creating PaymentIntent for invoice: ' . $request->invoice_number . ' with amount: ' . $request->amount);
            
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $request->amount,
                'currency' => 'usd',
                'description' => 'Invoice Payment: ' . $request->invoice_number,
                'metadata' => [
                    'invoice_number' => $request->invoice_number
                ],
            ]);
            
            \Log::info('PaymentIntent created successfully: ' . $paymentIntent->id);
            
            return response()->json(['clientSecret' => $paymentIntent->client_secret]);
        } catch (\Exception $e) {
            \Log::error('Failed to create PaymentIntent: ' . $e->getMessage());
            \Log::error('Request data: ' . json_encode($request->all()));
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function completePayment(Request $request)
    {
        try {
            // Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            
            \Log::info('Completing payment for PaymentIntent: ' . $request->payment_intent_id);
            
            // Verify the payment intent
            $paymentIntent = \Stripe\PaymentIntent::retrieve($request->payment_intent_id);
            
            if ($paymentIntent->status !== 'succeeded') {
                $errorMsg = 'Payment not completed. Current status: ' . $paymentIntent->status;
                \Log::error($errorMsg);
                throw new \Exception($errorMsg);
            }
            
            \Log::info('PaymentIntent status verified as succeeded');
            
            // Update your invoice
            $invoice = Invoice::where('i_invoice_number', $request->invoice_number)->firstOrFail();
            $invoice->i_status = "paid";
            $invoice->i_vendor_response = json_encode($paymentIntent);
            $invoice->i_payment_method = 'STRIPE';
            $invoice->save();
            
            \Log::info('Invoice updated successfully: ' . $request->invoice_number);
            
            // Send email notification
            Email_functions::sendNewEmail_For_Webhook(
                "Readyrentals1@gmail.com",
                $invoice->tenant->first_name.' '.$invoice->tenant->last_name." has paid the Invoice!",
                'email_templates.Invoice_Alert_Email',
                [],
                'notification@readyrentalsonline.com',
                'Ready Rentals Online',
                [
                    'heading' => 'Invoice payment received',
                    'status' => 'paid',
                    'statusText' => 'Payment received',
                    'content' => '<p>' . e(trim($invoice->tenant->first_name . ' ' . $invoice->tenant->last_name))
                        . ' paid invoice <strong>' . e($invoice->i_invoice_number)
                        . '</strong> in the amount of <strong>$' . number_format((float) $invoice->i_total, 2) . '</strong>.</p>',
                    'actionUrl' => url('/accounts/invoices'),
                    'actionText' => 'View invoices',
                ]
            );
            
            \Log::info('Payment confirmation email sent');
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Payment completion failed: ' . $e->getMessage());
            \Log::error('Request data: ' . json_encode($request->all()));
            if (isset($paymentIntent)) {
                \Log::error('PaymentIntent details: ' . json_encode($paymentIntent));
            }
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    
    // Create me a function that will send an email to all users with unread messages in the last 15 minutes

    public function sendUnreadMessagesAlert(Request $request)
    {   
        $expectedToken = (string) config('services.unread_message_alert_token');
        $providedToken = (string) $request->header('X-Alert-Token');
        abort_unless($expectedToken !== '' && hash_equals($expectedToken, $providedToken), 403);

        $emails = [];
        // Get users with unread messages in the last 15 minutes
        $unread_messages = Message::where('is_read', false)
                                    ->where('created_at', '>=', now()->subMinutes(15))
                                    ->with('receiver')
                                    ->get();
 
        foreach ($unread_messages as $MESSAGE)
        {
            $emails[] = $MESSAGE->receiver->email;
        }


        if($emails == null || count($emails) == 0)
        {
            return;
        }
 
        /*Send Email to Admin About new Application*/
        $email_content="
                        <h2>You have a new message on ReadyRentalsOnline.com<br></h2>
                        <h3>Please login to your account to view the message.<br></h3>
                    ";


        $db_data['body'] = $email_content;
        $result = Email_functions::sendNewEmail(
            'notification@readyrentalsonline.com',
            'Ready Rentals Online Message Notification',
            'email_templates.general_email_template',
            $emails,
            'notification@readyrentalsonline.com',
            config('app.name') . ' System',
            compact('db_data')
        );

        if (($result['res_code'] ?? null) === 200) {
            Log::info('Message alert email accepted by the configured mail transport.', [
                'recipient_count' => count($emails),
            ]);
        } else {
            Log::error('Message alert email could not be sent.', [
                'recipient_count' => count($emails),
                'error' => $result['message'] ?? 'Unknown mail transport error.',
            ]);
        }

    }

 


}
