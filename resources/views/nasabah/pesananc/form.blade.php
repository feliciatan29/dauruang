@extends('nasabah.layout')
@section('content')

@php
    $keranjang = session('keranjang', []);
    $total = 0;
    $berat = 0;
@endphp

@if(count($keranjang) > 0)
    @foreach($keranjang as $item)
        @php
            $total += $item['jumlah'] * $item['harga'];
            $berat += $item['jumlah'];
        @endphp
    @endforeach
@endif

<div class="container py-5">
    <h2 class="mb-4">Formulir Pengiriman Sampah</h2>

    <form action="{{ route('nasabah.pesananc.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Upload gambar --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Upload Gambar Sampah</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" required>
        </div>

        {{-- Informasi tempat tinggal --}}
        <h5 class="mt-4">Informasi Tempat Tinggal</h5>
        <div class="mb-3">
            <label class="form-label">No Telepon</label>
            <input type="text" name="telepon" class="form-control" placeholder="0812xxxxxxx" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat Lengkap</label>
            <textarea name="alamat" class="form-control" rows="3" required></textarea>
        </div>

        {{-- Informasi pengantaran --}}
        <h5 class="mt-4">Informasi Pengantaran</h5>
        <div class="mb-3">
            <label class="form-label">Tanggal Pengantaran</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Waktu Pengantaran</label>
            <select name="waktu" class="form-select" required>
                <option value="">Pilih Waktu</option>
                <option value="08.00-12.00">08.00 - 12.00</option>
                <option value="12.00-15.00">12.00 - 15.00</option>
                <option value="15.00-17.00">15.00 - 17.00</option>
            </select>
        </div>

        {{-- Informasi Penjualan --}}
        <h5 class="mt-4">Informasi Penjualan</h5>

        <div class="border rounded p-3 bg-light">
            <p class="mb-1"><strong>Total Jenis</strong> | {{ count($keranjang) }} Item</p>
            <p class="mb-2">Total Berat: <strong>{{ $berat }} kg</strong></p>

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
        </div>

        {{-- Informasi tambahan --}}
        <h5 class="mt-4">Informasi Tambahan</h5>
        <div class="mb-3">
            <textarea name="catatan" class="form-control" rows="3" placeholder="Catatan tambahan jika ada..."></textarea>
        </div>

        {{-- Tombol Kirim --}}
        <button id="simpanKeKeranjang" class="btn btn-secondary">Simpan ke Keranjang</button>

    </form>
</div>





@endsection
