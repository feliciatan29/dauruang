<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjemputan extends Model
{
    use HasFactory;
    public $table = "tbl_penjemputan";
    protected $fillable = [
    'nm_nasabah','tgl_penjemputan','waktu_penjemputan','alamat','berat','status','gambar_sampah'
    ];
}
