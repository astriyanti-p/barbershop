@extends('layouts.admin')
@section('title','Finance')

@section('content')

<div class="topbar">
    <div>
        <div class="small-text">FINANCIAL INTELLIGENCE UNIT</div>
        <h1 class="page-title">LAPORAN LABA & RUGI</h1>
        <div class="small-text">OKTOBER 2023 - DESEMBER 2023 • <span class="yellow">STATUS: FINALIZED</span></div>
    </div>

    <div class="d-flex gap-2">
        <button class="btn btn-dark">Ekspor PDF</button>
        <button class="btn btn-warning">Cetak Laporan</button>
    </div>
</div>

<!-- KPI CARDS -->
<div class="row g-4 mb-4">

    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text">LABA BERSIH (NET PROFIT)</div>
            <h1 class="mt-2">Rp 142.500K</h1>
            <small class="yellow">+12.4% vs last qtr</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text">TOTAL PENDAPATAN</div>
            <h1 class="mt-2">Rp 385.200K</h1>
            <small>98% of target</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text">TOTAL PENGELUARAN</div>
            <h1 class="mt-2">Rp 242.700K</h1>
            <small class="text-danger">+2.1% spend spike</small>
        </div>
    </div>

</div>

<!-- CHART + DISTRIBUTION -->
<div class="row g-4 mb-4">

    <div class="col-md-8">
        <div class="card-dark" style="height:280px">
            <div class="small-text">VISUALISASI KINERJA KEUANGAN</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text mb-3">DISTRIBUSI BIAYA</div>

            Gaji & Staf
            <div class="progress mb-3">
                <div class="progress-bar bg-warning" style="width:70%"></div>
            </div>

            Utilitas & Sewa
            <div class="progress mb-3">
                <div class="progress-bar bg-warning" style="width:40%"></div>
            </div>

            Produk & Stok
            <div class="progress mb-3">
                <div class="progress-bar bg-warning" style="width:25%"></div>
            </div>

            Pemasaran
            <div class="progress">
                <div class="progress-bar bg-warning" style="width:15%"></div>
            </div>
        </div>
    </div>

</div>

<!-- TABLE -->
<div class="card-dark">
    <div class="d-flex justify-content-between mb-3">
        <div class="small-text">DETAIL TRANSAKSI UTAMA</div>
        <input type="text" class="form-control w-25" placeholder="Cari entri...">
    </div>

    <table class="table table-dark table-borderless">
        <thead class="text-secondary">
            <tr>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Nilai (Rp)</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>2023-12-31</td>
                <td><span class="badge bg-warning text-dark">Pendapatan</span></td>
                <td>Penjualan Layanan Barbershop - Des</td>
                <td class="text-success">+125,400,000</td>
            </tr>

            <tr>
                <td>2023-12-28</td>
                <td><span class="badge bg-danger">Beban Gaji</span></td>
                <td>Payroll Karyawan - Des</td>
                <td class="text-danger">-52,000,000</td>
            </tr>

            <tr>
                <td>2023-12-25</td>
                <td><span class="badge bg-secondary">OpEx</span></td>
                <td>Sewa Gedung & Utilitas Station 01</td>
                <td class="text-danger">-15,200,000</td>
            </tr>

            <tr>
                <td>2023-12-20</td>
                <td><span class="badge bg-warning text-dark">Penjualan</span></td>
                <td>Penjualan Produk Ritel (Pomade & Oil)</td>
                <td class="text-success">+8,950,000</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
