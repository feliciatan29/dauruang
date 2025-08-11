@extends('nasabah.layout')

@section('content')
<div class="container py-5">
    <h1 class="mb-3">{{ $informasi->judul_informasi }}</h1>
    <p class="text-muted mb-3">{{ \Carbon\Carbon::parse($informasi->tgl_informasi)->format('d M Y') }} | {{ $informasi->kategori }}</p>

    @php
        $gambarPath = public_path('Foto_Informasi/' . $informasi->gambar);
        $gambarAda = $informasi->gambar && file_exists($gambarPath);
        $gambarUrl = $gambarAda ? asset('Foto_Informasi/' . $informasi->gambar) : asset('img/default.jpg');
    @endphp

    <img src="{{ $gambarUrl }}" class="img-fluid mb-4" alt="{{ $informasi->judul_informasi }}">

    <div class="mt-3">
        {!! $informasi->isi_informasi !!}
    </div>
</div>
@endsection
