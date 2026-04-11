<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Role\RoleController;
use App\Http\Controllers\Api\V1\ModulePermission\ModulePermissionController;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);

    // Route::post('register', [\App\Http\Controllers\Api\V1\AuthController::class, 'register']);
    // Route::post('logout', [\App\Http\Controllers\Api\V1\AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('check-session', [AuthController::class, 'checkSession']);
    });
    
    Route::apiResource('roles', RoleController::class);
    Route::get('roles/{role}/permissions', [RoleController::class, 'permissions']);
    Route::post('roles/{role}/sync-permissions', [RoleController::class, 'syncPermissions']);

    Route::apiResource('module-permissions', ModulePermissionController::class)->only(['index', 'show']);

    Route::apiResource('users', UserController::class);
});