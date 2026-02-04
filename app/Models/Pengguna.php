<?php

/**
 * Model: Pengguna
 * Peran: Menangani otentikasi dan data pengguna sistem (admin/staf)
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\PenggunaFactory> */
    use HasFactory, Notifiable;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'pengguna';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'surel',
        'kata_sandi',
    ];

    /**
     * Atribut yang harus disembunyikan untuk serialisasi.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'kata_sandi',
        'remember_token',
    ];

    /**
     * Dapatkan atribut yang harus di-cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'surel_diverifikasi_pada' => 'datetime',
            'kata_sandi' => 'hashed',
        ];
    }

    /**
     * Relasi ke Log Aktivitas.
     */
    public function log_aktivitas()
    {
        return $this->hasMany(LogAktivitas::class, 'pengguna_id');
    }

    /**
     * Override method untuk mendapatkan password (karena kita menggunakan 'kata_sandi').
     */
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}
