@extends('layouts.admin')
@section('title','Monitoring Pengunjung')

@section('content')

<style>
.table-dark-custom thead th {
    color: #ffc107 !important;
    font-weight: 600;
    font-size: 12px;
    text-transform: uppercase;
}

.card-dark {
    background: #121212;
    border: 1px solid #1f1f1f;
    border-radius: 12px;
}

/* INPUT & SELECT */
.search-box {
    background: #0d0d0d;
    border: 1px solid #222;
    color: #fff;
    padding: 10px;
    border-radius: 8px;
    transition: 0.2s ease;
}

/* 🔥 INI YANG KAMU MAU (ISI JADI PUTIH SAAT FOCUS/HOVER) */
.search-box:hover,
.search-box:focus {
    background: #fff;
    color: #000;
    border: 1px solid #fff;
    outline: none;
}

/* biar option dropdown tetap terbaca */
.search-box option {
    color: #000;
}

/* BUTTON HOVER */
.btn-outline-light:hover {
    background: #fff;
    color: #000;
    border-color: #fff;
    transition: 0.2s ease;
}

.page-title {
    color:#fff;
    font-weight:700;
}

.small-text {
    font-size:12px;
    color:#888;
}
</style>

<div class="topbar mb-4">
    <div>
        <div class="small-text">PLATFORM MONITORING</div>
        <h1 class="page-title">DATA PENGUNJUNG</h1>
        <div class="small-text">
            TOTAL BERDASARKAN TRANSAKSI BERHASIL
        </div>
    </div>
</div>

{{-- TOTAL --}}
<div class="card-dark p-3 mb-3">
    <h4>Total Pengunjung: <span id="totalVisitors">{{ $totalVisitors }}</span> Orang</h4>
</div>

{{-- FILTER --}}
<div class="card-dark p-4 mb-4">
    <div class="row g-3">

        <div class="col-md-4">
            <label class="text-secondary">Pilih Barbershop</label>
            <select id="filterShop" class="search-box w-100">
    <option value="">Semua Barbershop</option>
    @foreach($barbers as $b)
<option value="{{ optional($b->barberProfile)->shop_name }}">
    {{ optional($b->barberProfile)->shop_name }}
</option>
@endforeach
</select>
        </div>

        <div class="col-md-4">
            <label class="text-secondary">Dari</label>
            <input id="filterFromDate" type="date" class="search-box w-100">
        </div>

        <div class="col-md-4">
            <label class="text-secondary">Sampai</label>
            <input id="filterToDate" type="date" class="search-box w-100">
        </div>

    </div>
    <div class="mt-3 text-end">
    <button id="resetFilter" class="btn btn-sm btn-outline-light">
        Reset
    </button>
</div>
</div>


{{-- TABLE --}}
<div class="card-dark p-3">

    <table class="table-dark-custom w-100">

        <thead>
            <tr>
                <th>Customer</th>
                <th>Layanan</th>
                <th>Barbershop</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody id="paymentTable">
@foreach($visitors as $v)
<tr 
    data-date="{{ $v->booking_date }}" 
    data-status="{{ $v->payment_status }}" 
    data-shop="{{ optional($v->barber->barberProfile)->shop_name }}"
>
    <td>{{ $v->customer->name ?? '-' }}</td>
    <td>{{ optional($v->service)->name ?? '-' }}</td>
    <td>{{ optional($v->barber->barberProfile)->shop_name ?? '-' }}</td>
    <td>{{ $v->booking_date }}</td>
    <td>
        @if($v->payment_status == 'paid')
            <span class="badge bg-success">Berhasil</span>
        @else
            <span class="badge bg-warning">Pending</span>
        @endif
    </td>
</tr>
@endforeach
</tbody>
    </table>

</div>

<script>
const shop = document.getElementById("filterShop");
const fromDate = document.getElementById("filterFromDate");
const toDate = document.getElementById("filterToDate");

function filterData() {

    const rows = document.querySelectorAll("#paymentTable tr");

    let shopVal = shop.value;
    let from = fromDate.value;
    let to = toDate.value;

    let total = 0;

    rows.forEach(row => {

        let date = row.dataset.date;
        let status = row.dataset.status;
        let shopRow = row.dataset.shop;

        let matchDate =
            (!from || date >= from) &&
            (!to || date <= to);

        let matchShop =
            (!shopVal || shopVal.trim().toLowerCase() === shopRow.trim().toLowerCase());

        let match = matchDate && matchShop;

        row.style.display = match ? "" : "none";

        if (match && status === "paid") {
            total++;
        }

    });

    document.getElementById("totalVisitors").innerText = total;
}
document.getElementById("resetFilter").addEventListener("click", () => {

    shop.value = "";
    fromDate.value = "";
    toDate.value = "";

    filterData();

});

// event
shop.addEventListener("change", filterData);
fromDate.addEventListener("change", filterData);
toDate.addEventListener("change", filterData);

// run pertama
filterData();

// auto refresh setiap 10 detik
setInterval(() => {
    location.reload();
}, 10000);
</script>
@endsection