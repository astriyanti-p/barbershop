<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| PUBLIC (LANDING PAGE)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/daftar-barbershop', function () {
    return view('pages.daftar-barbershop');
})->name('daftar.barbershop');


/*
|--------------------------------------------------------------------------
| AUTH ADMIN & KASIR (WEB LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [WebAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [WebAuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [WebAuthController::class, 'logout'])
    ->name('admin.logout');


/*
|--------------------------------------------------------------------------
| ADMIN AREA (PROTECTED)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->group(function () {

    /* DASHBOARD */
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    /* BOOKINGS */
    Route::get('/bookings', function () {
        return view('admin.bookings');
    })->name('admin.bookings');

    Route::get('/bookings/{id}', function ($id) {
        return view('admin.bookings-show', compact('id'));
    })->name('admin.bookings.show');

    /* USERS */
    Route::get('/users', [AdminUserController::class, 'index'])
    ->name('admin.users');;

    /* REPORTS */
    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('admin.reports');

    /* FINANCE */
    Route::get('/finance', function () {
        return view('admin.finance');
    })->name('admin.finance');

    /* BARBER */
    Route::get('/barber', function () {
        return view('admin.barber');
    })->name('admin.barber');

    Route::get('/barber/{id}', function ($id) {
        return view('admin.barber-detail');
    })->name('admin.barber.detail');

    /* CATALOG */
    Route::get('/catalog', function () {
        return view('admin.catalog');
    })->name('admin.catalog');

    /* PRODUCTS */
    Route::get('/products', function () {
        return view('admin.products');
    })->name('admin.products');

    /* ATTENDANCE */
    Route::get('/attendance', function () {
        return view('admin.attendance');
    })->name('admin.attendance');

});