@extends('layouts.app')

@section('content')

<section class="form-section">
    <div class="container">

        <div class="form-card mx-auto">

            <h2 class="text-center text-warning mb-3">
                Daftarkan Barbershop Anda
            </h2>

            <p class="text-center text-secondary mb-4">
                Isi data di bawah ini, tim kami akan melakukan verifikasi terlebih dahulu.
            </p>

            <form method="POST" action="#" enctype="multipart/form-data">
                @csrf

                <!-- NAMA -->
                <div class="mb-3">
                    <label class="form-label">Nama Barbershop</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>

                <!-- PEMILIK -->
                <div class="mb-3">
                    <label class="form-label">Nama Pemilik</label>
                    <input type="text" class="form-control" name="pemilik" required>
                </div>

                <!-- EMAIL -->
                <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
                </div>

                <!-- PASSWORD -->
                <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
                </div>

                <!-- KONFIRMASI PASSWORD -->
                <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" name="password_confirmation" required>
                </div>

                <!-- NO HP -->
                <div class="mb-3">
                    <label class="form-label">No HP</label>
                    <input type="text" class="form-control" name="no_hp" required>
                </div>

                <!-- DESKRIPSI -->
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="3"></textarea>
                </div>

                <!-- FOTO -->
                <div class="mb-3">
                    <label class="form-label">Foto Barbershop</label>
                    <input type="file" class="form-control" name="foto">
                </div>

                <!-- BUTTON GPS -->
                <button type="button" class="btn btn-outline-warning mb-3 w-100" onclick="getLocation()">
                    📍 Ambil Lokasi Saya
                </button>

                <!-- MESSAGE -->
                <div id="geo-msg" class="mb-3"></div>

                <!-- LAT LNG -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Latitude</label>
                        <input type="text" class="form-control" name="latitude" id="latitude" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Longitude</label>
                        <input type="text" class="form-control" name="longitude" id="longitude" required>
                    </div>
                </div>

                <!-- ALAMAT AUTO -->
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
                </div>

                <!-- SUBMIT -->
                <button type="submit" class="btn btn-warning w-100 mt-3">
                    Daftar Sekarang
                </button>

            </form>

        </div>
    </div>
</section>

<style>
body {
    background:#0d0d0d;
    color:white;
}

.form-section {
    padding:80px 0;
}

.form-card {
    max-width:600px;
    background:#1a1a1a;
    padding:30px;
    border-radius:16px;
    border:1px solid rgba(255,255,255,0.08);
}

.form-control {
    background:#111;
    border:1px solid #333;
    color:white;
}

.form-control:focus {
    border-color:#d4a017;
    box-shadow:none;
}

label { color:#ccc; }

.btn-warning {
    box-shadow:0 0 10px rgba(212,160,23,0.4);
}
</style>

<script>
function getLocation() {

    if (!navigator.geolocation) {
        showMessage("Browser tidak mendukung GPS");
        return;
    }

    showMessage("Meminta izin lokasi...");

    navigator.geolocation.getCurrentPosition(
        function(position) {

            let lat = position.coords.latitude;
            let lng = position.coords.longitude;

            document.getElementById("latitude").value = lat;
            document.getElementById("longitude").value = lng;

            showMessage("Mengambil alamat...");

            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(res => res.json())
                .then(data => {

                    if (data && data.display_name) {
                        document.getElementById("alamat").value = data.display_name;
                        showMessage("Lokasi & alamat berhasil ✔");
                    } else {
                        showMessage("Alamat tidak ditemukan");
                    }

                })
                .catch(err => {
                    console.error(err);
                    showMessage("Gagal mengambil alamat");
                });

        },
        function(error) {

            let msg = "";

            switch(error.code) {
                case error.PERMISSION_DENIED:
                    msg = "Izin lokasi ditolak";
                    break;
                case error.POSITION_UNAVAILABLE:
                    msg = "Lokasi tidak tersedia";
                    break;
                case error.TIMEOUT:
                    msg = "Timeout lokasi";
                    break;
                default:
                    msg = "Error mengambil lokasi";
            }

            showMessage(msg);
        },
        {
            enableHighAccuracy:true,
            timeout:15000,
            maximumAge:0
        }
    );
}

function showMessage(text) {
    document.getElementById("geo-msg").innerText = text;
}
</script>

@endsection