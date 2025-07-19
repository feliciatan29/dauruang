@extends('layout')
@section('content')

<div class="container mt-4">
    <div class="col-lg-12">

         <h2 class="mb-3">Data Jadwal Jemput</h2>

        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <form action="/cari_penjemputan" method="GET" class="mb-3">
            @csrf
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <input type="date" name="dari" class="form-control" required>
                </div>
                <div class="col-auto">
                    <input type="date" name="sampai" class="form-control" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success">Cari Data</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Foto Sampah</th>
                        <th>Nama Nasabah</th>
                        <th>Tanggal Penjemputan</th>
                        <th>Waktu Penjemputan</th>
                        <th>Alamat</th>
                        <th>Berat (kg)</th>
                        <th>Status Penjemputan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penjemputans as $penjemputan)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>
                                <img src="{{ url('/Foto_Sampah/' . $penjemputan->gambar_sampah) }}"
                                     alt="Foto Sampah"
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                            </td>
                            <td>{{ $penjemputan->nm_nasabah }}</td>
                            <td>{{ $penjemputan->tgl_penjemputan }}</td>
                            <td>{{ $penjemputan->waktu_penjemputan }}</td>
                            <td>{{ $penjemputan->alamat }}</td>
                            <td>{{ $penjemputan->berat }}</td>
                            <td>
                                <span class="badge badge-{{ $penjemputan->status == 'selesai' ? 'success' : 'warning' }}">
                                    {{ ucfirst($penjemputan->status) }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('penjemputan.destroy', $penjemputan->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('penjemputan.edit', $penjemputan->id) }}"
                                       class="btn btn-sm btn-warning mb-1">Edit</a>
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">Data penjemputan belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
