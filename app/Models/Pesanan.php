<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'tbl_pesananc'; // Ubah ke tabel tbl_pesananc

    protected $fillable = [
        'telepon',
        'alamat',
        'tanggal',
        'waktu',
        'gambar',
        'catatan',
        'status',
    ];
}
