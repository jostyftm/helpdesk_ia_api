<?php

namespace App\Services;

use App\Models\ModulePermission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;


class ModulePermissionService
{
    /**
     * List all module permissions.
      * 
      * @param  Request  $request
      * @return Collection|AbstractPaginator
     */
    public function index(Request $request): Collection | AbstractPaginator
    {
        $permissionsModule = (new ModulePermission())->search(
            request:$request,
            filters: ['name', 'description'],
        );

        return $permissionsModule;
    }
}