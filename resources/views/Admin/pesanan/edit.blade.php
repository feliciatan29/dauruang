@extends('admin.layout')

@section('content')
    <div class="container mt-4">
        <div class="col-lg-10 offset-lg-1">
            <h2 class="mb-4">Edit Data Pesanan</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- DATA UTAMA --}}
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" value="{{ $pesanan->nama }}" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" value="{{ $pesanan->tanggal }}" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label>Waktu</label>
                    <input type="text" value="{{ $pesanan->waktu }}" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" value="{{ $pesanan->telepon }}" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" rows="2" readonly>{{ $pesanan->alamat }}</textarea>
                </div>

                {{-- JENIS SAMPAH --}}
                <div class="form-group mt-4">
                    <label class="form-label">Pilih Jenis Sampah:</label>

                    <div class="row font-weight-bold mb-2 px-2">
                        <div class="col-md-1 text-center">✔</div>
                        <div class="col-md-3">Jenis Sampah</div>
                        <div class="col-md-2">Harga (Rp/kg)</div>
                        <div class="col-md-3">Berat (kg)</div>
                        <div class="col-md-3">Subtotal</div>
                    </div>

                    @php
                        $dataSampah = json_decode($pesanan->jenis_sampah, true);
                    @endphp

                    @foreach ($dataSampah as $index => $item)
                        <div class="border rounded p-3 mb-2 bg-light detail-row">
                            <div class="row align-items-center">
                                <div class="col-md-1 text-center">
                                    <input type="checkbox" name="jenis_sampah[{{ $index }}][checked]"
                                        class="form-check-input sampah-checkbox" value="1"
                                        {{ isset($item['nama']) ? 'checked' : '' }}>
                                </div>

                                <div class="col-md-3">
                                    <input type="text" name="jenis_sampah[{{ $index }}][nama]"
                                        class="form-control" value="{{ $item['nama'] }}" readonly>
                                </div>

                                <div class="col-md-2">
                                    <input type="number" class="form-control harga-input"
                                        name="jenis_sampah[{{ $index }}][harga]" value="{{ $item['harga'] }}"
                                        min="0" step="100" readonly
                                        {{ isset($item['nama']) ? '' : 'disabled' }}>
                                </div>

                                <div class="col-md-3">
                                    <input type="number" class="form-control jumlah-input"
                                        name="jenis_sampah[{{ $index }}][jumlah]" value="{{ $item['jumlah'] }}"
                                        min="0" step="0.01" {{ isset($item['nama']) ? '' : 'disabled' }}>
                                </div>

                                <div class="col-md-3">
                                    <input type="text" class="form-control total-display bg-white" readonly>
                                    <input type="hidden" class="total-hidden"
                                        name="jenis_sampah[{{ $index }}][total]">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- TOTAL BERAT DAN HARGA --}}
                <div class="row mt-3 mb-3">
                    <div class="col-md-6">
                        <label>Total Berat (kg)</label>
                        <input type="text" id="totalBeratFormatted" class="form-control" readonly>
                        <input type="hidden" id="totalBerat" name="berat">
                    </div>
                    <div class="col-md-6">
                        <label>Total Harga (Rp)</label>
                        <input type="text" id="totalHargaFormatted" class="form-control" readonly>
                        <input type="hidden" id="totalHarga" name="total_pesanan">
                    </div>
                </div>

                {{-- CATATAN --}}
                <div class="form-group">
                    <label>Catatan</label>
                    <textarea class="form-control" rows="2" readonly>{{ $pesanan->catatan }}</textarea>
                </div>

                {{-- STATUS --}}
                <div class="form-group">
                    <label>Status Pesanan</label>
                    <select name="status" class="form-control" required>
                        <option value="sedang diproses" {{ $pesanan->status == 'diproses' ? 'selected' : '' }}>
                            Diproses</option>
                        <option value="telah diterima" {{ $pesanan->status == 'telah diterima' ? 'selected' : '' }}>
                            Telah Diterima</option>
                        <option value="transaksi berhasil"
                            {{ $pesanan->status == 'transaksi berhasil' ? 'selected' : '' }}>
                            Transaksi Berhasil</option>
                    </select>
                </div>

                {{-- TOMBOL --}}
                <div class="text-right mt-4">
                    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT UNTUK PERHITUNGAN DAN FILTER --}}
    <script>
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        function updateTotalSemua() {
            let totalBerat = 0;
            let totalHarga = 0;

            document.querySelectorAll('.detail-row').forEach(row => {
                const checkbox = row.querySelector('.sampah-checkbox');
                const harga = row.querySelector('.harga-input');
                const jumlah = row.querySelector('.jumlah-input');
                const totalDisplay = row.querySelector('.total-display');
                const totalHidden = row.querySelector('.total-hidden');

                let subtotal = 0;
                if (checkbox.checked) {
                    let h = parseFloat(harga.value) || 0;
                    let j = parseFloat(jumlah.value) || 0;
                    subtotal = h * j;

                    harga.disabled = false;
                    jumlah.disabled = false;

                    totalBerat += j;
                    totalHarga += subtotal;

                    totalDisplay.value = 'Rp ' + formatRupiah(subtotal);
                    totalHidden.value = subtotal;
                } else {
                    harga.disabled = true;
                    jumlah.disabled = true;
                    jumlah.value = '';
                    harga.value = '';
                    totalDisplay.value = '';
                    totalHidden.value = '';
                }
            });

            document.getElementById('totalBeratFormatted').value = totalBerat.toFixed(2);
            document.getElementById('totalBerat').value = totalBerat.toFixed(2);
            document.getElementById('totalHargaFormatted').value = 'Rp ' + formatRupiah(totalHarga);
            document.getElementById('totalHarga').value = totalHarga.toFixed(0);
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.sampah-checkbox').forEach(cb => {
                cb.addEventListener('change', updateTotalSemua);
            });

            document.querySelectorAll('.harga-input, .jumlah-input').forEach(input => {
                input.addEventListener('input', updateTotalSemua);
            });

            // Kosongkan input yang tidak dicentang saat form dikirim
            const form = document.querySelector('form');
            form.addEventListener('submit', function() {
                document.querySelectorAll('.detail-row').forEach(row => {
                    const checkbox = row.querySelector('.sampah-checkbox');
                    if (!checkbox.checked) {
                        row.querySelectorAll('input, select').forEach(input => {
                            input.disabled = true;
                        });
                    }
                });
            });

            updateTotalSemua();
        });
    </script>

    {{-- STYLE --}}
    <style>
        .sampah-checkbox {
            transform: scale(1.4);
            margin-top: 5px;
        }

        .detail-row:hover {
            background-color: #eef6ff;
        }

        .total-display:disabled {
            background-color: #f3f3f3;
        }
    </style>
@endsection
