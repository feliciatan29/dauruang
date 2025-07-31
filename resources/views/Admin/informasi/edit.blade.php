@extends('admin.layout')
@section('content')

<div class="col-lg-8 mb-4">
    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" align="center">DATA INFORMASI</h6>
        </div>
        <div class="card-body">

            <form class="user" method="POST" action="{{ route('informasi.update', $informasi->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Judul Informasi :</label>
                    <input type="text" class="form-control" name="judul_informasi" value="{{ $informasi->judul_informasi }}" required>
                </div>

                <div class="form-group">
                    <label>Kategori :</label>
                    <input type="text" class="form-control" name="kategori" value="{{ $informasi->kategori }}" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Informasi :</label>
                    <input type="date" class="form-control" name="tgl_informasi" value="{{ $informasi->tgl_informasi }}" required>
                </div>

                <div class="form-group">
                    <label>Isi Informasi :</label>
                    <input type="text" class="form-control" name="isi_informasi" value="{{ $informasi->isi_informasi }}" required>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" name="gambar" class="form-control" id="gambar">
                    <img src="{{ url('/Foto_Informasi/'.$informasi->gambar) }}" width="150px" alt="Current Image">
                </div>

                <center><input type="submit" class="btn btn-primary" value="Update Data" /></center>

            </form>

        </div>
    </div>
</div>
@endsection
