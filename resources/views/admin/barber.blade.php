@extends('layouts.admin')
@section('title','Manajemen Barbershop')

@section('content')

<div class="topbar">
    <div>
        <div class="small-text yellow">ADMIN CONTROL PANEL</div>
        <h1 class="page-title">MANAJEMEN BARBERSHOP</h1>
    </div>

    <div class="d-flex gap-3">
        <input id="searchBarber" class="form-control" style="width:260px" placeholder="Cari barbershop...">
        <button class="btn btn-warning">+ Tambah Barbershop</button>
    </div>
</div>

<!-- TABLE -->
<div class="card-dark mt-3">
<table class="table table-dark table-borderless align-middle">
<thead class="text-secondary">
<tr>
    <th>Foto</th>
    <th>Nama Barbershop</th>
    <th>Owner</th>
    <th>Alamat</th>
    <th>Status</th>
    <th width="260">Aksi</th>
</tr>
</thead>

<tbody>

<!-- ROW 1 -->
<tr>
<td>
<img src="https://images.unsplash.com/photo-1622287162716-74d9f54c16f6" width="70" class="rounded">
</td>
<td>Obsidian Barbershop</td>
<td>Hadi Syahputra</td>
<td>Jl. Mawar No 12, Surabaya</td>
<td><span class="badge bg-warning text-dark">PENDING</span></td>

<td class="d-flex gap-2">
<button class="btn btn-success btn-sm approve-btn">Approve</button>
<button class="btn btn-danger btn-sm reject-btn">Reject</button>

<a href="{{ route('admin.barber.detail',1) }}" class="btn btn-info btn-sm">
    Detail
</a>

<a href="{{ route('admin.barber.edit',1) }}" class="btn btn-secondary btn-sm">Edit</a>
<button class="btn btn-outline-light btn-sm">Hapus</button>
</td>
</tr>

<!-- ROW 2 -->
<tr>
<td>
<img src="https://images.unsplash.com/photo-1599351431202-1e0f0137899a" width="70" class="rounded">
</td>
<td>Gentleman Cut</td>
<td>Deni Kurnia</td>
<td>Jl. Kenanga No 8, Malang</td>
<td><span class="badge bg-success">AKTIF</span></td>

<td class="d-flex gap-2">
<a href="{{ route('admin.barber.detail',2) }}" class="btn btn-info btn-sm">
    Detail
</a>
<a href="{{ route('admin.barber.edit',2) }}" class="btn btn-secondary btn-sm">Edit
</a>
<button class="btn btn-outline-light btn-sm">Hapus</button>
</td>
</tr>

<!-- ROW 3 -->
<tr>
<td>
<img src="https://images.unsplash.com/photo-1580618672591-eb180b1a973f" width="70" class="rounded">
</td>
<td>Urban Fade Studio</td>
<td>Rizky Saputra</td>
<td>Jl. Melati No 21, Jember</td>
<td><span class="badge bg-danger">DITOLAK</span></td>

<td class="d-flex gap-2">
<a href="{{ route('admin.barber.detail',3) }}" class="btn btn-info btn-sm">
    Detail
</a>
<a href="{{ route('admin.barber.edit',3) }}" class="btn btn-secondary btn-sm">Edit  </a>
<button class="btn btn-outline-light btn-sm">Hapus</button>
</td>
</tr>

</tbody>
</table>
</div>

<!-- SCRIPT APPROVE / REJECT FRONTEND -->
<script>
document.querySelectorAll(".approve-btn").forEach(btn => {
    btn.addEventListener("click", function() {
        let row = this.closest("tr")
        let status = row.querySelector("td:nth-child(5) span")
        status.className = "badge bg-success"
        status.innerText = "AKTIF"
        this.remove()
        row.querySelector(".reject-btn").remove()
    })
})

document.querySelectorAll(".reject-btn").forEach(btn => {
    btn.addEventListener("click", function() {
        let row = this.closest("tr")
        let status = row.querySelector("td:nth-child(5) span")
        status.className = "badge bg-danger"
        status.innerText = "DITOLAK"
        this.remove()
        row.querySelector(".approve-btn").remove()
    })
})
// ================= SEARCH FILTER =================
document.getElementById("searchBarber").addEventListener("keyup", function () {

    let keyword = this.value.toLowerCase();
    let rows = document.querySelectorAll("tbody tr");

    rows.forEach(row => {

        let nama = row.cells[1].innerText.toLowerCase();
        let owner = row.cells[2].innerText.toLowerCase();
        let alamat = row.cells[3].innerText.toLowerCase();

        if (
            nama.includes(keyword) ||
            owner.includes(keyword) ||
            alamat.includes(keyword)
        ) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }

    });

});
</script>

@endsection
