<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PenjemputanController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PesanancController;
use App\Models\Pesananc;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root ke halaman login
Route::get('/', function () {
    return redirect('/login');
});

// Login & Logout
Route::get('/login', [UserController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Dashboard (Beranda)
Route::get('/admin.beranda', [BerandaController::class, 'index'])->name('admin.beranda')->middleware('auth');


// Artikel
Route::resource('artikel', ArtikelController::class)->middleware('auth');
Route::get('/cari_artikel', [ArtikelController::class, 'cari_artikel'])->middleware('auth');

// Informasi
Route::resource('informasi', InformasiController::class)->middleware('auth');
Route::get('/cari_informasi', [InformasiController::class, 'cari_informasi'])->middleware('auth');

// Nasabah
Route::resource('nasabah', NasabahController::class)->middleware('auth');

// Petugas
Route::resource('petugas', PetugasController::class)->parameters([
    'petugas' => 'petugas',
])->middleware('auth');

// Penjemputan
Route::resource('penjemputan', PenjemputanController::class)->middleware('auth');
Route::patch('penjemputan/{id}/status', [PenjemputanController::class, 'updateStatus'])->name('penjemputan.updateStatus');

// Jenis Sampah
Route::resource('jenis', JenisController::class)->parameters([
    'jenis' => 'jenis',
])->middleware('auth');
Route::get('/cari_jenis', [JenisController::class, 'cari_jenis'])->middleware('auth');

// Transaksi
Route::resource('transaksi', TransaksiController::class)->middleware('auth');

// Jadwal (Pencarian umum)
Route::get('/cari', [JadwalController::class, 'cari'])->middleware('auth');

// Pesanan
Route::resource('pesanan', PesananController::class);
Route::post('/pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');


Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index')->middleware('auth');

//route nasabah

Route::get('/beranda-nasabah', function () {
    return view('nasabah.beranda');
});

Route::get('/pesananc/diproses', function () {
    $pesananc = pesananc::where('status', 'diproses')->get();
    return view('nasabah.pesananc.diproses', compact('pesananc')); // ← INI WAJIB ADA
});


// Form pilih jenis
Route::get('/pesananc/pilihjenis', function () {
    return view('nasabah.pesananc.pilihjenis');
})->name('pesananc.pilihjenis');

// Formulir pengiriman
Route::get('/pesananc/form', [PesanancController::class, 'create'])->name('nasabah.pesananc.form');
Route::post('/pesananc/store', [PesanancController::class, 'store'])->name('nasabah.pesananc.store');

// Halaman berhasil
Route::get('/pesananc/berhasil', function () {
    return view('nasabah.pesananc.berhasil');
})->name('pesananc.berhasil');

// Lihat detail pesananc
Route::get('/pesananc/{id}', [PesanancController::class, 'show'])->name('nasabah.pesananc.detail');

// Batalkan pesananc
Route::delete('/pesananc/{id}/batal', [PesanancController::class, 'destroy'])->name('nasabah.pesananc.batal');

// Simpan data session keranjang
Route::post('/pesananc/session', [PesanancController::class, 'simpanSession'])->name('nasabah.pesananc.session');
Route::get('/pesananc/diproses', [PesanancController::class, 'diproses'])->name('pesananc.diproses');

