<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    /**
    * The attributes that are mass assignable.
    * 
    * @var array<int, string>
    */
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    /**
     * Get the guard name for the role.
     * 
     * @return array<int, string>
     */
    public function  guardName(): array
    {
        return ['web'];
    }
}
