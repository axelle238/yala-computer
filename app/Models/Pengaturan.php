<?php

/**
 * Model: Pengaturan
 * Peran: Menyimpan konfigurasi dinamis aplikasi
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;

    protected $table = 'pengaturan';

    protected $fillable = [
        'kunci',
        'nilai',
        'grup',
    ];

    /**
     * Helper untuk mendapatkan nilai pengaturan berdasarkan kunci.
     */
    public static function ambil(string $kunci, mixed $default = null)
    {
        return self::where('kunci', $kunci)->first()?->nilai ?? $default;
    }
}
