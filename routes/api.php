<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\LuggageSizeController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/user/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('users', UserController::class);
    Route::apiResource('rides', RideController::class);
    Route::apiResource('luggage-sizes', LuggageSizeController::class);
});

Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/login', [AuthController::class, 'login']);

Route::get('/provincias', [ProvinciaController::class, 'index', 'show']);
Route::get('/municipios', [MunicipioController::class, 'index']);
Route::apiResource('cars', CarController::class)->except(['create', 'edit']);
