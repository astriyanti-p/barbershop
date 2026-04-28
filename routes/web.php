<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

/* ================= REGISTER ================= */
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'username' => 'required',
        'nama_lengkap' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    User::create([
        'name' => $request->nama_lengkap,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('login');
})->name('register.submit');

/* ================= LOGIN ================= */
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('profil');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah',
    ]);
})->name('login.submit');

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

/* ================= USER ================= */
Route::view('/dashboard', 'user.dashboard');

Route::get('/profil', function () {
    return view('user.profil');
})->name('profil');

Route::get('/riwayat', function () {
    return view('user.riwayat');
})->name('riwayat');

Route::get('/profil/edit', function () {
    return view('user.edit-profil');
})->name('profil.edit');

Route::post('/profil/update', function () {
    return redirect()->route('profil');
})->name('profil.update');

Route::view('/detail-booking', 'user.detail-booking');

/* ================= LOGOUT ================= */
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');