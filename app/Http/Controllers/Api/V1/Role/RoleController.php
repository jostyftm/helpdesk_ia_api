<?php

namespace App\Http\Controllers\Api\V1\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Requests\Role\RoleListRequest;
use App\Http\Requests\Role\RoleCreateRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Services\RoleService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Response;

class RoleController extends Controller
{

    public function __construct(
        private readonly RoleService $roleService
    ) {
        $this->authorizeResource(Role::class, 'role');
    }

    /**
     * List all roles.
     * 
     * Display a listing of the resource.
     * 
     * @param  RoleListRequest  $request
     * @return AnonymousResourceCollection
     */
    public function index(RoleListRequest $request): AnonymousResourceCollection
    {
        $roles = $this->roleService->index($request);

        return RoleResource::collection($roles);
    }

    /**
     * Store Role
     * 
     * Store a newly created resource in storage.
     * 
     * @param  RoleCreateRequest  $request
     * @return JsonResource
     */
    public function store(RoleCreateRequest $request): JsonResource
    {
        $role = $this->roleService->store($request);

        return RoleResource::make($role);
     }

    /**
     * Show Role
     * 
     * Display the specified resource.
     * 
     * @param  Role  $role
     * @return JsonResource
     */
    public function show(Role $role): JsonResource
    {
        $role = $this->roleService->show($role);

        return RoleResource::make($role);
    }

    /**
     * Update Role
     * 
     * Update the specified resource in storage.
     * 
     * @param  RoleUpdateRequest  $request
     * @param  Role  $role
     * @return JsonResource
     */
    public function update(RoleUpdateRequest $request, Role $role): JsonResource
    {
        $role = $this->roleService->update($request, $role);

        return RoleResource::make($role);
     }

    /**
     * Delete Role
     *
     * Remove the specified resource from storage.
     * 
     * @param  Role  $role
     * @return Response
     */
    public function destroy(Role $role): Response
     {
        $this->roleService->destroy($role);

        return response()->noContent();
     }
}
