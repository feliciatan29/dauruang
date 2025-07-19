@extends('layout')
@section('content')

<div class="col-lg-8 mb-4">
    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" align="center">DATA NASABAH</h6>
        </div>
        <div class="card-body">

            <form class="user" method="POST" action="{{route('nasabah.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <Label>Kode nasabah :</Label>
                    <input type="text" class="form-control" name="kd_nasabah">
                </div>


                <div class="form-group">
                    <Label>Nama nasabah :</Label>
                    <input type="text" class="form-control" name="nm_nasabah">
                </div>

                <div class="form-group">
                    <Label>Alamat :</Label>
                    <input type="text" class="form-control" name="alamat">
                </div>

                <div class="form-group">
                    <Label>Jenis Nasabah :</Label>
                    <input type="radio" name="jenis_nasabah" value="Perorangan">Perorangan
                    <input type="radio" name="jenis_nasabah" value="Lembaga">Lembaga
                </div>

                <div class="form-group">
                    <Label>No Telephone :</Label>
                    <input type="text" class="form-control" name="no_telephone">
                </div>

                <div class="form-group">
                    <Label>Tanggal Daftar :</Label>
                    <input type="date" class="form-control" name="tgl_daftar">
                </div>

                <div class="form-group">
                    <Label>Status :</Label>
                    <input type="text" class="form-control" name="status">
                </div>

                <div class="form-group">
                    <Label>Foto Nasabah :</Label>
                    <input type="file" class="form-control" name="gambar">
                </div>


                <center><input type="submit" class="btn btn-primary" value="Simpan Data" /></center>


            </form>

        </div>
    </div>
</div>
@endsection
