@extends('layouts.admin')
@section('title','Dashboard')

@section('content')

<div class="topbar">
    <div>
        <div class="small-text">EXECUTIVE OVERVIEW</div>
        <h1>Dashboard</h1>
    </div>

    <div class="card-dark">
        <span class="yellow">■ OPERATIONAL</span>
        <div class="small-text">SERVER STATUS</div>
    </div>
</div>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text">TOTAL TRANSACTIONS</div>
            <h1>1,284</h1>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text">TOTAL INCOME</div>
            <h1 class="yellow">Rp 242.8M</h1>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text">MOBILE USERS</div>
            <h1>892</h1>
        </div>
    </div>

</div>

<div class="row mt-4 g-4">
    <div class="col-md-8">
        <div class="card-dark" style="height:260px">
            <div class="small-text">TELEMETRI PENDAPATAN MINGGUAN</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text">LOG AKTIVITAS</div>
            <p class="yellow">Transaksi berhasil #4402</p>
            <p class="small-text">2 menit lalu</p>
            <hr>
            <p class="yellow">User daftar @riza_barber</p>
            <p class="small-text">14 menit lalu</p>
        </div>
    </div>
</div>

@endsection
