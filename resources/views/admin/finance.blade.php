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

.search-box {
    background: #0d0d0d;
    border: 1px solid #222;
    color: #fff;
    padding: 10px;
    border-radius: 8px;
}

.page-title { color:#fff; font-weight:700; }
.small-text { font-size:12px; color:#888; }
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
    <h4>Total Pengunjung: <span id="totalVisitor">0</span> Orang</h4>
</div>

{{-- FILTER --}}
<div class="card-dark p-4 mb-4">
    <div class="row g-3">

        <div class="col-md-4">
            <label class="text-secondary">Pilih Barbershop</label>
            <select id="filterShop" class="search-box w-100">
                <option value="">Semua Barbershop</option>
                <option value="barber1">Barberkin</option>
                <option value="barber2">Barbersip</option>
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

            <tr data-date="2026-04-29" data-status="berhasil" data-shop="barber1">
                <td>Adrian</td>
                <td>Potong Rambut</td>
                <td>Barberkin</td>
                <td>2026-04-29</td>
                <td><span class="badge bg-success">Berhasil</span></td>
            </tr>

            <tr data-date="2026-04-29" data-status="pending" data-shop="barber1">
                <td>Bambang</td>
                <td>Cukur + Keramas</td>
                <td>Barberkin</td>
                <td>2026-04-29</td>
                <td><span class="badge bg-warning text-dark">Pending</span></td>
            </tr>

            <tr data-date="2026-04-30" data-status="berhasil" data-shop="barber2">
                <td>Raffi</td>
                <td>Hair Styling</td>
                <td>Barbersip</td>
                <td>2026-04-30</td>
                <td><span class="badge bg-success">Berhasil</span></td>
            </tr>

            <tr data-date="2026-04-30" data-status="gagal" data-shop="barber2">
                <td>Andree</td>
                <td>Potong Rambut</td>
                <td>Barbersip</td>
                <td>2026-04-30</td>
                <td><span class="badge bg-danger">Gagal</span></td>
            </tr>

        </tbody>
    </table>

</div>

<script>
const shop = document.getElementById("filterShop");
const fromDate = document.getElementById("filterFromDate");
const toDate = document.getElementById("filterToDate");

const rows = document.querySelectorAll("#paymentTable tr");

function filterData() {

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
            (!shopVal || shopVal === shopRow);

        let match = matchDate && matchShop;

        row.style.display = match ? "" : "none";

        // hitung hanya berhasil
        if (match && status === "berhasil") {
            total++;
        }

    });

    document.getElementById("totalVisitor").innerText = total;
}

shop.addEventListener("change", filterData);
fromDate.addEventListener("change", filterData);
toDate.addEventListener("change", filterData);

filterData();
</script>

@endsection