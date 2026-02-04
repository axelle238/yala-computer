<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SeederKategori extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama' => 'Laptop', 'ikon' => 'fas fa-laptop'],
            ['nama' => 'Komputer Rakitan', 'ikon' => 'fas fa-desktop'],
            ['nama' => 'Monitor', 'ikon' => 'fas fa-tv'],
            ['nama' => 'Keyboard & Mouse', 'ikon' => 'fas fa-keyboard'],
            ['nama' => 'Sparepart', 'ikon' => 'fas fa-microchip'],
        ];

        foreach ($kategori as $kat) {
            Kategori::create([
                'nama' => $kat['nama'],
                'slug' => Str::slug($kat['nama']),
                'ikon' => $kat['ikon'],
            ]);
        }
    }
}
