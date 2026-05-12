<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($field, $request->login)
            ->where('role', 'admin')
            ->first();

        if (!$user) {
            return back()->withErrors([
                'login' => 'Email atau username tidak ditemukan.',
            ])->onlyInput('login');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'login' => 'Password salah.',
            ])->onlyInput('login');
        }

        if (!$user->status) {
            return back()->withErrors([
                'login' => 'Akun tidak aktif.',
            ])->onlyInput('login');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/admin/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}