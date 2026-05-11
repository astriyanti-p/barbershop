@extends('layouts.admin')
@section('title','Manajemen Barbershop')

@section('content')

<div class="topbar">
    <div>
        <div class="small-text yellow">ADMIN CONTROL PANEL</div>
        <h1 class="page-title">MANAJEMEN BARBERSHOP</h1>
    </div>

    <form method="GET" action="{{ route('admin.barber') }}">
        <input
            name="search"
            value="{{ $search }}"
            class="form-control"
            style="width:260px"
            placeholder="Cari barbershop..."
        >
    </form>
</div>

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
@forelse($barbers as $barber)
<tr>
<td>
<img src="https://ui-avatars.com/api/?name={{ $barber->shop_name }}" width="70" class="rounded">
</td>

<td>{{ $barber->shop_name }}</td>
<td>{{ $barber->user->name ?? '-' }}</td>
<td>{{ $barber->user->address ?? '-' }}</td>

<td>
@if(optional($barber->user)->status == 0)
    <span class="badge bg-warning text-dark">PENDING</span>
@elseif(optional($barber->user)->status == 1)
    <span class="badge bg-success">AKTIF</span>
@else
    <span class="badge bg-danger">DITOLAK</span>
@endif
</td>

<td class="d-flex gap-2">

@if(optional($barber->user)->status == 0)
<form action="{{ route('admin.barber.approve',$barber->id) }}" method="POST">
@csrf
<button class="btn btn-success btn-sm">Approve</button>
</form>

<form action="{{ route('admin.barber.reject',$barber->id) }}" method="POST">
@csrf
<button class="btn btn-danger btn-sm">Reject</button>
</form>
@endif

<a href="{{ route('admin.barber.detail',$barber->id) }}" class="btn btn-info btn-sm">
Detail
</a>

<form action="{{ route('admin.barber.delete',$barber->id) }}" method="POST">
@csrf
@method('DELETE')
<button class="btn btn-outline-light btn-sm">Hapus</button>
</form>

</td>
</tr>

@empty
<tr>
<td colspan="6" class="text-center text-secondary py-4">
Tidak ada data barbershop 😢
</td>
</tr>
@endforelse
</tbody>
</table>

{{-- PAGINATION --}}
<div class="mt-3">
    {{ $barbers->withQueryString()->links() }}
</div>

</div>
@endsection
