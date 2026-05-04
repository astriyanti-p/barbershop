@extends('layouts.admin')
@section('title','Edit Barbershop')

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
    background:#111 !important;
    border:1px solid #333 !important;
    color:#fff !important;
}

/* PRODUCT */
.product-card img{
    height:180px;
    object-fit:cover;
    border-radius:8px;
}
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
             src="https://images.unsplash.com/photo-1622287162716-74d9f54c16f6"
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
<input class="form-control" value="Obsidian Barbershop">
</div>

<div class="col-md-6">
<label>Nama Pemilik</label>
<input class="form-control" value="Hadi Syahputra">
</div>

<div class="col-md-6">
<label>Email</label>
<input class="form-control" value="obsidian@mail.com">
</div>

<div class="col-md-6">
<label>No HP</label>
<input class="form-control" value="08123456789">
</div>

<div class="col-md-6">
<label>Kota</label>
<input class="form-control" value="Surabaya">
</div>

<div class="col-md-12">
<label>Alamat</label>
<input class="form-control" value="Jl. Mawar No 12, Surabaya">
</div>

<div class="col-md-6">
<label>Jam Operasional</label>
<input class="form-control" value="09:00 - 21:00">
</div>

<div class="col-md-6">
<label>Deskripsi</label>
<textarea class="form-control">Barbershop premium dengan barber profesional</textarea>
</div>

</div>

</div>
</div>
</div>

<!-- SERVICE -->
<div class="card-dark p-4 mt-4">

<div class="d-flex justify-content-between align-items-center">
<h4 class="yellow">Service (Max 5)</h4>
<button class="btn btn-warning btn-sm" onclick="addService()">+ Tambah Service</button>
</div>

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

<tr>
<td><input class="form-control" value="Haircut Premium"></td>
<td><input class="form-control" value="45 menit"></td>
<td><input class="form-control" value="120000"></td>
<td><button class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
</tr>

<tr>
<td><input class="form-control" value="Beard Styling"></td>
<td><input class="form-control" value="30 menit"></td>
<td><input class="form-control" value="80000"></td>
<td><button class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
</tr>

</tbody>
</table>
</div>

<!-- PRODUCT -->
<div class="card-dark p-4 mt-4">

<h4 class="yellow">Product</h4>

<div class="row g-3">

<!-- PRODUCT 1 -->
<div class="col-md-4">
<div class="card-dark p-3">

<img src="https://images.unsplash.com/photo-1599351431202-1e0f0137899a" class="img-fluid mb-2">

<input class="form-control mb-2" value="Pomade Strong Hold">
<textarea class="form-control mb-2">Tahan lama styling rambut</textarea>
<input class="form-control" value="75000">

</div>
</div>

<!-- PRODUCT 2 -->
<div class="col-md-4">
<div class="card-dark p-3">

<img src="https://images.unsplash.com/photo-1621607512022-6aecc4fed814" class="img-fluid mb-2">

<input class="form-control mb-2" value="Hair Powder">
<textarea class="form-control mb-2">Volume rambut natural</textarea>
<input class="form-control" value="60000">

</div>
</div>

<!-- PRODUCT 3 -->
<div class="col-md-4">
<div class="card-dark p-3">

<img src="https://images.unsplash.com/photo-1615397349754-cfa2066a298e" class="img-fluid mb-2">

<input class="form-control mb-2" value="Beard Oil">
<textarea class="form-control mb-2">Merawat jenggot agar lembut</textarea>
<input class="form-control" value="90000">

</div>
</div>

</div>
</div>

<!-- SAVE -->
<div class="mt-4 text-end">
    <button class="btn btn-success px-4" onclick="saveAndBack()">
    Simpan Perubahan
</button>
</div>

<script>

/* ================= FOTO ================= */
document.getElementById("btnGantiFoto").addEventListener("click", function () {
    document.getElementById("uploadFoto").click();
});

document.getElementById("uploadFoto").addEventListener("change", function (e) {
    let file = e.target.files[0];

    if (file) {
        let reader = new FileReader();
        reader.onload = function (event) {
            document.getElementById("previewImage").src = event.target.result;
        };
        reader.readAsDataURL(file);
    }
});

/* ================= SERVICE ================= */
function addService(){

    let table = document.getElementById("serviceTable");
    let rows = table.querySelectorAll("tr").length;

    if(rows >= 5){
        alert("Maksimal 5 service saja!");
        return;
    }

    table.innerHTML += `
    <tr>
        <td><input class="form-control"></td>
        <td><input class="form-control"></td>
        <td><input class="form-control"></td>
        <td><button class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
    </tr>`;
}

function removeRow(btn){
    btn.closest("tr").remove();
}

/* ================= SAVE & BACK ================= */
function saveAndBack() {
    // simulasi save (frontend only)
    alert("Data berhasil disimpan!");

    // balik ke halaman manajemen barber
    window.location.href = "{{ url('/admin/barber') }}";
}

</script>

@endsection