@extends('layouts.admin')
@section('title','Users')

@section('content')

<h1 class="page-title mb-4">Manajemen Pengguna</h1>

<div class="d-flex justify-content-between mb-4">
    <input class="form-control w-50 bg-dark text-white border-0"
           placeholder="Cari username / email...">

    <button class="btn btn-warning fw-bold" data-bs-toggle="modal" data-bs-target="#addUserModal">
        + Tambah Pengguna
    </button>
</div>

{{-- STAT CARD --}}
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card-dark p-4">
            <small class="text-secondary">TOTAL PENGGUNA</small>
            <h1 id="totalUser">3</h1>
            <div class="progress bg-secondary">
                <div class="progress-bar bg-warning" style="width:70%"></div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-dark p-4">
            <small class="text-secondary">PENGGUNA AKTIF</small>
            <h1 id="activeUser">2</h1>
            <small class="text-secondary">Aktif dalam sistem</small>
        </div>
    </div>
</div>

{{-- TABLE --}}
<div class="card-dark p-4">
    <h5 class="mb-3">Daftar Pengguna</h5>

    <table class="table table-dark table-borderless">
        <thead class="text-secondary">
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>

        <tbody id="userTable">
            <tr>
                <td>admin</td>
                <td>admin@mail.com</td>
                <td class="text-warning">Active</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                            Aksi
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item editBtn" href="#">Edit</a></li>
                            <li><a class="dropdown-item text-danger deleteBtn" href="#">Hapus</a></li>
                        </ul>
                    </div>
                </td>
            </tr>

            <tr>
                <td>barber01</td>
                <td>barber@mail.com</td>
                <td class="text-secondary">Inactive</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                            Aksi
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item editBtn" href="#">Edit</a></li>
                            <li><a class="dropdown-item text-danger deleteBtn" href="#">Hapus</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

{{-- MODAL TAMBAH USER --}}
<div class="modal fade" id="addUserModal">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white">

      <div class="modal-header">
        <h5>Tambah Pengguna</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" class="form-control" placeholder="Masukkan username">
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" class="form-control" placeholder="Masukkan email">
</div>

<div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control" placeholder="Masukkan password">
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select class="form-control">
        <option>Admin</option>
        <option>Kasir</option>
    </select>
</div>

      <div class="modal-footer">
        <button class="btn btn-warning w-100" onclick="addUser()">Simpan</button>
      </div>

    </div>
  </div>
</div>

    <!-- MODAL EDIT USER -->
<div class="modal fade" id="editUserModal">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white">

      <div class="modal-header border-0">
        <h5 class="modal-title">Edit Pengguna</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <input type="hidden" id="edit_id">

        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" id="edit_username" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" id="edit_email" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Password (opsional)</label>
          <input type="password" id="edit_password" class="form-control" placeholder="Isi jika ingin mengganti">
        </div>

        <div class="mb-3">
          <label class="form-label">Status</label>
          <select id="edit_role" class="form-control">
            <option value="Admin">Admin</option>
            <option value="Kasir">Kasir</option>
          </select>
        </div>

      </div>

      <div class="modal-footer border-0">
        <button class="btn btn-sm btn-warning"
        onclick="editUser(1,'Marcus','marcus@mail.com','Admin')">
   Edit
</button>
      </div>

    </div>
  </div>
</div>

{{-- SCRIPT --}}
<script>

function addUser(){
    let username = document.getElementById('username').value;
    let email = document.getElementById('email').value;
    let status = document.getElementById('status').value;

    let table = document.getElementById('userTable');

    let row = `
        <tr>
            <td>${username}</td>
            <td>${email}</td>
            <td class="${status=='Active'?'text-warning':'text-secondary'}">${status}</td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                        Aksi
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item editBtn" href="#">Edit</a></li>
                        <li><a class="dropdown-item text-danger deleteBtn" href="#">Hapus</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    `;

    table.innerHTML += row;
    document.getElementById('totalUser').innerText++;
}

document.addEventListener("click", function(e){

    if(e.target.classList.contains("deleteBtn")){
        e.target.closest("tr").remove();
        alert("User dihapus");
    }

    if(e.target.classList.contains("editBtn")){
        alert("Fitur edit (dummy frontend)");
    }

});
</script>

@endsection  
