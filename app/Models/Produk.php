<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'kategori_id',
        'nama',
        'slug',
        'deskripsi_pendek',
        'deskripsi_lengkap',
        'harga_modal',
        'harga_jual',
        'stok',
        'berat_gram',
        'spesifikasi_json',
        'gambar_json',
        'status',
    ];

    protected $casts = [
        'spesifikasi_json' => 'array',
        'gambar_json' => 'array',
        'harga_modal' => 'decimal:2',
        'harga_jual' => 'decimal:2',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
