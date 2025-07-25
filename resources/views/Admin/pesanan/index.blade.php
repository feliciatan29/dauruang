@extends('admin.layout')
@section('content')

<div class="container mt-4">
    <div class="col-lg-12">

        <h2 class="mb-3">Data Pesanan Nasabah</h2>

        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
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
                        <th>Status</th>
                        <th>Bukti Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanans as $key => $item)
                        <tr>
                            <td>{{ $i + $key + 1 }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->waktu }}</td>
                            <td>{{ $item->telepon }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->catatan ?? '-' }}</td>
                            <td>
                                <span class="badge badge-{{
                                    $item->status === 'transaksi berhasil' ? 'success' :
                                    ($item->status === 'telah diterima' ? 'info' : 'warning')
                                    }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
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
                                <form action="{{ route('pesanan.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('pesanan.edit', $item->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">Data pesanan belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
