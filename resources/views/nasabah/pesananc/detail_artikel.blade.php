@extends('nasabah.layout')

@section('content')
<div class="container py-5">
    <h1 class="mb-3">{{ $artikel->judul_artikel }}</h1>
    <p class="text-muted mb-3">Oleh {{ $artikel->nm_penulis }} | {{ \Carbon\Carbon::parse($artikel->tgl_terbit)->format('d M Y') }}</p>

    @php
        $gambarPath = public_path('Foto_Artikel/' . $artikel->gambar);
        $gambarAda = $artikel->gambar && file_exists($gambarPath);
        $gambarUrl = $gambarAda ? asset('Foto_Artikel/' . $artikel->gambar) : asset('img/default.jpg');
    @endphp

    <img src="{{ $gambarUrl }}" class="img-fluid mb-4" alt="{{ $artikel->judul_artikel }}">

    {{-- Jika konten mengandung HTML yang valid (dari admin), gunakan {!! !!}.
         Kalau mau aman dari XSS gunakan: {!! nl2br(e($artikel->isi_artikel)) !!} --}}
    <div class="mt-3">
        {!! $artikel->isi_artikel !!}
    </div>
</div>
@endsection
