<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjemputan extends Model
{
    use HasFactory;
    public $table = "tbl_penjemputan";
    protected $fillable = [
    'nama','tanggal','waktu','alamat','berat','jenis_sampah','status'
    ];
}
