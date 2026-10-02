<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChatConversationLayoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_message_board_renders_conversation_details_without_a_fixed_width_table(): void
    {
        $admin = User::factory()->create(['user_type' => 'superAdmin']);
        $tenant = User::factory()->create([
            'first_name' => 'Attayab',
            'last_name' => 'Ashraf',
            'user_type' => 'tenant',
            'email' => 'attayab@example.test',
            'unique_identifier' => 'test-tenant',
        ]);

        $response = $this->actingAs($admin)->get('/accounts/chat');

        $response->assertOk()
            ->assertSee('Conversations')
            ->assertSee('1 Active')
            ->assertSee('Attayab Ashraf')
            ->assertSee('Tenant')
            ->assertSee('attayab@example.test')
            ->assertSee('chat-conversation-list', false)
            ->assertSee('chat-conversation-email', false);

        $this->get('/accounts/chat/messages/test-tenant')
            ->assertOk()
            ->assertSee('Back to conversations')
            ->assertSee('aria-current="page"', false)
            ->assertSee('chat-thread-layout', false);

        $styles = file_get_contents(public_path('controlPanel/css/portal-modern-theme.css'));
        $this->assertStringContainsString('overflow-wrap: anywhere', $styles);
        $this->assertStringContainsString('.chat-message-content', $styles);
        $this->assertStringContainsString('white-space: pre-wrap', $styles);
        $this->assertStringContainsString('@media (max-width: 767.98px)', $styles);
        $this->assertStringContainsString('@media (max-width: 380px)', $styles);
        $this->assertStringContainsString('min-width: 0', $styles);
    }

    public function test_tenant_can_open_a_conversation_with_a_user_created_without_an_identifier(): void
    {
        $admin = User::factory()->create([
            'user_type' => 'superAdmin',
            'unique_identifier' => null,
        ]);
        $tenant = User::factory()->create(['user_type' => 'tenant']);

        $this->assertNotEmpty($admin->fresh()->unique_identifier);

        $this->actingAs($tenant)
            ->get('/accounts/chat')
            ->assertOk()
            ->assertSee('accounts/chat/messages/'.$admin->unique_identifier, false);

        $this->get('/accounts/chat/messages/'.$admin->unique_identifier)
            ->assertOk()
            ->assertSee('Type your message...');
    }
}
