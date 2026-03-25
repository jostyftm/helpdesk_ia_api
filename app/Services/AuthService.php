<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class AuthService
{
    /**
     * Handle the login request and return an access token if the credentials are valid.
     * 
     * @param Request $request
     * @return array
     */
    public function login(Request $request): array
    {
        $credentials = $request->only(['email', 'password']);

        $throttleKey = Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());
        $this->validateRateLimit($throttleKey);

        $user = User::where(column: 'email', operator: '=', value: $credentials['email'], boolean: 'and')->first();

        if(!Auth::attempt($credentials)) {
            RateLimiter::hit($throttleKey, $decaySeconds = 60);

            throw new UnauthorizedException(message: __('auth.invalid_credentials'), code: 401);
        }

        if(!$user->is_active) {
            throw ValidationException::withMessages([
                'email' => __('auth.inactive_user'),
            ]);
        }

        $this->clearRateLimit($throttleKey);

        return $this->crateToken($user);
    }

    /**
     * 
     */
    private function validateRateLimit(string $throttleKey): void
    {
        
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            throw new TooManyRequestsHttpException(null, __('auth.too_many_attempts'));
        }
    }

    /**
     * 
     */
    private function clearRateLimit(string $throttleKey): void
    {
        RateLimiter::clear($throttleKey);
    }
    
    /**
     * 
     */
    private function crateToken(User $user): array
    {
        return [
            'access_token' => $user->createToken(
                name: 'auth_token',
                expiresAt: now()->addDays(1)
            )->plainTextToken,
            'token_type' => 'Bearer',
        ];
    }
}
