<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;

class ForgotPasswordTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_can_request_password_reset_link(): void
    {
        $user = User::factory()->create();
        
        $response = $this->postJson('/api/v1/auth/forgot-password', [
            'email' => $user->email,
        ]);

        $response->assertStatus(200);
    }

    public function test_cannot_request_password_reset_link_with_invalid_email(): void
    {
        $response = $this->postJson('/api/v1/auth/forgot-password', [
            'email' => 'invalid-email',
        ]);
        $response->assertStatus(422);
    }

    public function test_cannot_request_password_reset_link_for_non_existent_email(): void
    {
        $response = $this->postJson('/api/v1/auth/forgot-password', [
            'email' => 'jhon@example.com',
        ]);
        $response->assertStatus(200);
    }

    public function test_cannot_request_password_reset_link_for_inactive_user(): void
    {
        $user = User::factory()->create([
            'is_active' => false,
        ]);
        $response = $this->postJson('/api/v1/auth/forgot-password', [
            'email' => $user->email,
        ]);

        $response->assertStatus(200);
    }

    public function test_cannot_request_password_reset_link_with_missing_email(): void
    {
        $response = $this->postJson('/api/v1/auth/forgot-password', [
            // 'email' => '', --- IGNORE ---
        ]);
        $response->assertStatus(422);
    }
}