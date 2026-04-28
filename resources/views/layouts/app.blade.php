<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Man Cave Barbershop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            background: linear-gradient(
                180deg,
                #1a1a1a 0%,
                #141414 50%,
                #1f1f1f 100%
            );
            color: #cccccc;
            padding-top: 90px;
            overflow-x: hidden;
        }

        .navbar-mancave {
            background: rgba(20, 20, 20, 0.85);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(212, 160, 23, 0.3);
            padding: 0.75rem 2rem;
        }

        .navbar-mancave .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #ffffff;
            font-weight: 500;
            font-size: 15px;
        }

        .navbar-mancave .brand-logo {
            width: 42px;
            height: 42px;
            background-color: #d4a017;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar-mancave .brand-logo svg {
            width: 22px;
            height: 22px;
            fill: #1a1a1a;
        }

        .navbar-mancave .nav-link {
            color: #cccccc !important;
            font-size: 14px;
        }

        .navbar-mancave .nav-link:hover {
            color: #d4a017 !important;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-mancave fixed-top">
    <div class="container">

        <!-- BRAND -->
        <a class="navbar-brand" href="/">
            <div class="brand-logo">
                <svg viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26C17.81 13.47 19 11.38 19 9c0-3.87-3.13-7-7-7zm2 14h-4v-1h4v1zm0-2h-4v-1h4v1z"/>
                </svg>
            </div>
            Man Cave Barbershop
        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="navMenu">

            <ul class="navbar-nav ms-auto align-items-center gap-2">

    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#home">Home</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#about">About Us</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#ourbarber">Our Barber</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#services">Services</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#prices">Prices</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#contact">Contact</a></li>

    <!-- 🔥 JIKA BELUM LOGIN -->
    @guest
        <li class="nav-item">
            <a href="{{ route('login') }}" class="btn btn-warning btn-sm ms-3">
                Login
            </a>
        </li>
    @endguest

    <!-- 🔥 JIKA SUDAH LOGIN -->
    @auth
        <li class="nav-item d-flex align-items-center ms-3">

            <span class="text-warning fw-semibold me-3">
                Halo, {{ auth()->user()->name ?? 'User' }}
            </span>

            <a href="/dashboard" class="btn btn-warning btn-sm me-2">
                Profil
            </a>

            <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-outline-danger btn-sm">
        Logout
    </button>
</form>

        </li>
    @endauth

</ul>

        </div>
    </div>
</nav>

<!-- CONTENT -->
@yield('content')

<!-- FOOTER -->
<footer class="text-center py-3 mt-5">
    Man Cave Barbershop &copy; {{ date('Y') }}
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>