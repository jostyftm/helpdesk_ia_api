<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{
    public function test_user_can_logout()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $token = $user->createToken(name: 'Test Token')->plainTextToken;

        $this->assertDatabaseCount(table: 'personal_access_tokens', count: 1);

        $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson('/api/v1/auth/logout');

        $response->assertStatus(204);

        $this->assertDatabaseCount(table: 'personal_access_tokens', count: 0);
    }

    public function test_user_cannot_logout_without_authentication()
    {
        $response = $this->postJson('/api/v1/auth/logout');

        $response->assertStatus(401);
    }

    public function test_user_cannot_logout_with_invalid_token()
    {
        $response = $this->withHeader('Authorization', 'Bearer invalid_token')
        ->postJson('/api/v1/auth/logout');

        $response->assertStatus(401);
    }
}