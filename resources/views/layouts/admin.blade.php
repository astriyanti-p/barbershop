<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
body{
    background:#0b0b0b;
    color:#fff;
    font-family: 'Segoe UI', sans-serif;
}

/* SIDEBAR */
.sidebar{
    width:240px;
    height:100vh;
    position:fixed;
    background:#0d0d0d;
    border-right:1px solid #1f1f1f;
}

.sidebar .brand{
    color:#ffc107;
    font-weight:bold;
    padding:20px;
    font-size:20px;
}

.menu-item{
    padding:14px 22px;
    color:#aaa;
    display:block;
    text-decoration:none;
}
.menu-item:hover{
    background:#111;
    color:#ffc107;
}
.menu-active{
    background:#111;
    border-left:4px solid #ffc107;
    color:#ffc107;
}

/* CONTENT AREA */
.main{
    margin-left:240px;
    padding:25px;
}

/* TOPBAR */
.topbar{
    display:flex;
    justify-content:space-between;
    margin-bottom:25px;
}

.card-dark{
    background:linear-gradient(145deg,#1a1a1a,#111);
    border:1px solid #1f1f1f;
    padding:25px;
    border-radius:10px;
}

.yellow{ color:#ffc107 }
.small-text{ font-size:12px; color:#aaa }

.page-title{ font-size:32px; font-weight:700 }
.section-label{ color:#ffc107; font-size:12px; letter-spacing:2px }

.search-box{
    background:#0d0d0d;
    border:1px solid #222;
    padding:14px;
    color:#fff;
    width:100%;
}

.table-dark-custom{
    width:100%;
    border-collapse:collapse;
}

.table-dark-custom th{
    font-size:12px;
    color:#aaa;
    padding:14px;
    border-bottom:1px solid #222;
}

.table-dark-custom td{
    padding:18px 14px;
    border-bottom:1px solid #1a1a1a;
}

.badge-status{
    font-size:11px;
    letter-spacing:1px;
}
.status-progress{ color:#ffc107 }
.status-waiting{ color:#4da3ff }
.status-confirm{ color:#1dd1a1 }

.right-panel{
    background:#111;
    border:1px solid #1f1f1f;
    padding:20px;
    border-radius:10px;
}

.menu-active{
    background:#111;
    border-left:4px solid #ffc107;
    color:#ffc107 !important;
}
</style>
</head>

<body>

@if(!Request::is('admin/login'))

<div class="sidebar">
    <div class="brand">OBSIDIAN AMBER</div>

    <a href="{{ url('/admin/dashboard') }}"
   class="menu-item {{ Request::is('admin/dashboard') ? 'menu-active' : '' }}">
   Dashboard
    </a>
    <a href="{{ url('/admin/bookings') }}"
    class="menu-item {{ Request::is('admin/bookings') ? 'menu-active' : '' }}">
   Booking
    </a>
    <a href="{{ url('/admin/users') }}"
    class="menu-item {{ Request::is('admin/users') ? 'menu-active' : '' }}">
   User
    </a>
    <a href="{{ url('/admin/reports') }}"
    class="menu-item {{ Request::is('admin/reports') ? 'menu-active' : '' }}">
   Report
    </a>
    <a href="{{ url('/admin/finance') }}"
    class="menu-item {{ Request::is('admin/finance') ? 'menu-active' : '' }}">
   Finance
    </a>
    <a href="{{ url('/admin/catalog') }}"
    class="menu-item {{ Request::is('admin/catalog') ? 'menu-active' : '' }}">
   Katalog
    </a>
    <a href="{{ url('/admin/products') }}"
    class="menu-item {{ Request::is('admin/products') ? 'menu-active' : '' }}">
   Product
    </a>
    <a href="{{ url('/admin/attendance') }}"
    class="menu-item {{ Request::is('admin/attendance') ? 'menu-active' : '' }}">
   Presensi Staff
    </a>
</div>

@endif

<div class="main">
    @yield('content')
</div>

</body>
</html>
