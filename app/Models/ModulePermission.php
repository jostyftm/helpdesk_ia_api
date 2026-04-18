<?php

namespace App\Models;

use App\Traits\HasSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModulePermission extends Model
{
    /** @use HasFactory<\Database\Factories\ModulePermissionFactory> */
    use HasFactory, HasSearchable;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'order',
        'name',
        'path',
        'show_sidebar',
        'description',
        'icon'
    ];

    public function casts(): array
    {
        return [
            'show_sidebar' => 'boolean',
            'order' => 'integer',
        ];
    }

    /**
     * Get the permissions for the module permission.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class);
    }
}
