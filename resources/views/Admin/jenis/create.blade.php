@extends('admin.layout')
@section('content')

<div class="col-lg-8 mb-4">
    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" align="center">DATA JENIS SAMPAH</h6>
        </div>
        <div class="card-body">

            <form class="user" method="POST" action="{{route('jenis.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <Label>Kode Jenis Sampah :</Label>
                    <input type="text" class="form-control" name="kd_jenis">
                </div>


                <div class="form-group">
                    <Label>Nama Jenis Sampah :</Label>
                    <input type="text" class="form-control" name="nm_jenis">
                </div>


                <div class="form-group">
                    <Label>Harga per kg (Rp) :</Label>
                    <input type="number" class="form-control" name="harga_perkilo">
                </div>

                <div class="form-group">
                    <Label>Harga Satuan :</Label>
                    <input type="number" class="form-control" name="harga_satuan">
                </div>

                <div class="form-group">
                    <Label>Foto Jenis Sampah :</Label>
                    <input type="file" class="form-control" name="gambar">
                </div>


                <center><input type="submit" class="btn btn-primary" value="Simpan Data" /></center>


            </form>

        </div>
    </div>
</div>
@endsection
