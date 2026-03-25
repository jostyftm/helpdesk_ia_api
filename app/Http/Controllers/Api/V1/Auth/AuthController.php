<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use App\Http\Resources\Auth\AuthResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    )
    {}

    /**
     * Handle the login request and return an access token if the credentials are valid.
     * 
     * @param LoginRequest $request
     * @return JsonResource
     */
    public function login(LoginRequest $request): JsonResource
    {
        $response = $this->authService->login($request);

        return AuthResource::make($response);
    }
}
