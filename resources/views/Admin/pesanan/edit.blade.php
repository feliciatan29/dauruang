@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <div class="col-lg-10 offset-lg-1">
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

        <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- DATA UTAMA --}}
            <div class="form-group">
                <label>Nama</label>
                <input type="text" value="{{ $pesanan->nama }}" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" value="{{ $pesanan->tanggal }}" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label>Waktu</label>
                <input type="text" value="{{ $pesanan->waktu }}" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label>Telepon</label>
                <input type="text" value="{{ $pesanan->telepon }}" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" rows="2" readonly>{{ $pesanan->alamat }}</textarea>
            </div>

            {{-- JENIS SAMPAH --}}
            <div class="form-group">
                <label>Jenis Sampah, Berat & Harga</label>
                @php
                    $jenisSampah = json_decode($pesanan->jenis_sampah, true);
                @endphp

                @if (is_array($jenisSampah))
                    <div id="jenisSampahContainer">
                        @foreach ($jenisSampah as $index => $js)
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <input type="text" name="jenis_sampah[{{ $index }}][nama]"
                                        value="{{ $js['nama'] ?? '' }}" class="form-control" required
                                        placeholder="Jenis Sampah">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" step="0.01" min="0"
                                        name="jenis_sampah[{{ $index }}][jumlah]"
                                        value="{{ floatval($js['jumlah'] ?? 0) }}"
                                        class="form-control berat-input" required placeholder="Berat (kg)">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" step="100" min="0"
                                        name="jenis_sampah[{{ $index }}][harga]"
                                        value="{{ intval($js['harga'] ?? 0) }}"
                                        class="form-control harga-input" required placeholder="Harga/kg">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control total-item bg-light" readonly
                                        placeholder="Subtotal">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Data jenis sampah tidak tersedia.</p>
                @endif
            </div>

            {{-- TOTAL BERAT DAN HARGA --}}
            <div class="row mt-3 mb-3">
                <div class="col-md-6">
                    <label>Total Berat (kg)</label>
                    <input type="text" id="totalBeratFormatted" class="form-control" readonly>
                    <input type="hidden" id="totalBerat" name="berat">
                </div>
                <div class="col-md-6">
                    <label>Total Harga (Rp)</label>
                    <input type="text" id="totalHargaFormatted" class="form-control" readonly>
                    <input type="hidden" id="totalHarga" name="total_pesanan">
                </div>
            </div>

            {{-- CATATAN --}}
            <div class="form-group">
                <label>Catatan</label>
                <textarea class="form-control" rows="2" readonly>{{ $pesanan->catatan }}</textarea>
            </div>

            {{-- STATUS --}}
            <div class="form-group">
                <label>Status Pesanan</label>
                <select name="status" class="form-control" required>
                    <option value="sedang diproses" {{ $pesanan->status == 'sedang diproses' ? 'selected' : '' }}>
                        Diproses</option>
                    <option value="telah diterima" {{ $pesanan->status == 'telah diterima' ? 'selected' : '' }}>
                        Telah Diterima</option>
                    <option value="transaksi berhasil" {{ $pesanan->status == 'transaksi berhasil' ? 'selected' : '' }}>
                        Transaksi Berhasil</option>
                </select>
            </div>

            {{-- TOMBOL --}}
            <div class="text-right mt-4">
                <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- JAVASCRIPT UNTUK HITUNG TOTAL --}}
<script>
    function hitungTotal() {
        let totalBerat = 0;
        let totalHarga = 0;

        document.querySelectorAll('#jenisSampahContainer .row').forEach(function(row) {
            const beratInput = row.querySelector('.berat-input');
            const hargaInput = row.querySelector('.harga-input');
            const totalItem = row.querySelector('.total-item');

            if (!beratInput || !hargaInput || !totalItem) return;

            const berat = parseFloat(beratInput.value) || 0;
            const harga = parseFloat(hargaInput.value) || 0;
            const subtotal = berat * harga;

            totalItem.value = 'Rp ' + subtotal.toLocaleString('id-ID');
            totalBerat += berat;
            totalHarga += subtotal;
        });

        // Set hasil akhir ke input
        document.getElementById('totalBeratFormatted').value = totalBerat.toFixed(2);
        document.getElementById('totalBerat').value = totalBerat.toFixed(2);

        document.getElementById('totalHargaFormatted').value = 'Rp ' + totalHarga.toLocaleString('id-ID');
        document.getElementById('totalHarga').value = totalHarga.toFixed(0);
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.berat-input, .harga-input').forEach(function(input) {
            input.addEventListener('input', hitungTotal);
        });
        hitungTotal(); // hitung awal
    });
</script>
@endsection
