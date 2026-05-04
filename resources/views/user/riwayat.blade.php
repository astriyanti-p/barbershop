@extends('layouts.dashboard')

@section('content')

<div class="container py-5">

    <!-- HEADER -->
    <div class="mb-4">
        <h2 class="text-warning fw-bold">Riwayat Transaksi</h2>
        <p class="text-secondary">Semua transaksi dan booking kamu</p>
    </div>

    <!-- FILTER BULAN -->
    <div class="filter-wrapper mb-4">
        <div class="d-flex align-items-center gap-3">
            <span class="filter-label">Filter Bulan:</span>
            <div class="select-wrapper">
                <select id="month-filter" class="filter-select">
                    <option value="all">Semua Bulan</option>
                    @foreach(range(1, 12) as $bulan)
                        <option value="{{ now()->year }}-{{ str_pad($bulan, 2, '0', STR_PAD_LEFT) }}">
                            {{ \Carbon\Carbon::create(now()->year, $bulan)->translatedFormat('F Y') }}
                        </option>
                    @endforeach
                </select>
                <span class="select-icon">▾</span>
            </div>
        </div>
    </div>

    <!-- COUNTER HASIL -->
    <p class="text-secondary small mb-3">
        Menampilkan <span id="result-count" class="text-warning fw-bold">3</span> transaksi
    </p>

    <!-- LIST TRANSAKSI -->
    <div class="row" id="transaction-list">

        <div class="col-12 mb-3 transaction-item" data-month="2026-04">
            <a href="/detail-booking?item=1" class="text-decoration-none text-light">
                <div class="history-card d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Haircut Fade</h5>
                        <small class="text-secondary">23 April 2026 - 14:30</small>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-success mb-2">Lunas</span>
                        <div class="price">Rp 35.000</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 mb-3 transaction-item" data-month="2026-04">
            <a href="/detail-booking?item=2" class="text-decoration-none text-light">
                <div class="history-card d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Cukur Jenggot</h5>
                        <small class="text-secondary">20 April 2026 - 11:00</small>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-success mb-2">Lunas</span>
                        <div class="price">Rp 20.000</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 mb-3 transaction-item" data-month="2026-04">
            <a href="/detail-booking?item=3" class="text-decoration-none text-light">
                <div class="history-card d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Hair Coloring</h5>
                        <small class="text-secondary">18 April 2026 - 16:00</small>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-warning text-dark mb-2">Pending</span>
                        <div class="price">Rp 120.000</div>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <!-- EMPTY STATE -->
    <div id="empty-state" class="text-center py-5 d-none">
        <div class="empty-icon mb-3">📭</div>
        <p class="text-secondary">Tidak ada transaksi di bulan ini.</p>
    </div>

</div>

<style>
.history-card {
    background: rgba(20,20,20,0.95);
    border: 1px solid rgba(212,160,23,0.3);
    border-radius: 20px;
    padding: 20px 25px;
    transition: all 0.3s ease;
}

.history-card:hover {
    transform: translateY(-4px);
    border-color: #d4a017;
    box-shadow: 0 15px 35px rgba(0,0,0,0.5);
}

.price {
    color: #ffc107;
    font-weight: 600;
    font-size: 18px;
}

.filter-label {
    color: #aaa;
    font-size: 14px;
    white-space: nowrap;
}

.select-wrapper {
    position: relative;
    display: inline-block;
}

.filter-select {
    appearance: none;
    -webkit-appearance: none;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(212,160,23,0.4);
    color: #ffc107;
    border-radius: 50px;
    padding: 8px 40px 8px 18px;
    font-size: 14px;
    cursor: pointer;
    outline: none;
    transition: all 0.25s ease;
}

.filter-select:hover,
.filter-select:focus {
    border-color: #d4a017;
    background: rgba(212,160,23,0.1);
}

.filter-select option {
    background: #1a1a1a;
    color: #fff;
}

.select-icon {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #ffc107;
    pointer-events: none;
    font-size: 13px;
}

.transaction-item {
    animation: fadeSlideIn 0.3s ease;
}

@keyframes fadeSlideIn {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}

.empty-icon {
    font-size: 48px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const select  = document.getElementById('month-filter');
    const items   = document.querySelectorAll('.transaction-item');
    const counter = document.getElementById('result-count');
    const empty   = document.getElementById('empty-state');

    select.addEventListener('change', function () {
        const selected = this.value;
        let visible = 0;

        items.forEach(function (item) {
            const match = selected === 'all' || item.dataset.month === selected;
            if (match) {
                item.classList.remove('d-none');
                item.style.animation = 'none';
                item.offsetHeight;
                item.style.animation = '';
                visible++;
            } else {
                item.classList.add('d-none');
            }
        });

        counter.textContent = visible;
        empty.classList.toggle('d-none', visible > 0);
    });
});
</script>

@endsection