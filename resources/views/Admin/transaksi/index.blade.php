@extends('layout')
@section('content')

<div class="container">
    <div class="col-lg-12 col-md-10 p-3 mt-3">
        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Bayar</th>
                    <th>Kode Pembayaran</th>
                    <th>Nama Nasabah</th>
                    <th>Jenis Sampah</th>
                    <th>Berat (Kg)</th>
                    <th>Harga per kg (Rp)</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Tanggal Bayar</th>
                    <th>Kode Pembayaran</th>
                    <th>Nama Nasabah</th>
                    <th>Jenis Sampah</th>
                    <th>Berat (Kg)</th>
                    <th>Harga per kg (Rp)</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>

            <tbody>
                @foreach($transaksis as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaksi->tgl_pembayaran }}</td>
                    <td>{{ $transaksi->kd_pembayaran }}</td>
                    <td>{{ $transaksi->nm_nasabah }}</td>
                    <td>{{ $transaksi->nm_jenis }}</td>
                    <td>{{ $transaksi->berat }}</td>
                    <td>{{ $transaksi->harga }}</td>
                    <td>{{ $transaksi->total_harga }}</td>
                    <td>{{ $transaksi->status }}</td>
                    <td>
                        
                        <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="javascript: return confirm('Apakah Anda Ingin Menghapus Data Ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
