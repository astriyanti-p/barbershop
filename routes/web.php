<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;

/* ================= HOME ================= */
Route::get('/', function () {
    return view('pages.home');
});


/* ================= ADMIN ================= */
Route::prefix('admin')->group(function () {

    Route::get('/login', function () {
        return view('admin.login');
    })->name('admin.login');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/bookings', function () {
        return view('admin.bookings');
    })->name('admin.bookings');

    // ✅ USERS SEKARANG PAKAI CONTROLLER (INI YANG BENAR)
    Route::get('/users', [AdminUserController::class,'index'])
        ->name('admin.users');

    Route::get('/users/create', [AdminUserController::class,'create'])
    ->name('admin.users.create');

    Route::post('/users/store', [App\Http\Controllers\AdminUserController::class,'store'])
    ->name('admin.users.store');

    // EDIT USER
Route::get('/users/edit/{id}', [AdminUserController::class,'edit'])
    ->name('admin.users.edit');

Route::post('/users/update/{id}', [AdminUserController::class,'update'])
    ->name('admin.users.update');

// DELETE USER
Route::get('/users/delete/{id}', [AdminUserController::class,'delete'])
    ->name('admin.users.delete');

    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('admin.reports');

    Route::get('/finance', function () {
        return view('admin.finance');
    })->name('admin.finance');

    Route::get('/barber', function () {
        return view('admin.barber');
    })->name('admin.barber');

    Route::get('/barber/{id}', function ($id) {
        return view('admin.barber-detail');
    })->name('admin.barber.detail');

    Route::get('/products', function () {
        return view('admin.products');
    })->name('admin.products');

    Route::get('/attendance', function () {
        return view('admin.attendance');
    })->name('admin.attendance');

});


/* ================= KASIR ================= */
Route::prefix('kasir')->group(function () {

    Route::get('/dashboard', function () {
        return view('kasir.dashboard');
    })->name('kasir.dashboard');

    Route::get('/bookings', function () {
        return view('kasir.bookings');
    })->name('kasir.bookings');

    Route::get('/products', function () {
        return view('kasir.products');
    })->name('kasir.products');

});
