@extends('nasabah.layout')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-sm p-4">
        <h1 class="mb-3 fw-bold">{{ $informasi->judul_informasi }}</h1>
        <p class="text-muted mb-4">
            <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($informasi->tgl_informasi)->format('d M Y') }}
            &nbsp; | &nbsp;
            <i class="bi bi-tag"></i> {{ $informasi->kategori }}
        </p>

        @php
            $gambarPath = public_path('Foto_Informasi/' . $informasi->gambar);
            $gambarAda = $informasi->gambar && file_exists($gambarPath);
            $gambarUrl = $gambarAda ? asset('Foto_Informasi/' . $informasi->gambar) : asset('img/default.jpg');
        @endphp

        <div class="text-center mb-4">
            <img src="{{ $gambarUrl }}"
                 class="img-fluid rounded shadow-sm"
                 alt="{{ $informasi->judul_informasi }}"
                 style="max-height: 400px; object-fit: cover;">
        </div>

        <div class="article-content" style="line-height: 1.8; font-size: 1.05rem;">
            {!! $informasi->isi_informasi !!}
        </div>

        <div class="mt-4">
            <a href="{{ route('beranda.nasabah') }}" class="btn btn-outline-success">
                ← Kembali ke Daftar Informasi
            </a>
        </div>
    </div>
</div>
@endsection
