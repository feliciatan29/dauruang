@extends('admin.layout')
@section('content')

<div class="col-lg-8 mb-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" align="center">DATA NASABAH</h6>
        </div>
        <div class="card-body">

            <form class="user" method="POST" action="{{ route('nasabah.update', $nasabah->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <Label>Kode nasabah :</Label>
                    <input type="text" class="form-control" name="kd_nasabah" value="{{ $nasabah->kd_nasabah }}">
                    @error('kd_nasabah')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <Label>Nama nasabah :</Label>
                    <input type="text" class="form-control" name="nm_nasabah" value="{{ $nasabah->nm_nasabah }}">
                    @error('nm_nasabah')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <Label>Alamat :</Label>
                    <input type="text" class="form-control" name="alamat" value="{{ $nasabah->alamat }}">
                    @error('alamat')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <Label>Jenis Nasabah :</Label>
                    <input type="radio" name="jenis_nasabah" value="Perorangan" {{ $nasabah->jenis_nasabah == 'Perorangan' ? 'checked' : '' }}> Perorangan
                    <input type="radio" name="jenis_nasabah" value="Lembaga" {{ $nasabah->jenis_nasabah == 'Lembaga' ? 'checked' : '' }}> Lembaga
                    @error('jenis_nasabah')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <Label>No Telephone :</Label>
                    <input type="text" class="form-control" name="no_telephone" value="{{ $nasabah->no_telephone }}">
                    @error('no_telephone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <Label>Tanggal Daftar :</Label>
                    <input type="date" class="form-control" name="tgl_daftar" value="{{ $nasabah->tgl_daftar }}">
                    @error('tgl_daftar')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <Label>Status :</Label>
                    <input type="text" class="form-control" name="status" value="{{ $nasabah->status }}">
                    @error('status')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <Label>Upload Foto nasabah :</Label>
                    <input type="file" class="form-control" name="gambar">
                    @if($nasabah->gambar)
                        <img src="{{ asset('Foto_Nasabah/' . $nasabah->gambar) }}" alt="Gambar Nasabah" width="150">
                    @endif
                    @error('gambar')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <center><input type="submit" class="btn btn-primary" value="Update Data" /></center>
            </form>

        </div>
    </div>
</div>

@endsection
