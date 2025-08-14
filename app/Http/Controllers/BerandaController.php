<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nasabah;
use App\Models\Riwayat;
use App\Models\Pesananc;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index()
    {
        $totalNasabah = Nasabah::count();
        $totalPenjemputan = Riwayat::count();
        $jadwalSelesai = Riwayat::where('status', 'transaksi berhasil')->count();

        // Ambil data jenis sampah terbanyak
        $rawJenisSampah = DB::table('tbl_riwayat')
            ->select(DB::raw("TRIM(BOTH '\"[]' FROM jenis_sampah) as jenis_sampah"), DB::raw('COUNT(*) as total'))
            ->groupBy('jenis_sampah')
            ->orderByDesc('total')
            ->first();

        $jenisSampahTerbanyak = null;
        if ($rawJenisSampah) {
            $decoded = json_decode($rawJenisSampah->jenis_sampah, true);
            $namaJenis = is_array($decoded) ? implode(', ', array_column($decoded, 'nama')) : $rawJenisSampah->jenis_sampah;

            $jenisSampahTerbanyak = (object) [
                'jenis_sampah' => $namaJenis,
                'total' => $rawJenisSampah->total
            ];
        }

        $totalSampahKg = Pesananc::sum('berat');

        // Artikel & Informasi
        $artikels = DB::table('tbl_artikel')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        $informasi = DB::table('tbl_informasi')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        // Grafik Uang Masuk per Bulan (pakai kolom `tanggal`)
        $uangMasuk = DB::table('tbl_riwayat')
            ->select(
                DB::raw('YEAR(tanggal) as tahun'),
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(total_pesanan) as total')
            )
            ->groupBy(DB::raw('YEAR(tanggal)'), DB::raw('MONTH(tanggal)'))
            ->orderBy(DB::raw('YEAR(tanggal)'))
            ->orderBy(DB::raw('MONTH(tanggal)'))
            ->get();

        $labels = [];
        $dataUangMasuk = [];
        foreach ($uangMasuk as $row) {
            $labels[] = date('F Y', mktime(0, 0, 0, $row->bulan, 1, $row->tahun));
            $dataUangMasuk[] = $row->total;
        }

        // Rasio Pengembalian Sampah (dalam persentase)
        $totalSampahMasuk = DB::table('tbl_riwayat')->sum('berat'); // kolom berat_sampah harus ada
        $totalSampahDiolah = DB::table('tbl_riwayat')
            ->where('status', 'transaksi berhasil')
            ->sum('berat');

        $rasioPengembalian = $totalSampahMasuk > 0
            ? round(($totalSampahDiolah / $totalSampahMasuk) * 100, 1)
            : 0;

        return view('admin.beranda', compact(
            'totalNasabah',
            'totalPenjemputan',
            'jadwalSelesai',
            'jenisSampahTerbanyak',
            'totalSampahKg',
            'artikels',
            'informasi',
            'labels',
            'dataUangMasuk',
            'rasioPengembalian'
        ));
    }
}
