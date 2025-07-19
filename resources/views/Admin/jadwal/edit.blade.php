@extends('layout')
@section('content')

<div class="col-lg-8 mb-4">
    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" align="center">DATA JADWAL PENJEMPUTAN SAMPAH</h6>
        </div>
        <div class="card-body">

            <form class="user" method="POST" action="{{ route('jadwal.update', $jadwal->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <Label>No Jadwal:</Label>
                    <input type="text" class="form-control" name="no_jadwal" value="{{ $jadwal->no_jadwal }}" required>
                </div>

                <div class="form-group">
                    <label>Nama Nasabah:</label>
                    <select class="form-control" name="nasabah_id" id="nasabah_id" required>
                        <option value="">~Pilih Nama Nasabah</option>
                        @foreach($nasabahs as $nasabah)
                            <option value="{{ $nasabah->id }}">{{ $nasabah->nm_nasabah }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label>Nama Petugas:</label>
                    <select class="form-control" name="petugas_id" id="nasabah_id" required>
                        <option value="">~Pilih Nama Petugas</option>
                        @foreach($petugash as $petugas)
                            <option value="{{ $petugas->id }}">{{ $petugas->nm_petugas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <Label>Tanggal Penjemputan:</Label>
                    <input type="date" class="form-control" name="tanggal" value="{{ $jadwal->tanggal }}" required>
                </div>

                <div class="form-group">
                    <Label>Berat (kg):</Label>
                    <input type="text" class="form-control" name="berat" value="{{ $jadwal->berat }}" required>
                </div>

                <div class="form-group">
                    <Label>Status Penjemputan:</Label>
                    <input type="text" class="form-control" name="status_jemput" value="{{ $jadwal->status_jemput }}" required>
                </div>

                <div class="form-group">
                    <Label>Upload Foto Sampah:</Label>
                    <input type="file" class="form-control" name="gambarjadwal">
                    @if($jadwal->gambarjadwal)
                        <p class="mt-2">Foto saat ini:</p>
                        <img src="{{ asset('Foto_Jadwal/' . $jadwal->gambarjadwal) }}" alt="Foto Jadwal" width="150">
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
