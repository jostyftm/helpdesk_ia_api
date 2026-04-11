<?php

namespace App\Models;

use App\Policies\RolePolicy;
use App\Traits\HasSearchable;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Spatie\Permission\Models\Role as SpatieRole;

#[UsePolicy(RolePolicy::class)]
class Role extends SpatieRole
{
    use HasSearchable;
    
    /**
    * The attributes that are mass assignable.
    * 
    * @var array<int, string>
    */
    protected $fillable = [
        'name',
        'guard_name',
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
