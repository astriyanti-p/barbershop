<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    

    <style>
        body {
            background: #0f0f0f;
    color: white;
    padding-top: 30px;
        }

        .navbar-user {
            background: rgba(20,20,20,0.9);
            border-bottom: 1px solid #333;
            padding: 12px 20px;
        }

        .user-left {
            color: #d4a017;
            font-weight: 600;
        }
        .navbar-mancave {
    background: rgba(20, 20, 20, 0.85);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(212, 160, 23, 0.3);
    padding: 0.75rem 2rem;
}
.dashboard-card {
    background: rgba(26,26,26,0.95);
    border: 1px solid #d4a017;
    border-radius: 16px;
    color: white;
    transition: 0.3s;
}

.dashboard-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.5);
}
/* DROPDOWN DARK THEME */
.dropdown-menu {
    background: rgba(26,26,26,0.95);
    border: 1px solid rgba(212,160,23,0.3);
    border-radius: 10px;
}

.dropdown-item {
    color: white;
    transition: 0.2s;
}

.dropdown-item:hover {
    background: rgba(212,160,23,0.1);
    color: #d4a017;
}

.dropdown-divider {
    border-color: rgba(212,160,23,0.2);
}
    </style>
</head>
<body>

<!-- NAVBAR USER -->
<!-- NAVBAR USER -->
<nav class="navbar navbar-mancave fixed-top">
    <div class="container d-flex align-items-center">

        <!-- KIRI: USERNAME -->
        <span class="text-warning fw-bold fs-5">
    Halo, User
</span>

        <!-- KANAN: HAMBURGER DROPDOWN -->
        <div class="dropdown ms-auto">

            <!-- TOGGLE (☰) -->
            <button class="btn text-warning fs-3 border-0 shadow-none p-0"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                ☰
            </button>

            <!-- DROPDOWN MENU -->
           <ul class="dropdown-menu dropdown-menu-end">

    <li>
        <a class="dropdown-item" href="/dashboard">Dashboard</a>
    </li>

    <li>
        <a class="dropdown-item" href="{{ route('profil') }}">Profil</a>
    </li>

    <li>
        <a class="dropdown-item" href="{{ url('/riwayat') }}">Riwayat Booking</a>
    </li>

    <li><hr class="dropdown-divider"></li>

    <li>
        <a class="dropdown-item text-danger" href="/">
            Keluar
        </a>
    </li>

</ul>
        </div>

    </div>
</nav>

<!-- CONTENT -->
@yield('content')

</body>
</html>