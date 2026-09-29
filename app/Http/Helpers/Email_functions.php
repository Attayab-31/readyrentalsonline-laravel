<?php
namespace App\Http\Helpers;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Ensure this is imported at the top

use App\Models\User;
use App\Models\AppSetting;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyAmenity;
use PHPMailer\PHPMailer;


class Email_functions
{


    public static function send_email($email_details = "",  $email_type = "", $view = "email_templates.general_email_template")
    {
        try {
            $db_data['email_type'] = $email_details['email_type'];
            $db_data['email_subject'] = $email_details['email_subject'];
            $db_data['body'] = $email_details['body'];
            $db_data['view_to_use'] = $email_details['view_to_use'];
    
            if ($db_data['email_subject'] == "" || $db_data['email_subject'] == null) {
                $db_data['email_subject'] = env("APP_NAME") . ": New Message Recieved";
            }
    
            $AppSetting = AppSetting::find(1);
    
            if ($AppSetting) {
                $as_contact_us_email_recipients = $AppSetting->as_contact_us_email_recipients;
    
                $as_smtp_host = $AppSetting->as_smtp_host;
                $as_smtp_security_protocol = $AppSetting->as_smtp_security_protocol;
                $as_smtp_port = $AppSetting->as_smtp_port;
                $as_smtp_username = $AppSetting->as_smtp_username;
                $as_smtp_password = $AppSetting->as_smtp_password;
                $as_smtp_send_from = $AppSetting->as_smtp_send_from;
    
                if ($as_smtp_host != "" && $as_smtp_port != "" && $as_smtp_username != "" && $as_smtp_password != "" && $as_smtp_send_from != "") {
                    $smtp_enabled = "yes";
                } else {
                    $smtp_enabled = "no";
                }
            } else {
                $as_contact_us_email_recipients = "";
                $smtp_enabled = "no";
            }
    
            $mail = new PHPMailer\PHPMailer(); // Create a new PHPMailer instance
    
            if ($smtp_enabled == "yes") {
                $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
                $mail->isSMTP();
                $mail->Host = $as_smtp_host;
                $mail->SMTPAuth = true;
                $mail->Username = $as_smtp_username;
                $mail->Password = $as_smtp_password;
                $mail->SMTPSecure = $as_smtp_security_protocol;
                $mail->Port = $as_smtp_port;
            } else {
                $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = false; // Authentication disabled
            }
            
            $mail->CharSet = 'UTF-8';
            $mail->IsHTML(true);
            $mail->SetFrom("notification@readyrentalsonline.com", env("APP_NAME") . ' System');
            $mail->Subject = $db_data['email_subject'];
            $mail->Body = view($db_data['view_to_use'], compact('db_data'));
    
            $emails = explode(',', $as_contact_us_email_recipients);
            foreach ($emails as $email) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $mail->AddAddress($email);
                }
            }
    
            // Send the email and check for success or failure
            if ($mail->Send()) {
                $res = array(
                    'res_code' => 200,
                );
            } else {
                $res = array(
                    'res_code' => 100,
                );
            }
    
            return $res;
    
        } catch (\Exception $e) {
            // Log the error with exception message
            Log::error('Email sending failed: ' . $e->getMessage());
    
            // Return failure response
            return array(
                'res_code' => 500,
                'message' => 'An error occurred while sending the email.',
            );
        }
    }
    

 

    public static function sendNewEmail(
        string|array $to,
        string $subject,
        string $view = "email_templates.general_email_template",
        array $bcc = [],
        string $fromEmail = "notification@readyrentalsonline.com",
        string $fromName = null,
        array $data = [] // Add this parameter
    ): array {
        $mail = new PHPMailer\PHPMailer(true); // Enable exceptions
    
        try {
            // Basic configuration
            $mail->SMTPDebug = 0;
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);
            
            // Set sender
            $fromName = $fromName ?? env("APP_NAME") . ' System';
            $mail->setFrom($fromEmail, $fromName);
            
            // Set subject and body
            $mail->Subject = $subject;
            
            // Add this line before sending:
            $mail->Body = view($view, $data)->render();
    
            // Process recipients
            if (is_string($to)) {
                $to = explode(',', $to);
            }
    
            foreach ($to as $email) {
                $email = trim($email);
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $mail->addAddress($email);
                }
            }
    
            // Add BCC recipients
            foreach ($bcc as $bccEmail) {
                $bccEmail = trim($bccEmail);
                if (filter_var($bccEmail, FILTER_VALIDATE_EMAIL)) {
                    $mail->addBCC($bccEmail);
                }
            }
        
        

            
            // Send email
            if ($mail->send()) {
                return [
                    'res_code' => 200,
                    'message' => 'Email sent successfully'
                ];
            }
    
        } catch (\Exception $e) {
            return [
                'res_code' => 500,
                'message' => 'Email sending failed: ' . $e->getMessage()
            ];
        }
    
        // Fallback return (should never reach here due to exception handling)
        return [
            'res_code' => 500,
            'message' => 'Unknown error occurred while sending email'
        ];
    }



    public static function sendNewEmail_For_Webhook(
        string|array $to,
        string $subject,
        string $view = "email_templates.Invoice_Alert_Email",
        array $bcc = [],
        string $fromEmail = "notification@readyrentalsonline.com",
        string $fromName = null,
        array $data = []
    ): array {
        $mail = new PHPMailer\PHPMailer(true); // Enable exceptions
    
        try {
            // Basic configuration
            $mail->SMTPDebug = 0;
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);
            
            // Set sender
            $fromName = $fromName ?? env("APP_NAME") . ' System';
            $mail->setFrom($fromEmail, $fromName);
            
            // Set subject and body
            $mail->Subject = $subject;
            $mail->Body = view($view, $data)->render();
    
            // Process recipients
            if (is_string($to)) {
                $to = explode(',', $to);
            }
    
            foreach ($to as $email) {
                $email = trim($email);
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $mail->addAddress($email);
                }
            }
    
            // Add BCC recipients
            foreach ($bcc as $bccEmail) {
                $bccEmail = trim($bccEmail);
                if (filter_var($bccEmail, FILTER_VALIDATE_EMAIL)) {
                    $mail->addBCC($bccEmail);
                }
            }
        
            // Send email
            if ($mail->send()) {
                return [
                    'res_code' => 200,
                    'message' => 'Email sent successfully'
                ];
            }
    
        } catch (\Exception $e) {
            return [
                'res_code' => 500,
                'message' => 'Email sending failed: ' . $e->getMessage()
            ];
        }
    
        // Fallback return (should never reach here due to exception handling)
        return [
            'res_code' => 500,
            'message' => 'Unknown error occurred while sending email'
        ];
    }


}