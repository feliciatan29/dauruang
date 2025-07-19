@extends('layout')
@section('content')

<div class="container py-4">
    <h3 class="text-2xl font-semibold mb-6">Pesanan Diproses</h3>

    @forelse($pesananc as $item)
    <div class="bg-white shadow-md rounded-xl p-4 mb-6 border border-gray-200">
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center gap-2">
                <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">Toko</span>
                <span class="font-medium text-gray-800">Pesanan #{{ $item->id }}</span>
            </div>
            <span class="text-green-600 font-semibold">SEDANG DIPROSES</span>
        </div>

        <div class="flex items-start gap-4">
            <img src="{{ asset('storage/'.$item->gambar) }}" alt="Gambar" class="w-24 h-24 object-cover rounded border">
            <div class="flex-1">
                <p class="text-lg font-semibold text-gray-900">{{ $item->catatan ?? 'Tidak ada catatan' }}</p>
                <p class="text-sm text-gray-500 mt-1">Alamat: {{ $item->alamat }}</p>
                <p class="text-sm text-gray-500">Telepon: {{ $item->telepon }}</p>
                <p class="text-sm text-gray-500">Tanggal: {{ $item->tanggal }} | Waktu: {{ $item->waktu }}</p>
            </div>
        </div>

        <div class="mt-4 flex justify-end gap-3">
            <button class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 text-sm">Hubungi Penjual</button>
            <button class="bg-white text-orange-500 border border-orange-500 px-4 py-2 rounded hover:bg-orange-100 text-sm">Beli Lagi</button>
        </div>
    </div>
    @empty
    <p class="text-center text-gray-500">Belum ada pesanan yang sedang diproses.</p>
    @endforelse
</div>

@endsection
