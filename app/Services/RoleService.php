<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Validation\ValidationException;

class RoleService
{
    /**
     * List all roles.
      * 
      * @param  Request  $request
      * @return Collection|AbstractPaginator
     */
    public function index(Request $request): Collection | AbstractPaginator
    {
        $roles = (new Role())->search(
            request:$request,
            filters: ['name', 'description'],
        );

        return $roles;
    }

    /**
     * Store a newly created resource in storage.
      * 
      * @param  Request  $request
      * @return Role
     */
    public function store(Request $request): Role
    {
        return Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'guard_name' => 'web',
        ]);
    }

    /**
     * Display the specified resource.
      * 
      * @param  Role  $role
      * @return Role
     */
    public function show(Role $role): Role
    {
        $role->load('permissions');

        return $role;
    }

    /**
     * Update the specified resource in storage.
      * 
      * @param  Request  $request
      * @param  Role  $role
      * @return Role
     */
    public function update(Request $request, Role $role): Role
    {
        $role->update($request->validated());

        return $role;
    }

    /**
     * Remove the specified resource from storage.
      * 
      * @param  Role  $role
      * @return void
     */
    public function destroy(Role $role): void
    {
        // Verify if the role is not assigned to any user before deleting
        if ($role->users()->count() > 0) {
            throw ValidationException::withMessages([
                'role' => [__('role.cannot_delete_assigned')],
            ]);
        }

        $role->delete();
    }

    /**
     * Get permissions of a role.
     * 
     * @param  Role  $role
     * @return Collection
     */
    public function permissions(Role $role): Collection
    {
        return $role->permissions;
    }

    /**
     * Sync permissions for a role.
     * 
     * @param  Role  $role
     * @param  Request  $request
     * @return void
     */
    public function syncPermissions(Request $request, Role $role): void
    {
        $permissions = $request->array('permissions.*.id');

        $role->syncPermissions($permissions);
    }
}