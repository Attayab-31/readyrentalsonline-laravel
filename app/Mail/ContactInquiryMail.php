<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $inquiry)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: config('app.name') . ' | New Contact Inquiry',
            replyTo: [$this->inquiry['email']],
        );
    }

    public function content(): Content
    {
        return new Content(view: 'email_templates.contact_inquiry');
    }
}
