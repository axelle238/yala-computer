<?php

/**
 * Model: Pesanan
 * Peran: Mencatat transaksi pembelian
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'nomor_invoice',
        'pelanggan_id',
        'total_harga',
        'status_pembayaran',
        'status_pesanan',
        'catatan_pembeli',
    ];

    /**
     * Relasi ke Pelanggan.
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    /**
     * Relasi ke PesananItem.
     */
    public function item()
    {
        return $this->hasMany(PesananItem::class, 'pesanan_id');
    }
}
