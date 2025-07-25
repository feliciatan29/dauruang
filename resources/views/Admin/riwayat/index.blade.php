@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <div class="col-lg-12">

        <h2 class="mb-3">Riwayat Pesanan</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Catatan</th>
                        <th>Bukti Gambar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayats as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->waktu }}</td>
                            <td>{{ $item->telepon }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->catatan ?? '-' }}</td>
                            <td>
                                @if($item->gambar)
                                    <a href="{{ asset('storage/' . $item->gambar) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $item->gambar) }}" width="60" height="60" style="object-fit:cover" alt="Bukti">
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-success">{{ ucfirst($item->status) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">Data riwayat belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
