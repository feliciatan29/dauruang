<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;
    protected $table = 'profiles';
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'tanggal_lahir',
        'jenis_kelamin',
        'nomor_hp',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
