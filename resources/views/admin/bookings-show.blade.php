@extends('layouts.admin')
@section('title','Detail Booking')

@section('content')

<style>
body {
    background: #0b0b0b;
    color: #fff;
}

/* CARD STYLE */
.card-dark {
    background: linear-gradient(145deg,#1a1a1a,#111);
    border: 1px solid #1f1f1f;
    border-radius: 12px;
    padding: 20px;
    color: #fff;
}

/* TITLE */
.page-title {
    color: #ffc107;
    font-weight: 700;
}

/* LABEL */
.label {
    font-size: 12px;
    color: #aaa;
    margin-bottom: 4px;
}

/* VALUE */
.value {
    font-size: 15px;
    color: #e4e6eb;
}

/* SECTION TITLE */
.section-title {
    color: #ffc107;
    font-size: 13px;
    letter-spacing: .5px;
    margin-bottom: 15px;
}

/* BADGE */
.badge-pending {
    background: #ffc107;
    color: #111;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 12px;
}

.badge-success {
    background: #1dd1a1;
    color: #0b0b0b;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 12px;
}

.badge-danger {
    background: #e74c3c;
    color: #fff;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 12px;
}

/* BUTTON */
.btn-back {
    border: 1px solid #444;
    color: #ccc;
}

.btn-back:hover {
    border-color: #ffc107;
    color: #ffc107;
}

.btn-primary {
    background: #ffc107 !important;
    border: none !important;
    color: #111 !important;
    font-weight: 600;
}

.btn-primary:hover {
    background: #e0aa06 !important;
}

.btn-outline-light {
    border: 1px solid #444 !important;
    color: #ccc !important;
}

.btn-outline-light:hover {
    border-color: #ffc107 !important;
    color: #ffc107 !important;
}
</style>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="page-title">Detail Booking</h2>
            <p style="color:#aaa;">Informasi lengkap booking & pembayaran</p>
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-back">
            ← Kembali
        </a>

    </div>

    <div class="row g-4">

        {{-- LEFT: BOOKING INFO --}}
        <div class="col-md-7">

            <div class="card-dark">

                <div class="section-title">INFORMASI BOOKING</div>

                <div class="mb-3">
                    <div class="label">Customer</div>
                    <div class="value">{{ $booking->customer_name ?? 'Adrian Wijaya' }}</div>
                </div>

                <div class="mb-3">
                    <div class="label">Barbershop</div>
                    <div class="value">{{ $booking->barbershop ?? 'BarberKing' }}</div>
                </div>

                <div class="mb-3">
                    <div class="label">Tanggal</div>
                    <div class="value">{{ $booking->date ?? '2026-04-29' }}</div>
                </div>

                <div class="mb-3">
                    <div class="label">Jam</div>
                    <div class="value">{{ $booking->time ?? '14:30' }}</div>
                </div>

                <div class="mb-3">
                    <div class="label">Status Booking</div>
                    <span class="badge-pending">Pending</span>
                </div>

                <div class="mb-3">
                    <div class="label">Catatan</div>
                    <div class="value">Potong rapi, fade tipis</div>
                </div>

            </div>

        </div>

        {{-- RIGHT: PAYMENT --}}
        <div class="col-md-5">

            <div class="card-dark">

                <div class="section-title">PEMBAYARAN</div>

                <div class="mb-3">
                    <div class="label">Invoice</div>
                    <div class="value">INV-000123</div>
                </div>

                <div class="mb-3">
                    <div class="label">Nominal</div>
                    <div class="value" style="color:#ffc107;">Rp 75.000</div>
                </div>

                <div class="mb-3">
                    <div class="label">Metode</div>
                    <div class="value">QRIS</div>
                </div>

                <div class="mb-3">
                    <div class="label">Status Payment</div>
                    <span class="badge-success">Success</span>
                </div>

            </div>

                

        </div>

    </div>

</div>

@endsection 