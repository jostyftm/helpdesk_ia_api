<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    /**
    * The attributes that are mass assignable.
    * 
    * @var array<int, string>
    */
    protected $fillable = [
        'name',
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
