@extends('layouts.admin')
@section('title','Attendance')

@section('content')

<div class="topbar">
    <div>
        <div class="small-text yellow">HR_METRICS_DASHBOARD</div>
        <h1 class="page-title">Presensi Staf</h1>
        <div class="small-text">
            Log operasional harian dan pemantauan ketersediaan SDM real-time
        </div>
    </div>

    <div class="d-flex gap-3">
        <div class="card-dark text-center">
            <div class="small-text">Staf Aktif</div>
            <h3>12 / 14</h3>
        </div>
        <div class="card-dark text-center">
            <div class="small-text">Rata-rata Jam</div>
            <h3>7.4</h3>
        </div>
    </div>
</div>

<!-- JADWAL -->
<div class="card-dark mt-4">
    <h5>Jadwal Mingguan</h5>

    <table class="table table-dark mt-3">
        <thead>
            <tr>
                <th>Staff</th>
                <th>Senin</th>
                <th>Selasa</th>
                <th>Rabu</th>
                <th>Kamis</th>
                <th>Jumat</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Aditiya</td>
                <td class="text-warning">09:00-18:00</td>
                <td class="text-warning">09:00-18:00</td>
                <td class="text-warning">09:00-18:00</td>
                <td>OFF</td>
                <td class="text-warning">09:00-18:00</td>
            </tr>
            <tr>
                <td>Reza</td>
                <td>OFF</td>
                <td class="text-warning">10:00-20:00</td>
                <td class="text-warning">10:00-20:00</td>
                <td class="text-warning">10:00-20:00</td>
                <td class="text-warning">10:00-20:00</td>
            </tr>
            <tr>
                <td>Sinta</td>
                <td class="text-warning">09:00-18:00</td>
                <td class="text-warning">09:00-18:00</td>
                <td>OFF</td>
                <td class="text-warning">09:00-18:00</td>
                <td class="text-warning">09:00-18:00</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- STATUS REALTIME + TOTAL JAM -->
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card-dark">
            <h5>Status Real-time</h5>
            <p class="text-warning">● Aditya — Tersedia</p>
            <p class="text-danger">● Reza — Melayani</p>
            <p class="text-secondary">● Sinta — Istirahat</p>
            <p class="text-warning">● Budi — Tersedia</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-warning text-dark">
            <h1>1,248</h1>
            <p>Total Jam Kerja Bulan Ini</p>
        </div>
    </div>
</div>

<!-- LOG -->
<div class="card-dark mt-4">
    <h5>Log Aktivitas Terkini</h5>
    <hr>
    <p>08:52 — Aditya Check-in</p>
    <p>09:05 — Reza Check-in</p>
    <p>12:15 — Sinta Break</p>
    <p>13:10 — Sinta Kembali kerja</p>
</div>

@endsection
