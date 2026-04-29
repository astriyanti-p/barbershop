<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Man Cave Barbershop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        /* NAVBAR */
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

        /* LOGO */
        .brand-logo {
            width: 42px;
            height: 42px;
            background: #d4a017;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-logo i {
            color: #1a1a1a;
            font-size: 18px;
        }

        /* NAV LINK */
        .navbar-mancave .nav-link {
            color: #cccccc !important;
            font-size: 14px;
            position: relative;
            transition: 0.3s;
        }

        /* UNDERLINE EFFECT */
        .navbar-mancave .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -4px;
            width: 0%;
            height: 2px;
            background: #d4a017;
            transition: 0.3s;
        }

        .navbar-mancave .nav-link:hover::after {
            width: 100%;
        }

        .navbar-mancave .nav-link:hover {
            color: #d4a017 !important;
        }

        /* BUTTON */
        .btn-warning {
            box-shadow: 0 0 10px rgba(212,160,23,0.4);
        }

        .btn-warning:hover {
            transform: scale(1.05);
        }

        /* FOOTER */
        footer {
            color: #888;
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
                <i class="bi bi-scissors"></i>
            </div>
            Man Cave Barbershop
        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <i class="bi bi-list"></i>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-center gap-3">

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}#home">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}#about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}#cara">Cara Kerja</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}#fitur">Fitur</a>
                </li>
                
                <!-- LOGIN ADMIN -->
                <li class="nav-item">
                    <a href="/admin/login" class="btn btn-warning btn-sm">
                        Login Admin
                    </a>
                </li>

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