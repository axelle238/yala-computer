<?php

/**
 * Model: PesananItem
 * Peran: Detail barang dalam satu pesanan
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananItem extends Model
{
    use HasFactory;

    protected $table = 'pesanan_item';

    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'kuantitas',
        'harga_satuan',
        'subtotal',
    ];

    /**
     * Relasi ke Pesanan.
     */
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    /**
     * Relasi ke Produk.
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
