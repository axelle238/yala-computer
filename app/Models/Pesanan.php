<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $fillable = [
        'nomor_invoice',
        'pengguna_id',
        'total_barang',
        'biaya_pengiriman',
        'total_bayar',
        'status',
        'catatan',
        'informasi_pengiriman_json',
    ];

    protected $casts = [
        'informasi_pengiriman_json' => 'array',
        'total_barang' => 'decimal:2',
        'biaya_pengiriman' => 'decimal:2',
        'total_bayar' => 'decimal:2',
    ];

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function detailPesanan(): HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }
}
