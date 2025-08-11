@extends('nasabah.layout')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold text-primary">Detail Pesanan #{{ $pesanan->id }}</h2>

    <div class="card p-4 shadow-sm">
        <div class="row">
            <!-- Gambar -->
            <div class="col-md-4 text-center">
                @if($pesanan->gambar)
                    <img src="{{ asset($pesanan->gambar) }}" class="img-fluid rounded border">
                @else
                    <div class="bg-light p-5 rounded">Tidak ada gambar</div>
                @endif
            </div>

            <!-- Informasi -->
            <div class="col-md-8">
                 <p><strong>Nama:</strong> {{ $pesanan->nama }}</p>
                    <p><strong>Telepon:</strong> {{ $pesanan->telepon }}</p>
                    <p><strong>Alamat:</strong> {{ $pesanan->alamat }}</p>
                    <p><strong>Tanggal:</strong> {{ $pesanan->tanggal }}</p>
                    <p><strong>Waktu:</strong> {{ $pesanan->waktu }}</p>
                    <p><strong>Jenis Sampah:</strong> {{ implode(', ', $pesanan->jenis_sampah ?? []) }}</p>
                    <p><strong>Berat:</strong> {{ $pesanan->berat }} kg</p>
                    <p><strong>Total Pesanan:</strong> Rp{{ number_format($pesanan->total_pesanan, 0, ',', '.') }}</p>
                    <p><strong>Catatan:</strong> {{ $pesanan->catatan }}</p>
                    <p><strong>Status:</strong> {{ $pesanan->status }}</p>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('pesananc.diproses') }}" class="btn btn-secondary">← Kembali</a>
    </div>
</div>
@endsection
