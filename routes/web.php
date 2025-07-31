<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\PenjemputanController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PesanancController;
use App\Models\Pesananc;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root to login page
Route::get('/', fn() => redirect('/login'));

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


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('nasabah', NasabahController::class);
});



// Penjemputan
Route::resource('penjemputan', PenjemputanController::class)->middleware('auth');
Route::patch('penjemputan/{id}/status', [PenjemputanController::class, 'updateStatus'])->name('penjemputan.updateStatus');

// Jenis Sampah
Route::resource('jenis', JenisController::class)->middleware('auth');
Route::get('/cari_jenis', [JenisController::class, 'cari_jenis'])->middleware('auth');

// Pesanan
Route::resource('pesanan', PesananController::class)->middleware('auth');
Route::post('/pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');

// Riwayat
Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index')->middleware('auth'); // Remove duplicate

// Route for nasabah
Route::get('/beranda-nasabah', fn() => view('nasabah.beranda'))->middleware('auth');

Route::get('/pesananc/diproses', function () {
    $pesananc = Pesananc::where('status', 'diproses')->get();
    return view('nasabah.pesananc.diproses', compact('pesananc'));
})->middleware('auth'); // Ensure auth middleware is applied

// Form pilih jenis
Route::get('/pesananc/pilihjenis', function () {
    return view('nasabah.pesananc.pilihjenis');
})->name('pesananc.pilihjenis')->middleware('auth');

// Formulir pengiriman
Route::get('/pesananc/form', [PesanancController::class, 'create'])->name('nasabah.pesananc.form')->middleware('auth');
Route::post('/pesananc/store', [PesanancController::class, 'store'])->name('nasabah.pesananc.store')->middleware('auth');

// Halaman berhasil
Route::get('/pesananc/berhasil', function () {
    return view('nasabah.pesananc.berhasil');
})->name('pesananc.berhasil')->middleware('auth');

// Lihat detail pesananc
Route::get('/pesananc/{id}', [PesanancController::class, 'show'])->name('nasabah.pesananc.detail')->middleware('auth');

// Batalkan pesananc
Route::delete('/pesananc/{id}/batal', [PesanancController::class, 'destroy'])->name('nasabah.pesananc.batal')->middleware('auth');

// Simpan data session keranjang
Route::post('/pesananc/session', [PesanancController::class, 'simpanSession'])->name('nasabah.pesananc.session')->middleware('auth');
// Route untuk daftar pesananc diproses
Route::get('/pesananc/diproses', [PesanancController::class, 'diproses'])->name('pesananc.diproses')->middleware('auth');

// Simpan data form ke session
Route::post('/form/simpan-sementara', [PesanancController::class, 'simpanSementara'])->name('nasabah.form.simpanSementara');
Route::get('/reset-form', function () {
    session()->forget('form_sementara');
    return redirect()->route('nasabah.pesananc.form');
});

// Tampilkan halaman keranjang
Route::get('/keranjang', [PesanancController::class, 'keranjang'])->name('pesananc.keranjang');

// Tampilkan form lagi (jika perlu kembali)
Route::get('/formulir', [PesanancController::class, 'formulir'])->name('nasabah.pesananc.formulir');
Route::post('/pesananc/submit', [PesanancController::class, 'submit'])->name('nasabah.pesananc.submit');

