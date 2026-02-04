<?php

/**
 * Model: LogAktivitas
 * Peran: Mencatat jejak aksi pengguna dalam sistem secara naratif
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';

    /**
     * Menonaktifkan timestamps default karena kita menggunakan 'waktu'.
     */
    public $timestamps = false;

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

    /**
     * Relasi ke Pengguna.
     */
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
