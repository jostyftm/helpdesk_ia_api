<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;

class UserService
{
    
    /**
    * List all users.
    * 
    * @param  Request  $request
    * @return Collection|AbstractPaginator
    */
    public function index(Request $request): Collection | AbstractPaginator
    {
        $users = (new User())->search(
            request: $request,
            relationships: ['roles'],
            filters: ['name', 'last_name', 'email', 'roles.name'],
        );

        return $users;
    }

    /**
     * Store a newly created user in storage.
     * 
     * @param  Request  $request
     * @return User
     */
    public function store(Request $request): User
    {
        $user = User::create($request->validated());
        $user->assignRole($request->input('role_id'));

        return $user;
    }

    /**
     * Display the specified user.
     * 
     * @param  User  $user
     * @return User
     */
    public function show(User $user): User
    {
        $user->load('roles');

        return $user;
    }

    /**
     * Update the specified user in storage.
     * 
     * @param  Request  $request
     * @param  User  $user
     * @return User
     */
    public function update(Request $request, User $user): User
    {
        $user->update($request->validated());
        $user->syncRoles($request->input('role_id'));

        return $user;
    }

    /**
     * Update the password for the specified user.
     * 
     * @param  Request  $request
     * @param  User  $user
     * @return User
     */
    public function updatePassword(Request $request, User $user): User
    {
        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);

        return $user;
    }

    /**
     * Remove the specified user from storage.
     * 
     * @param  User  $user
     * @return void
     */
    public function destroy(User $user): void
    {
        $user->delete();
    }


    /**
     * Deactivate the specified user.
     * 
     * @param  User  $user
     * @return User
     */
    public function deactivate(User $user): User
    {
        $user->update([
            'is_active' => false,
        ]);

        return $user;
    } 

    /**
     * Activate the specified user.
     * 
     * @param  User  $user
     * @return User
     */
    public function activate(User $user): User
    {
        $user->update([
            'is_active' => true,
        ]);

        return $user;
    }
}