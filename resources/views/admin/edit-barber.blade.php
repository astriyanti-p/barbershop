@extends('layouts.admin')
@section('title','Edit Barbershop')

@section('content')

<style>
.card-dark { background:#121212; border:1px solid #1f1f1f; border-radius:12px; }
.yellow { color:#ffc107; }
.small-text { font-size:12px; color:#888; }
.page-title { color:#fff; font-weight:700; }
.form-control { background:#111 !important; border:1px solid #333 !important; color:#fff !important; }
.product-card img{ height:180px; object-fit:cover; border-radius:8px; }
</style>

<div class="topbar">
    <div>
        <div class="small-text yellow">EDIT DATA</div>
        <h1 class="page-title">EDIT BARBERSHOP</h1>
    </div>
</div>

<div class="row mt-3 g-4">

<!-- FOTO -->
<div class="col-md-4">
    <div class="card-dark p-3 text-center">
        <img id="previewImage"
             src="{{ $barber->photo ?? 'https://via.placeholder.com/500x300' }}"
             class="img-fluid rounded mb-3"
             style="height:250px; width:100%; object-fit:cover;">

        <input type="file" id="uploadFoto" accept="image/*" hidden>
        <button type="button" class="btn btn-warning w-100" id="btnGantiFoto">
            Ganti Foto
        </button>
    </div>
</div>

<!-- FORM -->
<div class="col-md-8">
<div class="card-dark p-4">
<div class="row g-3">

<div class="col-md-6">
<label>Nama Barbershop</label>
<input class="form-control" value="{{ $barber->shop_name }}">
</div>

<div class="col-md-6">
<label>Nama Pemilik</label>
<input class="form-control" value="{{ $barber->user->name ?? '-' }}">
</div>

<div class="col-md-6">
<label>Email</label>
<input class="form-control" value="{{ $barber->user->email ?? '-' }}">
</div>

<div class="col-md-6">
<label>No HP</label>
<input class="form-control" value="{{ $barber->user->phone ?? '-' }}">
</div>

<div class="col-md-6">
<label>Kota</label>
<input class="form-control" value="{{ $barber->user->city ?? '-' }}">
</div>

<div class="col-md-12">
<label>Alamat</label>
<input class="form-control" value="{{ $barber->user->address ?? '-' }}">
</div>

<div class="col-md-6">
<label>Jam Operasional</label>
<input class="form-control"
value="@foreach($barber->schedules as $s) {{ $s->day_of_week }} {{ substr($s->start_time,0,5) }}-{{ substr($s->end_time,0,5) }}, @endforeach">
</div>

<div class="col-md-6">
<label>Deskripsi</label>
<textarea class="form-control">{{ $barber->bio }}</textarea>
</div>

</div>
</div>
</div>
</div>

{{-- ================= SERVICE ================= --}}
<div class="card-dark p-4 mt-4">
<h4 class="yellow">Service</h4>

<table class="table table-dark table-borderless mt-3">
<thead>
<tr>
<th>Nama</th>
<th>Durasi</th>
<th>Harga</th>
<th>Aksi</th>
</tr>
</thead>

<tbody id="serviceTable">
@foreach($barber->services as $service)
<tr>
<td><input class="form-control" value="{{ $service->name }}"></td>
<td><input class="form-control" value="{{ $service->duration }} menit"></td>
<td><input class="form-control" value="{{ $service->price }}"></td>
<td><button class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
</tr>
@endforeach
</tbody>
</table>
</div>

{{-- ================= PRODUCT ================= --}}
<div class="card-dark p-4 mt-4">
<h4 class="yellow">Product</h4>

<div class="row g-3">
@foreach($barber->products as $product)
<div class="col-md-4">
<div class="card-dark p-3">

<img src="{{ $product->image ?? 'https://via.placeholder.com/300x200' }}" class="img-fluid mb-2">

<input class="form-control mb-2" value="{{ $product->name }}">
<textarea class="form-control mb-2">{{ $product->description }}</textarea>
<input class="form-control" value="{{ $product->price }}">

</div>
</div>
@endforeach
</div>
</div>

<div class="mt-4 text-end">
    <button class="btn btn-success px-4" onclick="saveAndBack()">Simpan Perubahan</button>
</div>

<script>
document.getElementById("btnGantiFoto").onclick = () => {
    document.getElementById("uploadFoto").click();
};

document.getElementById("uploadFoto").onchange = e => {
    let reader = new FileReader();
    reader.onload = event => {
        document.getElementById("previewImage").src = event.target.result;
    };
    reader.readAsDataURL(e.target.files[0]);
};

function removeRow(btn){
    btn.closest("tr").remove();
}

function saveAndBack(){
    alert("Data berhasil disimpan!");
    window.location.href = "{{ url('/admin/barber') }}";
}
</script>

@endsection
