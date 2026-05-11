@extends('layouts.admin')
@section('title','Detail Booking')

@section('content')

<style>
body{
    background:#0b0b0b;
    color:#fff;
}

/* CARD */
.card-dark{
    background:linear-gradient(145deg,#1a1a1a,#111);
    border:1px solid #1f1f1f;
    border-radius:16px;
    padding:24px;
    color:#fff;
    box-shadow:0 10px 25px rgba(0,0,0,.25);
}

/* TITLE */
.page-title{
    color:#ffc107;
    font-weight:700;
}

/* LABEL */
.label{
    font-size:12px;
    color:#999;
    margin-bottom:4px;
    text-transform:uppercase;
    letter-spacing:.5px;
}

/* VALUE */
.value{
    font-size:15px;
    color:#e4e6eb;
    font-weight:500;
}

/* SECTION */
.section-title{
    color:#ffc107;
    font-size:13px;
    margin-bottom:20px;
    letter-spacing:1px;
    font-weight:700;
}

/* BADGE */
.badge-pending{
    background:#ffc107;
    color:#111;
    padding:6px 12px;
    border-radius:8px;
    font-size:12px;
    font-weight:600;
}

.badge-success{
    background:#1dd1a1;
    color:#111;
    padding:6px 12px;
    border-radius:8px;
    font-size:12px;
    font-weight:600;
}

.badge-danger{
    background:#e74c3c;
    color:#fff;
    padding:6px 12px;
    border-radius:8px;
    font-size:12px;
    font-weight:600;
}

/* BUTTON */
.btn-back{
    border:1px solid #333;
    color:#ccc;
    padding:10px 18px;
    border-radius:10px;
}

.btn-back:hover{
    border-color:#ffc107;
    color:#ffc107;
}

/* ITEM */
.info-item{
    padding-bottom:14px;
    margin-bottom:14px;
    border-bottom:1px solid #1f1f1f;
}

.info-item:last-child{
    border-bottom:none;
    margin-bottom:0;
    padding-bottom:0;
}

/* SERVICE BOX */
.service-box{
    background:#141414;
    border:1px solid #242424;
    border-radius:12px;
    padding:16px;
}

.service-name{
    font-size:18px;
    font-weight:700;
    color:#ffc107;
}

.service-price{
    color:#1dd1a1;
    font-weight:700;
    font-size:16px;
}
</style>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="page-title">Detail Booking</h2>
            <p style="color:#888;">
                Informasi lengkap booking & pembayaran
            </p>
        </div>

       

    </div>

    <div class="row g-4">

        {{-- LEFT --}}
        <div class="col-lg-7">

            <div class="card-dark">

                <div class="section-title">
                    INFORMASI BOOKING
                </div>

                {{-- CUSTOMER --}}
                <div class="info-item">
                    <div class="label">Customer</div>
                    <div class="value">
                        {{ $booking->customer->name ?? '-' }}
                    </div>
                </div>

                {{-- BARBERSHOP --}}
                <div class="info-item">
                    <div class="label">Barbershop</div>
                    <div class="value">
                        {{ $booking->barber->barberProfile->shop_name ?? '-' }}
                    </div>
                </div>

                {{-- LAYANAN --}}
                <div class="info-item">

                    <div class="label mb-3">
                        Layanan Dipilih
                    </div>

                    <div class="service-box">

                        <div class="service-name">
                            {{ $booking->service->name ?? '-' }}
                        </div>

                        <div class="mt-2 text-secondary">
                            {{ $booking->service->description ?? '-' }}
                        </div>

                        <div class="d-flex justify-content-between mt-3">

                            <div>
                                <small class="text-secondary">
                                    Durasi
                                </small>

                                <div class="value">
                                    {{ $booking->service->duration ?? 0 }} Menit
                                </div>
                            </div>

                            <div class="text-end">
                                <small class="text-secondary">
                                    Harga
                                </small>

                                <div class="service-price">
                                    Rp {{ number_format($booking->service->price ?? 0,0,',','.') }}
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- TANGGAL --}}
                <div class="info-item">
                    <div class="label">Tanggal Booking</div>
                    <div class="value">
                        {{ $booking->booking_date ?? '-' }}
                    </div>
                </div>

                {{-- JAM --}}
                <div class="info-item">
                    <div class="label">Jam Booking</div>
                    <div class="value">
                        {{ $booking->booking_time ?? '-' }}
                    </div>
                </div>

                {{-- STATUS --}}
                <div class="info-item">
                    <div class="label">Status Booking</div>

                    @if($booking->status == 'pending')

                        <span class="badge-pending">
                            Pending
                        </span>

                    @elseif($booking->status == 'confirmed')

                        <span class="badge-success">
                            Confirmed
                        </span>

                    @elseif($booking->status == 'completed')

                        <span class="badge-success">
                            Completed
                        </span>

                    @else

                        <span class="badge-danger">
                            Cancelled
                        </span>

                    @endif
                </div>

                {{-- NOTES --}}
                <div class="info-item">
                    <div class="label">Catatan</div>

                    <div class="value">
                        {{ $booking->notes ?? '-' }}
                    </div>
                </div>

            </div>

        </div>

        {{-- RIGHT --}}
        <div class="col-lg-5">

            <div class="card-dark">

                <div class="section-title">
                    PEMBAYARAN
                </div>

                {{-- INVOICE --}}
                <div class="info-item">
                    <div class="label">Invoice</div>

                    <div class="value">
                        {{ $booking->order_code }}
                    </div>
                </div>

                {{-- TOTAL --}}
                <div class="info-item">
                    <div class="label">Total Pembayaran</div>

                    <div class="service-price">
                        Rp {{ number_format($booking->total_amount,0,',','.') }}
                    </div>
                </div>

                {{-- PAYMENT METHOD --}}
                <div class="info-item">
                    <div class="label">Metode Pembayaran</div>

                    <div class="value">
                        {{ $booking->payment_method ?? '-' }}
                    </div>
                </div>

                {{-- PAYMENT GATEWAY --}}
                <div class="info-item">
                    <div class="label">Payment Gateway</div>

                    <div class="value">
                        {{ $booking->payment_gateway ?? '-' }}
                    </div>
                </div>

                {{-- TRANSACTION ID --}}
                <div class="info-item">
                    <div class="label">Transaction ID</div>

                    <div class="value">
                        {{ $booking->transaction_id ?? '-' }}
                    </div>
                </div>

                {{-- PAYMENT STATUS --}}
                <div class="info-item">
                    <div class="label">Status Pembayaran</div>

                    @if($booking->payment_status == 'paid')

                        <span class="badge-success">
                            Paid
                        </span>

                    @elseif($booking->payment_status == 'pending')

                        <span class="badge-pending">
                            Pending
                        </span>

                    @else

                        <span class="badge-danger">
                            {{ ucfirst($booking->payment_status) }}
                        </span>

                    @endif
                </div>

                {{-- PAID AT --}}
                <div class="info-item">
                    <div class="label">Tanggal Pembayaran</div>

                    <div class="value">
                        {{ $booking->paid_at ?? '-' }}
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection