<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LuggageSizeController;

// Rutas públicas
Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/login', [AuthController::class, 'login']);
Route::get('/provincias', [ProvinciaController::class, 'index']);
Route::get('/provincias/{id}', [ProvinciaController::class, 'show']);
Route::get('/provincias/{provincia}/municipios', [ProvinciaController::class, 'municipios']);

// Rutas protegidas por autenticación de Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/user/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('users', UserController::class);
    Route::apiResource('rides', RideController::class);
    Route::apiResource('luggage-sizes', LuggageSizeController::class);

    // Rutas protegidas por el rol de admin
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('cars', CarController::class)->except(['create', 'edit']);
    });
});
