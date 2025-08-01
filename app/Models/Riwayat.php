<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    protected $table = 'tbl_riwayat';
    protected $fillable = [
    'gambar',
    'nama',
    'telepon',
    'alamat',
    'tanggal',
    'waktu',
    'catatan',
    'jenis_sampah',
    'berat',
    'total_pesanan',
    'status',
    ];
}
