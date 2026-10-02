<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        VerifyEmail::toMailUsing(function ($notifiable, string $verificationUrl): MailMessage {
            return (new MailMessage)
                ->subject('Verify your email address')
                ->view('emails.emailVerificationLink', [
                    'db_data' => [
                        'User' => $notifiable,
                        'verificationLink' => $verificationUrl,
                    ],
                ]);
        });

        ResetPassword::toMailUsing(function ($notifiable, string $token): MailMessage {
            $resetUrl = route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]);

            return (new MailMessage)
                ->subject('Reset your password')
                ->view('emails.passwordResetLink', [
                    'user' => $notifiable,
                    'resetUrl' => $resetUrl,
                ]);
        });
    }
}
