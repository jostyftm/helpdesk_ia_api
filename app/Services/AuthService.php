<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
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

        return $this->createToken($user);
    }

    /**
     * Validate the rate limit for the given throttle key.
     *
     * @param string $throttleKey
     * @return void
     * @throws TooManyRequestsHttpException
     */
    private function validateRateLimit(string $throttleKey): void
    {
        
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            throw new TooManyRequestsHttpException(null, __('auth.too_many_attempts'));
        }
    }

    /**
     * Clear the rate limit for the given throttle key.
     *
     * @param string $throttleKey
     * @return void
     */
    private function clearRateLimit(string $throttleKey): void
    {
        RateLimiter::clear($throttleKey);
    }
    
    /**
     * Create an access token for the given user.
     *
     * @param User $user
     * @return array
     */
    private function createToken(User $user): array
    {
        return [
            'access_token' => $user->createToken(
                name: 'auth_token',
                expiresAt: now()->addDays(1)
            )->plainTextToken,
            'token_type' => 'Bearer',
        ];
    }

    /**
     * Handle the forgot password request and send a password reset link to the user.
     * 
     * @param Request $request
     * @return void
     */
    public function forgotPassword(Request $request): void
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // if ($status !== Password::RESET_LINK_SENT) {
        //     throw ValidationException::withMessages([
        //         'email' => __($status),
        //     ]);
        // }
    }

    /**
     * Reset the user's password.
     *
     * @param Request $request
     * @return void
     */
    public function resetPassword(Request $request): void
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => __($status),
            ]);
        }
    }

    /**
     * Logout
     * 
     * Revoke the user's access token.
     * 
     * @return void
     */
    public function logout(): void
    {
        /** @var \Laravel\Sanctum\PersonalAccessToken $token */
        $token = Auth::user()->currentAccessToken();
        $token->delete();
    }
}
