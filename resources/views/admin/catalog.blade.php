@extends('layouts.admin')
@section('title','Catalog')

@section('content')

<div class="topbar">
    <div>
        <div class="small-text yellow">MANAJEMEN ASET VISUAL</div>
        <h1 class="page-title">KATALOG GAYA RAMBUT</h1>
    </div>

    <div class="d-flex gap-3">
        <input class="form-control" style="width:260px" placeholder="Cari gaya...">
        <button class="btn btn-warning">+ Tambah Gaya</button>
    </div>
</div>

<div class="row g-4 mt-2">

    <!-- CARD 1 -->
    <div class="col-md-4">
        <div class="style-card">
            <img src="https://images.unsplash.com/photo-1621605815971-fbc98d665033" class="img-fluid">
            <div class="style-overlay">
                <span class="badge bg-warning text-dark mb-2">POPULAR</span>
                <h4>Mid Skin Fade</h4>
                <p>Gradasi halus dari kulit hingga rambut bagian atas.</p>
            </div>
        </div>
    </div>

    <!-- CARD 2 -->
    <div class="col-md-4">
        <div class="style-card">
            <img src="https://images.unsplash.com/photo-1599351431202-1e0f0137899a" class="img-fluid">
            <div class="style-overlay">
                <h4>Executive Pompadour</h4>
                <p>Gaya klasik volume tinggi dan elegan.</p>
            </div>
        </div>
    </div>

    <!-- CARD 3 -->
    <div class="col-md-4">
        <div class="style-card">
            <img src="https://images.unsplash.com/photo-1580618672591-eb180b1a973f" class="img-fluid">
            <div class="style-overlay">
                <h4>Military Buzz Cut</h4>
                <p>Potongan ultra pendek dengan garis tepi presisi.</p>
            </div>
        </div>
    </div>

    <!-- UPLOAD CARD -->
    <div class="col-md-4">
        <div class="upload-card d-flex align-items-center justify-content-center">
            <div class="text-center">
                <h5>Upload Style Baru</h5>
                <small>Support JPG, PNG</small>
            </div>
        </div>
    </div>

    <!-- CARD 4 -->
    <div class="col-md-4">
        <div class="style-card">
            <img src="https://images.unsplash.com/photo-1622287162716-74d9f54c16f6" class="img-fluid">
            <div class="style-overlay">
                <h4>Textured French Crop</h4>
                <p>Tekstur atas dipadukan fade samping.</p>
            </div>
        </div>
    </div>

</div>

@endsection
