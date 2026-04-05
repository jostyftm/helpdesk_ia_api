<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class ResetPasswordTest extends TestCase
{
    public function test_user_can_reset_password_with_valid_token(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('oldpassword'),
        ]);

        $plaintextToken = Password::createToken($user);

        $response = $this->postJson('/api/v1/auth/reset-password', [
            'email' => $user->email,
            'token' => $plaintextToken,
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => __('passwords.reset'),
            ]);
    }

    public function test_user_cannot_reset_password_with_invalid_token(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('oldpassword'),
        ]);

        $response = $this->postJson('/api/v1/auth/reset-password', [
            'email' => $user->email,
            'token' => 'invalid-token',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        $response->assertStatus(422);
    }

    public function test_user_cannot_reset_password_with_invalid_password_confirmation(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('oldpassword'),
        ]);

        $plaintextToken = Password::createToken($user);

        $response = $this->postJson('/api/v1/auth/reset-password', [
            'email' => $user->email,
            'token' => $plaintextToken,
            'password' => 'newpassword',
            'password_confirmation' => 'differentpassword',
        ]);

        $response->assertStatus(422);
    }
}