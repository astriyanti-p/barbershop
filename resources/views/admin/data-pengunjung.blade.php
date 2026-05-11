@extends('layouts.admin')
@section('title','Monitoring Pengunjung')

@section('content')

<style>
.table-dark-custom {
    width: 100%;
    border-collapse: collapse;
}

.table-dark-custom th,
.table-dark-custom td {
    padding: 14px;
    border-bottom: 1px solid #222;
}

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

/* FOCUS & HOVER */
.search-box:hover,
.search-box:focus {
    background: #fff;
    color: #000;
    border: 1px solid #fff;
    outline: none;
}

/* OPTION */
.search-box option {
    color: #000;
}

/* BUTTON */
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

/* PAGINATION */
.pagination {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 20px;
}

.page-item .page-link {
    background: #111 !important;
    border: 1px solid #333 !important;
    color: #fff !important;
    padding: 8px 14px;
    border-radius: 10px;
}

.page-item .page-link:hover {
    background: #fff !important;
    color: #000 !important;
}

.page-item.active .page-link {
    background: #ffc107 !important;
    color: #000 !important;
    border-color: #ffc107 !important;
}

.page-item.disabled .page-link {
    opacity: 0.5;
}
</style>

<div class="topbar mb-4">

    <div>

        <h1 class="page-title">
            DATA PENGUNJUNG
        </h1>

        <div class="small-text">
            TOTAL BERDASARKAN TRANSAKSI BERHASIL
        </div>

    </div>

</div>

{{-- TOTAL --}}
<div class="card-dark p-3 mb-3">

    <h4>
        Total Kunjungan:
        <span id="totalVisitors">
            {{ $totalVisitors }}
        </span>
        Orang
    </h4>

</div>

{{-- FILTER --}}
<form method="GET" action="">

<div class="card-dark p-4 mb-4">

    <div class="row g-3">

        {{-- BARBERSHOP --}}
        <div class="col-md-4">

            <label class="text-secondary">
                Pilih Barbershop
            </label>

            <select
                name="shop"
                class="search-box w-100"
            >

                <option value="">
                    Semua Barbershop
                </option>

                @foreach($barbers as $b)

                    <option
                        value="{{ optional($b->barberProfile)->shop_name }}"
                        {{
                            request('shop') ==
                            optional($b->barberProfile)->shop_name
                            ? 'selected'
                            : ''
                        }}
                    >
                        {{ optional($b->barberProfile)->shop_name }}
                    </option>

                @endforeach

            </select>

        </div>

        {{-- FROM --}}
        <div class="col-md-4">

            <label class="text-secondary">
                Dari
            </label>

            <input
                name="from_date"
                type="date"
                class="search-box w-100"
                value="{{ request('from_date') }}"
            >

        </div>

        {{-- TO --}}
        <div class="col-md-4">

            <label class="text-secondary">
                Sampai
            </label>

            <input
                name="to_date"
                type="date"
                class="search-box w-100"
                value="{{ request('to_date') }}"
            >

        </div>

        {{-- SEARCH CUSTOMER --}}
<div class="col-md-4">

    <label class="text-secondary">
        Cari Customer
    </label>

    <input
        type="text"
        name="search"
        class="search-box w-100"
        placeholder="Cari nama customer..."
        value="{{ request('search') }}"
    >

</div>

    </div>

    
    <div class="mt-3 d-flex justify-content-between align-items-center">

    {{-- CETAK PDF --}}
    <a id="printBtn"
   href="#"
   target="_blank"
   class="btn btn-sm btn-warning">
   🖨 Cetak PDF
</a>

    <div>

        <a
            href="{{ url()->current() }}"
            class="btn btn-sm btn-outline-light"
        >
            Reset
        </a>

    </div>

</div>

</div>

</form>

