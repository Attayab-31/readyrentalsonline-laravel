<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductionRoutesTest extends TestCase
{
    public function test_invoice_payment_page_fails_closed_without_matching_stripe_keys(): void
    {
        config([
            'services.stripe.mode' => 'test',
            'services.stripe.key' => null,
            'services.stripe.secret' => null,
        ]);

        $this->get('/invoices/pay/not-a-real-invoice')->assertStatus(503);
    }

    public function test_unread_message_email_trigger_is_post_only_and_requires_a_secret(): void
    {
        config(['services.unread_message_alert_token' => '']);

        $this->get('/send-unread-message-email-alert')->assertStatus(405);
        $this->post('/send-unread-message-email-alert')->assertForbidden();
    }
}
