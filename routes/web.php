<?php

use Illuminate\Support\Facades\Route;

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

    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');

    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('admin.reports');

    Route::get('/finance', function () {
        return view('admin.finance');
    })->name('admin.finance');

    Route::get('/catalog', function () {
        return view('admin.catalog');
    })->name('admin.catalog');

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
