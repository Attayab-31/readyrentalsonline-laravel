<?php

namespace Tests\Feature;

use App\Http\Controllers\Account\ChatController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class ChatMessageFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_send_message_and_poll_from_an_empty_conversation(): void
    {
        $admin = User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Admin',
            'user_type' => 'superAdmin',
            'unique_identifier' => 'admin-chat',
        ]);
        $tenant = User::factory()->create([
            'first_name' => 'Attayab',
            'last_name' => 'Ashraf',
            'user_type' => 'tenant',
            'email' => 'attayab@example.test',
            'unique_identifier' => 'tenant-chat',
        ]);

        $controller = Mockery::mock(ChatController::class)
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();
        $controller->shouldReceive('sendMessageNotification')
            ->once()
            ->with(Mockery::type(User::class), 'Can you confirm the viewing time?');
        $this->app->instance(ChatController::class, $controller);

        $this->actingAs($admin)
            ->postJson('/accounts/chat/fetch-new-messages', [
                'receiver_id' => $tenant->unique_identifier,
                'last_message_id' => null,
            ])
            ->assertOk()
            ->assertExactJson(['messageHtml' => '', 'lastMessageId' => null]);

        $sendResponse = $this->postJson('/accounts/chat/send', [
            'receiver_id' => $tenant->unique_identifier,
            'message' => 'Can you confirm the viewing time?',
        ]);
        $sendResponse->assertOk()->assertJsonPath('lastMessageId', 1);
        $this->assertStringContainsString('Can you confirm the viewing time?', $sendResponse->json('messageHtml'));

        $this->assertDatabaseHas('messages', [
            'sender_id' => $admin->id,
            'receiver_id' => $tenant->id,
            'message' => 'Can you confirm the viewing time?',
        ]);

        $pollResponse = $this->postJson('/accounts/chat/fetch-new-messages', [
            'receiver_id' => $tenant->unique_identifier,
            'last_message_id' => 0,
        ]);
        $pollResponse->assertOk()->assertJsonPath('lastMessageId', 1);
        $this->assertStringContainsString('Can you confirm the viewing time?', $pollResponse->json('messageHtml'));

        $recipientResponse = $this->actingAs($tenant)->postJson('/accounts/chat/fetch-new-messages', [
            'receiver_id' => $admin->unique_identifier,
            'last_message_id' => 0,
        ]);
        $recipientResponse->assertOk()->assertJsonPath('lastMessageId', 1);
        $this->assertStringContainsString('Can you confirm the viewing time?', $recipientResponse->json('messageHtml'));
        $this->assertDatabaseHas('messages', [
            'sender_id' => $admin->id,
            'receiver_id' => $tenant->id,
            'is_read' => true,
        ]);
    }
}
