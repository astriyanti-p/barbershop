@extends('layouts.admin')
@section('title','Manajemen Booking')

@section('content')

<style>
body {
    background: #0b0b0b;
    color: #fff;
}

.card {
    background: linear-gradient(145deg,#1a1a1a,#111);
    border: 1px solid #1f1f1f;
    color: #fff;
}

.form-control, .form-select {
    background: #0d0d0d;
    border: 1px solid #222;
    color: #fff;
    transition: 0.2s ease;
}
.form-control:hover,
.form-select:hover {
    background: #fff !important;
    color: #000 !important;
    border-color: #fff !important;
    transition: 0.2s ease;
}

/* 🔥 INI YANG KAMU BUTUH (ISI INPUT JADI PUTIH SAAT FOCUS) */
.form-control:focus,
.form-select:focus {
    background: #fff !important;
    color: #000 !important;
    border-color: #ffc107 !important;
    box-shadow: none !important;
}
.form-control:focus::placeholder {
    color: #666;
}
.form-select option {
    background: #fff;
    color: #000;
}

/* OPTION BIAR KEBAWAH */
.form-select option {
    color: #000;
}

/* TABLE */
.table-dark-gold {
    width: 100%;
    color: #fff;
    border-collapse: separate;
    border-spacing: 0;
}

.table-dark-gold thead {
    background: #111;
    border-bottom: 2px solid #ffc107;
}

.table-dark-gold thead th {
    color: #ffc107;
    font-size: 12px;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 14px;
}

.table-dark-gold tbody tr {
    border-bottom: 1px solid #1f1f1f;
    transition: 0.2s;
    cursor: pointer;
}

.table-dark-gold tbody tr:hover {
    background: #151515;
    transform: scale(1.01);
}

.table-dark-gold tbody td {
    padding: 16px 14px;
    color: #e4e6eb;
}

.badge.bg-warning { background:#ffc107 !important; color:#111; }
.badge.bg-success { background:#1dd1a1 !important; }
.badge.bg-danger { background:#e74c3c !important; }
.badge.bg-primary { background:#3498db !important; }

.table {
    --bs-table-bg: transparent;
}
</style>

<div class="container-fluid">

    <div class="mb-4">
        <h3 style="color:#ffc107;">Manajemen Booking</h3>
        <p style="color:#aaa;">Semua data booking</p>
    </div>

    {{-- FILTER --}}
    <div class="card p-4 mb-4">
        <div class="row g-3">

            <div class="col-md-3">
                <label class="form-label">Dari</label>
                <input type="date" id="filterFromDate" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Sampai</label>
                <input type="date" id="filterToDate" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Barbershop</label>
                <select id="filterShop" class="form-control">
                    <option value="">Semua</option>
                    @foreach($shops as $shop)
                        <option value="{{ $shop }}">{{ $shop }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select id="filterStatus" class="form-control">
                    <option value="">Semua</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <div class="col-md-12">
                <label class="form-label">Cari Customer</label>
                <input id="searchCustomer" class="form-control" placeholder="Cari nama customer...">
            </div>

        </div>

        <div class="mt-3 text-end">
            <button id="resetFilter" class="btn btn-sm btn-outline-light">
                Reset
            </button>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card p-3">

        <table class="table table-dark-gold">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Barbershop</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody id="bookingTable">

                @foreach($bookings as $b)

                <tr 
                    data-date="{{ $b->booking_date }}"
                    data-shop="{{ $b->barber->barberProfile->shop_name ?? '-' }}"
                    data-status="{{ $b->status }}"
                    onclick="window.location='{{ route('admin.bookings.show', $b->id) }}'"
                >
                    <td class="customerName">
                        {{ $b->customer->name ?? '-' }}
                    </td>

                    <td>
                        {{ $b->barber->barberProfile->shop_name ?? '-' }}
                    </td>

                    <td>
                        {{ $b->booking_date }}
                    </td>

                    <td>
                        {{ $b->booking_time ?? '-' }}
                    </td>

                    <td>
                        <span class="badge bg-{{ 
                            $b->status=='pending' ? 'warning' : 
                            ($b->status=='confirmed' ? 'success' : 
                            ($b->status=='cancelled' ? 'danger' : 'primary')) 
                        }}">
                            {{ ucfirst($b->status) }}
                        </span>
                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>

    </div>
</div>

<script>
function getRows() {
    return document.querySelectorAll("#bookingTable tr");
}

const searchInput = document.getElementById("searchCustomer");
const fromDate = document.getElementById("filterFromDate");
const toDate = document.getElementById("filterToDate");
const filterShop = document.getElementById("filterShop");
const filterStatus = document.getElementById("filterStatus");

function filterData() {

    let keyword = searchInput.value.toLowerCase();
    let from = fromDate.value;
    let to = toDate.value;
    let shop = filterShop.value;
    let status = filterStatus.value;

    const rows = getRows();

    rows.forEach(row => {

        let name = row.querySelector(".customerName").innerText.toLowerCase();
        let date = row.dataset.date;
        let rowShop = row.dataset.shop;
        let rowStatus = row.dataset.status;

        let match =
            name.includes(keyword) &&
            (!from || date >= from) &&
            (!to || date <= to) &&
            (!shop || rowShop === shop) &&
            (!status || rowStatus === status);

        row.style.display = match ? "" : "none";
    });
}

searchInput.addEventListener("keyup", filterData);
fromDate.addEventListener("change", filterData);
toDate.addEventListener("change", filterData);
filterShop.addEventListener("change", filterData);
filterStatus.addEventListener("change", filterData);

document.getElementById("resetFilter").addEventListener("click", () => {

    searchInput.value = "";
    fromDate.value = "";
    toDate.value = "";
    filterShop.value = "";
    filterStatus.value = "";

    filterData();
});

// run awal
filterData();
</script>

@endsection