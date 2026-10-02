<?php

namespace Tests\Feature;

use App\Http\Helpers\Email_functions;
use App\Models\AppSetting;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Mail\Transport\ArrayTransport;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailFunctionsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['mail.default' => 'array']);
        Mail::purge('array');
    }

    public function test_legacy_email_helper_uses_the_laravel_mail_transport(): void
    {
        AppSetting::forceCreate([
            'as_contact_us_email_recipients' => 'leasing@example.test',
        ]);

        $result = Email_functions::send_email([
            'email_type' => 'contact_us_form',
            'email_subject' => 'Test inquiry',
            'body' => '<p>Inquiry received</p>',
            'view_to_use' => 'email_templates.general_email_template',
        ]);

        $this->assertSame(200, $result['res_code']);
        $message = $this->sentMessages()->first()->getOriginalMessage();
        $this->assertSame('Test inquiry', $message->getSubject());
        $this->assertSame('leasing@example.test', $message->getTo()[0]->getAddress());
        $this->assertStringContainsString('Inquiry received', $message->getHtmlBody());
        $this->assertStringContainsString('/logo/ready_rentals_light.svg', $message->getHtmlBody());
    }

    public function test_message_and_property_notifications_render_and_preserve_bcc_recipients(): void
    {
        $messageResult = Email_functions::sendNewEmail(
            'tenant@example.test',
            'New message',
            'email_templates.new_message_notification',
            ['admin@example.test'],
            'notifications@example.test',
            'Ready Rentals',
            [
                'receiverName' => 'Tenant',
                'senderName' => 'Property Manager',
                'messageContent' => 'Please call me.',
                'loginUrl' => 'https://example.test/login',
            ]
        );

        $propertyResult = Email_functions::sendNewEmail(
            ['friend@example.test'],
            'Property shared',
            'email_templates.property_share',
            [],
            'notifications@example.test',
            'Property Manager',
            [
                'sender_name' => 'Property Manager',
                'property_title' => 'Test Home',
                'property_address' => '1 Test Street',
                'property_price' => 1200,
                'property_url' => 'https://example.test/properties/test-home',
                'message' => 'Take a look.',
                'property_image' => 'https://example.test/test-home.jpg',
            ]
        );

        $this->assertSame(200, $messageResult['res_code']);
        $this->assertSame(200, $propertyResult['res_code']);

        $messages = $this->sentMessages();
        $this->assertCount(2, $messages);
        $messageEmail = $messages[0]->getOriginalMessage();
        $this->assertSame('tenant@example.test', $messageEmail->getTo()[0]->getAddress());
        $this->assertSame('admin@example.test', $messageEmail->getBcc()[0]->getAddress());
        $this->assertStringContainsString('Please call me.', $messageEmail->getHtmlBody());
        $this->assertStringContainsString('/logo/ready_rentals_light.svg', $messageEmail->getHtmlBody());
        $this->assertStringContainsString('/logo/ready_rentals_light.svg', $messages[1]->getOriginalMessage()->getHtmlBody());
        $this->assertStringContainsString('Test Home', $messages[1]->getOriginalMessage()->getHtmlBody());
    }

    public function test_invoice_notification_helper_renders_and_sends_the_payment_template(): void
    {
        $result = Email_functions::sendNewEmail_For_Webhook(
            'tenant@example.test',
            'Payment received',
            'email_templates.Invoice_Alert_Email',
            [],
            'notifications@example.test',
            'Ready Rentals',
            [
                'heading' => 'Payment Successful',
                'status' => 'paid',
                'statusText' => 'Payment Received',
                'content' => '<p>Invoice payment confirmed.</p>',
                'actionUrl' => 'https://example.test/invoices/INV-TEST-EMAIL',
                'actionText' => 'View invoice',
            ]
        );

        $this->assertSame(200, $result['res_code']);
        $message = $this->sentMessages()->first()->getOriginalMessage();
        $this->assertSame('tenant@example.test', $message->getTo()[0]->getAddress());
        $this->assertStringContainsString('Payment Successful', $message->getHtmlBody());
        $this->assertStringContainsString('Invoice payment confirmed.', $message->getHtmlBody());
        $this->assertStringContainsString('/logo/ready_rentals_light.svg', $message->getHtmlBody());
    }

    public function test_invoice_creation_notification_template_renders(): void
    {
        $invoice = new Invoice([
            'i_invoice_number' => 'INV-TEST-EMAIL',
            'i_issue_date' => '2026-10-02',
            'i_due_date' => '2026-11-02',
            'i_subtotal' => 25,
            'i_tax' => 0,
            'i_discount' => 0,
            'i_fee' => 0,
            'i_total' => 25,
            'i_notes' => 'Test invoice notification.',
        ]);
        $invoice->setRelation('tenant', new User([
            'first_name' => 'Test',
            'last_name' => 'Tenant',
        ]));

        $result = Email_functions::sendNewEmail(
            'tenant@example.test',
            'New invoice',
            'email_templates.new_invoice_creation_alert',
            [],
            'notifications@example.test',
            'Ready Rentals',
            ['invoice' => $invoice, 'heading' => 'New invoice created']
        );

        $this->assertSame(200, $result['res_code']);
        $html = $this->sentMessages()->first()->getOriginalMessage()->getHtmlBody();
        $this->assertStringContainsString('INV-TEST-EMAIL', $html);
        $this->assertStringContainsString('/logo/ready_rentals_light.svg', $html);
    }

    public function test_verification_email_template_uses_shared_branding(): void
    {
        $html = view('emails.emailVerificationLink', [
            'db_data' => [
                'User' => new User([
                    'first_name' => 'Test',
                    'last_name' => 'Tenant',
                ]),
                'verificationLink' => 'https://example.test/verify-email/test-token',
            ],
        ])->render();

        $this->assertStringContainsString('/logo/ready_rentals_light.svg', $html);
        $this->assertStringContainsString('Verify email address', $html);
        $this->assertStringContainsString('https://example.test/verify-email/test-token', $html);
    }

    public function test_email_helper_fails_explicitly_when_no_valid_recipient_is_configured(): void
    {
        $result = Email_functions::sendNewEmail(
            'not-an-email',
            'No recipient',
            'email_templates.general_email_template',
            [],
            'notifications@example.test',
            'Ready Rentals',
            ['db_data' => ['body' => 'This must not be sent.']]
        );

        $this->assertSame(500, $result['res_code']);
        $this->assertSame('No valid email recipients are configured.', $result['message']);
        $this->assertCount(0, $this->sentMessages());
    }

    private function sentMessages()
    {
        $transport = Mail::mailer('array')->getSymfonyTransport();
        $this->assertInstanceOf(ArrayTransport::class, $transport);

        return $transport->messages();
    }
}
