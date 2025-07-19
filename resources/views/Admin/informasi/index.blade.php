@extends('layout')

@section('content')

<style>
    .informasi-content,
    .judul-informasi {
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: normal;
        word-wrap: break-word;
        max-width: 250px;
        text-align: left;
        margin: auto;
    }
</style>

<div class="container mt-4">
    <div class="col-lg-12">

        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="mb-3 d-flex justify-content-between flex-wrap">
            <form action="/cari_informasi" method="GET" class="form-inline d-flex flex-wrap gap-2">
                @csrf
                <input type="text" name="kata" class="form-control mr-2 mb-2 mb-md-0" placeholder="Cari...">
                <button type="submit" class="btn btn-success">Cari Informasi</button>
            </form>
            <a href="{{ route('informasi.create') }}" class="btn btn-primary">Tambah Informasi</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul Informasi</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Isi Informasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($informasis as $index => $informasi)
                        <tr>
                            <td>{{ $i + $index + 1 }}</td>
                            <td>
                                <img src="{{ url('/Foto_Informasi/'.$informasi->gambar) }}"
                                     alt="Gambar Informasi"
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                            </td>
                            <td>
                                <div class="judul-informasi" title="{{ $informasi->judul_informasi }}">
                                    {{ $informasi->judul_informasi }}
                                </div>
                            </td>
                            <td>{{ $informasi->kategori }}</td>
                            <td>{{ $informasi->tgl_informasi }}</td>
                            <td>
                                <div class="informasi-content" title="{{ strip_tags($informasi->isi_informasi) }}">
                                    {!! nl2br(e($informasi->isi_informasi)) !!}
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('informasi.destroy', $informasi->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('informasi.edit', $informasi->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Data informasi belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $informasis->links() }}
        </div>

    </div>
</div>

@endsection
