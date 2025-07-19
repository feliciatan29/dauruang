<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;
    public $table = "tbl_informasi";
    protected $fillable = [
    'judul_informasi','kategori','tgl_informasi','isi_informasi','gambar'
    ];
}
