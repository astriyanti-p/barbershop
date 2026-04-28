@extends('layouts.admin')

@section('title', 'Login Sistem')

@section('content')

<style>
body {
    background: radial-gradient(circle at top, #111 0%, #000 70%);
    height: 100vh;
    color: #fff;
}

.login-card {
    background: linear-gradient(145deg,#1a1a1a,#0d0d0d);
    border: 1px solid rgba(255,193,7,0.2);
    border-radius: 12px;
    padding: 35px;
    box-shadow: 0 0 40px rgba(0,0,0,0.7);
}

.brand {
    color: #ffc107;
    font-weight: bold;
    letter-spacing: 1px;
}

.form-control {
    background: transparent;
    border: none;
    border-bottom: 1px solid #555;
    border-radius: 0;
    color: white;
}

.form-control:focus {
    background: transparent;
    color: white;
    border-color: #ffc107;
    box-shadow: none;
}

.btn-login {
    background: #ffc107;
    border: none;
    font-weight: bold;
    letter-spacing: 1px;
    padding: 12px;
    transition: .3s;
}

.btn-login:hover {
    background: #ffca2c;
    transform: scale(1.02);
}

.small-text {
    font-size: 12px;
    color: #aaa;
}
</style>

<div class="d-flex justify-content-center align-items-center" style="height:80vh;">
    <div class="col-md-4">

        <div class="login-card">

            <div class="mb-4">
                <span class="brand">🟨 OBSIDIAN AMBER</span>
                <h3 class="mt-2">Login Sistem</h3>
                <div class="small-text">Gunakan akun Admin atau Kasir</div>
            </div>

            <!-- FORM LOGIN -->
            <form onsubmit="loginSystem(event)">

                <div class="mb-4">
                    <label class="small-text">USERNAME</label>
                    <input id="username" type="text" class="form-control" placeholder="Masukkan username">
                </div>

                <div class="mb-4">
                    <label class="small-text">PASSWORD</label>
                    <input id="password" type="password" class="form-control" placeholder="Masukkan password">
                </div>

                <div class="d-flex justify-content-between small-text mb-4">
                    <div><input type="checkbox"> Ingat perangkat</div>
                    <div>v2.0 build</div>
                </div>

                <button class="btn btn-login w-100">
                    MASUK →
                </button>

                <div class="mt-4 small-text">
                    <span style="color:#00ff9c;">●</span> Status sistem: READY
                </div>

            </form>

        </div>

    </div>
</div>

<!-- SCRIPT LOGIN ROLE -->
<script>
function loginSystem(e){
    e.preventDefault()

    let user = document.getElementById("username").value
    let pass = document.getElementById("password").value

    // akun dummy sementara
    if(user === "admin" && pass === "admin123"){
        window.location.href = "/admin/dashboard"
        return
    }

    if(user === "kasir" && pass === "kasir123"){
        window.location.href = "/kasir/bookings"
        return
    }

    alert("Username atau Password salah!")
}
</script>

@endsection
