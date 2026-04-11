<?php

namespace App\Http\Controllers\Api\V1\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Requests\Role\RoleListRequest;
use App\Http\Requests\Role\RoleCreateRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Http\Requests\Role\SyncPermissionRequest;
use App\Http\Resources\Permission\PermissionResource;
use App\Services\RoleService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Response;

class RoleController extends Controller
{

    public function __construct(
        public readonly RoleService $roleService
    ) {   
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
        //
        $this->authorize('viewAny', Role::class);
        
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
        $this->authorize('create', Role::class);

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
        $this->authorize('view', $role);

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
        $this->authorize('update', $role);

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
        $this->authorize('delete', $role);

        $this->roleService->destroy($role);

        return response()->noContent();
    }

    /**
     * Get Role Permissions
     * 
     * Display the permissions of the specified resource.
     * 
     * @param  Role  $role
     * @return JsonResource
     */
    public function permissions(Role $role): JsonResource
    {
        $this->authorize('view', $role);

        $permissions = $this->roleService->permissions($role);

        return PermissionResource::collection($permissions);
    }

    /**
     * Sync Role Permissions
     * 
     * Sync the permissions of the specified resource.
     * 
     * @param  SyncPermissionRequest  $request
     * @param  Role  $role
     * @return JsonResource
     */
    public function syncPermissions(SyncPermissionRequest $request, Role $role): JsonResource
    {
        $this->authorize('update', $role);

        $this->roleService->syncPermissions($request,$role);

        return RoleResource::make($role);
    }
}
