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

                {{-- NAMA --}}
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $pesanan->nama) }}" class="form-control"
                        readonly>
                </div>

                {{-- TANGGAL --}}
                <div class="form-group">
                    <label for="tanggal">Tanggal Penjemputan</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $pesanan->tanggal) }}"
                        class="form-control" readonly>
                </div>

                {{-- WAKTU --}}
                <div class="form-group">
                    <label for="waktu">Waktu Penjemputan</label>
                    <input type="text" name="waktu" value="{{ old('waktu', $pesanan->waktu) }}" class="form-control"
                        readonly>
                </div>

                {{-- TELEPON --}}
                <div class="form-group">
                    <label for="telepon">Nomor Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $pesanan->telepon) }}"
                        class="form-control" readonly>
                </div>

                {{-- ALAMAT --}}
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" readonly>{{ old('alamat', $pesanan->alamat) }}</textarea>
                </div>

                {{-- JENIS SAMPAH --}}
                <div class="form-group">
                    <label for="jenis_sampah">Jenis Sampah</label>
                    @php $jenisSampah = json_decode($pesanan->jenis_sampah, true); @endphp
                    <input type="text" readonly class="form-control"
                        value="{{ is_array($jenisSampah) ? implode(', ', array_column($jenisSampah, 'nama')) : '-' }}">
                </div>

                {{-- BERAT (BOLEH UBAH) --}}
                <div class="form-group">
                    <label for="berat">Berat Sampah (kg)</label>
                    <input type="number" step="0.01" name="berat" value="{{ old('berat', $pesanan->berat) }}"
                        class="form-control" required>
                </div>

                {{-- TOTAL PESANAN --}}
                <div class="form-group">
                    <label for="total_pesanan">Total Pesanan (Rp)</label>
                    <input type="number" name="total_pesanan" value="{{ old('total_pesanan', $pesanan->total_pesanan) }}"
                        class="form-control" readonly>
                </div>

                {{-- CATATAN --}}
                <div class="form-group">
                    <label for="catatan">Catatan (Opsional)</label>
                    <textarea name="catatan" class="form-control" rows="2" readonly>{{ old('catatan', $pesanan->catatan) }}</textarea>
                </div>

                {{-- STATUS (BOLEH UBAH) --}}
                <div class="form-group">
                    <label for="status">Status Pesanan</label>
                    <select name="status" class="form-control" required>
                        <option value="sedang diproses" {{ $pesanan->status == 'sedang diproses' ? 'selected' : '' }}>
                            Sedang Diproses</option>
                        <option value="telah diterima" {{ $pesanan->status == 'telah diterima' ? 'selected' : '' }}>Telah
                            Diterima</option>
                        <option value="transaksi berhasil"
                            {{ $pesanan->status == 'transaksi berhasil' ? 'selected' : '' }}>Transaksi Berhasil</option>
                    </select>
                </div>

                {{-- GAMBAR --}}
                <div class="form-group">
                    <label for="gambar">Bukti Gambar</label><br>
                    @if ($pesanan->gambar)
                        <img src="{{ asset('storage/' . $pesanan->gambar) }}" width="120" class="mb-2 rounded">
                    @endif
                    <input type="file" name="gambar" class="form-control-file" disabled>
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
