<?php

/**
 * Model: Banner
 * Peran: Representasi data banner promosi
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banner';

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'tautan_tombol',
        'teks_tombol',
        'urutan',
        'apakah_aktif',
    ];

    protected $casts = [
        'apakah_aktif' => 'boolean',
        'urutan' => 'integer',
    ];
}
