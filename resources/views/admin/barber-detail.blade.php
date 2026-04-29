@extends('layouts.admin')
@section('title','Detail Barbershop')

@section('content')

<div class="topbar">
    <div>
        <div class="small-text yellow">DETAIL DATA</div>
        <h1 class="page-title">DETAIL BARBERSHOP</h1>
    </div>

    <a href="{{ url('/admin/barber') }}" class="btn btn-outline-light">
        ← Kembali
    </a>
</div>

<div class="row mt-3 g-4">

    <!-- FOTO -->
    <div class="col-md-4">
        <div class="card-dark p-3">
            <img src="https://images.unsplash.com/photo-1622287162716-74d9f54c16f6" class="img-fluid rounded mb-3">
            <button class="btn btn-warning w-100">Ganti Foto</button>
        </div>
    </div>

    <!-- FORM DETAIL -->
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
                    <label>No HP</label>
                    <input class="form-control" value="08123456789">
                </div>

                <div class="col-md-6">
                    <label>Kota</label>
                    <input class="form-control" value="Surabaya">
                </div>

                <div class="col-md-12">
                    <label>Alamat Lengkap</label>
                    <input class="form-control" value="Jl. Mawar No 12, Surabaya">
                </div>

                <div class="col-md-6">
                    <label>Jam Operasional</label>
                    <input class="form-control" value="09:00 - 21:00">
                </div>

                <div class="col-md-6">
                    <label>Deskripsi</label>
                    <input class="form-control" value="Barbershop premium dengan barber profesional">
                </div>

                <div class="col-md-6">
                    <label>Longitude</label>
                    <input class="form-control" value="112.7508">
                </div>

                <div class="col-md-6">
                    <label>Latitude</label>
                    <input class="form-control" value="-7.2575">
                </div>

            </div>

        </div>
    </div>
</div>

<!-- 💈 DAFTAR SERVICE -->
<div class="card-dark p-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="yellow">Service Tersedia</h4>
        </button>
    </div>

    <table class="table table-dark table-borderless align-middle">
        <thead class="text-secondary">
            <tr>
                <th>Nama Service</th>
                <th>Durasi</th>
                <th>Harga</th>
            </tr>
        </thead>

        <tbody id="serviceTable">

            <tr>
                <td>Haircut Premium</td>
                <td>45 menit</td>
                <td class="yellow">Rp 120.000</td>
            </tr>

            <tr>
                <td>Beard Styling</td>
                <td>30 menit</td>
                <td class="yellow">Rp 80.000</td>
            </tr>

            <tr>
                <td>Hair Coloring</td>
                <td>90 menit</td>
                <td class="yellow">Rp 250.000</td>
            </tr>

        </tbody>
    </table>
</div>

<!-- ⭐ RATING ADMIN -->
<div class="card-dark p-4 mt-4">

    <h4 class="yellow mb-3">Rating dari Admin</h4>

    <div class="mb-3">
        <label>Beri Rating</label>
        <select class="form-control">
            <option>⭐ 1</option>
            <option>⭐⭐ 2</option>
            <option>⭐⭐⭐ 3</option>
            <option>⭐⭐⭐⭐ 4</option>
            <option selected>⭐⭐⭐⭐⭐ 5</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Catatan Admin</label>
        <textarea class="form-control" rows="3">
Barbershop sangat rapi dan pelayanan cepat.
        </textarea>
    </div>

    <button class="btn btn-warning">Simpan Perubahan</button>

</div>

<!-- MODAL TAMBAH SERVICE -->
<div class="modal fade" id="serviceModal">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white">

      <div class="modal-header border-secondary">
        <h5 class="modal-title">Tambah Service</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <label>Nama Service</label>
        <input id="serviceName" class="form-control mb-2">

        <label>Durasi</label>
        <input id="serviceDuration" class="form-control mb-2" placeholder="contoh: 60 menit">

        <label>Harga</label>
        <input id="servicePrice" class="form-control" placeholder="contoh: 150000">
      </div>

      <div class="modal-footer border-secondary">
        <button class="btn btn-outline-light" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-warning" onclick="addService()">Tambah</button>
      </div>

    </div>
  </div>
</div>


<script>
function addService(){
    let name = document.getElementById("serviceName").value
    let dur  = document.getElementById("serviceDuration").value
    let price= document.getElementById("servicePrice").value

    if(name === "" || dur === "" || price === "") return alert("Isi semua field!")

    let table = document.getElementById("serviceTable")

    table.innerHTML += `
        <tr>
            <td>${name}</td>
            <td>${dur}</td>
            <td class="yellow">Rp ${Number(price).toLocaleString("id-ID")}</td>
            <td>
                <button class="btn btn-sm btn-secondary">Edit</button>
                <button class="btn btn-sm btn-outline-light deleteService">Hapus</button>
            </td>
        </tr>
    `

    bootstrap.Modal.getInstance(document.getElementById('serviceModal')).hide()
}
</script>

@endsection
