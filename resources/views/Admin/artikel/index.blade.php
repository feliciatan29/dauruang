@extends('layout')

@section('content')

<style>
    /* Clamp Isi Artikel dan Judul Artikel ke 5 baris dengan ellipsis */
    .artikel-content,
    .judul-artikel {
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
            <form action="/cari_artikel" method="GET" class="form-inline d-flex flex-wrap gap-2">
                @csrf
                <input type="text" name="kata" class="form-control mr-2 mb-2 mb-md-0" placeholder="Cari...">
                <button type="submit" class="btn btn-success">Cari Data</button>
            </form>
            <a href="{{ route('artikel.create') }}" class="btn btn-primary">Tambah Artikel</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul Artikel</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Tanggal Terbit</th>
                        <th>Isi Artikel</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($artikels as $index => $artikel)
                        <tr>
                            <td>{{ $i + $index + 1 }}</td>
                            <td>
                                <img src="{{ url('/Foto_Artikel/' . $artikel->gambar) }}"
                                     alt="Gambar Artikel"
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                            </td>
                            <td>
                                <div class="judul-artikel" title="{{ $artikel->judul_artikel }}">
                                    {{ $artikel->judul_artikel }}
                                </div>
                            </td>
                            <td>{{ $artikel->nm_penulis }}</td>
                            <td>{{ $artikel->kategori }}</td>
                            <td>{{ $artikel->tgl_terbit }}</td>
                            <td>
                                <div class="artikel-content" title="{{ strip_tags($artikel->isi_artikel) }}">
                                    {!! nl2br(e($artikel->isi_artikel)) !!}
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('artikel.edit', $artikel->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Data artikel belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $artikels->links() }}
        </div>

    </div>
</div>

@endsection
