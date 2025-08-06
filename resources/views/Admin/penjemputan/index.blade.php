@extends('admin.layout')
@section('content')
    <div class="container mt-4">
        <div class="col-lg-12">
            <h2 class="mb-3">Data Jadwal Jemput</h2>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <form action="{{ url('/penjemputan') }}" method="GET" class="mb-3">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <input type="text" name="cari" class="form-control" placeholder="Cari tanggal atau waktu...">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success">Cari</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Nasabah</th>
                            <th>Tanggal Penjemputan</th>
                            <th>Waktu Penjemputan</th>
                            <th>Alamat</th>
                            <th>Berat (kg)</th>
                            <th>Jenis Sampah</th>
                            <th>Status Penjemputan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penjemputans as $penjemputan)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $penjemputan->nama }}</td>
                                <td>{{ $penjemputan->tanggal }}</td>
                                <td>{{ $penjemputan->waktu }}</td>
                                <td>{{ $penjemputan->alamat }}</td>
                                <td>{{ $penjemputan->berat }}</td>
                                {{-- Jenis Sampah --}}
                                <td>
                                    @php
                                        $jenisSampah = json_decode($penjemputan->jenis_sampah, true);
                                    @endphp
                                    @if (is_array($jenisSampah) && count($jenisSampah))
                                        <ul class="list-unstyled mb-0 text-left">
                                            @foreach ($jenisSampah as $sampah)
                                                <li>{{ $sampah['nama'] ?? '-' }}
                                                    ({{ number_format($sampah['jumlah'] ?? 0, 2) }} kg)</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>
                                    <span
                                    class="badge
                                    @if ($penjemputan->status === 'transaksi berhasil') badge-success
                                    @elseif ($penjemputan->status === 'telah diterima') badge-info
                                    @else badge-warning @endif
                                    ">
                                        {{ ucfirst($penjemputan->status) }}
                                    </span>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">Data penjemputan belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
