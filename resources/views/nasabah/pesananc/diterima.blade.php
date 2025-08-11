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
            background-color: #cfe2ff;
            color: #084298;
        }

        .sampah-title {
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .icon-small {
            width: 18px;
            height: 18px;
            vertical-align: middle;
            margin-right: 6px;
        }

        .note-text::before {
            content: '📝 ';
        }

        .btn-action {
            transition: all 0.25s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .btn-action:hover {
            box-shadow: 0 4px 12px rgba(255, 115, 0, 0.25);
        }

        .action-footer {
            margin-top: 1.5rem;
            text-align: right;
        }

        @media (max-width: 576px) {
            .order-card {
                padding: 1rem;
            }

            .btn-action {
                width: 100%;
            }

            .action-footer {
                text-align: center;
            }
        }
    </style>

    
<div class="container py-5">
        <h2 class="text-center mb-5 fw-bold text-primary">Pesanan Telah Diterima</h2>

<div class="container-xxl py-5">
        <div class="container py-5">
        <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
            <div class="tracking-box text-center rounded py-5 px-4">
                <div class="tracking-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"></h4>
                    <a href="#">Lihat Riwayat Pesanan &rarr;</a>
                </div>

                <div class="tracking-step">
                    <div class="step active">
                        <div class="icon"><i class="bi bi-arrow-repeat"></i></div>
                        <a href="{{ route('pesananc.diproses') }}"> Sedang Diproses</a>
                    </div>
                    <div class="step active">
                        <div class="icon"><i class="bi bi-box-seam"></i></div>
                        <a href="{{ route('pesananc.diterima') }}"> Telah Diterima</a>
                    </div>
                    <div class="step active">
                        <div class="icon"><i class="bi bi-check-circle"></i></div>
                        <a href="{{ route('pesananc.transaksi_berhasil') }}">Transaksi Berhasil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @forelse($pesananc as $item)
            <div class="order-card mb-4">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-semibold">Pesanan #{{ $item['id'] ?? 'N/A' }}</span>
                    </div>
                    <span class="badge-status">Telah Diterima</span>
                </div>

                {{-- Isi Konten --}}
                <div class="row g-3">
                    {{-- Gambar --}}
                    <div class="col-12 col-md-3 text-center">
                        @if (!empty($item['gambar']))
                            <img src="{{ asset($item['gambar']) }}" alt="Gambar Pesanan" class="img-fluid rounded border">
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
                            <i class="bi bi-cash"></i> Total: Rp {{ number_format($item->total_pesanan ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <!-- Total & Tombol -->
                <div class="action-footer mt-4">
                    <p class="fw-semibold mb-2">Total: Rp {{ number_format($item['total_pesanan'] ?? 0, 0, ',', '.') }}</p>
                    <a href="tel:{{ $item['telepon'] ?? '' }}" class="btn btn-success btn-action text-white px-4">
                        Hubungi Penjemput
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-muted fs-5">Belum ada pesanan yang telah diterima.</p>
        @endforelse
    </div>

<style>
.tracking-box {
    box-shadow: 0 0 45px rgba(0, 0, 0, 0.08);
    background-color: #fff;
    border-radius: 16px;
    padding: 30px;
    max-width: 100%;
}

.tracking-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.tracking-header h4 {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
}

.tracking-header a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
}

.tracking-step {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    padding: 20px 0;
}

.tracking-step::before {
    content: "";
    position: absolute;
    top: 40%; /* Tengah container */
    left: calc(15% + 20px);
    right: calc(15% + 20px);
    transform: translateY(-50%);
    height: 2px;
    background-color: rgba(0, 0, 0, 0.1); /* Garis samar */
    z-index: 0;
}

.step {
    position: relative;
    z-index: 1;
    text-align: center;
    flex: 1;
}

.step .icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    font-size: 26px;
    color: #555;
}

.step.active .icon {
    background-color: #28a745;
    color: #fff;
}

.step p {
    font-size: 14px;
    margin: 0;
    color: #444;
}

.artikel-content,
.judul-artikel {
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    word-wrap: break-word;
    max-width: 100%; /* biar full width di dalam card */
}

.card-img-top {
    width: 100%;
    height: 100%;
    object-fit: cover; /* agar gambar terisi penuh tanpa distorsi */
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}


</style>

@endsection
