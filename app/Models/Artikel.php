<?php

/**
 * Model: Artikel
 * Peran: Menangani data konten blog dan informasi SEO.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = [
        'pengguna_id',
        'judul',
        'slug',
        'konten',
        'gambar_sampul',
        'kategori',
        'apakah_diterbitkan',
        'meta_judul',
        'meta_deskripsi',
    ];

    protected $casts = [
        'apakah_diterbitkan' => 'boolean',
    ];

    /**
     * Relasi ke Penulis (Pengguna).
     */
    public function penulis()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
