@extends('layouts.dashboard')

@section('content')

<div class="container py-5">

    <!-- HEADER -->
    <div class="mb-4">
        <h2 class="text-warning">Profil Saya</h2>
        <p class="text-secondary">Informasi akun pengguna</p>
    </div>

    <div class="row g-4 align-items-stretch">

        <!-- CARD PROFIL -->
        <div class="col-md-4">
            <div class="card profile-card p-4 text-center h-100 d-flex flex-column justify-content-center">

                <!-- FORM UPLOAD (HIDDEN) -->
                <form id="photoForm">
                    <input type="file" id="photoInput" hidden accept="image/*">
                </form>

                <!-- FOTO PROFIL (CLICKABLE) -->
                <div class="avatar mx-auto mb-3"
                     onclick="document.getElementById('photoInput').click()"
                     style="cursor:pointer;">
                    <span class="text-dark fw-bold fs-2">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </span>
                </div>

                

                <p class="text-secondary small mb-3">
                    


                </p>

                <a href="{{ route('profil.edit') }}" class="btn btn-edit-profile btn-sm w-100">
    Edit Profil
</a>

            </div>
        </div>

        <!-- DETAIL -->
        <div class="col-md-8">
            <div class="card profile-card p-4 h-100">

                <h5 class="text-warning mb-3">Detail Akun</h5>

                <div class="mb-3">
                    <label class="text-secondary">Nama</label>
                    <div class="text-light">
                        {{ auth()->user()->name ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="text-secondary">Email</label>
                    <div class="text-light">
                        {{ auth()->user()->email ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="text-secondary">Username</label>
                    <div class="text-light">
                        {{ auth()->user()->username ?? '-' }}
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- STYLE -->
<style>
.profile-card {
    background: rgba(26,26,26,0.9);
    border: 1px solid rgba(212,160,23,0.2);
    border-radius: 16px;
    color: white;
    min-height: 320px;
}

.avatar {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    background: #d4a017;
    display: flex;
    align-items: center;
    justify-content: center;
}
.btn-edit-profile {
    background: #0f0f0f;
    color: #d4a017;
    border: 1px solid #d4a017;
    transition: 0.3s ease;
    font-weight: 500;
}

.btn-edit-profile:hover {
    background: #d4a017;
    color: #0f0f0f;
    border-color: #d4a017;
    transform: translateY(-2px);
}

.btn-edit-profile:active {
    transform: scale(0.98);
}
</style>

<!-- SCRIPT (UPLOAD CLICK) -->
<script>
document.getElementById('photoInput').addEventListener('change', function () {
    alert('File dipilih: ' + this.files[0].name);
});
</script>

@endsection