@extends('layouts.admin')

@section('title', 'Finance')

@section('content')

<style>
body {
    background: #0b0b0b;
    color: #fff;
}

.card-dark {
    background: linear-gradient(145deg, #1a1a1a, #111);
    border: 1px solid #1f1f1f;
    border-radius: 14px;
    padding: 16px;
}
</style>

<div class="container-fluid">

    {{-- SUMMARY STATIC --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card-dark">💰 Total Saldo Sistem <br><b>Rp 1.000.000</b></div>
        </div>
        <div class="col-md-3">
            <div class="card-dark">📥 Total Income <br><b>Rp 500.000</b></div>
        </div>
        <div class="col-md-3">
            <div class="card-dark">💸 Withdraw Pending <br><b>Rp 200.000</b></div>
        </div>
        <div class="col-md-3">
            <div class="card-dark">✅ Withdraw Selesai <br><b>Rp 300.000</b></div>
        </div>
    </div>

    {{-- TABLE STATIC --}}
    <div class="card-dark">
        <h5 class="mb-3">List Barbershop</h5>

        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle">
                <thead>
                    <tr>
                        <th>Barbershop</th>
                        <th>Saldo</th>
                        <th>Income</th>
                        <th>Withdraw</th>
                        <th>Pending</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Barbershop A</td>
                        <td>Rp 1.000.000</td>
                        <td>Rp 500.000</td>
                        <td>Rp 200.000</td>
                        <td>Rp 100.000</td>
                        <td>
                            <button class="btn btn-sm btn-info"
                                data-bs-toggle="modal"
                                data-bs-target="#detailModal"
                                onclick="openDetail(1)">
                                🔍 Detail
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>Barbershop B</td>
                        <td>Rp 2.000.000</td>
                        <td>Rp 800.000</td>
                        <td>Rp 300.000</td>
                        <td>Rp 150.000</td>
                        <td>
                            <button class="btn btn-sm btn-info"
                                data-bs-toggle="modal"
                                data-bs-target="#detailModal"
                                onclick="openDetail(2)">
                                🔍 Detail
                            </button>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>

</div>

{{-- MODAL --}}
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-dark text-white">

            <div class="modal-header">
                <h5>Detail Finance</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div id="detailContent">Loading...</div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openDetail(id) {

    const data = {
        1: {
            saldo: 1000000,
            income: 500000,
            withdraw: 200000,
            pending: 100000,
            withdraws: [
                {amount: 100000, bank: "BCA", account: "12345", status: "pending"},
                {amount: 200000, bank: "BRI", account: "67890", status: "done"}
            ]
        },
        2: {
            saldo: 2000000,
            income: 800000,
            withdraw: 300000,
            pending: 150000,
            withdraws: [
                {amount: 150000, bank: "BNI", account: "11111", status: "pending"}
            ]
        }
    };

    const d = data[id];

    let html = `
        <div class="row mb-3">
            <div class="col-md-3">💳 Saldo: <b>Rp ${d.saldo}</b></div>
            <div class="col-md-3">📥 Income: <b>Rp ${d.income}</b></div>
            <div class="col-md-3">💸 Withdraw: <b>Rp ${d.withdraw}</b></div>
            <div class="col-md-3">⏳ Pending: <b>Rp ${d.pending}</b></div>
        </div>

        <hr>

        <h6>Withdraw Request</h6>
        <table class="table table-dark">
            <tr>
                <th>Nominal</th>
                <th>Bank</th>
                <th>Rekening</th>
                <th>Status</th>
            </tr>
    `;

    d.withdraws.forEach(w => {
        html += `
            <tr>
                <td>Rp ${w.amount}</td>
                <td>${w.bank}</td>
                <td>${w.account}</td>
                <td>${w.status}</td>
            </tr>
        `;
    });

    html += `</table>`;

    document.getElementById('detailContent').innerHTML = html;
}
</script>
@endpush