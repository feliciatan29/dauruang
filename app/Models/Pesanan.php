<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'tbl_pesanan';

    protected $fillable = [
        'tanggal',
        'nama',
        'jenis_sampah',
        'berat',
        'status',
    ];
}
