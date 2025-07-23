@extends('nasabah.layout')
@section('content')

<div class="container d-flex flex-column justify-content-center align-items-center py-5" style="min-height: 80vh;">
    <img src="{{ asset('nasabah.img/success-illustration.png') }}" alt="Success" class="mb-4" style="max-width: 300px;">
    <h3 class="text-success fw-bold mb-2">Order Berhasil Terkirim</h3>
    <p class="text-muted mb-4">Berhasil melakukan transaksi drop off</p>
    <a href="{{ url('beranda-nasabah') }}" class="btn btn-success px-5 rounded-pill">Selesai</a>
</div>

@endsection
