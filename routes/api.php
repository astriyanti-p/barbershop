<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Barber\ServiceController;
use App\Http\Controllers\Api\Customer\OrderController;
use App\Http\Controllers\Api\Barber\BarberScheduleController;
use App\Http\Controllers\Api\Customer\BarberBrowseController;
use App\Http\Controllers\Api\Customer\HomeController;
use App\Http\Controllers\Api\Customer\BookingController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'sendOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/book', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
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

// Mengarah ke HomeController
Route::get('/map-shops', [HomeController::class, 'getMapShops']);

// Mengarah ke BookingController
Route::get('/services', [BookingController::class, 'getServices']);
Route::get('/slots', [BookingController::class, 'getSlots']);
