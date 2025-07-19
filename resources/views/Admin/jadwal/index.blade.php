@extends('layout')
@section('content')

<div class="container">
    <div class="col-lg-12 col-md-10 p-3 mt-3">
        @if($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<form action="/cari" method="GET" class="form-inline">
    @csrf
    <div class="form-row align-items-center">
        <div class="col-auto">
            <input type="date" name="dari" class="form-control" placeholder="Dari Tanggal" required>
        </div>
        <div class="col-auto">
            <input type="date" name="sampai" class="form-control" placeholder="Sampai Tanggal" required>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-success">Cari Data</button>
        </div>
        <div class="col-auto">
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary">Tambah Data</a>
        </div>
    </div>
</form>

                                <table class="table table-bordered datatable" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto Sampah</th>
                                            <th>Nomor Jadwal</th>
                                            <th>Nama Nasabah</th>
                                            <th>Nama Petugas</th>
                                            <th>Tanggal Penjemputan</th>
                                            <th>Berat (kg)</th>
                                            <th>Status Penjemputan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto Sampah</th>
                                            <th>Nomor Jadwal</th>
                                            <th>Nama Nasabah</th>
                                            <th>Nama Petugas</th>
                                            <th>Tanggal Penjemputan</th>
                                            <th>Berat (kg)</th>
                                            <th>Status Penjemputan</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($jadwals as $jadwal)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td><img src="{{url('/Foto_Jadwal/' . $jadwal->gambarjadwal)}}"
                                                    style="border-radius: 0; width: 100px; height: 100px; object-fit: cover;">
                                                </td>
                                                <td>{{ $jadwal->no_jadwal }}</td>
                                                <td>{{ $jadwal->nm_nasabah }}</td>
                                                <td>{{ $jadwal->nm_petugas }}</td>
                                                <td>{{ $jadwal->tanggal }}</td>
                                                <td>{{ $jadwal->berat }}</td>
                                                <td>{{ $jadwal->status_jemput }}</td>
                                                <td>
                                                    <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('jadwal.edit', $jadwal->id) }}"
                                                            class="btn btn-warning">Edit</a>
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="javascript: return confirm('Apakah Anda Ingin Menghapus Data Ini?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

@endsection
