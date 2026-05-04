@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="hero-section" id="home">
    <div class="slider">

        <div class="slides" id="slides">
            <div class="slide"><img src="{{ asset('images/barber1.jpg') }}"></div>
            <div class="slide"><img src="{{ asset('images/barber2.jpg') }}"></div>
            <div class="slide"><img src="{{ asset('images/barber-bg.jpg') }}"></div>
        </div>

        <div class="overlay"></div>

        <div class="hero-content">
            <h1>Booking Barbershop</h1>
            <h2>Lebih Mudah & Tanpa Antre</h2>

            <div class="mt-4">
                <a href="#" class="btn btn-warning btn-lg me-2">Booking Sekarang</a>
                <a href="{{ route('daftar.barbershop') }}" class="btn btn-outline-light btn-lg">
                    Daftarkan Barbershop
                </a>
            </div>
        </div>

        <button class="nav prev" onclick="prevSlide()">❮</button>
        <button class="nav next" onclick="nextSlide()">❯</button>
    </div>
</section>

<!-- ABOUT -->
<section class="section-dark fade-up" id="about">
    <div class="container text-center">
        <h2 class="title">About Us</h2>
        <hr class="divider">

        <p class="desc mb-5">
            Platform booking barbershop yang memudahkan pelanggan tanpa antre,
            serta membantu barbershop mengelola jadwal secara efisien.
        </p>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="flow-card p-4 text-center">
                    <div class="icon">⚡</div>
                    <h5 class="text-warning">Praktis</h5>
                    <p class="text-secondary">Booking kapan saja</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="flow-card p-4 text-center">
                    <div class="icon">🔒</div>
                    <h5 class="text-warning">Terverifikasi</h5>
                    <p class="text-secondary">Aman & terpercaya</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="flow-card p-4 text-center">
                    <div class="icon">📊</div>
                    <h5 class="text-warning">Terorganisir</h5>
                    <p class="text-secondary">Jadwal rapi</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CARA KERJA -->
<section class="section-alt fade-up" id="cara">
    <div class="container text-center">
        <h2 class="title">Cara Kerja</h2>
        <hr class="divider">

        <div class="row g-4 mt-4">

            <div class="col-md-6">
                <div class="flow-card p-4">
                    <h4 class="text-warning">Konsumen</h4>
                    <div class="step"><span>1</span><p>Pilih barbershop</p></div>
                    <div class="step"><span>2</span><p>Pilih layanan</p></div>
                    <div class="step"><span>3</span><p>Booking</p></div>
                    <div class="step"><span>4</span><p>Datang tanpa antre</p></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="flow-card p-4">
                    <h4 class="text-warning">Barbershop</h4>
                    <div class="step"><span>1</span><p>Daftar</p></div>
                    <div class="step"><span>2</span><p>Verifikasi</p></div>
                    <div class="step"><span>3</span><p>Kelola layanan</p></div>
                    <div class="step"><span>4</span><p>Terima booking</p></div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FITUR -->
<section class="section-dark fade-up text-center" id="fitur">
    <div class="container">
        <h2 class="title">Kenapa Harus Pakai?</h2>
        <hr class="divider">

        <div class="row g-4 mt-4">
            <div class="col-md-4">
                <div class="flow-card p-4">
                    <div class="icon">⏰</div>
                    <h5 class="text-warning">Hemat Waktu</h5>
                    <p class="text-secondary">Tanpa antre</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="flow-card p-4">
                    <div class="icon">📱</div>
                    <h5 class="text-warning">Mudah</h5>
                    <p class="text-secondary">Beberapa klik</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="flow-card p-4">
                    <div class="icon">💈</div>
                    <h5 class="text-warning">Banyak Pilihan</h5>
                    <p class="text-secondary">Sesuai kebutuhan</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section-alt text-center fade-up">
    <div class="container">
        <h2 class="title">Gabung Sekarang</h2>
        <p class="desc mb-4">Kelola pelanggan lebih mudah</p>

        <a href="/daftar-barbershop" class="btn btn-warning btn-lg">
            Daftar Sekarang
        </a>
    </div>
</section>

<!-- STYLE FIX -->
<style>
body {
    background:#0d0d0d;
    color:white;
}

/* smooth scroll */
html {
    scroll-behavior: smooth;
}

/* fix navbar offset */
section {
    scroll-margin-top: 90px;
}

/* HERO */
.hero-section {
    height:100vh;
    overflow:hidden;
    position:relative;
}

.slides {
    display:flex;
    transition:0.6s;
}

.slide {
    min-width:100%;
}

.slide img {
    width:100%;
    height:100vh;
    object-fit:cover;
}

.overlay {
    position:absolute;
    inset:0;
    background:linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.7));
}

.hero-content {
    position:absolute;
    top:40%;
    width:100%;
    text-align:center;
    z-index:2;
}

/* NAV */
.nav {
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    background:rgba(0,0,0,0.4);
    border:none;
    color:white;
    font-size:28px;
    padding:10px;
    z-index:3;
}
.prev { left:20px; }
.next { right:20px; }

/* SECTION */
.section-dark { background:#111; padding:80px 0; }
.section-alt { background:#0d0d0d; padding:80px 0; }

.title { color:#d4a017; }
.desc { color:#aaa; max-width:600px; margin:auto; }

/* CARD */
.flow-card {
    background:#1a1a1a;
    border-radius:16px;
    border:1px solid rgba(255,255,255,0.08);
    transition:0.3s;
}
.flow-card:hover {
    transform:translateY(-10px);
    background:#222;
}

/* ICON */
.icon { font-size:40px; margin-bottom:10px; }

/* STEP */
.step {
    display:flex;
    gap:10px;
    margin-bottom:10px;
}

.step span {
    width:30px;
    height:30px;
    background:#d4a017;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
}

/* DIVIDER */
.divider {
    width:60px;
    height:3px;
    background:#d4a017;
    margin:15px auto;
    border:none;
}

/* FADE */
.fade-up {
    opacity:0;
    transform:translateY(30px);
    transition:0.8s;
}
.fade-up.show {
    opacity:1;
    transform:translateY(0);
}
</style>

<!-- SCRIPT -->
<script>
let index = 0;
const slides = document.getElementById('slides');
const total = document.querySelectorAll('.slide').length;

function showSlide() {
    slides.style.transform = `translateX(-${index * 100}%)`;
}

window.nextSlide = function () {
    index = (index + 1) % total;
    showSlide();
}

window.prevSlide = function () {
    index = (index - 1 + total) % total;
    showSlide();
}

setInterval(nextSlide, 4000);

/* scroll animation */
const faders = document.querySelectorAll('.fade-up');

window.addEventListener('scroll', () => {
    faders.forEach(el => {
        if (el.getBoundingClientRect().top < window.innerHeight - 100) {
            el.classList.add('show');
        }
    });
});
</script>

@endsection