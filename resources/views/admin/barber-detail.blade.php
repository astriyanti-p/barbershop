@extends('layouts.admin')
@section('title','Detail Barbershop')

@section('content')

<style>
.card-dark {
    background: #121212;
    border: 1px solid #1f1f1f;
    border-radius: 12px;
}

.yellow { color:#ffc107; }
.small-text { font-size:12px; color:#888; }
.page-title { color:#fff; font-weight:700; }

/* ================= REVIEW ================= */
.review-item {
    padding: 12px;
    border: 1px solid #2a2a2a;
    border-radius: 10px;
    background: #0f0f0f;
}

.review-item p {
    margin: 5px 0 0;
    color: #ccc;
}

/* ================= INPUT & TEXTAREA UNIFORM ================= */
.form-control {
    background: #111 !important;
    border: 1px solid #333 !important;
    color: #fff !important;
    border-radius: 6px;
    height: 38px;
}

textarea.form-control {
    height: auto;
    min-height: 38px;
    resize: none;
    overflow: hidden;
    line-height: 1.5;
    padding: 0.375rem 0.75rem;
}

/* disabled biar tetap terlihat normal */
.form-control[disabled],
textarea[disabled] {
    opacity: 1 !important;
    -webkit-text-fill-color: #ddd;
}

/* ================= PRODUCT ================= */
.product-card img {
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
}
</style>

<div class="topbar">
    <div>
        <div class="small-text yellow">DETAIL DATA</div>
        <h1 class="page-title">DETAIL BARBERSHOP</h1>
    </div>
</div>

<div class="row mt-3 g-4">

    <!-- FOTO -->
    <div class="col-md-4">
        <div class="card-dark p-3">
            <img src="https://images.unsplash.com/photo-1622287162716-74d9f54c16f6"
                 class="img-fluid rounded mb-3">
            <button class="btn btn-warning w-100">Ganti Foto</button>
        </div>
    </div>

    <!-- DETAIL -->
    <div class="col-md-8">
        <div class="card-dark p-4">

            <div class="row g-3">

                <div class="col-md-6">
                    <label>Nama Barbershop</label>
                    <input class="form-control" value="Obsidian Barbershop" disabled>
                </div>

                <div class="col-md-6">
                    <label>Nama Pemilik</label>
                    <input class="form-control" value="Hadi Syahputra" disabled>
                </div>

                <div class="col-md-6">
                    <label>Email</label>
                    <input class="form-control" value="obsidian@mail.com" disabled>
                </div>

                <div class="col-md-6">
                    <label>No HP</label>
                    <input class="form-control" value="08123456789" disabled>
                </div>

                <div class="col-md-6">
                    <label>Kota</label>
                    <input class="form-control" value="Surabaya" disabled>
                </div>

                <div class="col-md-12">
                    <label>Alamat Lengkap</label>
                    <input class="form-control" value="Jl. Mawar No 12, Surabaya" disabled>
                </div>

                <div class="col-md-6">
                    <label>Jam Operasional</label>
                    <input class="form-control" value="09:00 - 21:00" disabled>
                </div>

                <!-- 🔥 DESKRIPSI FIX -->
                <div class="col-md-6">
                    <label>Deskripsi</label>
                    <textarea class="form-control auto-resize" disabled>
Barbershop premium dengan barber profesional dan pelayanan terbaik
                    </textarea>
                </div>

                <div class="col-md-6">
                    <label>Longitude</label>
                    <input class="form-control" value="112.7508" disabled>
                </div>

                <div class="col-md-6">
                    <label>Latitude</label>
                    <input class="form-control" value="-7.2575" disabled>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- SERVICE -->
<div class="card-dark p-4 mt-4">

    <h4 class="yellow">Service Tersedia</h4>

    <table class="table table-dark table-borderless align-middle mt-3">
        <thead class="text-secondary">
            <tr>
                <th>Nama Service</th>
                <th>Durasi</th>
                <th>Harga</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Haircut Premium</td>
                <td>45 menit</td>
                <td class="yellow">Rp 120.000</td>
            </tr>

            <tr>
                <td>Beard Styling</td>
                <td>30 menit</td>
                <td class="yellow">Rp 80.000</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- 🛍 PRODUCT -->
<div class="card-dark p-4 mt-4">

    <h4 class="yellow mb-3">Product Tersedia</h4>

    <div class="row g-3">

        <!-- PRODUCT 1 -->
        <div class="col-md-4 product-card">
            <div class="card-dark p-3">

                <img src="https://images.unsplash.com/photo-1599351431202-1e0f0137899a"
                     class="img-fluid mb-2">

                <input class="form-control mb-2" value="Pomade Strong Hold" disabled>

                <textarea class="form-control auto-resize mb-2" disabled>
Tahan lama untuk styling rambut rapi dan natural
                </textarea>

                <div class="yellow fw-bold">Rp 75.000</div>
            </div>
        </div>

        <!-- PRODUCT 2 -->
        <div class="col-md-4 product-card">
            <div class="card-dark p-3">

                <img src="https://images.unsplash.com/photo-1621607512022-6aecc4fed814"
                     class="img-fluid mb-2">

                <input class="form-control mb-2" value="Hair Powder Volume" disabled>

                <textarea class="form-control auto-resize mb-2" disabled>
Menambah volume rambut tanpa membuat lengket
                </textarea>

                <div class="yellow fw-bold">Rp 60.000</div>
            </div>
        </div>

        <!-- PRODUCT 3 -->
        <div class="col-md-4 product-card">
            <div class="card-dark p-3">

                <img src="https://images.unsplash.com/photo-1615397349754-cfa2066a298e"
                     class="img-fluid mb-2">

                <input class="form-control mb-2" value="Beard Oil Premium" disabled>

                <textarea class="form-control auto-resize mb-2" disabled>
Merawat jenggot agar lembut, sehat, dan tidak kering
                </textarea>

                <div class="yellow fw-bold">Rp 90.000</div>
            </div>
        </div>

    </div>
</div>

<!-- ⭐ ULASAN -->
<div class="card-dark p-4 mt-4">

    <h4 class="yellow mb-3">Ulasan Pengguna</h4>

    <div id="reviewList">

        <div class="review-item mb-3" data-rating="5">
            <strong>Andi</strong>
            <div class="text-warning">⭐⭐⭐⭐⭐</div>
            <p>Pelayanan sangat bagus dan cepat 🔥</p>

            <button class="btn btn-sm btn-outline-danger hideReview">Hide</button>
            <button class="btn btn-sm btn-secondary deleteReview">Hapus</button>
        </div>

    </div>
</div>

<script>

// ================= AUTO RESIZE =================
function autoResize(el){
    el.style.height = "auto";
    el.style.height = el.scrollHeight + "px";
}

document.querySelectorAll("textarea.auto-resize").forEach(el => {
    autoResize(el);
});

// ================= REVIEW ACTION =================
document.addEventListener("click", function(e) {

    if (e.target.classList.contains("hideReview")) {

        let item = e.target.closest(".review-item");

        if (item.style.opacity === "0.3") {
            item.style.opacity = "1";
            e.target.innerText = "Hide";
        } else {
            item.style.opacity = "0.3";
            e.target.innerText = "Unhide";
        }
    }

    if (e.target.classList.contains("deleteReview")) {
        e.target.closest(".review-item").remove();
    }

});

</script>

@endsection