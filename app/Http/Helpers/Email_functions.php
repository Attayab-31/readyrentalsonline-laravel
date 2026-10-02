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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

use App\Models\User;
use App\Models\AppSetting;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyAmenity;


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
                $db_data['email_subject'] = config('app.name') . ": New Message Recieved";
            }
    
            $AppSetting = AppSetting::find(1);
            $recipients = $AppSetting?->as_contact_us_email_recipients
                ?: config('mail.contact_recipients', '');

            return self::sendRenderedEmail(
                $recipients,
                $db_data['email_subject'],
                view($db_data['view_to_use'], compact('db_data'))->render(),
                [],
                'notification@readyrentalsonline.com',
                config('app.name') . ' System'
            );
        } catch (\Throwable $exception) {
            Log::error('Email sending failed', ['exception' => $exception->getMessage()]);

            return [
                'res_code' => 500,
                'message' => 'An error occurred while preparing the email.',
            ];
        }
    }
    

 

    public static function sendNewEmail(
        string|array $to,
        string $subject,
        string $view = "email_templates.general_email_template",
        array $bcc = [],
        string $fromEmail = "notification@readyrentalsonline.com",
        ?string $fromName = null,
        array $data = [] // Add this parameter
    ): array {
        return self::sendViewEmail($to, $subject, $view, $bcc, $fromEmail, $fromName, $data);
    }



    public static function sendNewEmail_For_Webhook(
        string|array $to,
        string $subject,
        string $view = "email_templates.Invoice_Alert_Email",
        array $bcc = [],
        string $fromEmail = "notification@readyrentalsonline.com",
        ?string $fromName = null,
        array $data = []
    ): array {
        return self::sendViewEmail($to, $subject, $view, $bcc, $fromEmail, $fromName, $data);
    }

    private static function sendViewEmail(
        string|array $to,
        string $subject,
        string $view,
        array $bcc,
        string $fromEmail,
        ?string $fromName,
        array $data
    ): array {
        try {
            return self::sendRenderedEmail(
                $to,
                $subject,
                view($view, $data)->render(),
                $bcc,
                $fromEmail,
                $fromName ?? config('app.name') . ' System'
            );
        } catch (\Throwable $exception) {
            Log::error('Email could not be prepared', [
                'view' => $view,
                'exception' => $exception->getMessage(),
            ]);

            return [
                'res_code' => 500,
                'message' => 'Email could not be prepared.',
            ];
        }
    }

    private static function sendRenderedEmail(
        string|array $to,
        string $subject,
        string $html,
        array $bcc,
        string $fromEmail,
        string $fromName
    ): array {
        $recipients = self::validAddresses($to);
        $bccRecipients = self::validAddresses($bcc);

        if ($recipients === []) {
            Log::error('Email was not sent because no valid recipients are configured.');

            return [
                'res_code' => 500,
                'message' => 'No valid email recipients are configured.',
            ];
        }

        try {
            $mailerName = self::configuredMailerName();
            if ($mailerName === 'app_settings_smtp') {
                $fromEmail = config("mail.mailers.{$mailerName}.from.address", $fromEmail);
                $fromName = config("mail.mailers.{$mailerName}.from.name", $fromName);
            }

            $sentMessage = Mail::mailer($mailerName)->send([], [], function ($message) use (
                $recipients,
                $bccRecipients,
                $subject,
                $html,
                $fromEmail,
                $fromName
            ): void {
                $message->to($recipients)
                    ->from($fromEmail, $fromName)
                    ->subject($subject)
                    ->html($html);

                if ($bccRecipients !== []) {
                    $message->bcc($bccRecipients);
                }
            });

            if ($sentMessage === null) {
                Log::error('Configured mail transport did not send the email.', [
                    'mailer' => $mailerName,
                    'recipient_count' => count($recipients),
                ]);

                return [
                    'res_code' => 500,
                    'message' => 'Configured mail transport did not send the email.',
                ];
            }

            return [
                'res_code' => 200,
                'message' => $mailerName === 'log'
                    ? 'Email recorded by the log mailer; it was not delivered to an inbox.'
                    : 'Email accepted by the configured mail transport.',
            ];
        } catch (\Throwable $exception) {
            Log::error('Email sending failed', [
                'mailer' => $mailerName ?? config('mail.default'),
                'recipient_count' => count($recipients),
                'exception' => $exception->getMessage(),
            ]);

            return [
                'res_code' => 500,
                'message' => 'Email sending failed: ' . $exception->getMessage(),
            ];
        }
    }

    private static function configuredMailerName(): string
    {
        $settings = AppSetting::find(1);
        if (! $settings || ! filled($settings->as_smtp_host) || ! filled($settings->as_smtp_port)) {
            return (string) config('mail.default');
        }

        $mailerName = 'app_settings_smtp';
        Config::set("mail.mailers.{$mailerName}", [
            'transport' => 'smtp',
            'host' => $settings->as_smtp_host,
            'port' => (int) $settings->as_smtp_port,
            'encryption' => $settings->as_smtp_security_protocol ?: null,
            'username' => $settings->as_smtp_username ?: null,
            'password' => $settings->as_smtp_password ?: null,
            'timeout' => 15,
            'local_domain' => parse_url(config('app.url'), PHP_URL_HOST),
        ]);
        Config::set("mail.mailers.{$mailerName}.from", [
            'address' => $settings->as_smtp_send_from ?: config('mail.from.address'),
            'name' => config('mail.from.name', config('app.name')),
        ]);
        Mail::purge($mailerName);

        return $mailerName;
    }

    private static function validAddresses(string|array $addresses): array
    {
        $addresses = is_array($addresses) ? $addresses : explode(',', $addresses);

        return collect($addresses)
            ->map(fn ($address) => trim((string) $address))
            ->filter(fn ($address) => filter_var($address, FILTER_VALIDATE_EMAIL))
            ->unique()
            ->values()
            ->all();
    }


}