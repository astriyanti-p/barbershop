@extends('layouts.admin')
@section('title','Tambah User')

@section('content')
<div class="container mt-4">
    <h3>Tambah Pengguna</h3>

    <form action="/admin/users/store" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name') }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input
            type="text"
            name="username"
            class="form-control"
            value="{{ old('username') }}"
            required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input
            type="text"
            name="phone"
            class="form-control"
            value="{{ old('phone') }}"
            required>
        </div>


        <div class="mb-3">
            <label class="form-label">Password</label>
            <input
                type="password"
                name="password"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
                <option value="barber" {{ old('role')=='barber' ? 'selected' : '' }}>Barber</option>
                <option value="customer" {{ old('role')=='customer' ? 'selected' : '' }}>Customer</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="">-- Pilih Status --</option>
                <option value="active" {{ old('status')=='active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status')=='inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/admin/users" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
