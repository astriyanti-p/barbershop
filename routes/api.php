<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Barber\ServiceController;
use App\Http\Controllers\Api\Customer\OrderController;
use App\Http\Controllers\Api\Barber\BarberScheduleController;
use App\Http\Controllers\Api\Customer\BarberBrowseController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'role:barber'])->group(function () {
    Route::get('/barber/dashboard', function (\Illuminate\Http\Request $request) {
        return response()->json([
            'message' => 'Welcome Barber',
            'role' => $request->user()->role
        ]);
    });
});

Route::middleware(['auth:sanctum', 'role:barber'])
    ->prefix('barber')
    ->group(function () {
        Route::apiResource('services', ServiceController::class);
});

Route::middleware(['auth:sanctum', 'role:customer'])->prefix('customer')->group(function () {
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{order}', [OrderController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'role:barber'])
    ->prefix('barber')
    ->group(function () {
        Route::apiResource('schedules', BarberScheduleController::class);
});

Route::prefix('customer')->group(function () {
    Route::get('/barbers', [BarberBrowseController::class, 'barbers']);
    Route::get('/barbers/{id}', [BarberBrowseController::class, 'barberDetail']);
    Route::get('/barbers/{id}/services', [BarberBrowseController::class, 'services']);
    Route::get('/barbers/{id}/schedules', [BarberBrowseController::class, 'schedules']);
});