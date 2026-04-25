@extends('layouts.dashboard')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

<div class="container py-5">

    <h2 class="text-warning mb-4">Detail Booking</h2>

    <!-- ================= UI DETAIL ================= -->
    <div class="detail-ui">

        <div class="card detail-card p-4 text-white">

            <h3 class="title mb-3">Status Booking Aktif</h3>

            @if(request('item') == 1)

            <span class="badge-paid">PAID</span>

            <p><b>Layanan:</b> Haircut Fade</p>
            <p><b>Barber:</b> Rudi</p>
            <p><b>Jadwal:</b> 23 April 2026 - 14:30</p>

            <hr class="line">

            <div class="row-status">
                <span>Status</span>
                <span class="badge-lunas">LUNAS</span>
            </div>

            <div class="row-status">
                <span>Total</span>
                <b class="price">Rp 35.000</b>
            </div>

            @endif

        </div>

    </div>

    <!-- ================= STRUK ================= -->
    <div class="receipt-print" id="receipt">

        <h4 class="text-center">MAN CAVE BARBERSHOP</h4>
        <p class="text-center small">Jl. Keren No.123</p>

        <hr class="dash">

        <p>Kode : MCB-2026-00921</p>
        <p>Nama : Andree</p>
        <p>Barber : Rudi</p>

        <hr class="dash">

        <p>Haircut Fade</p>
        <p>23 April 2026 - 14:30</p>

        <hr class="dash">

        <div class="row-status">
            <span>Total</span>
            <b>Rp 35.000</b>
        </div>

        <p class="text-center mt-2">Terima kasih 🙏</p>
    </div>

    <!-- BUTTON -->
   <div class="mt-3 position-relative d-inline-block">

    <button onclick="toggleMenu()" class="btn btn-warning">
        Unduh Detail Booking
    </button>

    <!-- MENU -->
    <div id="actionMenu" class="action-menu shadow">
        <button onclick="downloadStruk()">Simpan gambar</button>
        <button onclick="shareWhatsApp()">Kirim ke lainnya</button>
    </div>

</div>

</div>
<style>
    .detail-card{
    background: #151515;
    border: 1px solid #d4a017;
    border-radius: 18px;
    box-shadow: 0 0 20px rgba(212,160,23,0.15);
}

.title{
    color:#d4a017;
    font-weight:bold;
}

.badge-paid{
    display:inline-block;
    background:#18c37e;
    color:white;
    padding:6px 14px;
    border-radius:8px;
    font-weight:bold;
    margin-bottom:15px;
}

.badge-lunas{
    background:#18c37e;
    color:#fff;
    padding:4px 10px;
    border-radius:6px;
}

.row-status{
    display:flex;
    justify-content:space-between;
    margin-top:6px;
}

.price{
    color:#d4a017;
}

.line{
    border-color:#d4a017;
}

/* STRUK */
.receipt-print{
    position: absolute;
    left: -9999px; /* lebih aman dari display:none */
    width: 320px;
    background: #fff;
    color: #000;
    padding: 18px;
    font-family: monospace;
    font-size: 12px;
    border-radius: 10px;
}

.dash{
    border-top:1px dashed #000;
}
.action-menu{
    display:none;
    position:absolute;
    top:45px;
    left:0;
    background:#fff;
    border-radius:10px;
    overflow:hidden;
    min-width:180px;
    z-index:999;
}

.action-menu button{
    width:100%;
    padding:10px;
    border:none;
    background:#fff;
    text-align:left;
    cursor:pointer;
    font-size:14px;
}

.action-menu button:hover{
    background:#f2f2f2;
}   
</style>

<script>
async function downloadStruk() {
    const el = document.getElementById("receipt");

    const canvas = await html2canvas(el, {
        scale: 3,
        useCORS: true,
        backgroundColor: "#ffffff"
    });

    const image = canvas.toDataURL("image/png");

    // DOWNLOAD
    const link = document.createElement("a");
    link.download = "struk-booking.png";
    link.href = image;
    link.click();
}

async function shareWhatsApp() {
    const el = document.getElementById("receipt");

    const canvas = await html2canvas(el, {
        scale: 3,
        useCORS: true,
        backgroundColor: "#ffffff"
    });

    const image = canvas.toDataURL("image/png");

    // ubah base64 ke blob
    const res = await fetch(image);
    const blob = await res.blob();
    const file = new File([blob], "struk.png", { type: "image/png" });

    // cek support share
    if (navigator.canShare && navigator.canShare({ files: [file] })) {
        await navigator.share({
            title: "Struk Booking",
            text: "Struk booking barbershop",
            files: [file]
        });
    } else {
        alert("Device kamu belum support share file. Silakan download dulu.");
    }
}
function toggleMenu(){
    const menu = document.getElementById("actionMenu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

// klik luar untuk tutup menu
document.addEventListener("click", function(e){
    const menu = document.getElementById("actionMenu");
    const btn = e.target.closest("button");

    if(!e.target.closest(".position-relative")){
        menu.style.display = "none";
    }
});
</script>
@endsection