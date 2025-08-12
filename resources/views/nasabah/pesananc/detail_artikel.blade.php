@extends('nasabah.layout')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-sm p-4">
        <h1 class="mb-3 fw-bold">{{ $artikel->judul_artikel }}</h1>
        <p class="text-muted mb-4">
            <i class="bi bi-person"></i> {{ $artikel->nm_penulis }}
            &nbsp; | &nbsp;
            <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($artikel->tgl_terbit)->format('d M Y') }}
        </p>

        @php
            $gambarPath = public_path('Foto_Artikel/' . $artikel->gambar);
            $gambarAda = $artikel->gambar && file_exists($gambarPath);
            $gambarUrl = $gambarAda ? asset('Foto_Artikel/' . $artikel->gambar) : asset('img/default.jpg');
        @endphp

        <div class="text-center mb-4">
            <img src="{{ $gambarUrl }}"
                 class="img-fluid rounded shadow-sm"
                 alt="{{ $artikel->judul_artikel }}"
                 style="max-height: 400px; object-fit: cover;">
        </div>

        <div class="article-content" style="line-height: 1.8; font-size: 1.05rem;">
            {!! $artikel->isi_artikel !!}
        </div>

        <div class="mt-4">
            <a href="{{ route('beranda.nasabah') }}" class="btn btn-outline-success">
                ← Kembali ke Daftar Artikel
            </a>
        </div>
    </div>
</div>
@endsection
