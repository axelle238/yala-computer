<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'pengguna_id',
        'tipe',
        'aksi',
        'target',
        'pesan',
        'pesan_naratif',
        'meta_json',
        'ip_address',
        'user_agent',
    ];

    /**
     * Konversi tipe data atribut.
     */
    protected $casts = [
        'meta_json' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke pengguna yang melakukan aktivitas.
     */
    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}