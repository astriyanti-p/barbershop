@extends('layouts.app')

@section('content')

<!-- HERO -->
<section id="home" class="hero-section">
    <div class="overlay"></div>
    <div class="hero-content">
        <h1>SELAMAT DATANG</h1>
        <h2>DI BARBERSHOP</h2>
    </div>
</section>

<!-- ABOUT -->
<section id="about"  style="padding: 4rem 0; background:rgba(0,0,0,0.6);">
    <div class="container">
        <h2 style="color:#d4a017; text-align:center; margin-bottom:2rem;">About Us</h2>

        <div style="max-width:800px; margin:0 auto; text-align:center;">
            <p style="font-size:18px; line-height:1.8; margin-bottom:1.5rem;">
                Man Cave Barbershop adalah tempat potong rambut modern yang menggabungkan gaya klasik dan tren terkini.
                Berdiri sejak 2020, kami berkomitmen memberikan pelayanan terbaik untuk penampilan terbaik Anda.
            </p>

            <p style="font-size:16px; line-height:1.8; color:#aaa;">
                Dengan barber profesional yang berpengalaman dan suasana nyaman seperti "cave" pria sejati,
                kami siap membuat Anda tampil percaya diri.
            </p>
        </div>
    </div>
</section>

<!-- BARBER -->
<section id="ourbarber"  style="padding: 4rem 0; background:rgba(0,0,0,0.6);">
    <div class="container">
        <h2 style="color:#d4a017; text-align:center; margin-bottom:2rem;">Our Barber</h2>
        <p style="text-align:center; color:#aaa; margin-bottom:2rem;">
            Tim barber profesional di Man Cave Barbershop
        </p>

        <div class="row g-4">

            <!-- Barber 1 -->
            <div class="col-md-6 col-sm-6">
                <div class="gallery-card">
                    <img src="{{ asset('images/barber1.jpg') }}" alt="Barber 1">
                    <div class="text-center p-3">
                        <h4 class="text-warning">Barber Joko</h4>
                        <p class="text-secondary small">Spesialis Potong Klasik</p>
                    </div>
                </div>
            </div>

            <!-- Barber 2 -->
            <div class="col-md-6 col-sm-6">
                <div class="gallery-card">
                    <img src="{{ asset('images/barber2.jpg') }}" alt="Barber 2">
                    <div class="text-center p-3">
                        <h4 class="text-warning">Barber Rudi</h4>
                        <p class="text-secondary small">Spesialis Fade & Beard</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SERVICES -->
