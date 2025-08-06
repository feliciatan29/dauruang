@extends('admin.layout')

@section('content')
    <div class="container mt-4">
        <div class="col-lg-12">

            <h2 class="mb-3">Data Pesanan Nasabah</h2>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesanans as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
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
                                                    ({{ number_format($sampah['jumlah'] ?? 0, 2) }} kg)</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>{{ number_format($item->berat, 2) }} kg</td>
                                <td>Rp {{ number_format($item->total_pesanan, 0, ',', '.') }}</td>
                                <td>{{ $item->catatan ?? '-' }}</td>

                                {{-- Status --}}
                                <td>
                                    @php
                                        $badgeClass = match ($item->status) {
                                            'transaksi berhasil' => 'success',
                                            'telah diterima' => 'info',
                                            default => 'warning',
                                        };
                                    @endphp
                                    <span class="badge badge-{{ $badgeClass }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>

                                {{-- Gambar --}}
                                <td>
                                    @if ($item->gambar && file_exists(public_path($item->gambar)))
                                        <a href="{{ asset($item->gambar) }}" target="_blank">
                                            <img src="{{ asset($item->gambar) }}" width="60" height="60"
                                                style="object-fit:cover;" alt="Bukti Gambar">
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td>
                                    <form action="{{ route('pesanan.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('pesanan.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning mb-1">Edit</a>
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center">Data pesanan belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
