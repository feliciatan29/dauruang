<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;
    protected $table = 'tbl_nasabah'; // Nama tabel di database
    protected $fillable = [
        'kd_nasabah',
        'nm_nasabah',
        'alamat',
        'jenis_nasabah',
        'no_telephone',
        'tgl_daftar',
        'status',
        'gambar',
    ];
}
