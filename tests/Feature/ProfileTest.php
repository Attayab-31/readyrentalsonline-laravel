<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_account_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/accounts/edit-profile')
            ->assertOk();
    }

    public function test_account_profile_can_be_updated(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/accounts/update-profile', [
                'first_name' => 'Taylor',
                'last_name' => 'Example',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect('/accounts/edit-profile');

        $this->assertSame('Taylor', $user->fresh()->first_name);
        $this->assertSame('Example', $user->fresh()->last_name);
    }

    public function test_account_profile_requires_first_and_last_name(): void
    {
        $user = User::factory()->create();
        $firstName = $user->first_name;
        $lastName = $user->last_name;

        $this->actingAs($user)
            ->from('/accounts/edit-profile')
            ->post('/accounts/update-profile', [])
            ->assertSessionHasErrors(['first_name', 'last_name'])
            ->assertRedirect('/accounts/edit-profile');

        $this->assertSame($firstName, $user->fresh()->first_name);
        $this->assertSame($lastName, $user->fresh()->last_name);
    }
}
