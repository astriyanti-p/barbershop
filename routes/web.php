<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Admin\AuthController;

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
        'role' => 'user',
    ]);

    return redirect()->route('login');
})->name('register.submit');


/* ================= LOGIN USER ================= */
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
Route::get('/daftar-barbershop', function () {
    return view('pages.daftar-barbershop');
})->name('daftar.barbershop');


/* ================= ADMIN ================= */
    Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
      // Semua route admin di bawah ini wajib sudah login
    Route::middleware('auth')->group(function () {
        
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
        Route::get('/bookings', function () {
            return view('admin.bookings');
        })->name('admin.bookings');
        
        Route::get('/bookings/{id}', function ($id) {
            return view('admin.bookings-show', compact('id'));
        })->name('admin.bookings.show');
        
        Route::get('/users', function () {
            return view('admin.users');
        })->name('admin.users');
        
        Route::get('/reports', function () {
            return view('admin.reports');
        })->name('admin.reports');
        
        Route::get('/finance', function () {
            return view('admin.finance');
        })->name('admin.finance');
        
        Route::get('/barber', function () {
            return view('admin.barber');
        })->name('admin.barber');
        Route::get('/admin/barber/edit/{id}', function ($id) {
    return view('admin.edit-barber', compact('id'));
})->name('admin.barber.edit');
        
        Route::get('/barber/{id}', function ($id) {
            return view('admin.barber-detail');
        })->name('admin.barber.detail');
        
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
});


    // /* LOGIN ADMIN */
    // Route::get('/login', function () {
    //     return view('admin.login');
    // })->name('admin.login');

//     /* DASHBOARD */
//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');

//     /* BOOKING */
//     Route::get('/bookings', function () {
//         return view('admin.bookings');
//     })->name('admin.bookings');

//     // ✅ FIX: ini sebelumnya salah route (double /admin)
//     Route::get('/bookings/{id}', function ($id) {
//         return view('admin.bookings-show', compact('id'));
//     })->name('admin.bookings.show');

//     /* USERS */
//     Route::get('/users', function () {
//         return view('admin.users');
//     })->name('admin.users');

//     /* REPORTS */
//     Route::get('/reports', function () {
//         return view('admin.reports');
//     })->name('admin.reports');

//     /* FINANCE */
//     Route::get('/finance', function () {
//         return view('admin.finance');
//     })->name('admin.finance');

//     /* BARBER */
//     Route::get('/barber', function () {
//         return view('admin.barber');
//     })->name('admin.barber');

//     Route::get('/barber/{id}', function ($id) {
//         return view('admin.barber-detail');
//     })->name('admin.barber.detail');

//     /* CATALOG */
//     Route::get('/catalog', function () {
//         return view('admin.catalog');
//     })->name('admin.catalog');

//     /* PRODUCTS */
//     Route::get('/products', function () {
//         return view('admin.products');
//     })->name('admin.products');

//     /* ATTENDANCE */
//     Route::get('/attendance', function () {
//         return view('admin.attendance');
//     })->name('admin.attendance');
// });


// /* ================= KASIR ================= */
// Route::prefix('kasir')->group(function () {

//     Route::get('/dashboard', function () {
//         return view('kasir.dashboard');
//     })->name('kasir.dashboard');

//     Route::get('/bookings', function () {
//         return view('kasir.bookings');
//     })->name('kasir.bookings');

//     Route::get('/products', function () {
//         return view('kasir.products');
//     })->name('kasir.products');

// });


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