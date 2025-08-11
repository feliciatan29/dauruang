@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Jenis Sampah</h3>

    <form action="{{ route('pesananc.updatePilihJenis') }}" method="POST">
        @csrf

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Jenis Sampah</th>
                    <th>Harga/Kg</th>
                    <th>Berat (Kg)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jenis_sampah as $item)
                    @php
                        // Ambil berat dari keranjang jika ada
                        $berat = isset($keranjang[$item->id]['berat']) ? $keranjang[$item->id]['berat'] : '';
                    @endphp
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>
                            <input type="number"
                                name="keranjang[{{ $item->id }}][berat]"
                                class="form-control"
                                value="{{ $berat }}"
                                step="0.1"
                                min="0">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('pesananc.form') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
