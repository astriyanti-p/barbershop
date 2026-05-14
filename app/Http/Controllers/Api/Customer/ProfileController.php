<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // ==========================================
    // 1. AMBIL DATA PROFIL TERBARU
    // ==========================================
    public function getProfile(Request $request)
    {
        $user = $request->user();
        if ($user->photo) {
            $user->photo_url = asset('storage/' . $user->photo);
        }
        return response()->json($user);
    }

    // ==========================================
    // 2. UPDATE DATA DIRI (Nama, HP, Alamat)
    // ==========================================
    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string'
        ]);

        if ($request->has('name')) $user->name = $request->name;
        if ($request->has('phone')) $user->phone = $request->phone;
        if ($request->has('address')) $user->address = $request->address;

        $user->save();
        return response()->json(['status' => 'success', 'message' => 'Profil diperbarui!', 'user' => $user]);
    }

    // ==========================================
    // 3. GANTI EMAIL UTAMA
    // ==========================================
    public function updateEmail(Request $request)
    {
        $request->validate([
            'new_email' => 'required|email|unique:users,email',
            'password' => 'required'
        ], [
            'new_email.unique' => 'Email ini sudah terdaftar. Gunakan email lain.'
        ]);

        $user = $request->user();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Password saat ini salah!'], 401);
        }

        $user->email = $request->new_email;
        $user->save();
        return response()->json(['status' => 'success', 'message' => 'Email utama berhasil diperbarui!']);
    }

    // ==========================================
    // 4. UPDATE FOTO PROFIL
    // ==========================================
    public function updatePhoto(Request $request)
    {
        $request->validate(['photo' => 'required|image|max:2048']);
        $user = $request->user();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profiles', 'public');
            $user->photo = $path;
            $user->save();

            return response()->json([
                'status' => 'success',
                'photo_url' => asset('storage/' . $path)
            ]);
        }
        return response()->json(['message' => 'Gagal upload file'], 400);
    }
}
