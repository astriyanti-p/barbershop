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

<!-- STAT CARD -->
<div class="row g-4">

    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text">TOTAL BARBERSHOP TERDAFTAR</div>
            <h1>12</h1>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text">TOTAL USER (KONSUMEN)</div>
            <h1 class="yellow">1,284</h1>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text">BOOKING HARI INI</div>
            <h1>47</h1>
        </div>
    </div>

</div>

<!-- GRAFIK -->
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

            <p class="yellow">Booking baru oleh Andi</p>
            <p class="small-text">5 menit lalu</p>
            <hr>

            <p class="yellow">User baru mendaftar</p>
            <p class="small-text">20 menit lalu</p>
            <hr>

            <p class="yellow">Barbershop baru ditambahkan</p>
            <p class="small-text">1 jam lalu</p>
        </div>
    </div>

</div>


<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('bookingChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'],
        datasets: [{
            label: 'Jumlah Booking',
            data: [12, 19, 9, 14, 22, 30, 25],
            borderColor: '#ffc107',
            backgroundColor: 'rgba(255,193,7,0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        plugins: { legend: { labels: { color: "#fff" } } },
        scales: {
            x: { ticks: { color:"#aaa" } },
            y: { ticks: { color:"#aaa" } }
        }
    }
});
</script>

@endsection
