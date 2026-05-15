@extends('layouts.admin')
@section('title','Dashboard')

@section('content')

<div class="topbar">
    <div>
        <div class="small-text">BARBERSHOP OVERVIEW</div>
        <h1 class="page-title">Dashboard</h1>
    </div>

    <div class="card-dark">
        <span class="yellow">● SYSTEM ONLINE</span>
        <div class="small-text">ALL SERVICES RUNNING</div>
    </div>
</div>

<!-- ================= STAT CARD ================= -->
<div class="row g-4">

    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text">TOTAL BARBERSHOP TERDAFTAR</div>
            <h1>{{ $totalBarber }}</h1>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text">TOTAL USER (KONSUMEN)</div>
            <h1 class="yellow">{{ $totalUsers }}</h1>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text">TOTAL SALDO SISTEM</div>
            <h1>Rp {{ number_format($totalSaldo,0,',','.') }}</h1>
        </div>
    </div>

</div>

<!-- ================= GRAFIK ================= -->
<div class="row mt-4 g-4">

    <div class="col-md-8">
        <div class="card-dark">
            <div class="small-text mb-3">STATISTIK BOOKING MINGGUAN</div>
            <canvas id="bookingChart" height="120"></canvas>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text">AKTIVITAS TERBARU</div>

            <p class="yellow">Booking baru masuk</p>
            <p class="small-text">Realtime dari database</p>
            <hr>

            <p class="yellow">User baru mendaftar</p>
            <p class="small-text">Realtime dari database</p>
            <hr>

            <p class="yellow">Barbershop baru ditambahkan</p>
            <p class="small-text">Realtime dari database</p>
        </div>
    </div>

</div>


<!-- ================= CHART JS ================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const labels = @json($labels);
const dataBooking = @json($data);

const ctx = document.getElementById('bookingChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Jumlah Booking',
            data: dataBooking,
            borderWidth: 3,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true
            }
        }
    }
});
</script>

@endsection
