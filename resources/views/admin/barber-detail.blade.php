@extends('layouts.admin')
@section('title','Detail Barbershop')

@section('content')

<style>
.card-dark {
    background: #121212;
    border: 1px solid #1f1f1f;
    border-radius: 12px;
}

.yellow { color:#ffc107; }
.small-text { font-size:12px; color:#888; }
.page-title { color:#fff; font-weight:700; }

.form-control {
    background: #111 !important;
    border: 1px solid #333 !important;
    color: #fff !important;
    border-radius: 6px;
}

textarea.form-control {
    resize: none;
    overflow: hidden;
    line-height: 1.5;
}

.product-card img {
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
}
</style>

<div class="topbar">
    <div>
        <div class="small-text yellow">DETAIL DATA</div>
        <h1 class="page-title">DETAIL BARBERSHOP</h1>
    </div>
</div>

<div class="row mt-3 g-4">

    {{-- FOTO --}}
    <div class="col-md-4">
        <div class="card-dark p-3">
            <img src="https://ui-avatars.com/api/?name={{ $barber->shop_name }}"
                 class="img-fluid rounded mb-3">
        </div>
    </div>

    {{-- DETAIL --}}
    <div class="col-md-8">
        <div class="card-dark p-4">

            <div class="row g-3">

                <div class="col-md-6">
                    <label>Nama Barbershop</label>
                    <input class="form-control" value="{{ $barber->shop_name }}" disabled>
                </div>

                <div class="col-md-6">
                    <label>Nama Pemilik</label>
                    <input class="form-control" value="{{ $barber->user->name ?? '-' }}" disabled>
                </div>

                <div class="col-md-6">
                    <label>Email</label>
                    <input class="form-control" value="{{ $barber->user->email ?? '-' }}" disabled>
                </div>

                <div class="col-md-6">
                    <label>No HP</label>
                    <input class="form-control" value="{{ $barber->user->phone ?? '-' }}" disabled>
                </div>

                <div class="col-md-6">
                    <label>Kota</label>
                    <input class="form-control" value="{{ $barber->user->city ?? '-' }}" disabled>
                </div>

                <div class="col-md-12">
                    <label>Alamat Lengkap</label>
                    <input class="form-control" value="{{ $barber->user->address ?? '-' }}" disabled>
                </div>

                <div class="col-md-6">
                    <label>Jam Operasional</label>
                    <input class="form-control"
                           value="{{ optional($barber->schedules->first())->open ?? '-' }} - {{ optional($barber->schedules->first())->close ?? '-' }}"
                           disabled>
                </div>

                <div class="col-md-6">
                    <label>Deskripsi</label>
                    <textarea class="form-control auto-resize" disabled>{{ $barber->bio }}</textarea>
                </div>

                <div class="col-md-6">
                    <label>Longitude</label>
                    <input class="form-control" value="{{ $barber->longitude }}" disabled>
                </div>

                <div class="col-md-6">
                    <label>Latitude</label>
                    <input class="form-control" value="{{ $barber->latitude }}" disabled>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- SERVICE --}}
<div class="card-dark p-4 mt-4">
    <h4 class="yellow">Service Tersedia</h4>

    <table class="table table-dark table-borderless align-middle mt-3">
        <thead class="text-secondary">
            <tr>
                <th>Nama Service</th>
                <th>Durasi</th>
                <th>Harga</th>
            </tr>
        </thead>

        <tbody>
        @forelse($barber->services as $service)
            <tr>
                <td>{{ $service->name }}</td>
                <td>{{ $service->duration }} menit</td>
                <td class="yellow">Rp {{ number_format($service->price,0,',','.') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center text-secondary">Belum ada service</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- PRODUCT --}}
<div class="card-dark p-4 mt-4">

    <h4 class="yellow mb-3">Product Tersedia</h4>

    <div class="row g-3">
    @forelse($barber->products as $product)
        <div class="col-md-4 product-card">
            <div class="card-dark p-3">

                <img src="https://ui-avatars.com/api/?name={{ $product->name }}"
                     class="img-fluid mb-2">

                <input class="form-control mb-2" value="{{ $product->name }}" disabled>

                <textarea class="form-control auto-resize mb-2" disabled>{{ $product->description }}</textarea>

                <div class="yellow fw-bold">
                    Rp {{ number_format($product->price,0,',','.') }}
                </div>

            </div>
        </div>
    @empty
        <p class="text-secondary">Belum ada produk</p>
    @endforelse
    </div>
</div>

<script>
function autoResize(el){
    el.style.height = "auto";
    el.style.height = el.scrollHeight + "px";
}
document.querySelectorAll("textarea.auto-resize").forEach(el => autoResize(el));
</script>

@endsection
