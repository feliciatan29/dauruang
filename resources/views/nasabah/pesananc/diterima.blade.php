
@extends('nasabah.layout')

@section('content')
    <style>
        .order-card {
            transition: all 0.3s ease;
            border-radius: 1rem;
            border: 1px solid #dee2e6;
            padding: 1.5rem;
            background-color: #fff;
            position: relative;
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

        .sampah-title {
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .btn-action {
            transition: all 0.25s ease;
        }

        .action-footer {
            margin-top: 1.5rem;
            text-align: right;
        }

        @media (max-width: 576px) {
            .order-card {
                padding: 1rem;
            }

            .action-footer {
                text-align: center;
            }
        }
    </style>

    <div class="container py-5">
        <h2 class="text-center mb-5 fw-bold text-success">Pesanan Telah Diterima</h2>

        @forelse($pesananc as $item)
            <div class="order-card mb-4">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-danger text-white">Toko</span>
                        <span class="fw-semibold">Pesanan #{{ $item->id ?? 'N/A' }}</span>
                    </div>
                    <span class="badge-status">Transaksi Berhasil</span>
                </div>

                {{-- Isi Konten --}}
                <div class="row g-3">
                    {{-- Gambar --}}
                    <div class="col-12 col-md-3 text-center">
                        @if (!empty($item->gambar))
                            <img src="{{ asset($item->gambar) }}" alt="Gambar Pesanan" class="img-fluid rounded border">
                        @else
                            <div class="bg-light text-center p-4 border rounded">Tidak ada gambar</div>
                        @endif
                    </div>

                    <!-- Informasi -->
                    <div class="col-12 col-md-9 text-secondary">
                        <p class="sampah-title">
                            SAMPAH {{ $item->jenis_sampah->jenis_sampah ?? '-' }}
                        </p>
                        <p class="mb-2">
                            <i class="bi bi-scale"></i> {{ $item->berat ?? '-' }} kg
                        </p>
                        <p>
                            <i class="bi bi-sticky"></i> {{ $item->catatan ?? '-' }}
                        </p>
                        <p>
                            <i class="bi bi-cash"></i> Total: <strong>Rp {{ number_format($item->total_pesanan ?? 0, 0, ',', '.') }}</strong>
                        </p>
                        <small class="text-muted">Transaksi selesai dan tercatat.</small>
                    </div>
                </div>

                <!-- Footer -->
                <div class="action-footer mt-4">
                    <p class="fw-semibold mb-2">Total: Rp {{ number_format($item->total_pesanan ?? 0, 0, ',', '.') }}</p>
                    <a href="#" class="btn btn-outline-success btn-action px-4" disabled>
                        ✔ Selesai
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-muted fs-5">Belum ada transaksi yang berhasil.</p>
        @endforelse
    </div>
@endsection
