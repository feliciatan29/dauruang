@extends('admin.layout')
@section('content')

<div class="container mt-4">
    <div class="col-lg-12">

        <h2 class="mb-3">Data Jenis Sampah</h2>

        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <form action="/cari_jenis" method="GET" class="mb-3">
            @csrf
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari data jenis..."
                        value="{{ request('keyword') }}"
                        style="width: 300px;">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success">Cari Data</button>
                </div>
                <div class="col-auto">
                    <a href="{{ route('jenis.create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Foto Jenis Sampah</th>
                        <th>Kode Jenis</th>
                        <th>Nama Jenis</th>
                        <th>Harga per kg (Rp)</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenish as $jenis)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>
                                <img src="{{ url('Foto_jenis/' . $jenis->gambar) }}"
                                     alt="Foto Jenis"
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                            </td>
                            <td>{{ $jenis->kd_jenis }}</td>
                            <td>{{ $jenis->nm_jenis }}</td>
                            <td>{{ number_format($jenis->harga_perkilo, 0, ',', '.') }}</td>
                            <td>{{ number_format($jenis->harga_satuan, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('jenis.destroy', $jenis->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('jenis.edit', $jenis->id) }}"
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
                            <td colspan="7" class="text-center">Tidak ada data jenis sampah yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $jenish->links() }}
        </div>

    </div>
</div>

@endsection
