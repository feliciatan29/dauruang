@extends('layout')
@section('content')

<div class="col-lg-8 mb-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">Tambah Data Pembayaran</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tgl_pembayaran">Tanggal Pembayaran:</label>
                    <input type="date" name="tgl_pembayaran" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="kd_pembayaran">Kode Pembayaran:</label>
                    <input type="text" name="kd_pembayaran" class="form-control" placeholder="Masukkan Kode Pembayaran" required>
                </div>

                <div class="form-group">
                    <label for="nasabah_id">Nama Nasabah:</label>
                    <select name="nasabah_id" id="nasabah_id" class="form-control" onchange="updateBerat(this.value)" required>
                        <option value="">-- Pilih Nasabah --</option>
                        @foreach ($jadwals as $jadwal)
                            <option value="{{ $jadwal->nasabah_id }}">{{ $jadwal->nm_nasabah }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jenis_id">Jenis Sampah:</label>
                    <select name="jenis_id" id="jenis_id" class="form-control" onchange="updateHarga(this.value)" required>
                        <option value="">-- Pilih Jenis Sampah --</option>
                        @foreach ($jenish as $jenis)
                            <option value="{{ $jenis->id }}">{{ $jenis->nm_jenis }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="berat">Berat (Kg):</label>
                    <input type="number" id="berat" name="berat" class="form-control" placeholder="Otomatis terisi" readonly required>
                </div>

                <div class="form-group">
                    <label for="harga">Harga per Kg:</label>
                    <input type="number" id="harga" name="harga" class="form-control" placeholder="Otomatis terisi" readonly required>
                </div>

                <div class="form-group">
                    <label for="total_harga">Total Harga:</label>
                    <input type="number" id="total_harga" name="total_harga" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <input type="text" id="status" name="status" class="form-control" value='Pending' hidden>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
@endsection

<script>
    // Array untuk menyimpan berat nasabah
    var beratNasabah = {
        @foreach ($jadwals as $jadwal)
            "{{ $jadwal->nasabah_id }}": "{{ $jadwal->berat }}",
        @endforeach
    };

    // Array untuk menyimpan harga jenis sampah
    var hargaJenis = {
        @foreach ($jenish as $jenis)
            "{{ $jenis->id }}": "{{ $jenis->harga }}",
        @endforeach
    };

    function updateBerat(nasabahId) {
        if (nasabahId in beratNasabah) {
            document.getElementById("berat").value = beratNasabah[nasabahId];
        } else {
            document.getElementById("berat").value = "";
        }
        hitungTotal();
    }

    function updateHarga(jenisId) {
        if (jenisId in hargaJenis) {
            document.getElementById("harga").value = hargaJenis[jenisId];
        } else {
            document.getElementById("harga").value = "";
        }
        hitungTotal();
    }

    function hitungTotal() {
        var berat = parseFloat(document.getElementById("berat").value) || 0;
        var harga = parseFloat(document.getElementById("harga").value) || 0;
        var total = berat * harga;
        document.getElementById("total_harga").value = total;
    }
</script>
