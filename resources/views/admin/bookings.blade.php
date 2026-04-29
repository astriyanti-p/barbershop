@extends('layouts.admin')
@section('title','Manajemen Booking')

@section('content')

<style>
body {
    background: #0b0b0b;
    color: #fff;
}

/* CARD */
.card {
    background: linear-gradient(145deg,#1a1a1a,#111);
    border: 1px solid #1f1f1f;
    color: #fff;
}

/* FORM */
.form-control, .form-select {
    background: #0d0d0d;
    border: 1px solid #222;
    color: #fff;
}

.form-control:focus, .form-select:focus {
    border-color: #ffc107;
    box-shadow: none;
}

/* TABLE */
.table-dark-gold {
    width: 100%;
    color: #fff;
    border-collapse: separate;
    border-spacing: 0;
}

/* HEADER */
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

/* ROW */
.table-dark-gold tbody tr {
    border-bottom: 1px solid #1f1f1f;
    transition: 0.2s;
    cursor: pointer;
}

.table-dark-gold tbody tr:hover {
    background: #151515;
    transform: scale(1.01);
}

/* CELL */
.table-dark-gold tbody td {
    padding: 16px 14px;
    color: #e4e6eb;
}

/* BADGE */
.badge.bg-warning { background:#ffc107 !important; color:#111; }
.badge.bg-success { background:#1dd1a1 !important; }
.badge.bg-danger { background:#e74c3c !important; }
.badge.bg-primary { background:#3498db !important; }

/* REMOVE BOOTSTRAP OVERLAY */
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
                    <option>BarberKing</option>
                    <option>Gentleman Cut</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select id="filterStatus" class="form-control">
                    <option value="">Semua</option>
                    <option value="pending">Pending</option>
                    <option value="diterima">Diterima</option>
                    <option value="ditolak">Ditolak</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>

            <div class="col-md-12">
                <label class="form-label">Cari Customer</label>
                <input id="searchCustomer" class="form-control" placeholder="Cari nama customer...">
            </div>

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

                @foreach([
                    ['id'=>1,'name'=>'Adrian Wijaya','shop'=>'BarberKing','date'=>'2026-04-29','time'=>'14:30','status'=>'pending'],
                    ['id'=>2,'name'=>'Bambang','shop'=>'Gentleman Cut','date'=>'2026-04-29','time'=>'15:00','status'=>'diterima'],
                    ['id'=>3,'name'=>'Andree','shop'=>'BarberKing','date'=>'2026-04-30','time'=>'16:00','status'=>'ditolak'],
                    ['id'=>4,'name'=>'Raffi','shop'=>'Gentleman Cut','date'=>'2026-04-30','time'=>'17:00','status'=>'selesai'],
                ] as $b)

                <tr 
                    data-date="{{ $b['date'] }}"
                    data-shop="{{ $b['shop'] }}"
                    data-status="{{ $b['status'] }}"
                    onclick="window.location='{{ route('admin.bookings.show', $b['id']) }}'"
                >
                    <td class="customerName">{{ $b['name'] }}</td>
                    <td>{{ $b['shop'] }}</td>
                    <td>{{ $b['date'] }}</td>
                    <td>{{ $b['time'] }}</td>
                    <td>
                        <span class="badge bg-{{ 
                            $b['status']=='pending' ? 'warning' : 
                            ($b['status']=='diterima' ? 'success' : 
                            ($b['status']=='ditolak' ? 'danger' : 'primary')) 
                        }}">
                            {{ ucfirst($b['status']) }}
                        </span>
                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>

    </div>
</div>

{{-- SCRIPT --}}
<script>
const searchInput = document.getElementById("searchCustomer");
const fromDate = document.getElementById("filterFromDate");
const toDate = document.getElementById("filterToDate");
const filterShop = document.getElementById("filterShop");
const filterStatus = document.getElementById("filterStatus");

const rows = document.querySelectorAll("#bookingTable tr");

function filterData() {

    let keyword = searchInput.value.toLowerCase();
    let from = fromDate.value;
    let to = toDate.value;
    let shop = filterShop.value;
    let status = filterStatus.value;

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
</script>

@endsection