@extends('layouts.admin')
@section('title','Reports')

@section('content')

<div class="topbar">
    <div>
        <div class="small-text">FINANCIAL TELEMETRY // 08-2024</div>
        <h1 class="page-title">Laporan Transaksi Jasa</h1>
    </div>

    <div class="d-flex gap-3">
        <div class="card-dark text-center">
            <div class="small-text">TOTAL INCOME</div>
            <h4 class="yellow">Rp 12.450.000</h4>
        </div>

        <div class="card-dark text-center">
            <div class="small-text">TOTAL SERVICES</div>
            <h4>142</h4>
        </div>
    </div>
</div>

<!-- FILTER BAR -->
<div class="card-dark mb-4 d-flex justify-content-between align-items-center">
    <div>
        <small class="small-text">PERIODE WAKTU</small><br>
        01 AGU 2024 → 31 AGU 2024
    </div>

    <div>
        <small class="small-text">STATUS SERVER</small><br>
        <span class="yellow">■ DATA SYNC COMPLETE</span>
    </div>

    <div class="d-flex gap-2">
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#filterModal">
            Filter
        </button>
        <button class="btn btn-warning">Export CSV</button>
    </div>
</div>

<!-- TABLE -->
<div class="card-dark mb-4">
    <table class="table table-dark table-borderless">
        <thead class="text-secondary">
            <tr>
                <th>Timestamp</th>
                <th>ID</th>
                <th>Service</th>
                <th>Barber</th>
                <th>Client</th>
                <th>Revenue</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody id="reportTable">
            <tr>
                <td>2024-08-15 14:22</td>
                <td>TRX_9921_X</td>
                <td class="serviceName">Executive Fade</td>
                <td>Hadi Syahputra</td>
                <td>Reza Rahadian</td>
                <td class="yellow">Rp 120.000</td>
                <td class="text-warning">PAID</td>
            </tr>

            <tr>
                <td>2024-08-15 13:45</td>
                <td>TRX_9920_A</td>
                <td class="serviceName">Beard Sculpting</td>
                <td>Deni Kurnia</td>
                <td>Anonymous</td>
                <td class="yellow">Rp 85.000</td>
                <td class="text-warning">PAID</td>
            </tr>

            <tr>
                <td>2024-08-15 12:10</td>
                <td>TRX_9919_B</td>
                <td class="serviceName">The Obsidian Cut</td>
                <td>Hadi Syahputra</td>
                <td>Gading Marten</td>
                <td class="yellow">Rp 250.000</td>
                <td class="text-warning">PAID</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- CHART SECTION -->
<div class="row g-4">
    <div class="col-md-4">
        <div class="card-dark">
            <div class="small-text mb-3">SERVICE VOLUME BREAKDOWN</div>
            Executive Fade 45%
            <div class="progress mb-3"><div class="progress-bar bg-warning" style="width:45%"></div></div>

            Beard Sculpting 28%
            <div class="progress mb-3"><div class="progress-bar bg-warning" style="width:28%"></div></div>

            The Obsidian Cut 12%
            <div class="progress"><div class="progress-bar bg-warning" style="width:12%"></div></div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card-dark" style="height:220px">
            <div class="small-text">REVENUE HOURLY TELEMETRY</div>
        </div>
    </div>
</div>

<!-- MODAL FILTER -->
<div class="modal fade" id="filterModal">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">

      <div class="modal-header border-secondary">
        <h5 class="modal-title">Filter Laporan</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <label class="mb-2">Pilih Service</label>
        <select id="serviceFilter" class="form-control">
            <option value="all">Semua Service</option>
            <option value="Executive Fade">Executive Fade</option>
            <option value="Beard Sculpting">Beard Sculpting</option>
            <option value="The Obsidian Cut">The Obsidian Cut</option>
        </select>
      </div>

      <div class="modal-footer border-secondary">
        <button class="btn btn-outline-light" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-warning" onclick="applyFilter()">Terapkan Filter</button>
      </div>

    </div>
  </div>
</div>

<script>
function applyFilter() {
    let selectedService = document.getElementById("serviceFilter").value;
    let rows = document.querySelectorAll("#reportTable tr");

    rows.forEach(row => {
        let service = row.querySelector(".serviceName").innerText;

        if(selectedService === "all" || service === selectedService){
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });

    let modal = bootstrap.Modal.getInstance(document.getElementById('filterModal'));
    modal.hide();
}
</script>

@endsection
