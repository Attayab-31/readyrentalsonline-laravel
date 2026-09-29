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

use PHPMailer\PHPMailer;
use App\Models\Message;
 
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

        $validatedData = $request->validate($Rules , $messages , $attributes);


        $email_content = "
                        <h2>Full name: <small>$request->full_name</small></h2>
                        <h2>Email: <small>$request->email</small></h2>
                        <h2>Service Type: <small>$request->service_type</small></h2>
                        <h2>Phone Number: <small>$request->phone_number</small></h2>
                        <h2>Message: <small>$request->message</small></h2>
                       ";

        $email_details = array(
                               'email_type' => "contact_us_form", 
                               'email_subject' => config('app.name')."| New Message Recieved",
                               'body' => $email_content, 
                               'view_to_use' => "email_templates.general_email_template",
                              ); 
        
        $email_res = Email_functions::send_email($email_details);


        if($email_res['res_code'] == 200)
        {
            $res = array(
                        'res_code' => 200,
                        'res_msg_markup' =>'<div class="alert alert-success" role="alert"><b><i class="fas fa-check"></i> Inquiry Recieved!</b><br>
                                                Thank You! We have recieved your message and we will try to get back to you as soon as possible.</div>
                                           '
                        );
        }
        elseif($email_res['res_code'] == 100)
        {
            $res = array(
                        'res_code' => 100,
                        'res_msg_markup' =>'<div class="alert alert-danger" role="alert"><b><i class="fas fa-times"></i> Email not sent!</b><br>
                                                Something went wrong. Please try again leter!</div>
                                            '                     
                        );
        }        
        else
        {
            $res = array(
                        'res_code' => 300,
                        'res_msg_markup' =>'<div class="alert alert-primary" role="alert"><b><i class="fas fa-times"></i> Somting went wrong!</b><br>
                                                Something went wrong. Please try again leter!</div>'                     
                        );
        }


        return $res;

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
                $emailBody = view('email_templates.Invoice_Alert_Email', compact('invoice'))->render();
                $to = "Readyrentals1@gmail.com";
                $subject = $invoice->tenant->first_name.' '.$invoice->tenant->last_name." has paid the Invoice!";

                $result = Email_functions::sendNewEmail(
                    $to,
                    $subject,
                    $emailBody
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
            $emailBody = view('email_templates.Invoice_Alert_Email', compact('invoice'))->render();
            Email_functions::sendNewEmail(
                "Readyrentals1@gmail.com",
                $invoice->tenant->first_name.' '.$invoice->tenant->last_name." has paid the Invoice!",
                $emailBody
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


        $mail = new PHPMailer\PHPMailer(); // Create a new PHPMailer instance
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = false; // Authentication disabled

        $mail->CharSet = 'UTF-8';
        $mail->IsHTML(true);
        $mail->SetFrom("notification@readyrentalsonline.com", config('app.name') . ' System');
        $mail->Subject = "Ready Rentals Online Message Notification";
        $mail->Body = view('email_templates.general_email_template', compact('db_data'));
        $mail->AddAddress('notification@readyrentalsonline.com');
 
        foreach ($emails as $email)
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL))
            { 
                // Add address to BCC
                $mail->AddBCC($email); 
            }
        }
        
        // Send the email and check for success or failure
        if ($mail->Send())
        {
            // Add Log Here for email sent with reciepeitns emails
            Log::info('Message Alert Email Sent to: '.implode(',', $emails));
        }
        else
        {   
            // Add Log Here for email not sent with reciepeitns emails with the error message
            Log::error('Message Alert Email Not Sent to: '.implode(',', $emails).' | Error: '.$mail->ErrorInfo);
        }

    }

 


}
