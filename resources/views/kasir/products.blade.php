@extends('layouts.kasir')
@section('title','Kasir Produk')

@section('content')

<h1 class="mb-4">Penjualan Produk Offline</h1>

<div class="row g-4">

    <!-- PRODUK -->
    <div class="col-md-8">
        <div class="card-dark mb-3">
            <h5 class="mb-0">Pilih Produk</h5>
        </div>

        <div class="row g-3" id="productList"></div>
    </div>

    <!-- CART -->
    <div class="col-md-4">
        <div class="card-dark">
            <h5 class="mb-3">Keranjang Belanja</h5>

            <div id="cartItems"></div>

            <hr class="border-secondary">

            <div class="d-flex justify-content-between">
                <h5>Total</h5>
                <h4 class="text-warning">Rp <span id="total">0</span></h4>
            </div>

            <button class="btn btn-warning w-100 mt-3 py-2 fw-bold" onclick="bukaPembayaran()">
                Bayar Sekarang
            </button>
        </div>
    </div>

</div>


<script>
let products=[
 {name:"Pomade",price:75000,icon:"🧴"},
 {name:"Hair Powder",price:65000,icon:"💨"},
 {name:"Hair Tonic",price:55000,icon:"🧪"},
 {name:"Shampoo",price:45000,icon:"🫧"}
]

let cart=[]

function renderProducts(){
    let html=""
    products.forEach(p=>{
        html+=`
        <div class="col-md-4">
            <div class="card-dark text-center h-100">
                <div style="font-size:40px">${p.icon}</div>
                <h5 class="mt-2">${p.name}</h5>
                <p class="text-warning fw-bold">Rp ${p.price}</p>
                <button class="btn btn-warning btn-sm px-3"
                    onclick='addCart(${JSON.stringify(p)})'>
                    + Tambah
                </button>
            </div>
        </div>`
    })
    productList.innerHTML=html
}
renderProducts()

function addCart(p){
    cart.push(p)
    renderCart()
}

function renderCart(){
    let totalHarga=0
    let html=""

    cart.forEach((c,i)=>{
        totalHarga+=c.price
        html+=`
        <div class="d-flex justify-content-between mb-2">
            <span>${c.name}</span>
            <span class="text-warning">Rp ${c.price}</span>
        </div>`
    })

    if(cart.length==0){
        html="<small class='text-secondary'>Belum ada produk</small>"
    }

    cartItems.innerHTML=html
    total.innerText=totalHarga
}

function checkout(){
    alert("Transaksi berhasil!")
    cart=[]
    renderCart()
}

function bukaPembayaran(){
    if(cart.length==0){
        alert("Keranjang masih kosong!")
        return
    }

    document.getElementById("totalBayar").innerText = total.innerText

    let modal = new bootstrap.Modal(document.getElementById('paymentModal'))
    modal.show()
}

function hitungKembalian(){
    let uang = document.getElementById("uangCustomer").value
    let totalHarga = parseInt(total.innerText)

    let kembali = uang - totalHarga

    if(kembali < 0){
        document.getElementById("kembalian").value = "Uang kurang!"
    }else{
        document.getElementById("kembalian").value = "Rp " + kembali
    }
}

function selesaiTransaksi(){
    alert("Transaksi selesai 🎉")

    cart=[]
    renderCart()

    document.getElementById("uangCustomer").value=""
    document.getElementById("kembalian").value=""

    let modal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'))
    modal.hide()
}
</script>

<!-- MODAL PEMBAYARAN -->
<div class="modal fade" id="paymentModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white border-0">

      <div class="modal-header border-secondary">
        <h5 class="modal-title">Pembayaran</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="card-dark mb-3 text-center">
            <small>Total Belanja</small>
            <h2 class="text-warning">Rp <span id="totalBayar">0</span></h2>
        </div>

        <label>Uang Customer</label>
        <input id="uangCustomer" type="number" class="form-control mb-3"
               placeholder="Masukkan uang customer" onkeyup="hitungKembalian()">

        <label>Kembalian</label>
        <input id="kembalian" type="text" class="form-control"
               readonly>

      </div>

      <div class="modal-footer border-secondary">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-warning px-4 fw-bold" onclick="selesaiTransaksi()">
          Selesai Transaksi
        </button>
      </div>

    </div>
  </div>
</div>


@endsection
