@extends('layout')

@section('content')
<div class="container">
    <h2>Edit Pesanan</h2>
    <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $pesanan->tanggal }}" required>
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $pesanan->nama }}" required>
        </div>
        <div class="mb-3">
            <label>Jenis Sampah</label>
            <input type="text" name="jenis_sampah" class="form-control" value="{{ $pesanan->jenis_sampah }}" required>
        </div>
        <div class="mb-3">
            <label>Berat (kg)</label>
            <input type="number" step="0.1" name="berat" class="form-control" value="{{ $pesanan->berat }}" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="on going" {{ $pesanan->status == 'on going' ? 'selected' : '' }}>On Going</option>
                <option value="process" {{ $pesanan->status == 'process' ? 'selected' : '' }}>Process</option>
                <option value="done" {{ $pesanan->status == 'done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection