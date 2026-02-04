<?php

/**
 * Model: Pelanggan
 * Peran: Menyimpan data pembeli
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pelanggan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pelanggan';

    protected $fillable = [
        'nama',
        'surel',
        'telepon',
        'alamat',
        'kata_sandi',
    ];

    protected $hidden = [
        'kata_sandi',
    ];

    /**
     * Relasi ke Pesanan.
     */
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'pelanggan_id');
    }
}
