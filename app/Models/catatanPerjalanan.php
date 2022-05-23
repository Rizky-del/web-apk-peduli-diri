<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catatanPerjalanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'chek_in',
        'chek_out',
        'lokasi_kunjung',
        'suhu_tubuh',
        'gambar_lokasi',
        'deskripsi',
    ];
}
