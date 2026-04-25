<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;



/* REGISTER GET */
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

/* REGISTER POST */
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


Route::get('/', function () {
    return view('pages.home');
});

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
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');

Route::get('/dashboard', function () {
    return view('user.dashboard');
});

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
Route::view('/dashboard', 'user.dashboard');

/* LOGOUT */
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');     