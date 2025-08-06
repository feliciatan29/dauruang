@extends('nasabah.layout')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<style>
    .profile-container {
        padding: 30px 20px;
    }

    .profile-heading {
        font-weight: 600;
        font-size: 20px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        color: #333;
    }

    .profile-heading i {
        margin-right: 10px;
    }

    .nav-tabs-profile {
        border-bottom: 1px solid #ddd;
        margin-bottom: 25px;
        overflow-x: auto;
        white-space: nowrap;
    }

    .nav-tabs-profile .nav-link {
        color: #333;
        font-weight: 500;
        padding: 10px 16px;
    }

    .nav-tabs-profile .nav-link.active {
        color: #00b14f;
        border-bottom: 2px solid #00b14f;
    }

    .profile-photo-box {
        background: #fff;
        border: 1.5px solid #ddd;
        border-radius: 12px;
        padding: 20px 15px;
        text-align: center;
        margin-bottom: 30px;
    }

    .profile-photo-box img {
        width: 100%;
        max-width: 180px;
        border-radius: 10px;
        aspect-ratio: 1/1;
        object-fit: cover;
        margin-bottom: 12px;
        border: 1px solid #ccc;
    }

    .btn-upload {
        font-size: 14px;
        padding: 6px 15px;
        border-radius: 8px;
        border: 1px solid #ccc;
        background: #fff;
        cursor: pointer;
    }

    .photo-note {
        font-size: 11px;
        color: #777;
        margin-top: 8px;
    }

    .section-title {
        font-weight: 600;
        font-size: 17px;
        margin-bottom: 14px;
        color: #333;
    }

    .info-line {
        font-size: 15px;
        margin-bottom: 12px;
    }

    .info-line strong {
        color: #222;
        font-weight: 600;
        min-width: 120px;
        display: inline-block;
    }

    .info-line span {
        color: #00b14f;
        margin-left: 6px;
        cursor: pointer;
        font-weight: 500;
    }

    .badge-verif {
        background-color: #d4f4e2;
        color: #00b14f;
        padding: 2px 8px;
        font-size: 12px;
        border-radius: 4px;
        margin-left: 6px;
    }

    .button-group .btn {
        border-radius: 20px;
        margin-top: 10px;
        width: 100%;
    }

    @media (max-width: 768px) {
        .info-line {
            font-size: 14px;
        }

        .section-title {
            font-size: 16px;
        }

        .profile-photo-box {
            margin-bottom: 20px;
        }
    }
</style>

<div class="container profile-container">
    <!-- Heading -->
    <div class="profile-heading">
        <i class="bi bi-person"></i> {{ Auth::user()->name ?? 'Nama Pengguna' }}
    </div>

    <!-- Nav Tabs -->
    <ul class="nav nav-tabs nav-tabs-profile">
        <li class="nav-item"><a class="nav-link active" href="#">Biodata Diri</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Daftar Alamat</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Panduan</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Syarat dan Ketentuan</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Hubungi Kami</a></li>
    </ul>

    <!-- Profile Section -->
    <div class="row">
        <!-- Foto Profil -->
        <div class="col-lg-4 col-md-5 col-12">
            <div class="profile-photo-box mx-auto">
                <img src="{{ asset($profile->foto ?? 'nasabah/img/user-icon.png') }}" alt="Foto Profil">
                <button class="btn-upload">Pilih Foto</button>
                <div class="photo-note">
                    Besar file: maksimum 10MB<br>Ekstensi: JPG, JPEG, PNG
                </div>
            </div>
        </div>


        <!-- Biodata dan Kontak -->
<div class="col-lg-8 col-md-7 col-12">
    <a href="{{ route('profiles.edit') }}" class="section-title d-inline-block text-decoration-none" style="color: #00b14f;">
    <i class="bi bi-pencil-square me-2"></i> 
</a>



            <div class="info-line">
    <strong>Nama</strong> {{ $user->name ?? '-' }} <span></span>
</div>

<div class="info-line">
    <strong>Tanggal Lahir</strong> {{ $profile->tanggal_lahir ?? 'Tambah Tanggal Lahir' }} <span></span>
</div>

<div class="info-line">
    <strong>Jenis Kelamin</strong> {{ $profile->jenis_kelamin ?? 'Tambah Jenis Kelamin' }} <span></span>
</div>

<div class="info-line">
    <strong>Email</strong> {{ $user->email ?? '-' }}
    <span class="badge-verif">Terverifikasi</span>
    <span></span>
</div>

<div class="info-line">
    <strong>Nomor HP</strong> {{ $profile->nomor_hp ?? 'Tambah Nomor HP' }} <span></span>
</div>


            <div class="button-group">
                <button class="btn btn-outline-secondary">Buat Kata Sandi</button>
            </div>
        </div>
    </div>
</div>

@endsection
