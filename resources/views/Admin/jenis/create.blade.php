@extends('admin.layout')
@section('content')

<div class="col-lg-8 mb-4">
    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">DATA JENIS SAMPAH</h6>
        </div>
        <div class="card-body">

            {{-- Tampilkan pesan error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="user" method="POST" action="{{ route('jenis.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Kode Jenis Sampah :</label>
                    <input type="text" class="form-control" name="kd_jenis" value="{{ old('kd_jenis') }}">
                </div>

                <div class="form-group">
                    <label>Nama Jenis Sampah :</label>
                    <input type="text" class="form-control" name="nm_jenis" value="{{ old('nm_jenis') }}">
                </div>

                <div class="form-group">
                    <label>Harga per kg (Rp) :</label>
                    <input type="number" class="form-control" name="harga_perkilo" value="{{ old('harga_perkilo') }}">
                </div>

                <div class="form-group">
                    <label>Foto Jenis Sampah :</label>
                    <input type="file" class="form-control" name="gambar">
                </div>

                <center>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </center>
            </form>

        </div>
    </div>
</div>
@endsection
