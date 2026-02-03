<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';

    public $timestamps = false; // Karena hanya ada kolom 'waktu' manual/default timestamp

    protected $fillable = [
        'pengguna_id',
        'aksi',
        'target',
        'pesan_naratif',
        'meta_json',
        'waktu',
    ];

    protected $casts = [
        'meta_json' => 'array',
        'waktu' => 'datetime',
    ];

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