{{-- TABLE --}}
<div class="card-dark p-3">


    <table class="table-dark-custom">

        <thead>

            <tr>
                <th>Customer</th>
                <th>Barbershop</th>
                <th>Layanan</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Status</th>
            </tr>

        </thead>

        <tbody id="visitorTable">

            @forelse($visitors as $v)

                <tr>

                    {{-- CUSTOMER --}}
                    <td>
                        {{ $v->customer->name ?? '-' }}
                    </td>

                    {{-- SHOP --}}
                    <td>
                        {{ optional($v->barber->barberProfile)->shop_name ?? '-' }}
                    </td>

                    {{-- SERVICE --}}
                    <td>
                        {{ $v->service->name ?? '-' }}
                    </td>

                    {{-- DATE --}}
                    <td>
                        {{
                            \Carbon\Carbon::parse(
                                $v->booking_date
                            )->format('Y-m-d')
                        }}
                    </td>

                    {{-- TIME --}}
                    <td>

                        {{
                            $v->booking_time
                            ? \Carbon\Carbon::parse(
                                $v->booking_time
                            )->format('H:i')
                            : '-'
                        }}

                    </td>

                    {{-- STATUS --}}
                    <td>

                        @if($v->payment_status == 'paid')

                            <span class="badge bg-success">
                                Berhasil
                            </span>

                        @else

                            <span class="badge bg-warning">
                                Pending
                            </span>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="6"
                        class="text-center text-secondary py-4"
                    >
                        Tidak ada data
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    <div id="pagination" class="mt-3 d-flex justify-content-center"></div>

    {{-- PAGINATION --}}
    <div class="mt-4">
    </div>

</div>

<script>
let currentPage = 1;
let typingTimer = null;

function getFilters() {
    return {
        shop: document.querySelector('[name="shop"]').value,
        from_date: document.querySelector('[name="from_date"]').value,
        to_date: document.querySelector('[name="to_date"]').value,
        search: document.querySelector('[name="search"]').value,
        page: currentPage
    };
}

async function loadVisitors(page = 1) {
    currentPage = page;

    const params = new URLSearchParams(getFilters()).toString();

    const response = await fetch("{{ route('admin.visitors.data') }}?" + params);
    const data = await response.json();

    // =====================
    // TABLE RENDER
    // =====================
    let html = '';

    if (data.data.length === 0) {
        html = `
        <tr>
            <td colspan="6" class="text-center text-secondary py-4">
                Tidak ada data
            </td>
        </tr>`;
    } else {
        data.data.forEach(v => {
            html += `
            <tr>
                <td>${v.customer?.name ?? '-'}</td>
                <td>${v.barber?.barber_profile?.shop_name ?? '-'}</td>
                <td>${v.service?.name ?? '-'}</td>
                <td>${v.booking_date ?? '-'}</td>
                <td>${v.booking_time ? v.booking_time.substring(0,5) : '-'}</td>
                <td>
                    ${v.payment_status === 'paid'
                        ? '<span class="badge bg-success">Berhasil</span>'
                        : '<span class="badge bg-warning">Pending</span>'}
                </td>
            </tr>`;
        });
    }

    document.getElementById('visitorTable').innerHTML = html;

    // =====================
    // TOTAL UPDATE
    // =====================
    document.getElementById('totalVisitors').innerText = data.total;

    // =====================
    // PAGINATION
    // =====================
    renderPagination(data);
}

function renderPagination(data) {
    let html = '';

    if (data.last_page <= 1) {
        document.getElementById('pagination').innerHTML = '';
        return;
    }

    // Prev
    if (data.current_page > 1) {
        html += `<button class="btn btn-sm btn-outline-light mx-1"
        onclick="loadVisitors(${data.current_page - 1})">Prev</button>`;
    }

    // Pages
    for (let i = 1; i <= data.last_page; i++) {
        html += `
        <button
            onclick="loadVisitors(${i})"
            class="btn btn-sm ${i === data.current_page ? 'btn-warning' : 'btn-outline-light'} mx-1"
        >
            ${i}
        </button>`;
    }

    // Next
    if (data.current_page < data.last_page) {
        html += `<button class="btn btn-sm btn-outline-light mx-1"
        onclick="loadVisitors(${data.current_page + 1})">Next</button>`;
    }

    document.getElementById('pagination').innerHTML = html;
}

/* ======================
   AUTO FILTER
====================== */
document.querySelectorAll('select, input[type="date"]').forEach(el => {
    el.addEventListener('change', () => loadVisitors(1));
});

document.querySelector('[name="search"]').addEventListener('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(() => loadVisitors(1), 400);
});

/* ======================
   AUTO REFRESH SAFE
====================== */
setInterval(() => {
    loadVisitors(currentPage);
}, 5000);

/* FIRST LOAD */
loadVisitors(1);

document.getElementById('printBtn').addEventListener('click', function () {

    const params = new URLSearchParams({
        shop: document.querySelector('[name="shop"]').value,
        from_date: document.querySelector('[name="from_date"]').value,
        to_date: document.querySelector('[name="to_date"]').value,
        search: document.querySelector('[name="search"]').value
    }).toString();

    this.href = "{{ route('admin.visitors.print') }}?" + params;
});
</script>

@endsection