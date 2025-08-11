@extends('admin.layout')
@section('content')
    <div class="col-lg-8 mb-4">
        <!-- Illustrations -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" align="center">DATA JENIS SAMPAH</h6>
            </div>
            <div class="card-body">

                <form action="{{ route('jenis.update', $jenis->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Kode Jenis Sampah :</label>
                        <input type="text" class="form-control" name="kd_jenis" value="{{ $jenis->kd_jenis }}">
                    </div>

                    <div class="form-group">
                        <label>Nama Jenis Sampah :</label>
                        <input type="text" class="form-control" name="nm_jenis" value="{{ $jenis->nm_jenis }}">
                    </div>

                    <div class="form-group">
                        <label>Harga per kg (Rp) :</label>
                        <input type="number" class="form-control" name="harga_perkilo" value="{{ $jenis->harga_perkilo }}">
                    </div>

                    <div class="form-group">
                        <label>Upload Foto :</label>
                        <input type="file" class="form-control" name="gambar">
                        @if ($jenis->gambar)
                            <small>Gambar saat ini:</small><br>
                            <img src="{{ asset('Foto_Jenis/' . $jenis->gambar) }}" alt="Foto Sampah" width="120">
                        @endif
                    </div>

                    <center>
                        <input type="submit" class="btn btn-primary" value="Update Data" />
                    </center>
                </form>

            </div>
        </div>
    </div>
@endsection