<section id="services" style="padding: 4rem 0; background:rgba(0,0,0,0.6);">
    <div class="container">
        <h2 class="text-center text-warning mb-4">Our Services</h2>

        <div class="row g-4">

            <!-- Service -->
            @foreach([
                ['img'=>'potong.jpg','title'=>'Potong Rambut','price'=>'Rp35.000'],
                ['img'=>'cukur.jpg','title'=>'Cukur Jenggot','price'=>'Rp25.000'],
                ['img'=>'coloring.jpg','title'=>'Warna Rambut','price'=>'Rp150.000'],
                ['img'=>'lurusin.jpg','title'=>'Straightening','price'=>'Rp200.000'],
            ] as $s)
            <div class="col-md-3 col-sm-6">
                <div class="service-card text-center">
                    <img src="{{ asset('images/'.$s['img']) }}">
                    <div class="p-3">
                        <h5 class="text-warning">{{ $s['title'] }}</h5>
                        <p class="text-secondary small">Mulai dari {{ $s['price'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- PRICES -->
<!-- PRICES -->
<section id="prices" style="padding: 4rem 0; background:rgba(0,0,0,0.6);">
  <div class="container">
    <h2 class="title">Prices</h2>

    <div class="row g-4 justify-content-center">

      <!-- CARD 1 -->
      <div class="col-md-4 col-sm-6">
        <div class="price-card text-center h-100">
          <h4>CUT & WASH</h4>
          <h2>START IDR 30.000 <span>/ session</span></h2>

          <ul>
            <li>Haircut sesuai keinginan</li>
            <li>Rekomendasi Model sesuai bentuk wajah</li>
            <li>Pembersihan kulit kepala dengan shampo</li>
            <li>Pemberian Vitamin Rambut</li>
            <li>Penataan model rambut dengan pomade</li>
          </ul>
        </div>
      </div>

      <!-- CARD 2 -->
      <div class="col-md-4 col-sm-6">
        <div class="price-card text-center h-100">
          <h4>CUT & WASH (KIDS)</h4>
          <h2>START IDR 25.000 <span>/ session</span></h2>

          <ul>
            <li>Haircut sesuai keinginan</li>
            <li>Untuk anak usia maksimal 10 tahun</li>
            <li>Pembersihan kulit kepala dengan shampo</li>
            <li>Pemberian Vitamin Rambut</li>
            <li>Penataan model rambut dengan pomade</li>
          </ul>
        </div>
      </div>

      <!-- CARD 3 -->
      <div class="col-md-4 col-sm-6">
        <div class="price-card text-center h-100">
          <h4>HAIR COLOR FOR MEN</h4>
          <h2>START IDR 100.000 <span>/ session</span></h2>

          <ul>
            <li>Sample warna rambut</li>
            <li>Rekomendasi warna sesuai trend</li>
            <li>Coloring & gradasi sesuai keinginan</li>
            <li>Pembersihan kulit kepala</li>
            <li>Pemberian Vitamin Rambut</li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- CONTACT -->
<section id="contact" style="padding: 4rem 0; background:rgba(0,0,0,0.6);">
  <div class="container">
    <h2 class="title">Contact Us</h2>

    <div class="row g-4 align-items-stretch">

      <!-- MAP (KIRI) -->
      <div class="col-md-6">

        <h4 class="text-warning mb-3">Lokasi Kami</h4>

        <iframe
          src="https://www.google.com/maps?q=-8.1599551,113.7230733&z=18&output=embed"
          width="100%"
          height="350"
          style="border:0; border-radius:12px;"
          loading="lazy">
        </iframe>
        <a 
  href="https://www.google.com/maps?q=-8.1599551,113.7230733"
  target="_blank"
  class="open-maps-btn">
  Buka di Google Maps
</a>

      </div>

      <!-- CONTACT (KANAN) -->
      <div class="col-md-6">

        <h4 class="text-warning mb-3">Hubungi Kami</h4>

        <div class="contact-box">

          <!-- WHATSAPP -->
          <a href="https://wa.me/6281234567890" target="_blank" class="contact-row">
            <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png">
            <div>
              <h5>WhatsApp</h5>
              <p>+62 812-3456-7890</p>
            </div>
          </a>

          <!-- INSTAGRAM -->
          <a href="https://instagram.com/mancavebarbershop" target="_blank" class="contact-row">
            <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png">
            <div>
              <h5>Instagram</h5>
              <p>@mancavebarbershop</p>
            </div>
          </a>

          <!-- EMAIL -->
          <a href="mailto:barbershop@gmail.com" class="contact-row">
            <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png">
            <div>
              <h5>Email</h5>
              <p>barbershop@gmail.com</p>
            </div>
          </a>

        </div>

      </div>

    </div>
  </div>
</section>

    </div>
  </div>
</section>  

<!-- STYLE -->
<style>
.gallery-card, .service-card, .price-card {
    background:#1a1a1a;
    border-radius:12px;
    border:1px solid #2a2a2a;
    overflow:hidden;
    transition:0.3s;
}
.gallery-card img {
    width:100%;
    height:420px;
    object-fit:cover;
}
.service-card img {
    width:100%;
    height:200px;
    object-fit:cover;
}
.gallery-card,
.service-card,
.price-card {
    transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
    cursor: pointer;
}

.gallery-card:hover,
.service-card:hover,
.price-card:hover {
    transform: translateY(-12px) scale(1.03);
    box-shadow: 0 25px 50px rgba(0,0,0,0.6);
    border-color: #d4a017;
}   
.gallery-card:hover,
.service-card:hover,
.price-card:hover {
    box-shadow: 0 0 20px rgba(212,160,23,0.25),
                0 25px 50px rgba(0,0,0,0.6);
}
@media (max-width: 768px) {

    .gallery-card:hover,
    .service-card:hover,
    .price-card:hover {
        transform: translateY(-6px) scale(1.01);
    }

    .hero-content h1 {
        font-size: 36px;
    }

    .hero-content h2 {
        font-size: 20px;
    }
}
.gallery-card:active,
.service-card:active,
.price-card:active {
    transform: scale(0.98);
}
.hero-section {
    height:100vh;
    background:url("{{ asset('images/barber-bg.jpg') }}") center/cover;
    display:flex;
    justify-content:center;
    align-items:center;
    position: relative; /* WAJIB */
}
.overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        rgba(0,0,0,0.7),
        rgba(0,0,0,0.6),
        rgba(0,0,0,0.8)
    );
    z-index: 1;
}
.hero-content {
    position: relative;
    text-align: center;
    z-index: 2; /* 🔥 INI KUNCI NYA */
}
.hero-content h1 {
    font-size:56px;
    color:white;
}
.hero-content h2 {
    color:#d4a017;
}
#prices {
  padding: 4rem 0;
  background:rgba(0,0,0,0.6)
}

.container {
  width: 90%;
  margin: auto;
}

.title {
  text-align: center;
  color: #d4a017;
  margin-bottom: 2rem;
}

.price-wrapper {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}
.price-card {
  background: #1a1a1a;
  border: 1px solid #d4a017;
  border-radius: 12px;
  color: white;
  transition: 0.3s;
  padding-bottom: 1rem;
}

.price-card h4 {
  padding: 1rem;
  color: #d4a017;
}

.price-card h2 {
  padding: 1rem;
  font-size: 22px;
}

.price-card h2 span {
  font-size: 14px;
  color: #aaa;
}

.price-card ul {
  list-style: none;
  padding: 0;
}

.price-card ul li {
  padding: 0.8rem;
  border-top: 1px solid #333;
}

.price-card:hover {
  transform: translateY(-10px) scale(1.05);
  box-shadow: 0 20px 40px rgba(0,0,0,0.5);
}
.contact-box {
  background: rgba(26, 26, 26, 0.85);
  border: 1px solid rgba(212, 160, 23, 0.4);
  border-radius: 18px;
  padding: 24px;
  display: flex;
  flex-direction: column;
  gap: 15px;
  backdrop-filter: blur(8px);
  transition: 0.3s;
  height: 100%;
}

.contact-box:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 45px rgba(0,0,0,0.4);
  border-color: #d4a017;
}

.contact-row {
  display: flex;
  align-items: center;
  gap: 15px;
  text-decoration: none;
  padding: 12px;
  border-radius: 12px;
  transition: 0.25s;
  color: white;
}

.contact-row img {
  width: 28px;
  height: 28px;
}

.contact-row h5 {
  margin: 0;
  font-size: 18px;
  font-weight: 700;
  color: #d4a017;
}

.contact-row p {
  margin: 0;
  font-size: 14px;
  color: #ddd;
}

.contact-row:hover {
  background: rgba(212,160,23,0.08);
  transform: translateX(6px);
}
.open-maps-btn {
  display: inline-block;
  margin-top: 12px;
  padding: 10px 14px;
  background: rgba(212,160,23,0.15);
  color: #d4a017;
  border: 1px solid #d4a017;
  border-radius: 10px;
  text-decoration: none;
  font-weight: 600;
  transition: 0.3s;
}

.open-maps-btn:hover {
  background: #d4a017;
  color: black;
  transform: translateY(-2px);
}
</style>

@endsection