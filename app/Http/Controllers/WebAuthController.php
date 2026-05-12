<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        if (Auth::attempt([$field => $request->login, 'password' => $request->password])) {
            $request->session()->regenerate();

            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'login' => 'Akses hanya untuk admin.',
                ]);
            }

            return redirect('/admin/dashboard');
        }

        return back()->withErrors([
            'login' => 'Login gagal.',
        ]);
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}