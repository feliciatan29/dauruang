@extends('admin.layout')
@section('content')

<div class="container mt-4">
    <div class="col-lg-8 offset-lg-2">

        <h2 class="mb-4">Edit Data Pesanan</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="telepon">Nomor Telepon</label>
                <input type="text" name="telepon" value="{{ old('telepon', $pesanan->telepon) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', $pesanan->alamat) }}</textarea>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal Penjemputan</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $pesanan->tanggal) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="waktu">Waktu Penjemputan</label>
                <input type="text" name="waktu" value="{{ old('waktu', $pesanan->waktu) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="catatan">Catatan (Opsional)</label>
                <textarea name="catatan" class="form-control" rows="2">{{ old('catatan', $pesanan->catatan) }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Status Pesanan</label>
                <select name="status" class="form-control" required>
                    <option value="sedang diproses" {{ $pesanan->status == 'sedang diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                    <option value="telah diterima" {{ $pesanan->status == 'telah diterima' ? 'selected' : '' }}>Telah Diterima</option>
                    <option value="transaksi berhasil" {{ $pesanan->status == 'transaksi berhasil' ? 'selected' : '' }}>Transaksi Berhasil</option>
                </select>
            </div>

            <div class="form-group">
                <label for="gambar">Bukti Gambar (Opsional)</label><br>
                @if ($pesanan->gambar)
                    <img src="{{ asset('storage/' . $pesanan->gambar) }}" width="120" class="mb-2 rounded">
                @endif
                <input type="file" name="gambar" class="form-control-file">
                <small class="form-text text-muted">Format gambar: JPG, JPEG, PNG. Maks. 2MB.</small>
            </div>

            <div class="text-right">
                <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>

    </div>
</div>

@endsection
