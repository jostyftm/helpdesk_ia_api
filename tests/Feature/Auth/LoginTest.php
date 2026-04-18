<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

// 1. Can authenticate a user with valid credentials

class LoginTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_can_authenticate_user_with_valid_credentials(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/v1/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_cannot_authenticate_user_with_invalid_credentials(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('newPassword'),
        ]);
        $response = $this->postJson('/api/v1/auth/login', [
            'email' => $user->email,
            'password' => 'wrongPassword',
        ]);

        $response->assertStatus(422);
    }


    public function test_cannot_authenticate_inactive_user(): void
    {
        $user = User::factory()->create([
            'is_active' => false,
        ]);
        $response = $this->postJson('/api/v1/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(422);
    }

    public function test_block_ip_after_failed_login_attempts(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('newPassword'),
        ]);

        $totalAttemps = 10;
        $limitAttempts = 5;

        for ($i = 0; $i < $totalAttemps; $i++) {
            $response = $this->postJson('/api/v1/auth/login', [
                'email' => $user->email,
                'password' => 'wrongPassword',
            ]);

            if ($i < $limitAttempts) {
                $response->assertStatus(422);
            } else {
                $response->assertStatus(429);
            }
        }
    }
}
