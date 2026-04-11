<?php

namespace App\Http\Controllers\Api\V1\ModulePermission;

use App\Http\Controllers\Controller;
use App\Http\Resources\Permission\ModulePermissionResource;
use App\Models\ModulePermission;
use App\Services\ModulePermissionService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ModulePermissionController extends Controller
{

    public function __construct(
        public ModulePermissionService $modulePermissionService
    ) {}
    
    /**
     * List all module permissions.
     * 
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $permissionsModule = $this->modulePermissionService->index(request());

        return ModulePermissionResource::collection($permissionsModule);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ModulePermission $modulePermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModulePermission $modulePermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModulePermission $modulePermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModulePermission $modulePermission)
    {
        //
    }
}
