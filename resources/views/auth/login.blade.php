@extends('layouts.app')

@section('content')

<section style="height:100vh; display:flex; align-items:center; justify-content:center; background:#0f0f0f;">

    <form style="width:350px; padding:30px; background:#1a1a1a; border-radius:12px; border:1px solid #2a2a2a;">

        <h2 style="color:#d4a017; text-align:center; margin-bottom:20px;">
            Login
        </h2>

        <!-- EMAIL -->
        <input type="text" placeholder="Email"
            style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:none; outline:none; background:#2a2a2a; color:#fff;">

        <!-- PASSWORD -->
        <div style="position:relative; margin-bottom:20px;">

            <input id="password" type="password" placeholder="Password"
                style="width:100%; padding:10px 40px 10px 10px; border-radius:8px; border:none; outline:none; background:#2a2a2a; color:#fff;">

            <i id="toggleIcon"
               class="bi bi-eye"
               onclick="togglePassword()"
               style="position:absolute; right:10px; top:50%; transform:translateY(-50%); cursor:pointer; color:#d4a017; font-size:18px;">
            </i>

        </div>

        <!-- BUTTON LOGIN -->
        <a href="/dashboard"
           style="display:block; text-align:center; width:100%; padding:10px; background:#d4a017; color:#000; border-radius:8px; text-decoration:none; font-weight:bold;">
            Login
        </a>

        <!-- REGISTER LINK -->
        <p style="margin-top:15px; text-align:center; color:#ccc;">
            Belum punya akun?
            <a href="{{ route('register') }}" style="color:#d4a017; text-decoration:none;">
                Register
            </a>
        </p>

    </form>

</section>

<!-- TOGGLE PASSWORD SCRIPT -->
<script>
function togglePassword() {
    const input = document.getElementById("password");
    const icon = document.getElementById("toggleIcon");

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    }
}
</script>

@endsection