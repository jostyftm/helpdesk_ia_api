<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Models\User;
use App\Http\Requests\User\UserListRequest;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Services\UserService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        public UserService $userService
    ) {}

    /**
     * List users 
     * 
     * Display a listing of the resource.
     * 
     * @param  UserListRequest  $request
     * @return AnonymousResourceCollection
     */
    public function index(UserListRequest $request): AnonymousResourceCollection
    {
        $users = $this->userService->index($request);

        return UserResource::collection($users);
    }

    /**
     * Store User
     * 
     * Store a newly created resource in storage.
     * 
     * @param  UserCreateRequest  $request
     * @return JsonResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserCreateRequest $request): JsonResource
    {
        $user = $this->userService->store($request);

        return new UserResource($user);
    }

    /**
     * Show User
     * 
     * Display the specified resource.
     * 
     * @param  User  $user
     * @return JsonResource
     */
    public function show(User $user): JsonResource
    {
        $user = $this->userService->show($user);

        return new UserResource($user);
    }

    /**
     * Update User
     * 
     * Update the specified resource in storage.
     * 
     * @param  UserUpdateRequest  $request
     * @param  User  $user
     * @return JsonResource
     */
    public function update(UserUpdateRequest $request, User $user): JsonResource
    {
        $user = $this->userService->update($request, $user);

        return new UserResource($user);
    }

    /**
     * Update Password
     * 
     * Update the password for the specified resource in storage.
     * 
     * @param  UpdatePasswordRequest  $request
     * @param  User  $user
     * @return JsonResource
     */
    public function updatePassword(UpdatePasswordRequest $request, User $user): JsonResource
    {
        $user = $this->userService->updatePassword($request, $user);

        return new UserResource($user);
    }

    /**
     * Delete User
     * 
     * Remove the specified resource from storage.
     * 
     * @param  User  $user
     * @return JsonResource
     */
    public function destroy(User $user): JsonResource
    {
        $this->userService->destroy($user);

        return new UserResource($user);
    }

    /**
     * Deactivate User
     * 
     * Deactivate the specified resource in storage.
     * 
     * @param  User  $user
     * @return JsonResource
     */
    public function deactivate(User $user): JsonResource
    {
        $response = $this->userService->deactivate($user);

        return new UserResource($response);
    }

    /**
     * Activate User
     * 
     * Activate the specified resource in storage.
     * 
     * @param  User  $user
     * @return JsonResource
     */
    public function activate(User $user): JsonResource
    {
        $response = $this->userService->activate($user);

        return new UserResource($user);
    }
}
