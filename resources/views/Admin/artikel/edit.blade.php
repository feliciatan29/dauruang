@extends('layout')
@section('content')

<div class="col-lg-8 mb-4">
    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" align="center">DATA ARTIKEL</h6>
        </div>
        <div class="card-body">

            <form class="user" method="POST" action="{{ route('artikel.update', $artikel->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Judul Artikel :</label>
                    <input type="text" class="form-control" name="judul_artikel" value="{{ $artikel->judul_artikel }}" required>
                </div>

                <div class="form-group">
                    <label>Nama Penulis :</label>
                    <input type="text" class="form-control" name="nm_penulis" value="{{ $artikel->nm_penulis }}" required>
                </div>

                <div class="form-group">
                    <label>Kategori :</label>
                    <input type="text" class="form-control" name="kategori" value="{{ $artikel->kategori }}" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Terbit :</label>
                    <input type="date" class="form-control" name="tgl_terbit" value="{{ $artikel->tgl_terbit }}" required>
                </div>

                <div class="form-group">
                    <label>Isi Artikel :</label>
                    <input type="text" class="form-control" name="isi_artikel" value="{{ $artikel->isi_artikel }}" required>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" name="gambar" class="form-control" id="gambar">
                    <img src="{{ url('/Foto_Artikel/'.$artikel->gambar) }}" width="150px" alt="Current Image">
                </div>

                <center><input type="submit" class="btn btn-primary" value="Update Data" /></center>

            </form>

        </div>
    </div>
</div>
@endsection