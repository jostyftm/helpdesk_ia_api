<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPassword;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use App\Http\Resources\Auth\AuthResource;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Resources\Permission\ModulePermissionResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function __construct(
        public readonly AuthService $authService
    ) {}

    /**
     * Login
     * 
     * Handle the login request and return an access token if the credentials are valid.
     * 
     * @param LoginRequest $request
     * @return JsonResource
     * @unauthenticated
     */
    public function login(LoginRequest $request): JsonResource
    {
        $response = $this->authService->login($request);

        return AuthResource::make($response);
    }

    /**
     * Forgot Password
     * 
     * Handle the forgot password request and send a password reset link to the user.
     * @param ForgotPassword $request
     * @return JsonResponse
     * @unauthenticated
     */
    public function forgotPassword(ForgotPassword $request): JsonResponse
    {
        $this->authService->forgotPassword($request);

        return response()->json([
            'message' => __('passwords.sent'),
        ], status: 200);
    }

    /**
     * Reset Password
     * 
     * Handle the reset password request and reset the user's password if the token is valid.
     * 
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     * @unauthenticated
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $this->authService->resetPassword($request);

        return response()->json([
            'message' => __('passwords.reset'),
        ], status: 200);
    }

    /**
     * Logout
     * 
     * Handle the logout request and revoke the user's access token.
     * 
     * @return Response
     */
    public function logout(): Response
    {
        $this->authService->logout();

        return response()->noContent();
    }

    /**
     * Check Session
     * 
     * Check if the user's session is active.
     * 
     * @return JsonResponse
     */
    public function checkSession(): JsonResponse
    {
        $this->authService->checkSession();

        return response()->json([
            'message' => 'Session is active',
        ], status: 200);
    }

    /**
     * Get the authenticated user
     * 
     * Return the authenticated user's information.
     * 
     * @return JsonResource
     */
    public function me(): JsonResource
    {
        $user = $this->authService->me();

        return UserResource::make($user);
    }

    /**
     * Get the authenticated user's permissions
     * 
     * Return the authenticated user's module permissions.
     * 
     */
    public function getModulePermissions() #: JsonResource
    {
        $permissions = $this->authService->getModulePermissions();

        return $permissions;
        return ModulePermissionResource::collection($permissions);
    }
}
