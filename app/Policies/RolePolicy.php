<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        Log::info('Checking viewAny permission for user: ' . $user->hasAnyPermission(['all.access', 'roles.read']));
        return $user->hasAnyPermission(['all.access', 'roles.read']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        return $user->hasAnyPermission(['all.access', 'roles.read']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyPermission(['all.access', 'roles.create']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        return $user->hasAnyPermission(['all.access', 'roles.update']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        return $user->hasAnyPermission(['all.access', 'roles.delete']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        return $user->hasAnyPermission(['all.access', 'roles.restore']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        return $user->hasAnyPermission(['all.access', 'roles.forceDelete']);
    }
}
