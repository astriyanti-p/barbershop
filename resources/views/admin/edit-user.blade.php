@extends('layouts.admin')
@section('title','Edit User')

@section('content')
<div class="container mt-4">
    <h3>Edit Pengguna</h3>

    <form action="/admin/users/update/{{ $user->id }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control"
                   value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control"
                   value="{{ $user->username }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="phone" class="form-control"
                   value="{{ $user->phone }}" required>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                <option value="barber" {{ $user->role=='barber'?'selected':'' }}>Barber</option>
                <option value="customer" {{ $user->role=='customer'?'selected':'' }}>Customer</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="active" {{ $user->status==1?'selected':'' }}>Active</option>
                <option value="inactive" {{ $user->status==0?'selected':'' }}>Inactive</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="/admin/users" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
