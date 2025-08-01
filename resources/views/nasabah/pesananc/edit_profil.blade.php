@extends('nasabah.layout')

@section('content')
<div class="container mt-4">
    <h4>Edit Biodata Diri</h4>
    <form action="{{ route('profiles.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nama Lengkap -->
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" value="{{ $user->name }}">
        </div>

        <!-- Tanggal Lahir -->
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $profile->tanggal_lahir ?? '' }}">
        </div>

        <!-- Jenis Kelamin -->
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
    <option value="">Pilih</option>
    <option value="Laki-laki" {{ (isset($profile) && $profile->jenis_kelamin == 'Laki-laki') ? 'selected' : '' }}>Laki-laki</option>
    <option value="Perempuan" {{ (isset($profile) && $profile->jenis_kelamin == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
</select>
        </div>

        <!-- Nomor HP -->
        <div class="form-group">
            <label for="nomor_hp">Nomor HP</label>
            <input type="text" name="nomor_hp" class="form-control" value="{{ $profile->nomor_hp ?? '' }}">
        </div>

        <!-- Foto -->
        <div class="form-group">
            <label for="foto">Foto Profil</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>
@endsection
