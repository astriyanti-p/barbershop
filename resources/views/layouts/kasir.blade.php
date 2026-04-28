<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* BACKGROUND */
body{
    background:#161616;
    color:#fff;
    font-family:'Segoe UI', sans-serif;
}

/* SIDEBAR */
.sidebar{
    width:240px;
    min-height:100vh;
    background:#1b1b1b;
    border-right:1px solid #2a2a2a;
}

.brand{
    color:#ffc107;
    font-weight:bold;
    font-size:20px;
}

/* MENU */
.menu-item{
    display:block;
    padding:14px 18px;
    color:#bbb;
    text-decoration:none;
    border-radius:6px;
    margin-bottom:6px;
}
.menu-item:hover{
    background:#222;
    color:#ffc107;
}
.menu-active{
    background:#222;
    color:#ffc107 !important;
    border-left:4px solid #ffc107;
}

/* CONTENT AREA */
.content{
    background:#161616;
    min-height:100vh;
}

/* CARD / PANEL */
.card-dark{
    background:#1f1f1f;
    border:1px solid #2a2a2a;
    padding:25px;
    border-radius:12px;
}

/* INPUT */
input, select{
    background:#2a2a2a !important;
    border:1px solid #333 !important;
    color:#fff !important;
}

/* TABLE */
.table-cashier{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}
.table-cashier th{
    padding:14px;
    background:#202020;
    color:#ffc107;
}
.table-cashier td{
    padding:16px;
    border-bottom:1px solid #2a2a2a;
}

/* BUTTON */
.btn-warning{
    background:#ffc107;
    border:none;
    font-weight:600;
}
</style>
</head>

<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="sidebar p-3">
        <div class="brand mb-4">OBSIDIAN AMBER</div>

        <a href="{{ url('/kasir/bookings') }}"
           class="menu-item {{ Request::is('kasir/bookings') ? 'menu-active' : '' }}">
            Booking
        </a>

        <a href="{{ url('/kasir/products') }}"
           class="menu-item {{ Request::is('kasir/products') ? 'menu-active' : '' }}">
            Products
        </a>
    </div>

        <!-- CONTENT -->
    <div class="content flex-grow-1 p-4">
        @yield('content')
    </div>

</div>

<!-- WAJIB untuk Bootstrap Modal -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
