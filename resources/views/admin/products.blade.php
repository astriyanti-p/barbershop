@extends('layouts.admin')
@section('title','Catalog Product')

@section('content')

<div class="topbar">
    <div>
        <div class="small-text yellow">UNIT_TOTAL: 42</div>
        <h1 class="page-title">KATALOG PRODUK</h1>
    </div>

    <button class="btn btn-warning">+ Tambah Produk Baru</button>
</div>

<div class="card-dark mb-4">
    <div class="row">
        <div class="col-md-6">
            <input class="form-control" placeholder="Cari berdasarkan nama atau kode...">
        </div>
        <div class="col-md-4">
            <button class="btn btn-outline-light">Pomade</button>
            <button class="btn btn-outline-light">Oil</button>
            <button class="btn btn-outline-light">Styling</button>
        </div>
        <div class="col-md-2">
            <select class="form-control">
                <option>Terbaru</option>
            </select>
        </div>
    </div>
</div>

<div class="row g-4">

    <!-- PRODUCT CARD -->
    <div class="col-md-3">
        <div class="card-dark">
            <img src="https://images.unsplash.com/photo-1585386959984-a41552231658" class="img-fluid">
            <h5 class="mt-3">AMBER MATTE CLAY</h5>
            <div class="small-text">Rp 245.000</div>
            <div class="small-text yellow">Stock 12</div>
            <div class="mt-3">
                <button class="btn btn-outline-light btn-sm">Detail</button>
                <button class="btn btn-warning btn-sm">Update Stok</button>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-dark">
            <img src="https://images.unsplash.com/photo-1608248597279-f99d160bfcbc" class="img-fluid">
            <h5 class="mt-3">OBSIDIAN BEARD OIL</h5>
            <div class="small-text">Rp 185.000</div>
            <div class="text-danger small-text">Stock 3</div>
            <div class="mt-3">
                <button class="btn btn-outline-light btn-sm">Detail</button>
                <button class="btn btn-warning btn-sm">Update Stok</button>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-dark">
            <img src="https://images.unsplash.com/photo-1629198688000-71f23e745b6e" class="img-fluid">
            <h5 class="mt-3">TITAN HAIR TONIC</h5>
            <div class="small-text">Rp 120.000</div>
            <div class="small-text yellow">Stock 28</div>
            <div class="mt-3">
                <button class="btn btn-outline-light btn-sm">Detail</button>
                <button class="btn btn-warning btn-sm">Update Stok</button>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-dark">
            <img src="https://images.unsplash.com/photo-1611078489935-0cb964de46d6" class="img-fluid">
            <h5 class="mt-3">SIGNATURE COMB</h5>
            <div class="small-text">Rp 350.000</div>
            <div class="small-text yellow">Stock 8</div>
            <div class="mt-3">
                <button class="btn btn-outline-light btn-sm">Detail</button>
                <button class="btn btn-warning btn-sm">Update Stok</button>
            </div>
        </div>
    </div>

</div>

<div class="row mt-5">
    <div class="col-md-8">
        <div class="card-dark">
            <h5>⚠ Inventaris Kritis</h5>
            <hr>
            <p>Obsidian Beard Oil — <span class="text-danger">3 Unit</span></p>
            <p>Silver Frost Aftershave — <span class="text-danger">1 Unit</span></p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-warning text-dark">
            <h3>Rp 8.420.500</h3>
            <p>Nilai Inventaris Total</p>
        </div>
    </div>
</div>

@endsection
