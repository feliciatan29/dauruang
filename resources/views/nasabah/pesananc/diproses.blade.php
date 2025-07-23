@extends('nasabah.layout')

@section('content')
<!-- CSS Custom -->
<style>
    .order-card {
        transition: all 0.3s ease;
        border-radius: 1rem;
        border: 1px solid #dee2e6;
        padding: 1.5rem;
        background-color: #fff;
    }

    .order-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        transform: translateY(-3px);
    }

    .badge-status {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        padding: 0.4rem 0.8rem;
        border-radius: 999px;
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .btn-action {
        transition: all 0.25s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .btn-action:hover {
        box-shadow: 0 4px 12px rgba(255, 115, 0, 0.25);
    }

    @media (max-width: 576px) {
        .order-card {
            padding: 1rem;
        }

        .btn-action {
            width: 100%;
        }
    }
</style>

<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold text-success">Pesanan Sedang Diproses</h2>

    @forelse($pesananc as $item)
    <div class="order-card mb-4">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-danger text-white">Toko</span>
                <span class="fw-semibold">Pesanan #{{ $item->id }}</span>
            </div>
            <span class="badge-status">Sedang Diproses</span>
        </div>

        {{-- Isi Konten --}}
        <div class="row g-3">
            {{-- Gambar --}}
            <div class="col-12 col-md-3">
                <img src="{{ asset('storage/'.$item->gambar) }}" alt="Gambar Pesanan"
                    class="img-fluid rounded border">
            </div>

            {{-- Detail --}}
            <div class="col-12 col-md-9 text-secondary">
                <p><strong>Catatan:</strong> {{ $item->catatan ?? 'Tidak ada catatan' }}</p>
                <p><strong>Alamat:</strong> {{ $item->alamat }}</p>
                <p><strong>Telepon:</strong> {{ $item->telepon }}</p>
                <p><strong>Tanggal & Waktu:</strong> {{ $item->tanggal }} • {{ $item->waktu }}</p>
            </div>
        </div>

        {{-- Tombol --}}
        <div class="d-flex flex-column flex-sm-row gap-2 justify-content-end mt-4">
            <button class="btn btn-warning btn-action text-white px-4">Hubungi Penjemput</button>
        </div>
    </div>
    @empty
    <p class="text-center text-muted fs-5">Belum ada pesanan yang sedang diproses.</p>
    @endforelse
</div>
@endsection
