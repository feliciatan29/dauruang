@extends('nasabah.layout')
@section('content')

<div class="container py-5">
    <h2>Keranjang Formulir</h2>

    @php
        $form = session('form_sementara');
    @endphp

    @if($form)
        <div class="card p-3 mb-4">
            <p><strong>No Telepon:</strong> {{ $form['telepon'] ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $form['alamat'] ?? '-' }}</p>
            <p><strong>Tanggal:</strong> {{ $form['tanggal'] ?? '-' }}</p>
            <p><strong>Waktu:</strong> {{ $form['waktu'] ?? '-' }}</p>
            <p><strong>Catatan:</strong> {{ $form['catatan'] ?? '-' }}</p>
        </div>

        <a href="{{ route('pesananc.formulir') }}" class="btn btn-primary">Lanjutkan Isi Formulir</a>
    @else
        <p class="text-muted">Belum ada data formulir yang disimpan sementara.</p>
    @endif
</div>

@endsection
