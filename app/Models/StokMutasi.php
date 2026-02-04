<?php

/**
 * Model: StokMutasi
 * Peran: Menangani pencatatan riwayat pergerakan stok barang.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokMutasi extends Model
{
    use HasFactory;

    protected $table = 'stok_mutasi';

    public $timestamps = false; // Kita menggunakan 'waktu'

    protected $fillable = [
        'produk_id',
        'pengguna_id',
        'jumlah_awal',
        'perubahan',
        'jumlah_akhir',
        'jenis',
        'keterangan',
        'waktu',
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];

    /**
     * Relasi ke Produk.
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    /**
     * Relasi ke Operator (Pengguna).
     */
    public function operator()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
