@extends('layouts.admin')

@section('title', 'Login Sistem')

@section('content')

<style>
/* RESET */
body {
    margin: 0;
    padding: 0;
    overflow: hidden;
}

/* WRAPPER FULL SCREEN */
.login-wrapper {
    position: fixed;
    inset: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    background: radial-gradient(circle at 30% 30%, #1a1a1a, #000);
}

/* 🔥 GLOW ANIMATION */
.login-wrapper::before {
    content: "";
    position: absolute;
    width: 500px;
    height: 500px;
    background: rgba(255,193,7,0.08);
    filter: blur(120px);
    animation: glowMove 10s infinite alternate;
}

@keyframes glowMove {
    from { transform: translate(-100px, -100px); }
    to { transform: translate(120px, 120px); }
}

/* CARD */
.login-card {
    position: relative;
    z-index: 2;

    width: 680px;
    padding: 50px;

    border-radius: 20px;
    background: linear-gradient(145deg, #111, #0a0a0a);
    border: 1px solid rgba(255,255,255,0.08);

    box-shadow: 
        0 0 40px rgba(0,0,0,0.8),
        0 0 60px rgba(255,193,7,0.05);

    animation: fadeIn 0.8s ease;
}

/* ANIMASI MASUK */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* TEXT */
.brand {
    color: #ffc107;
    font-weight: bold;
    letter-spacing: 2px;
}

.subtitle {
    color: #aaa;
    font-size: 13px;
}

.small-text {
    font-size: 12px;
    color: #888;
}

/* INPUT */
.form-control {
    background: #0d0d0d;
    border: 1px solid #333;
    color: white;
    border-radius: 10px;
    padding: 12px;
}

.form-control:focus {
    border-color: #ffc107;
    box-shadow: 0 0 12px rgba(255,193,7,0.2);
}

/* BUTTON */
.btn-login {
    background: linear-gradient(45deg, #ffc107, #ffca2c);
    border: none;
    font-weight: bold;
    padding: 12px;
    border-radius: 10px;
    transition: 0.3s;
}

.btn-login:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(255,193,7,0.5);
}
</style>

<div class="login-wrapper">

    <div class="login-card text-center">

        <!-- HEADER -->
        <div class="mb-4">
            <div class="brand">🟨 OBSIDIAN AMBER</div>
            <h3 class="mt-2">Login Sistem</h3>
            <div class="subtitle">Akses Admin & Kasir</div>
        </div>

        <!-- FORM -->
        <form onsubmit="loginSystem(event)">

            <div class="mb-3 text-start">
                <label class="small-text">Username</label>
                <input id="username" type="text" class="form-control" placeholder="Masukkan username">
            </div>

            <div class="mb-3 text-start">
                <label class="small-text">Password</label>
                <input id="password" type="password" class="form-control" placeholder="Masukkan password">
            </div>

            <div class="d-flex justify-content-between small-text mb-4">
                <div><input type="checkbox"> Ingat</div>
                <div>v2.0</div>
            </div>

            <button class="btn btn-login w-100">
                MASUK →
            </button>

            <div class="mt-4 small-text">
                <span style="color:#00ff9c;">●</span> Sistem aktif
            </div>

        </form>

    </div>

</div>

<script>
function loginSystem(e){
    e.preventDefault()

    let user = document.getElementById("username").value
    let pass = document.getElementById("password").value

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