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
use App\Http\Controllers\BerandaNasabahController;
use App\Http\Controllers\ProfilesController;
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
Route::get('/admin.beranda', [BerandaController::class, 'index'])->name('admin.beranda');

// Artikel
Route::resource('artikel', ArtikelController::class);
Route::get('/cari_artikel', [ArtikelController::class, 'cari_artikel']);

// Informasi
Route::resource('informasi', InformasiController::class);
Route::get('/cari_informasi', [InformasiController::class, 'cari_informasi']);


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('nasabah', NasabahController::class);
});



// Penjemputan
Route::resource('penjemputan', PenjemputanController::class);
Route::patch('penjemputan/{id}/status', [PenjemputanController::class, 'updateStatus'])->name('penjemputan.updateStatus');

// Jenis Sampah
Route::resource('jenis', JenisController::class);
Route::get('/cari_jenis', [JenisController::class, 'cari_jenis']);

// Pesanan
Route::resource('pesanan', PesananController::class);
Route::post('/pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');

// Riwayat
Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index'); // Remove duplicate




// Route for nasabah
Route::get('/beranda-nasabah', [BerandaNasabahController::class, 'index'])->name('beranda.nasabah');

Route::get('/pesananc/diproses', function () {
    $pesananc = Pesananc::where('status', 'diproses')->get();
    return view('nasabah.pesananc.diproses', compact('pesananc'));
}); // Ensure auth middleware is applied

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
// Route untuk daftar pesananc diproses
Route::get('/pesananc/diproses', [PesanancController::class, 'diproses'])->name('pesananc.diproses');

// Simpan data form ke session
Route::post('/form/simpan-sementara', [PesanancController::class, 'simpanSementara'])->name('nasabah.form.simpanSementara');
Route::get('/reset-form', function () {
    session()->forget('form_sementara');
    return redirect()->route('nasabah.pesananc.form');
});
Route::get('/nasabah/pesananc/diproses', [PesanancController::class, 'diproses'])->name('pesananc.diproses');

Route::post('/nasabah/pesananc/submit', [PesanancController::class, 'submit'])->name('nasabah.pesananc.submit');


// Tampilkan halaman keranjang
Route::get('/keranjang', [PesanancController::class, 'keranjang'])->name('pesananc.keranjang');

// Tampilkan form lagi (jika perlu kembali)
Route::get('/formulir', [PesanancController::class, 'formulir'])->name('nasabah.pesananc.formulir');
Route::post('/pesananc/submit', [PesanancController::class, 'submit'])->name('nasabah.pesananc.submit');

Route::get('/profil-saya', function () {
    return view('nasabah.pesananc.profil');
})->name('profil');

Route::middleware(['auth'])->group(function () {
    Route::post('/profile', [ProfilesController::class, 'update'])->name('profile.update');
});

Route::put('/profile', [ProfilesController::class, 'update'])->name('profile.update');
Route::get('/profil/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profiles.edit');
Route::put('/profil/update/{id}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profiles.update');
Route::get('/profile', [ProfilesController::class, 'show'])->name('profiles.show');

Route::prefix('nasabah')->name('nasabah.')->group(function () {
    Route::get('/pesananc/formulir', [PesanancController::class, 'formulir'])->name('pesananc.formulir');
});


Route::prefix('nasabah')->name('nasabah.')->group(function () {
    Route::get('/pesananc/formulir', [PesanancController::class, 'formulir'])->name('pesananc.formulir');
});
//baru ni 
//status telah diterima
Route::get('/nasabah/pesananc/diterima', [PesanancController::class, 'diterima'])->name('pesananc.diterima');
//status transaksi berhasil 
Route::get('/nasabah/pesananc/transaksi_berhasil', [PesanancController::class, 'transaksi_berhasil'])->name('pesananc.transaksi_berhasil');

Route::post('/pesananc/pilihjenis', [PesanancController::class, 'pilihjenis'])->name('nasabah.pesananc.pilihjenis');
