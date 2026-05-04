@extends('layouts.dashboard')

@section('content')

<div class="container py-5">

    <h2 class="text-warning mb-4">Edit Profil</h2>

    <div class="card p-4 profile-card">

        <!-- FORM -->
        <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- FOTO PROFIL -->
            <div class="text-center mb-4">

                <!-- INPUT FILE -->
                <input type="file" name="photo" id="photoInput" hidden accept="image/*">

                <!-- AVATAR CLICK -->
                <div class="avatar mx-auto"
                     onclick="document.getElementById('photoInput').click()"
                     style="cursor:pointer; overflow:hidden;">

                    <img id="previewImg"
                         src="https://ui-avatars.com/api/?name={{ auth()->user()?->name ?? 'User' }}"
                         style="width:100%; height:100%; object-fit:cover;">
                </div>

                <small class="text-secondary d-block mt-2">
                    Klik foto untuk ubah
                </small>

            </div>

            <!-- NAMA -->
            <div class="mb-3">
                <label class="text-secondary">Nama</label>
                <input type="text"
                       name="name"
                       class="form-control bg-dark text-light border-secondary"
                       value="{{ auth()->user()->name ?? '' }}">
            </div>

            <!-- EMAIL -->
            <div class="mb-3">
                <label class="text-secondary">Email</label>
                <input type="email"
                       name="email"
                       class="form-control bg-dark text-light border-secondary"
                       value="{{ auth()->user()->email ?? '' }}">
            </div>

            <!-- USERNAME -->
            <div class="mb-3">
                <label class="text-secondary">Username</label>
                <input type="text"
                       name="username"
                       class="form-control bg-dark text-light border-secondary"
                       value="{{ auth()->user()->username ?? '' }}">
            </div>

            <!-- BUTTON -->
            <div class="d-flex gap-2">

                <button type="submit" class="btn btn-warning">
                    Simpan Perubahan
                </button>

                <a href="{{ route('profil') }}" class="btn btn-outline-light">
                    Kembali
                </a>

            </div>

        </form>

    </div>
</div>

<!-- STYLE -->
<style>
.profile-card {
    background: rgba(26,26,26,0.9);
    border: 1px solid rgba(212,160,23,0.2);
    border-radius: 16px;
    color: white;
}

.avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 2px solid #d4a017;
    background: #1a1a1a;
}
</style>

<!-- SCRIPT FIX (AMAN) -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const input = document.getElementById('photoInput');
    const preview = document.getElementById('previewImg');

    input.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(file);
        }
    });

});
</script>

@endsection