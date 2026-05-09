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

.form-control,
.form-select {
    background: #0d0d0d;
    border: 1px solid #222;
    color: #fff;
}

.form-control:focus,
.form-select:focus {
    background: #fff !important;
    color: #000 !important;
    border-color: #ffc107 !important;
    box-shadow: none !important;
}

/* TABLE */
.table-dark-gold {
    width: 100%;
    color: #fff;
    border-collapse: collapse;
}

.table-dark-gold thead th {
    color: #ffc107;
    font-size: 12px;
    text-transform: uppercase;
    padding: 14px;
    border-bottom: 2px solid #ffc107;
}

.table-dark-gold tbody td {
    padding: 14px;
    border-bottom: 1px solid #1f1f1f;
}

.table-dark-gold tbody tr:hover {
    background: #151515;
    cursor: pointer;
}

/* PAGINATION */
.pagination-box {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 20px;
}

.pagination-box button {
    background: #111;
    border: 1px solid #333;
    color: #fff;
    padding: 6px 12px;
    border-radius: 8px;
}

.pagination-box button.active {
    background: #ffc107;
    color: #000;
}
</style>

<div class="container-fluid">

    <div class="mb-4">
        <h3 style="color:#ffc107;">Data Booking</h3>
        <p style="color:#aaa;">Semua data booking</p>
    </div>

    {{-- FILTER --}}
    <div class="card p-4 mb-4">

        <div class="row g-3">

            <div class="col-md-3">
                <label>Dari</label>
                <input type="date" name="from" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Sampai</label>
                <input type="date" name="to" class="form-control">
            </div>

            <div class="col-md-3">
                <label>Barbershop</label>
                <select name="shop" class="form-control">
                    <option value="">Semua</option>
                    @foreach($shops as $shop)
                        <option value="{{ $shop }}">{{ $shop }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">Semua</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <div class="col-md-12">
                <label>Cari Customer</label>
                <input type="text" name="search" class="form-control" placeholder="Cari nama customer...">
            </div>

        </div>

        <div class="mt-3 d-flex justify-content-between">
            <a href="#" id="printBtn" target="_blank" class="btn btn-warning btn-sm">
    🖨 Cetak PDF
</a>
            <button type="button" id="resetBtn" class="btn btn-outline-light btn-sm">Reset</button>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="card p-3">

        <table class="table-dark-gold">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Barbershop</th>
                    <th>Layanan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody id="bookingTable"></tbody>
        </table>

        <div id="pagination" class="pagination-box"></div>

    </div>

</div>

<script>
let currentPage = 1;
let typingTimer = null;

/* =========================
   GET FILTER VALUES
========================= */
function getFilters() {
    return {
        from: document.querySelector('[name="from"]').value,
        to: document.querySelector('[name="to"]').value,
        shop: document.querySelector('[name="shop"]').value,
        status: document.querySelector('[name="status"]').value,
        search: document.querySelector('[name="search"]').value,
        page: currentPage
    };
}

/* =========================
   LOAD DATA AJAX
========================= */
async function loadBookings(page = 1) {
    currentPage = page;

    const params = new URLSearchParams(getFilters()).toString();

    try {
        const res = await fetch("{{ route('admin.bookings.data') }}?" + params);

        if (!res.ok) {
            console.error("Fetch error:", res.status);
            return;
        }

        const data = await res.json();

        let html = '';

        if (!data || !data.data || data.data.length === 0) {
            html = `
            <tr>
                <td colspan="5" class="text-center text-secondary py-4">
                    Tidak ada data booking
                </td>
            </tr>`;
        } else {
            data.data.forEach(b => {

                const statusClass =
                    b.status === 'pending' ? 'warning' :
                    b.status === 'confirmed' ? 'success' :
                    b.status === 'cancelled' ? 'danger' : 'primary';

                const statusText = b.status
                    ? b.status.charAt(0).toUpperCase() + b.status.slice(1)
                    : '-';

                html += `
                <tr onclick="window.location='/admin/bookings/${b.id}'">

                    <td>${b.customer?.name ?? '-'}</td>
                    <td>${b.barber?.barber_profile?.shop_name ?? '-'}</td>
                    <td>${b.service?.name ?? '-'}</td>
                    <td>${b.booking_date ?? '-'}</td>
                    <td>
                        <span class="badge bg-${statusClass}">
                            ${statusText}
                        </span>
                    </td>

                </tr>`;
            });
        }

        document.getElementById('bookingTable').innerHTML = html;

        renderPagination(data);

    } catch (err) {
        console.error("AJAX error:", err);
    }
}

/* =========================
   PAGINATION
========================= */
function renderPagination(data) {
    let html = '';

    if (!data || data.last_page <= 1) {
        document.getElementById('pagination').innerHTML = '';
        return;
    }

    if (data.current_page > 1) {
        html += `<button onclick="loadBookings(${data.current_page - 1})">Prev</button>`;
    }

    for (let i = 1; i <= data.last_page; i++) {
        html += `
        <button class="${i === data.current_page ? 'active' : ''}"
            onclick="loadBookings(${i})">
            ${i}
        </button>`;
    }

    if (data.current_page < data.last_page) {
        html += `<button onclick="loadBookings(${data.current_page + 1})">Next</button>`;
    }

    document.getElementById('pagination').innerHTML = html;
}

/* =========================
   AUTO FILTER (IMPORTANT FIX)
========================= */
function bindFilters() {
    document.querySelectorAll('input, select').forEach(el => {
        el.addEventListener('change', () => loadBookings(1));
    });
}

/* =========================
   SEARCH DEBOUNCE
========================= */
document.querySelector('[name="search"]').addEventListener('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(() => loadBookings(1), 400);
});

/* =========================
   RESET FILTER
========================= */
document.getElementById('resetBtn').addEventListener('click', () => {

    document.querySelectorAll('input[type="text"], input[type="date"]').forEach(el => el.value = '');
    document.querySelectorAll('select').forEach(el => el.selectedIndex = 0);

    loadBookings(1);
});

/* =========================
   PRINT BUTTON (FIX FILTER SYNC)
========================= */
document.getElementById('printBtn').addEventListener('click', function () {

    const params = new URLSearchParams({
        from: document.querySelector('[name="from"]').value,
        to: document.querySelector('[name="to"]').value,
        shop: document.querySelector('[name="shop"]').value,
        status: document.querySelector('[name="status"]').value,
        search: document.querySelector('[name="search"]').value
    }).toString();

    this.href = "{{ route('admin.bookings.print') }}?" + params;
});

/* =========================
   INIT
========================= */
bindFilters();
loadBookings(1);
</script>

@endsection