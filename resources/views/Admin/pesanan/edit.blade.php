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
                        <div class="col-md-1">Pilih</div>
                        <div class="col-md-3">Jenis Sampah</div>
                        <div class="col-md-2">Harga (Rp/kg)</div>
                        <div class="col-md-2">Berat (kg)</div>
                        <div class="col-md-2">Subtotal</div>
                    </div>

                    @php
                        $jenisSampah = $jenisSampah ?? (json_decode($pesanan->jenis_sampah, true) ?? []);
                    @endphp

                    @foreach ($jenisSampah as $index => $item)
                        @php
                            $namaVal = $item['nama'] ?? '';
                            $hargaVal = isset($item['harga']) ? $item['harga'] : 0;
                            $jumlahVal = isset($item['jumlah']) ? $item['jumlah'] : 0;
                            $totalVal = isset($item['total']) ? $item['total'] : $hargaVal * $jumlahVal;
                            $checked = !isset($item['checked']) || $item['checked'] ? 'checked' : '';
                        @endphp

                        <div class="row mb-2 detail-row align-items-center">
                            <!-- Checkbox -->
                            <div class="col-md-1 text-center">
                                <input type="checkbox" class="check-input"
                                    name="jenis_sampah[{{ $index }}][checked]" value="1" {{ $checked }}>
                            </div>

                            <!-- Jenis Sampah -->
                            <div class="col-md-3">
                                <select name="jenis_sampah[{{ $index }}][nama]" class="form-control jenis-select" data-index="{{ $index }}">
                                    <option value="">-- Pilih Jenis --</option>
                                    @foreach ($allJenis as $jenis)
                                        <option value="{{ $jenis->nm_jenis }}" data-harga="{{ $jenis->harga_perkilo }}"
                                            {{ $namaVal == $jenis->nm_jenis ? 'selected' : '' }}>
                                            {{ $jenis->nm_jenis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Harga -->
                            <div class="col-md-2">
                                <input type="number" class="form-control harga-input"
                                    name="jenis_sampah[{{ $index }}][harga]" value="{{ $hargaVal }}"
                                    min="0" step="100">
                            </div>

                            <!-- Berat -->
                            <div class="col-md-2">
                                <input type="number" class="form-control jumlah-input"
                                    name="jenis_sampah[{{ $index }}][jumlah]" value="{{ $jumlahVal }}"
                                    min="0" step="0.1">
                            </div>

                            <!-- Subtotal -->
                            <div class="col-md-2">
                                <input type="number" class="form-control total-input"
                                    name="jenis_sampah[{{ $index }}][total]" value="{{ $totalVal }}" readonly>
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
                        <option value="sedang diproses" {{ $pesanan->status == 'sedang diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="telah diterima" {{ $pesanan->status == 'telah diterima' ? 'selected' : '' }}>Telah Diterima</option>
                        <option value="transaksi berhasil" {{ $pesanan->status == 'transaksi berhasil' ? 'selected' : '' }}>Transaksi Berhasil</option>
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

    {{-- SCRIPT --}}
    <script>
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        function updateTotal(row) {
            const checkbox = row.querySelector('.check-input');
            const hargaInput = row.querySelector('.harga-input');
            const jumlahInput = row.querySelector('.jumlah-input');
            const totalInput = row.querySelector('.total-input');

            if (checkbox.checked) {
                const harga = parseFloat(hargaInput.value) || 0;
                const jumlah = parseFloat(jumlahInput.value) || 0;
                totalInput.value = harga * jumlah;
            } else {
                totalInput.value = 0;
            }
            updateTotalSemua();
        }

        function updateTotalSemua() {
            let totalBerat = 0;
            let totalHarga = 0;

            document.querySelectorAll('.detail-row').forEach(row => {
                const checkbox = row.querySelector('.check-input');
                const jumlah = parseFloat(row.querySelector('.jumlah-input').value) || 0;
                const total = parseFloat(row.querySelector('.total-input').value) || 0;

                if (checkbox.checked) {
                    totalBerat += jumlah;
                    totalHarga += total;
                }
            });

            document.getElementById('totalBeratFormatted').value = totalBerat.toFixed(2);
            document.getElementById('totalBerat').value = totalBerat.toFixed(2);
            document.getElementById('totalHargaFormatted').value = 'Rp ' + formatRupiah(totalHarga);
            document.getElementById('totalHarga').value = Math.round(totalHarga);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // auto isi harga saat pilih jenis
            document.querySelectorAll('.jenis-select').forEach(select => {
                select.addEventListener('change', function() {
                    const hargaInput = this.closest('.detail-row').querySelector('.harga-input');
                    const selectedOption = this.options[this.selectedIndex];
                    const harga = selectedOption.getAttribute('data-harga');
                    hargaInput.value = harga ? harga : 0;
                    updateTotal(this.closest('.detail-row'));
                });
            });

            // update saat harga/jumlah berubah
            document.querySelectorAll('.harga-input, .jumlah-input').forEach(input => {
                input.addEventListener('input', function() {
                    updateTotal(this.closest('.detail-row'));
                });
            });

            // update saat checkbox berubah
            document.querySelectorAll('.check-input').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateTotal(this.closest('.detail-row'));
                });
            });

            // inisialisasi perhitungan awal
            updateTotalSemua();
        });
    </script>
@endsection
