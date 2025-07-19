<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    public $table = "tbl_artikel";
    protected $fillable = [
    'judul_artikel','nm_penulis','kategori','tgl_terbit','isi_artikel','gambar'
    ];
}
