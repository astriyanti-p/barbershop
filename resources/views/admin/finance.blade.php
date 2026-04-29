@extends('layouts.admin')
@section('title','Manajemen Pembayaran')

@section('content')
<style>
/* ================= TABLE ================= */
.table-dark-custom thead th {
    color: #ffc107 !important;
    font-weight: 600;
    font-size: 12px;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.table-dark-custom td.yellow {
    color: #fff !important;
    font-weight: 500;
}

/* ================= INPUT GLOBAL ================= */
.search-box {
    background: #0d0d0d;
    border: 1px solid #222;
    color: #fff;
    padding: 10px 12px;
    border-radius: 8px;
    outline: none;
    transition: 0.2s;
}

.search-box:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 2px rgba(255,193,7,0.15);
}

/* ================= DATE INPUT FIX ================= */
/* ini yang bikin icon kalender jadi putih */
input[type="date"] {
    color-scheme: dark; /* penting biar native date picker dark mode */
}

/* Chrome / Edge / Safari */
input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1); /* bikin icon putih */
    cursor: pointer;
    opacity: 1;
}

/* hover biar enak */
input[type="date"]::-webkit-calendar-picker-indicator:hover {
    opacity: 0.8;
}

/* hilangin spin button kecil */
input[type="date"]::-webkit-inner-spin-button {
    display: none;
}

/* Firefox support */
input[type="date"] {
    -moz-appearance: textfield;
}

/* ================= CARD ================= */
.card-dark {
    background: #121212;
    border: 1px solid #1f1f1f;
    border-radius: 12px;
}

/* ================= TEXT ================= */
.small-text {
    font-size: 12px;
    color: #888;
}

.page-title {
    color: #fff;
    font-weight: 700;
}

.yellow {
    color: #ffc107;
}
</style>
</style>

<div class="topbar">
    <div>
        <div class="small-text">PAYMENT SYSTEM</div>
        <h1 class="page-title">LIST TRANSAKSI PEMBAYARAN</h1>
        <div class="small-text">
            STATUS REALTIME • 
            <span class="yellow">BERHASIL / PENDING / GAGAL</span>
        </div>
    </div>
</div>

{{-- FILTER --}}
<div class="card-dark mb-4 p-4">

    <div class="row g-3">

        {{-- FROM DATE --}}
        <div class="col-md-3">
            <label class="form-label text-secondary">Dari Tanggal</label>
            <input id="filterFromDate" type="date" class="search-box">
        </div>

        {{-- TO DATE --}}
        <div class="col-md-3">
            <label class="form-label text-secondary">Sampai Tanggal</label>
            <input id="filterToDate" type="date" class="search-box">
        </div>

        {{-- STATUS --}}
        <div class="col-md-3">
            <label class="form-label text-secondary">Status</label>
            <select id="filterStatus" class="search-box">
                <option value="">Semua Status</option>
                <option value="berhasil">Berhasil</option>
                <option value="pending">Pending</option>
                <option value="gagal">Gagal</option>
            </select>
        </div>

        {{-- SEARCH CUSTOMER (PALING BAWAH) --}}
        <div class="col-md-12">
            <label class="form-label text-secondary">Cari Customer</label>
            <input id="searchPayment" type="text" class="search-box" placeholder="Cari nama customer...">
        </div>

    </div>
</div>

{{-- TABLE --}}
<div class="card-dark">

    <div class="small-text mb-3">DAFTAR TRANSAKSI</div>

    <table class="table-dark-custom">

        <thead>
            <tr>
                <th>Customer</th>
                <th>Nominal</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody id="paymentTable">

            <tr data-date="2026-04-29" data-status="berhasil" data-method="cash">
                <td class="customer">Adrian Wijaya</td>
                <td class="yellow">Rp 75.000</td>
                <td>Cash</td>
                <td><span class="badge bg-success">Berhasil</span></td>
                <td>2026-04-29</td>
            </tr>

            <tr data-date="2026-04-29" data-status="pending" data-method="qris">
                <td class="customer">Bambang</td>
                <td class="yellow">Rp 100.000</td>
                <td>QRIS</td>
                <td><span class="badge bg-warning text-dark">Pending</span></td>
                <td>2026-04-29</td>
            </tr>

            <tr data-date="2026-04-30" data-status="gagal" data-method="transfer">
                <td class="customer">Andree</td>
                <td class="yellow">Rp 50.000</td>
                <td>Transfer</td>
                <td><span class="badge bg-danger">Gagal</span></td>
                <td>2026-04-30</td>
            </tr>

            <tr data-date="2026-04-30" data-status="berhasil" data-method="qris">
                <td class="customer">Raffi</td>
                <td class="yellow">Rp 120.000</td>
                <td>QRIS</td>
                <td><span class="badge bg-success">Berhasil</span></td>
                <td>2026-04-30</td>
            </tr>

        </tbody>
    </table>
</div>

<script>
const search = document.getElementById("searchPayment");
const fromDate = document.getElementById("filterFromDate");
const toDate = document.getElementById("filterToDate");
const status = document.getElementById("filterStatus");

const rows = document.querySelectorAll("#paymentTable tr");

function filterPayment() {

    let keyword = search.value.toLowerCase();
    let from = fromDate.value;
    let to = toDate.value;
    let statusVal = status.value;

    rows.forEach(row => {

        let name = row.querySelector(".customer").innerText.toLowerCase();
        let date = row.dataset.date;
        let st = row.dataset.status;

        let matchDate =
            (!from || date >= from) &&
            (!to || date <= to);

        let match =
            name.includes(keyword) &&
            matchDate &&
            (!statusVal || st === statusVal);

        row.style.display = match ? "" : "none";
    });
}

search.addEventListener("keyup", filterPayment);
fromDate.addEventListener("change", filterPayment);
toDate.addEventListener("change", filterPayment);
status.addEventListener("change", filterPayment);
</script>


@endsection