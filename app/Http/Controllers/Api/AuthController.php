<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\OtpMail;

class AuthController extends Controller
{
    // ==========================================
    // 1. REGISTER
    // ==========================================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:8|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:customer,barber',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => true,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Register success',
            'token' => $token,
            'user' => $user
        ]);
    }

    // ==========================================
    // 2. LOGIN
    // ==========================================
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->login)
            ->orWhere('username', $request->login)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login success',
            'token' => $token,
            'user' => $user
        ]);
    }

    // ==========================================
    // 3. LOGOUT
    // ==========================================
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout success'
        ]);
    }

    // ==========================================
    // 4. KIRIM OTP (LUPA PASSWORD)
    // ==========================================
    public function sendOtp(Request $request)
    {
        // Validasi apakah email ada di database
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Email tidak terdaftar di sistem kami.'
        ]);

        $email = $request->email;
        $otp = rand(100000, 999999);
        $expiry = Carbon::now()->addMinutes(5); // Berlaku 5 menit

        // Simpan OTP ke tabel users
        $user = User::where('email', $email)->first();
        $user->otp_code = $otp;
        $user->otp_expiry = $expiry;
        $user->save();

        // Eksekusi Kirim Email menggunakan Mailable
        try {
            Mail::to($email)->send(new OtpMail($otp));

            return response()->json([
                'status' => 'success',
                'message' => 'Kode OTP berhasil dikirim ke email Anda.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengirim email: ' . $e->getMessage()
            ], 500);
        }
    }

    // ==========================================
    // 5. VERIFIKASI OTP
    // ==========================================
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6'
        ]);

        $user = User::where('email', $request->email)
            ->where('otp_code', $request->otp)
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Kode OTP salah!'], 400);
        }

        // Cek apakah expired (waktu sekarang lebih dari waktu expired di DB)
        if (Carbon::now()->greaterThan($user->otp_expiry)) {
            return response()->json(['message' => 'Kode OTP sudah kedaluwarsa!'], 400);
        }

        return response()->json(['status' => 'success', 'message' => 'OTP Valid']);
    }

    // ==========================================
    // 6. GANTI PASSWORD BARU
    // ==========================================
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        // Ganti password dan hanguskan OTP lama
        $user->password = Hash::make($request->password);
        $user->otp_code = null;
        $user->otp_expiry = null;
        $user->save();

        return response()->json(['status' => 'success', 'message' => 'Password berhasil diubah! Silakan login.']);
    }
}
