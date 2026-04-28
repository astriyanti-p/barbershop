@extends('layouts.dashboard')

@section('content')

<div class="container py-5">

    <!-- HEADER -->
    <div class="mb-4">
        <h2 class="text-warning">Dashboard User</h2>
        <p class="text-secondary">Ringkasan booking & transaksi Anda</p>
    </div>

    <div class="row g-4 mb-4">

        <!-- STATUS BOOKING AKTIF -->
        <div class="col-md-6">
            <div class="card dashboard-card p-4 h-100">

                <h5 class="text-warning mb-3">Status Booking Aktif</h5>

                <div class="mb-2">
                    <span class="badge bg-success">PAID</span>
                </div>

                <p><b>Layanan:</b> Haircut Fade</p>
                <p><b>Barber:</b> Rudi</p>
                <p><b>Jadwal:</b> 23 April 2026 - 14:30</p>

            </div>
        </div>

        <!-- QR CODE / KODE BOOKING -->
        <div class="col-md-6">
        <div class="card dashboard-card p-4 h-100 text-center">

        <h5 class="text-warning mb-3">Kode Booking</h5>

        <h3 class="text-light">{{ $booking->kode_booking ?? 'MCB-2026-00921' }}</h3>
        <p class="text-secondary">Andree</p>

        <p class="text-secondary small">Sebutkan kode ini ke kasir</p>

        </div>
    </div>
    </div>

        <!-- DETAIL BOOKING -->
        <div class="col-md-12 mb-4">
    <a href="/detail-booking?item=1" class="text-decoration-none">
        <div class="card dashboard-card p-4">

            <h5 class="text-warning mb-3">Detail Booking</h5>

            <div class="row">
                <div class="col-md-4">
                    <p><b>Layanan:</b> Haircut Fade</p>
                </div>
                <div class="col-md-4">
                    <p><b>Harga:</b> Rp 35.000</p>
                </div>
                <div class="col-md-4">
                    <p><b>Pembayaran:</b> Lunas</p>
                </div>
            </div>

        </div>
    </a>
</div>

        
       <!-- RIWAYAT BOOKING -->
        <div class="col-md-12 mb-4">
    <a href="/riwayat" class="text-decoration-none">
        <div class="card dashboard-card p-4">

            <h5 class="text-warning mb-3">Riwayat Booking</h5>

            <ul class="list-group list-group-dark">

                <a href="/detail-booking?item=1" class="list-group-item bg-dark text-white d-flex justify-content-between text-decoration-none">
                    Haircut Fade
                    <span class="badge bg-success">Selesai</span>
                </a>

                <a href="/detail-booking?item=2" class="list-group-item bg-dark text-white d-flex justify-content-between text-decoration-none">
                    Cukur Jenggot
                    <span class="badge bg-success">Selesai</span>
                </a>

                <a href="/detail-booking?item=3" class="list-group-item bg-dark text-white d-flex justify-content-between text-decoration-none">
                    Hair Coloring
                    <span class="badge bg-warning text-dark">Pending</span>
                </a>

            </ul>

        </div>
    </a>
</div>

<!-- STYLE -->
<style>
.dashboard-card {
    background: rgba(26,26,26,0.9);
    border: 1px solid rgba(212,160,23,0.2);
    border-radius: 16px;
    color: white;
    transition: 0.3s;
}

.dashboard-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.5);
    border-color: #d4a017;
}

.qr-box {
    width: 160px;
    height: 160px;
    padding: 10px;
    background: white;
    border-radius: 12px;
}
.dashboard-card {
    cursor: pointer;
}
</style>

@endsection