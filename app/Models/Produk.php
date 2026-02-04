<?php

/**
 * Model: Produk
 * Peran: Menyimpan informasi detail produk komputer
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'kategori_id',
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'gambar_utama',
        'galeri_gambar',
        'apakah_aktif',
        'apakah_unggulan',
        'meta_judul',
        'meta_deskripsi',
    ];

    protected $casts = [
        'galeri_gambar' => 'array',
        'apakah_aktif' => 'boolean',
        'apakah_unggulan' => 'boolean',
        'harga' => 'decimal:2',
    ];

    /**
     * Relasi ke Kategori.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Relasi ke Stok.
     */
    public function stok()
    {
        return $this->hasOne(Stok::class, 'produk_id');
    }

    /**
     * Dapatkan jumlah stok saat ini.
     */
    public function getJumlahStokAttribute()
    {
        return $this->stok?->jumlah ?? 0;
    }
}
