@extends('layout')
@section('content')

<div class="container mt-4">
    <div class="col-lg-12">

        <h2 class="mb-3">Data Pesanan</h2>

        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <a href="{{ route('pesanan.create') }}" class="btn btn-primary mb-3">Tambah Pesanan</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Jenis Sampah</th>
                        <th>Berat (kg)</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanans as $key => $item)
                        <tr>
                            <td>{{ $i + $key + 1 }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->jenis_sampah }}</td>
                            <td>{{ $item->berat }}</td>
                            <td>
                                <span class="badge badge-{{ 
                                    $item->status === 'done' ? 'success' : 
                                    ($item->status === 'process' ? 'info' : 'warning') 
                                }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('pesanan.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('pesanan.edit', $item->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Data pesanan belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
