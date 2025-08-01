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

    // Ambil data jenis sampah terbanyak (masih dalam bentuk JSON string)
   $rawJenisSampah = DB::table('tbl_riwayat')
    ->select(DB::raw("TRIM(BOTH '\"[]' FROM jenis_sampah) as jenis_sampah"), DB::raw('COUNT(*) as total'))
    ->groupBy('jenis_sampah')
    ->orderByDesc('total')
    ->first();

    // Proses agar hanya menampilkan nama jenis sampah (tanpa JSON/array)
    $jenisSampahTerbanyak = null;

    if ($rawJenisSampah) {
        $decoded = json_decode($rawJenisSampah->jenis_sampah, true);

        if (is_array($decoded)) {
            // Ambil hanya nama-nya dan gabungkan
            $namaJenis = implode(', ', array_column($decoded, 'nama'));
        } else {
            $namaJenis = $rawJenisSampah->jenis_sampah; // fallback jika bukan JSON
        }

        $jenisSampahTerbanyak = (object) [
            'jenis_sampah' => $namaJenis,
            'total' => $rawJenisSampah->total
        ];
    }

    $totalSampahKg = Pesananc::sum('berat');

    return view('admin.beranda', compact(
        'totalNasabah',
        'totalPenjemputan',
        'jadwalSelesai',
        'jenisSampahTerbanyak',
        'totalSampahKg'
    ));
}

    // Fungsi lainnya tetap default (tidak digunakan di beranda)
    public function create() {}
    public function store(Request $request) {}
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
