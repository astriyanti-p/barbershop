@extends('layouts.app')

@section('content')

<section style="height:100vh; display:flex; align-items:center; justify-content:center; background:#0f0f0f;">

    <form method="POST" action="{{ route('register.submit') }}"
        style="width:380px; padding:35px; background:#1a1a1a; border-radius:14px; border:1px solid #2a2a2a; box-shadow:0 10px 30px rgba(0,0,0,0.5);">

        @csrf

        <h2 style="color:#d4a017; text-align:center; margin-bottom:25px; letter-spacing:2px;">
            REGISTER
        </h2>

        <input type="text" name="username" placeholder="Username"
            style="width:100%; padding:12px; margin-bottom:12px; border-radius:8px; border:none; outline:none; background:#2a2a2a; color:#fff;">

        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap"
            style="width:100%; padding:12px; margin-bottom:12px; border-radius:8px; border:none; outline:none; background:#2a2a2a; color:#fff;">

        <input type="email" name="email" placeholder="Email"
            style="width:100%; padding:12px; margin-bottom:12px; border-radius:8px; border:none; outline:none; background:#2a2a2a; color:#fff;">

        <input type="password" name="password" placeholder="Password"
            style="width:100%; padding:12px; margin-bottom:20px; border-radius:8px; border:none; outline:none; background:#2a2a2a; color:#fff;">

        <button type="submit"
            style="width:100%; padding:12px; background:#d4a017; border:none; border-radius:8px; font-weight:bold; cursor:pointer; transition:0.3s;">
            Create Account
        </button>

        <p class="mt-3 text-center" style="color:#ccc;">
            Sudah punya akun?
            <a href="{{ route('login') }}" style="color:#d4a017; text-decoration:none;">
                Login
            </a>
        </p>

    </form>

</section>

@endsection