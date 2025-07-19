@extends('layout')

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
                        <th>Nama</th>
                        <th>Jenis Sampah</th>
                        <th>Berat (kg)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayats as $key => $riwayat)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $riwayat->tanggal }}</td>
                            <td>{{ $riwayat->nama }}</td>
                            <td>{{ $riwayat->jenis_sampah }}</td>
                            <td>{{ $riwayat->berat }}</td>
                            <td>
                                <span class="badge badge-{{ 
                                    $riwayat->status === 'done' ? 'success' : 
                                    ($riwayat->status === 'process' ? 'info' : 'warning') 
                                }}">
                                    {{ ucfirst($riwayat->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Data riwayat belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
