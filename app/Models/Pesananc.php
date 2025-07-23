<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesananc extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'tbl_pesananc';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'gambar',
        'telepon',
        'alamat',
        'tanggal',
        'waktu',
        'catatan',
        'status'
    ];
}
