<?php

/**
 * Model: Stok
 * Peran: Mencatat ketersediaan barang
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $table = 'stok';

    protected $fillable = [
        'produk_id',
        'jumlah',
        'catatan',
    ];

    /**
     * Relasi ke Produk.
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
