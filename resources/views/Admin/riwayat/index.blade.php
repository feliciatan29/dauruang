@extends('admin.layout')

@section('content')
    <div class="container mt-4">
        <div class="col-lg-12">

            <h2 class="mb-3">Riwayat Pesanan</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Jenis Sampah</th>
                            <th>Berat (kg)</th>
                            <th>Total Pesanan</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Bukti Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayats as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->waktu }}</td>
                                <td>{{ $item->telepon }}</td>
                                <td>{{ $item->alamat }}</td>

                                {{-- Jenis Sampah --}}
                                <td>
                                    @php
                                        $jenisSampah = json_decode($item->jenis_sampah, true);
                                    @endphp
                                    @if (is_array($jenisSampah) && count($jenisSampah))
                                        <ul class="list-unstyled mb-0 text-left">
                                            @foreach ($jenisSampah as $sampah)
                                                <li>{{ $sampah['nama'] ?? '-' }}
                                                    ({{ number_format($sampah['jumlah'] ?? 0, 2) }} kg)
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>{{ $item->berat ?? '-' }} kg</td>
                                <td>Rp {{ number_format($item->total_pesanan ?? 0, 0, ',', '.') }}</td>
                                <td>{{ $item->catatan ?? '-' }}</td>

                                <td>
                                    @if ($item->status === 'dibatalkan')
                                        <span class="badge badge-danger">{{ ucfirst($item->status) }}</span>
                                    @elseif ($item->status === 'transaksi berhasil')
                                        <span class="badge badge-success">{{ ucfirst($item->status) }}</span>
                                    @else
                                        <span class="badge badge-secondary">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </td>

                                {{-- Gambar --}}
                                <td>
                                    @php
                                        $gambar = $item->gambar ? 'Foto_Sampah/' . basename($item->gambar) : null;
                                    @endphp

                                    @if ($gambar && file_exists(public_path($gambar)))
                                        <a href="{{ asset($gambar) }}" target="_blank">
                                            <img src="{{ asset($gambar) }}" width="60" height="60"
                                                style="object-fit: cover;" alt="Bukti">
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13">Data riwayat belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
