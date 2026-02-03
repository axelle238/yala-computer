<?php

namespace Database\Seeders;

use App\Models\Pengguna;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat Admin
        Pengguna::factory()->create([
            'nama' => 'Administrator',
            'email' => 'admin@yala.com',
            'peran' => 'admin',
            'password' => bcrypt('password'), // Sebaiknya default password
        ]);

        // Buat Pelanggan Test
        Pengguna::factory()->create([
            'nama' => 'Pelanggan Test',
            'email' => 'pelanggan@yala.com',
            'peran' => 'pelanggan',
        ]);
    }
}