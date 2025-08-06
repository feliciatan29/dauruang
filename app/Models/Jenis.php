<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;
    public $table = "tbl_jenis";
    protected $fillable = [
    'kd_jenis','nm_jenis','harga_perkilo','gambar'
    ];
}
