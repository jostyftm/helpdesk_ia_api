<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\User\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    // ->middleware('throttle:5,1'); // Limit to 5 attempts per minute

    // Route::post('register', [\App\Http\Controllers\Api\V1\AuthController::class, 'register']);
    // Route::post('logout', [\App\Http\Controllers\Api\V1\AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::apiResource('users', UserController::class);