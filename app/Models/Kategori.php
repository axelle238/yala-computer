<?php

/**
 * Model: Kategori
 * Peran: Mengelompokkan produk-produk di toko
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'ikon',
    ];

    /**
     * Relasi ke Produk.
     */
    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}
