@extends('admin.layout')
@section('content')

<div class="container mt-4">
    <div class="col-lg-12">

        <h2 class="mb-3">Data Nasabah</h2>


        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

    <div class="mb-3">
            <a href="{{ route('admin.nasabah.create') }}" class="btn btn-primary">Tambah Nasabah</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Foto Nasabah</th>
                        <th>Kode Nasabah</th>
                        <th>Nama Nasabah</th>
                        <th>Alamat</th>
                        <th>Jenis Nasabah</th>
                        <th>No Telephone</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($nasabahs as $index => $nasabah)
                        <tr>
                            <td>{{ $i + $index + 1 }}</td>
                            <td>
                                <img src="{{ asset('Foto_Nasabah/' . $nasabah->gambar) }}"
                                     alt="Foto Nasabah"
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                            </td>
                            <td>{{ $nasabah->kd_nasabah }}</td>
                            <td>{{ $nasabah->nm_nasabah }}</td>
                            <td>{{ $nasabah->alamat }}</td>
                            <td>{{ $nasabah->jenis_nasabah }}</td>
                            <td>{{ $nasabah->no_telephone }}</td>
                            <td>{{ $nasabah->tgl_daftar }}</td>
                            <td>
                                <span class="badge badge-{{ $nasabah->status == 'aktif' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($nasabah->status) }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.nasabah.destroy', $nasabah->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('admin.nasabah.edit', $nasabah->id) }}"
                                       class="btn btn-sm btn-warning mb-1">Edit</a>
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Data nasabah belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $nasabahs->links() }}
        </div>

    </div>
</div>

@endsection
