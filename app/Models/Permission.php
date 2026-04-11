<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    /**
    * The attributes that are mass assignable.
    * 
    * @var array<int, string>
    */
    protected $fillable = [
        'module_permission_id',
        'name',
        'display_name',
        'description',
    ];

    /**
     * Get the module permission that owns the permission.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modulePermission(): BelongsTo
    {
        return $this->belongsTo(ModulePermission::class);
    }

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
