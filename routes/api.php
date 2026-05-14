<?php

use Illuminate\Support\Facades\Route;

// --- CONTROLLERS ---
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Customer\ProfileController;
use App\Http\Controllers\Api\Customer\HomeController;
use App\Http\Controllers\Api\Customer\BookingController;
use App\Http\Controllers\Api\Customer\BarberBrowseController;
use App\Http\Controllers\Api\Customer\OrderController;
use App\Http\Controllers\Api\Barber\ServiceController;
use App\Http\Controllers\Api\Barber\BarberScheduleController;
use App\Http\Controllers\Api\Customer\ExploreController;

// ==========================================
// 1. PUBLIC ROUTES (Tanpa Login - Agar Flutter Lancar)
// ==========================================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'sendOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Data yang boleh dilihat orang sebelum/sesudah login
Route::get('/map-shops', [HomeController::class, 'getMapShops']);
Route::get('/services', [BookingController::class, 'getServices']);
Route::get('/slots', [BookingController::class, 'getSlots']);
Route::get('/popular-styles', [HomeController::class, 'getPopularStyles']);
Route::get('/explore', [ExploreController::class, 'index']);


// ==========================================
// 2. PROTECTED ROUTES (WAJIB LOGIN)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // --- PROFILE ---
    Route::get('/profile', [ProfileController::class, 'getProfile']);
    Route::post('/profile/update', [ProfileController::class, 'updateProfile']);
    Route::post('/profile/update-email', [ProfileController::class, 'updateEmail']);
    Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto']);

    // --- TRANSAKSI (HARUS DI DALAM SINI) ---
    // Supaya Laravel tahu siapa yang beli
    Route::post('/book', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);

    // --- JELAJAH CUSTOMER ---
    Route::prefix('customer')->group(function () {
        Route::get('/barbers', [BarberBrowseController::class, 'barbers']);
        Route::get('/barbers/{id}', [BarberBrowseController::class, 'barberDetail']);
        Route::get('/orders/{order}', [OrderController::class, 'show']);
    });

    // --- KHUSUS PEMILIK BARBER ---
    Route::middleware('role:barber')->prefix('barber')->group(function () {
        Route::apiResource('services', ServiceController::class);
        Route::apiResource('schedules', BarberScheduleController::class);
    });
});
