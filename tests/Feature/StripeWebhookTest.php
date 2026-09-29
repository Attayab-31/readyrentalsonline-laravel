<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StripeWebhookTest extends TestCase
{
    use RefreshDatabase;

    private string $secret = 'test_webhook_signing_secret';

    protected function setUp(): void
    {
        parent::setUp();
        config(['services.stripe.webhook_secret' => $this->secret]);
    }

    public function test_it_rejects_an_invalid_signature(): void
    {
        $response = $this->call('POST', '/stripe/webhook', [], [], [], [
            'HTTP_STRIPE_SIGNATURE' => 'invalid',
            'CONTENT_TYPE' => 'application/json',
        ], $this->payload('evt_bad_signature'));

        $response->assertForbidden();
        $this->assertDatabaseMissing('stripe_webhook_events', ['event_id' => 'evt_bad_signature']);
    }

    public function test_it_returns_unavailable_when_the_signing_secret_is_missing(): void
    {
        config(['services.stripe.webhook_secret' => null]);

        $this->post('/stripe/webhook', [], ['Stripe-Signature' => 'unused'])
            ->assertStatus(503);
    }

    public function test_it_processes_a_signed_event_once_and_acknowledges_retries(): void
    {
        $payload = $this->payload('evt_webhook_idempotency');
        $timestamp = time();
        $signature = 't='.$timestamp.',v1='.hash_hmac('sha256', $timestamp.'.'.$payload, $this->secret);
        $server = [
            'HTTP_STRIPE_SIGNATURE' => $signature,
            'CONTENT_TYPE' => 'application/json',
        ];

        $this->call('POST', '/stripe/webhook', [], [], [], $server, $payload)
            ->assertOk()
            ->assertJson(['status' => 'success']);

        $this->call('POST', '/stripe/webhook', [], [], [], $server, $payload)
            ->assertOk()
            ->assertJson(['status' => 'already_processed']);

        $this->assertDatabaseCount('stripe_webhook_events', 1);
    }

    private function payload(string $eventId): string
    {
        return json_encode([
            'id' => $eventId,
            'object' => 'event',
            'api_version' => '2025-07-30.basil',
            'created' => time(),
            'data' => ['object' => ['id' => 'pi_webhook_test', 'object' => 'payment_intent']],
            'livemode' => false,
            'type' => 'customer.created',
        ], JSON_THROW_ON_ERROR);
    }
}
