@extends('nasabah.layout')

@section('content')
<div class="container mt-4">
    <h4>Edit Biodata Diri</h4>

    <!-- Tampilkan pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tampilkan error validasi -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profiles.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nama (di tabel users) -->
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control"
                   value="{{ old('nama', $user->name) }}">
        </div>

        <!-- Nama Lengkap (di tabel profiles) -->
        <div class="form-group mt-3">
            <label for="nama_lengkap">Nama Lengkap Lengkap (Opsional)</label>
            <input type="text" name="nama_lengkap" class="form-control"
                   value="{{ old('nama_lengkap', $profile->nama_lengkap ?? '') }}">
        </div>

        <!-- Tanggal Lahir -->
        <div class="form-group mt-3">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control"
                   value="{{ old('tanggal_lahir', $profile->tanggal_lahir ?? '') }}">
        </div>

        <!-- Jenis Kelamin -->
        <div class="form-group mt-3">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="">Pilih</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $profile->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $profile->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <!-- Nomor HP -->
        <div class="form-group mt-3">
            <label for="nomor_hp">Nomor HP</label>
            <input type="text" name="nomor_hp" class="form-control"
                   value="{{ old('nomor_hp', $profile->nomor_hp ?? '') }}">
        </div>

        <!-- Foto -->
        <div class="form-group mt-3">
            <label for="foto">Foto Profil</label>
            <input type="file" name="foto" class="form-control">

            @if(!empty($profile->foto))
                <div class="mt-2">
                    <img src="{{ asset($profile->foto) }}" alt="Foto Profil" width="100" class="rounded">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
    </form>
</div>
@endsection
