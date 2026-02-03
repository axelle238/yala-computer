<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatStok extends Model
{
    protected $table = 'riwayat_stok';

    protected $fillable = [
        'produk_id',
        'pengguna_id',
        'jenis',
        'jumlah',
        'stok_awal',
        'stok_akhir',
        'keterangan',
        'referensi',
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
