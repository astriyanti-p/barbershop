@extends('layouts.kasir')
@section('title','Kasir Booking')

@section('content')

<h1 class="mb-4">Booking Walk-In</h1>

<div class="d-flex justify-content-between mb-3">
    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#bookingModal">
        + New Booking
    </button>

    <input id="searchInput" class="form-control w-25" placeholder="Cari customer...">
</div>

<div class="card-dark">
    <table class="table-cashier" id="bookingTable">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Layanan</th>
                <th>Jam</th>
                <th>Status</th>
                <th width="120">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>


<!-- MODAL BOOKING -->
<div class="modal fade" id="bookingModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white border-0 shadow-lg">

      <!-- HEADER -->
      <div class="modal-header border-secondary">
        <h5 class="modal-title fw-bold">Tambah Booking</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body">

        <!-- Nama -->
        <label class="form-label">Nama Customer</label>
        <div class="input-group mb-3">
          <span class="input-group-text bg-warning border-0">👤</span>
          <input type="text" class="form-control" placeholder="Masukkan nama customer">
        </div>

        <!-- Treatment -->
        <label class="form-label">Jenis Treatment</label>
        <div class="input-group mb-3">
          <span class="input-group-text bg-warning border-0">✂️</span>
          <select class="form-select">
            <option selected disabled>-- Pilih Treatment --</option>
            <option>Haircut</option>
            <option>Haircut + Wash</option>
            <option>Haircut + Beard</option>
            <option>Full Treatment</option>
          </select>
        </div>

        <!-- Jam -->
        <label class="form-label">Pilih Jam</label>
        <div class="input-group">
          <span class="input-group-text bg-warning border-0">🕒</span>
          <select class="form-select">
            <option selected disabled>-- Pilih Jam --</option>
            <option>10:00</option>
            <option>11:00</option>
            <option>12:00</option>
            <option>13:00</option>
            <option>14:00</option>
            <option>15:00</option>
            <option>16:00</option>
            <option>17:00</option>
            <option>18:00</option>
            <option>19:00</option>
          </select>
        </div>

        <small class="text-secondary">
          Pastikan jam yang dipilih tersedia sebelum menyimpan.
        </small>

      </div>

      <!-- FOOTER -->
      <div class="modal-footer border-secondary">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-warning px-4 fw-bold" data-bs-dismiss="modal">
          Simpan
        </button>
      </div>

    </div>
  </div>
</div>

<script>
let bookings = []

function renderTable(){
    let tbody = document.querySelector("#bookingTable tbody")
    tbody.innerHTML = ""

    bookings.forEach((b,index)=>{
        tbody.innerHTML += `
        <tr>
            <td>${b.nama}</td>
            <td>${b.layanan}</td>
            <td>${b.jam}</td>
            <td>Waiting</td>
            <td>
                <button class="btn btn-sm btn-danger" onclick="hapus(${index})">Hapus</button>
            </td>
        </tr>`
    })
}

function addBooking(){
    let nama = document.getElementById("nama").value
    let layanan = document.getElementById("layanan").value
    let jam = document.getElementById("jam").value

    if(nama == "" || layanan == "" || jam == ""){
        alert("Isi semua data!")
        return
    }

    bookings.push({nama,layanan,jam})
    renderTable()

    document.getElementById("nama").value=""
    document.getElementById("layanan").value=""
    document.getElementById("jam").value=""
}

function hapus(index){
    bookings.splice(index,1)
    renderTable()
}

/* SEARCH */
document.getElementById("searchInput").addEventListener("keyup",function(){
    let value = this.value.toLowerCase()
    let rows = document.querySelectorAll("#bookingTable tbody tr")

    rows.forEach(row=>{
        row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none"
    })
})
</script>

@endsection
