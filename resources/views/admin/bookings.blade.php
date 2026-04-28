@extends('layouts.admin')
@section('title','Bookings')

@section('content')

{{-- HEADER PAGE (judul kiri + tombol kanan) --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <div class="section-label">OPERATIONS MODULE</div>
        <div class="page-title">Manajemen Booking Offline</div>
        <p class="small-text">
            Kelola antrean pelanggan walk-in dan reservasi offline melalui pusat kendali digital.
        </p>
    </div>

    <button class="btn btn-warning"
            data-bs-toggle="modal"
            data-bs-target="#bookingModal">
        + NEW BOOKING
    </button>
</div>

<div class="row">
    {{-- LEFT CONTENT --}}
    <div class="col-md-9">

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card-dark">
                    <div class="small-text">TOTAL HARI INI</div>
                    <h2>42</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-dark">
                    <div class="small-text">DALAM ANTREAN</div>
                    <h2 class="yellow">08</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-dark">
                    <div class="small-text">SELESAI</div>
                    <h2>31</h2>
                </div>
            </div>
        </div>

        <div class="card-dark mb-3">
            <input id="searchCustomer" class="search-box" placeholder="Cari pelanggan...">
        </div>

        <div class="card-dark">
            <table class="table-dark-custom">
                <thead>
                    <tr>
                        <th>CUSTOMER NAME</th>
                        <th>SERVICE</th>
                        <th>TIME</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody id="bookingTable">>
                    <tr>
                        <td class="customerName">ADRIAN WIJAYA</td>
                        <td>Luxury Cut & Shave</td>
                        <td>14:30 WIB</td>
                        <td class="badge-status status-progress">IN PROGRESS</td>
                    </tr>
                    <tr>
                        <td class="customerName">BAMBANG SURYO</td>
                        <td>Beard Trimming</td>
                        <td>15:15 WIB</td>
                        <td class="badge-status status-waiting">WAITING</td>
                    </tr>
                    <tr>
                        <td class="customerName">DENNY CAKMAN</td>
                        <td>Hair Coloring</td>
                        <td>16:00 WIB</td>
                        <td class="badge-status status-confirm">CONFIRMED</td>
                    </tr>
                    <tr>
                        <td class="customerName">RAFFI AHMAD</td>
                        <td>Signature Cut</td>
                        <td>16:45 WIB</td>
                        <td class="badge-status status-waiting">WAITING</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-dark mt-4">
            <div class="yellow">[ SYSTEM LOG ]</div>
            <div class="small-text mt-2">
                > FETCHING LATEST OFFLINE DATABASE... <br>
                > SYNCING WITH CLOUD SERVERS ( SUCCESS ) <br>
                > LISTENING FOR NEW LOCAL INPUT ON PORT 4080
            </div>
        </div>

    </div>

    {{-- RIGHT PANEL --}}
    <div class="col-md-3">

        <div class="right-panel mb-4">
            <div class="section-label">URGENT ACTIONS</div>
            <p class="small-text">Booking OFF-0938 was cancelled</p>
            <button class="btn btn-sm btn-outline-warning">CONFIRM</button>
        </div>

        <div class="right-panel">
            <div class="section-label">SERVICE QUEUE</div>

            <div class="small-text">Haircut Section 85%</div>
            <div class="progress mb-3">
                <div class="progress-bar bg-warning" style="width:85%"></div>
            </div>

            <div class="small-text">Wash & Style 40%</div>
            <div class="progress">
                <div class="progress-bar bg-warning" style="width:40%"></div>
            </div>
        </div>

    </div>
</div>


{{-- MODAL NEW BOOKING --}}
<div class="modal fade" id="bookingModal">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">

      <div class="modal-header border-secondary">
        <h5 class="modal-title">Tambah Booking Baru</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form>
            <div class="mb-3">
                <label class="mb-1">Nama Customer</label>
                <input type="text" class="form-control" placeholder="Masukkan nama">
            </div>

            <div class="mb-3">
                <label class="mb-1">Pilih Service</label>
                <select class="form-control">
                    <option>Luxury Cut & Shave</option>
                    <option>Signature Cut</option>
                    <option>Hair Coloring</option>
                    <option>Beard Trimming</option>
                    <option>Hair Wash & Style</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="mb-1">Pilih Jam</label>
                <input type="time" class="form-control">
            </div>
        </form>
      </div>

      <div class="modal-footer border-secondary">
        <button class="btn btn-outline-light" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-warning">Simpan Booking</button>
      </div>

    </div>
  </div>
</div>

    <script>
document.getElementById("searchCustomer").addEventListener("keyup", function() {
    let keyword = this.value.toLowerCase();
    let rows = document.querySelectorAll("#bookingTable tr");

    rows.forEach(row => {
        let customer = row.querySelector(".customerName").innerText.toLowerCase();

        if(customer.includes(keyword)){
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});
</script>

@endsection
