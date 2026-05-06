<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BarberProfile;
use Illuminate\Support\Facades\Hash;


class BarberRegisterController extends Controller
{
    public function store(Request $request)
    {
      $request->validate([
    'nama' => 'required',
    'pemilik' => 'required',
    'username' => 'required|unique:users,username',
    'email' => 'required|email|unique:users,email',
    'password' => [
        'required',
        'confirmed',
        'min:6',
        'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/'
    ],
    'no_hp' => 'required|unique:users,phone',
    'alamat' => 'required',
    'deskripsi' => 'required',
    'latitude' => 'required',
    'longitude' => 'required',
    'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
], [
    'email.unique' => 'Email sudah digunakan!',
    'no_hp.unique' => 'No HP sudah digunakan!',
    'username.unique' => 'Username sudah digunakan!',
    'password.confirmed' => 'Password tidak sama!',
    'password.regex' => 'Password harus mengandung huruf dan angka!',
    'password.min' => 'Password minimal 6 karakter!',
    'foto.image' => 'File harus berupa gambar!',
    'foto.mimes' => 'Format gambar harus jpg, jpeg, atau png!',
    'foto.max' => 'Ukuran gambar maksimal 2MB!',
    'foto.required' => 'Foto wajib diisi!',
    'nama.required' => 'Nama barbershop wajib diisi!',
    'pemilik.required' => 'Nama pemilik wajib diisi!',
    'username.required' => 'Username wajib diisi!',
    'email.required' => 'Email wajib diisi!',
    'password.required' => 'Password wajib diisi!',
    'password.confirmed' => 'Konfirmasi password wajib diisi!',
    'no_hp.required' => 'No HP wajib diisi!',
    'alamat.required' => 'Alamat wajib diisi!',
    'deskripsi.required' => 'Deskripsi wajib diisi!',
    'latitude.required' => 'Latitude wajib diisi!',
    'longitude.required' => 'Longitude wajib diisi!',
    'foto.required' => 'Foto wajib diisi!',
]);
        // UPLOAD FOTO (optional)
        $photoPath = null;
        if ($request->hasFile('foto')) {
            $photoPath = $request->file('foto')->store('barbers', 'public');
        }

        $username = $request->username;

        // SIMPAN USER
        $user = User::create([
    'name' => $request->pemilik,
    'username' => $username,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'phone' => $request->no_hp,
    'address' => $request->alamat,
    'photo' => $photoPath,
    'role' => 'barber',
    'status' => 0
]);

        // SIMPAN BARBER PROFILE
        BarberProfile::create([
            'user_id' => $user->id,
            'shop_name' => $request->nama,
            'bio' => $request->deskripsi,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'rating' => 0
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil! Tunggu konfirmasi admin ya.');
    }
}