@extends('layout')
@section('content')

<div class="col-lg-8 mb-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">Edit Data Pembayaran</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('transaksi.update', $transaksi->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Tanggal Pembayaran:</label>
                    <input type="date" class="form-control" name="tgl_pembayaran" value="{{ $transaksi->tgl_pembayaran }}" required>
                </div>

                <div class="form-group">
                    <label>Kode Pembayaran:</label>
                    <input type="text" class="form-control" name="kd_pembayaran" value="{{ $transaksi->kd_pembayaran }}" required>
                </div>

                <div class="form-group">
                    <label>Nama Nasabah:</label>
                    <select class="form-control" name="nasabah_id" id="nasabah_id" required>
                        <option value="">~ Pilih Nama Nasabah ~</option>
                        @foreach($nasabahs as $nasabah)
                            <option value="{{ $nasabah->id }}" {{ $nasabah->id == $transaksi->nasabah_id ? 'selected' : '' }}>
                                {{ $nasabah->nm_nasabah }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jenis Sampah:</label>
                    <select class="form-control" name="jenis_id" id="jenis_id" required>
                        <option value="">~ Pilih Jenis Sampah ~</option>
                        @foreach($jenish as $jenis)
                            <option value="{{ $jenis->id }}" {{ $jenis->id == $transaksi->jenis_id ? 'selected' : '' }}>
                                {{ $jenis->nm_jenis }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Harga (Rp):</label>
                    <input type="text" class="form-control" id="harga" name="harga" value="{{ $transaksi->harga }}" readonly>
                </div>

                <div class="form-group">
                    <label>Berat (Kg):</label>
                    <input type="text" class="form-control" id="berat" name="berat" value="{{ $transaksi->berat }}" readonly>
                </div>

                <div class="form-group">
                    <label>Total Harga (Rp):</label>
                    <input type="text" class="form-control" id="total_harga" name="total_harga" value="{{ $transaksi->total_harga }}" readonly>
                </div>

                <div class="form-group">
                    <label>Status Pembayaran:</label>
                    <select class="form-control" name="status" required>
                        <option value="Pending" {{ $pembayaran->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Selesai" {{ $pembayaran->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <center>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </center>
            </form>
        </div>
    </div>
</div>

@endsection
