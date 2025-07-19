@extends('layout')
@section('content')

<div class="col-lg-8 mb-4">
    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-3 font-weight-bold text-primary" align="center">DATA ARTIKEL</h6>
        </div>
        <div class="card-body">
            <form class="user" method="POST" action="{{ route('artikel.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Judul Artikel :</label>
                    <input type="text" class="form-control" name="judul_artikel" required>
                </div>

                <div class="form-group">
                    <label>Nama Penulis :</label>
                    <input type="text" class="form-control" name="nm_penulis" required>
                </div>

                <div class="form-group">
                    <label>Kategori :</label><br>
                    <input type="text" class="form-control" name="kategori" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Terbit :</label>
                    <input type="date" class="form-control" name="tgl_terbit" required>
                </div>

                 <div class="form-group">
                    <label>Isi Artikel :</label>
                    <input type="text" class="form-control" name="isi_artikel" required>
                </div>

                <div class="form-group">
                          <Label>Upload Foto Artikel :</Label>
                          <input type="file" class="form-control" name="gambar">
                    </div>

                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Simpan Data" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection