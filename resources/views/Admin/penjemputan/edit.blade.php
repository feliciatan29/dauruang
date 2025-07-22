@extends('admin.layout')
@section('content')

<div class="col-lg-8 mb-4">
    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" align="center">DATA PENJEMPUTAN SAMPAH</h6>
        </div>
        <div class="card-body">

            <form class="user" method="POST" action="{{ route('penjemputan.update', $penjemputan->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                <label for="nm_nasabah">Nama Nasabah</label>
                <select name="nm_nasabah" class="form-control" required>
                    <option value="">-- Pilih Nasabah --</option>
                    @foreach ($nasabahs as $nasabah)
                        <option value="{{ $nasabah->id }}" {{ $penjemputan->nm_nasabah == $nasabah->id ? 'selected' : '' }}>
                            {{ $nasabah->nm_nasabah }}
                        </option>
                    @endforeach
                </select>
                </div>

                <div class="form-group">
                    <Label>Tanggal Penjemputan:</Label>
                    <input type="date" class="form-control" name="tgl_penjemputan" value="{{ $penjemputan->tgl_penjemputan }}" required>
                </div>

                <div class="form-group">
                    <Label>Waktu Penjemputan:</Label>
                    <input type="date" class="form-control" name="tgl_penjemputan" value="{{ $penjemputan->waktu_penjemputan }}" required>
                </div>

                <div class="form-group">
                    <Label>Alamat:</Label>
                    <input type="text" class="form-control" name="alamat" value="{{ $penjemputan->alamat }}" required>
                </div>

                <div class="form-group">
                    <Label>Berat (kg):</Label>
                    <input type="text" class="form-control" name="berat" value="{{ $penjemputan->berat }}" required>
                </div>

                <div class="form-group">
                    <Label>Status Penjemputan:</Label>
                    <input type="text" class="form-control" name="status" value="{{ $penjemputan->status }}" required>
                </div>

                <div class="form-group">
                    <Label>Upload Foto Sampah:</Label>
                    <input type="file" class="form-control" name="gambar_sampah">
                    @if($penjemputan->gambar_sampah)
                        <p class="mt-2">Foto saat ini:</p>
                        <img src="{{ asset('Foto_Penjemputan/' . $penjemputan->gambar_sampah) }}" alt="Foto Jadwal" width="150">
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
