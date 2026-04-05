<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;

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
        $roles = (new Role())->search($request);

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
        return Role::create($request->validated());
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
        $role->delete();
    }
}