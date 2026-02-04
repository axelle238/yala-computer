<?php

/**
 * Seeder: SeederPenggunaUtama
 * Peran: Membuat akun administrator awal untuk sistem
 */

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SeederPenggunaUtama extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        Pengguna::create([
            'nama' => 'Admin Yala Computer',
            'surel' => 'admin@yalacomputer.com',
            'kata_sandi' => Hash::make('password123'),
        ]);
    }
}
