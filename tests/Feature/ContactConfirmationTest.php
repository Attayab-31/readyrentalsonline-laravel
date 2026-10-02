<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactInquiryMail;
use App\Models\AppSetting;

class ContactConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_contact_submission_has_a_branded_confirmation_state(): void
    {
        $this->withSession(['contact_submission_status' => 'success'])
            ->get('/contact-us')
            ->assertOk()
            ->assertSee('Message received')
            ->assertSee('Thanks for reaching out.')
            ->assertSee('Send another message')
            ->assertDontSee('id="contact-form"', false);
    }

    public function test_failed_contact_submission_shows_guidance_and_keeps_the_form_available(): void
    {
        $this->withSession(['contact_submission_status' => 'error'])
            ->get('/contact-us')
            ->assertOk()
            ->assertSee('We could not send your message.')
            ->assertSee('id="contact-form"', false);
    }

    public function test_contact_form_validation_redirects_without_sending_a_message(): void
    {
        $this->from('/contact-us')
            ->post('/contact-us/process-form', [])
            ->assertRedirect('/contact-us')
            ->assertSessionHasErrors(['full_name', 'email', 'service_type', 'phone_number', 'message']);
    }

    public function test_valid_contact_inquiry_is_sent_to_configured_recipients(): void
    {
        Mail::fake();
        AppSetting::forceCreate([
            'as_contact_us_email_recipients' => 'leasing@example.test',
        ]);

        $this->post('/contact-us/process-form', [
            'full_name' => 'Test Resident',
            'email' => 'resident@example.test',
            'service_type' => 'Property Rental',
            'phone_number' => '555-0100',
            'message' => 'I would like information about a rental.',
        ])->assertRedirect('/contact-us')
            ->assertSessionHas('contact_submission_status', 'success');

        Mail::assertSent(ContactInquiryMail::class, function (ContactInquiryMail $mail): bool {
            $html = $mail->render();

            return $mail->hasTo('leasing@example.test')
                && $mail->inquiry['email'] === 'resident@example.test'
                && str_contains($html, '/logo/ready_rentals_light.svg');
        });
    }

    public function test_contact_inquiry_fails_clearly_when_no_recipient_is_configured(): void
    {
        Mail::fake();
        config(['mail.contact_recipients' => '']);

        $this->from('/contact-us')->post('/contact-us/process-form', [
            'full_name' => 'Test Resident',
            'email' => 'resident@example.test',
            'service_type' => 'General Help',
            'phone_number' => '555-0100',
            'message' => 'A test message.',
        ])->assertRedirect('/contact-us')
            ->assertSessionHas('contact_submission_status', 'error');

        Mail::assertNothingSent();
    }

    public function test_contact_inquiry_uses_the_public_contact_address_as_a_fallback_recipient(): void
    {
        Mail::fake();
        config(['mail.contact_recipients' => 'info@readyrentalsonline.com']);

        $response = $this->postJson('/contact-us/process-form', [
            'full_name' => 'Test Resident',
            'email' => 'resident@example.test',
            'service_type' => 'General Help',
            'phone_number' => '555-0100',
            'message' => 'Testing the configured fallback.',
        ])->assertOk()
            ->assertJsonPath('res_code', 200);

        $this->assertStringContainsString('Message received', $response->json('res_msg_markup'));

        Mail::assertSent(ContactInquiryMail::class, fn (ContactInquiryMail $mail): bool =>
            $mail->hasTo('info@readyrentalsonline.com')
        );
    }
}
