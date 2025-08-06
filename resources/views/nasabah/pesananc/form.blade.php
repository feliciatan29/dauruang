
@extends('nasabah.layout')
@section('content')

@php
    $keranjang = session('keranjang', []);
    $total = 0;
    $berat = 0;
    $form = session('form_sementara', []);
@endphp

@if(count($keranjang) > 0)
    @foreach($keranjang as $item)
        @php
            $total += $item['jumlah'] * $item['harga'];
            $berat += $item['jumlah'];
        @endphp
    @endforeach
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container py-5">
    <h2 class="mb-4">Formulir Pengiriman Sampah</h2>

    {{-- ✅ FORM UTAMA --}}
    <form id="form-pesanan" action="{{ route('nasabah.pesananc.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Upload gambar --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Upload Gambar Sampah</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" required>
            @if(!empty($form['gambar']))
                <p class="mt-2">Gambar sebelumnya:</p>
                <img src="{{ asset($form['gambar']) }}" alt="Gambar Sebelumnya" width="200">
            @endif
        </div>

        {{-- Informasi tempat tinggal --}}
        <h5 class="mt-4">Informasi Tempat Tinggal</h5>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control wajib"
                placeholder="Nama Lengkap" value="{{ old('nama', $form['nama'] ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">No Telepon</label>
            <input type="text" name="telepon" class="form-control wajib"
                placeholder="0812xxxxxxx" value="{{ old('telepon', $form['telepon'] ?? '') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $form['alamat'] ?? '') }}</textarea>
        </div>

        {{-- Informasi pengantaran --}}
        <h5 class="mt-4">Informasi Pengantaran</h5>
        <div class="mb-3">
            <label class="form-label">Tanggal Pengantaran</label>
            <input type="date" name="tanggal" class="form-control wajib"
                value="{{ old('tanggal', $form['tanggal'] ?? '') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Waktu Pengantaran</label>
            <select name="waktu" class="form-select wajib">
                <option value="">Pilih Waktu</option>
                <option value="08.00-12.00" {{ old('waktu', $form['waktu'] ?? '') == '08.00-12.00' ? 'selected' : '' }}>08.00 - 12.00</option>
                <option value="12.00-15.00" {{ old('waktu', $form['waktu'] ?? '') == '12.00-15.00' ? 'selected' : '' }}>12.00 - 15.00</option>
                <option value="15.00-17.00" {{ old('waktu', $form['waktu'] ?? '') == '15.00-17.00' ? 'selected' : '' }}>15.00 - 17.00</option>
            </select>
        </div>

        {{-- Informasi Penjualan --}}
        <h5 class="mt-4">Informasi Penjualan</h5>
        <div class="border rounded p-3 bg-light">
            <p class="mb-1"><strong>Total Jenis</strong> | {{ count($keranjang) }} Item</p>
            <p class="mb-2">Total Berat: <strong>{{ $berat }} kg</strong></p>

            <ul class="mb-3">
                @foreach($keranjang as $item)
                    <li>{{ $item['nama'] ?? '-' }} - {{ $item['jumlah'] }} kg</li>
                @endforeach
            </ul>

            <div class="alert alert-primary text-center fw-medium mb-3" role="alert">
                Setiap penjualan akan dikenakan biaya layanan sebesar <strong>0%</strong> kepada Pengguna
            </div>

            <div class="d-flex justify-content-between">
                <span>Estimasi Penjualan</span>
                <span class="fw-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="d-flex justify-content-between text-danger">
                <span>Biaya Layanan</span>
                <span class="fw-semibold">Rp 0</span>
            </div>
            <div class="d-flex justify-content-between text-success">
                <span>Estimasi Pendapatan</span>
                <span class="fw-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            {{-- ✅ TOMBOL PENGALIHAN KE PILIH JENIS --}}
            <button type="submit" form="form-edit-jenis" class="btn btn-outline-primary mt-3">
                <i class="bi bi-plus-circle"></i> Tambah / Edit Jenis Sampah
            </button>
        </div>

        {{-- Hidden input untuk database --}}
        <input type="hidden" name="jenis_sampah" value="{{ json_encode($keranjang) }}">
        <input type="hidden" name="berat" value="{{ $berat }}">
        <input type="hidden" name="total_pesanan" value="{{ $total }}">

        {{-- Informasi tambahan --}}
        <h5 class="mt-4">Informasi Tambahan</h5>
        <div class="mb-3">
            <textarea name="catatan" class="form-control" rows="3" placeholder="Catatan tambahan jika ada...">{{ old('catatan', $form['catatan'] ?? '') }}</textarea>
        </div>

        {{-- Tombol Aksi --}}
        <div class="d-flex gap-3 mt-4">
            <button type="submit" name="action" value="keranjang" class="btn btn-secondary">Simpan di Keranjang</button>
            <button type="submit" name="action" value="kirim" class="btn btn-success">Kirim Pesanan</button>
        </div>
    </form>

    {{-- ✅ FORM TAMBAH JENIS SAMPAH (DILUAR FORM UTAMA) --}}
    <form id="form-edit-jenis" action="{{ route('pesananc.pilihjenis') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="form_sementara" value="{{ base64_encode(serialize($form)) }}">
    </form>
</div>

{{-- Script Validasi Dinamis --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('#form-pesanan');
        const wajibFields = form.querySelectorAll('.wajib');

        document.querySelector('button[name="action"][value="keranjang"]').addEventListener('click', function (e) {
            e.preventDefault();
            wajibFields.forEach(field => field.removeAttribute('required'));

            let input = form.querySelector('input[name="action"]');
            if (!input) {
                input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'action';
                form.appendChild(input);
            }
            input.value = 'keranjang';

            form.submit();
        });

        document.querySelector('button[name="action"][value="kirim"]').addEventListener('click', function () {
            wajibFields.forEach(field => field.setAttribute('required', 'required'));
        });
    });
</script>

@endsection
