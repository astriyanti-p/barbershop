@extends('layouts.admin')
@section('title','Users')

@section('content')

<h1 class="page-title mb-4">Manajemen Pengguna</h1>

<div class="d-flex justify-content-between mb-4">

    <form method="GET" action="/admin/users" class="w-50">
    <input type="text"
           name="search"
           value="{{ $search }}"
           class="form-control bg-dark text-white border-0"
           placeholder="Cari nama / username / email..."
           onkeyup="this.form.submit()">
    </form>

    <a href="/admin/users/create" class="btn btn-warning">
        + Tambah Pengguna
    </a>
</div>

{{-- STAT CARD --}}
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card-dark p-4">
            <small class="text-secondary">TOTAL PENGGUNA</small>
            <h1>{{ $totalUser }}</h1>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-dark p-4">
            <small class="text-secondary">PENGGUNA AKTIF</small>
            <h1>{{ $activeUser }}</h1>
            <small class="text-secondary">Status = active</small>
        </div>
    </div>
</div>

{{-- TABLE --}}
<div class="card-dark p-4">
    <h5 class="mb-3">Daftar Pengguna</h5>

    <table class="table table-dark table-borderless">
        <thead class="text-secondary">
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>No HP</th>
                <th width="160">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>

                {{-- ROLE --}}
                <td>
                    @if($user->role == 'admin')
                        <span class="badge bg-danger">ADMIN</span>
                    @elseif($user->role == 'barber')
                        <span class="badge bg-info">BARBER</span>
                    @else
                        <span class="badge bg-secondary">CUSTOMER</span>
                    @endif
                </td>

                {{-- STATUS (DB = 1 / 0) --}}
                <td>
                    @if($user->status == 1)
                        <span class="text-warning">ACTIVE</span>
                    @else
                        <span class="text-secondary">INACTIVE</span>
                    @endif
                </td>

                <td>{{ $user->phone ?? '-' }}</td>

                {{-- AKSI --}}
                <td>
                    <a href="/admin/users/edit/{{ $user->id }}"
                       class="btn btn-sm btn-warning">Edit</a>

                    <a href="/admin/users/delete/{{ $user->id }}"
                       onclick="return confirm('Yakin hapus user ini?')"
                       class="btn btn-sm btn-danger">Hapus</a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>

@endsection
