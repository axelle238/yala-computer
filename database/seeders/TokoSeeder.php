<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Kategori
        $kategoriLaptop = Kategori::create([
            'nama' => 'Laptop & Notebook',
            'slug' => 'laptop-notebook',
        ]);

        $kategoriAksesoris = Kategori::create([
            'nama' => 'Aksesoris Komputer',
            'slug' => 'aksesoris-komputer',
        ]);

        $kategoriSoftware = Kategori::create([
            'nama' => 'Software Original',
            'slug' => 'software-original',
        ]);

        // 2. Buat Produk Dummy
        Produk::create([
            'kategori_id' => $kategoriLaptop->id,
            'nama' => 'ASUS ROG Zephyrus G14',
            'slug' => 'asus-rog-zephyrus-g14',
            'deskripsi_pendek' => 'Laptop gaming ultra-slim dengan performa gahar Ryzen 9.',
            'deskripsi_lengkap' => 'ASUS ROG Zephyrus G14 adalah laptop gaming 14 inci paling kuat di dunia. Mengungguli persaingan dengan CPU AMD Ryzen™ 9 8 Core dan GPU GeForce RTX™ 4060 yang kencang.',
            'harga_modal' => 20000000,
            'harga_jual' => 24500000,
            'stok' => 5,
            'berat_gram' => 1700,
            'spesifikasi_json' => [
                'Processor' => 'AMD Ryzen 9',
                'RAM' => '16GB DDR5',
                'Storage' => '1TB NVMe SSD',
                'GPU' => 'NVIDIA RTX 4060 8GB'
            ],
            'status' => 'aktif',
        ]);

        Produk::create([
            'kategori_id' => $kategoriLaptop->id,
            'nama' => 'MacBook Air M2',
            'slug' => 'macbook-air-m2',
            'deskripsi_pendek' => 'Laptop tipis, ringan, dan bertenaga dengan chip M2.',
            'deskripsi_lengkap' => 'Desain ulang total. Supercharged by M2. MacBook Air terbaru lebih tipis, lebih ringan, dan lebih cepat.',
            'harga_modal' => 15000000,
            'harga_jual' => 18999000,
            'stok' => 10,
            'berat_gram' => 1240,
            'spesifikasi_json' => [
                'Processor' => 'Apple M2 Chip',
                'RAM' => '8GB Unified',
                'Storage' => '256GB SSD',
                'Display' => '13.6 Liquid Retina'
            ],
            'status' => 'aktif',
        ]);

        Produk::create([
            'kategori_id' => $kategoriAksesoris->id,
            'nama' => 'Logitech MX Master 3S',
            'slug' => 'logitech-mx-master-3s',
            'deskripsi_pendek' => 'Mouse produktivitas terbaik dengan klik sunyi.',
            'deskripsi_lengkap' => 'Temui MX Master 3S – mouse ikonik yang diremaster ulang. Rasakan setiap momen alur kerja Anda dengan presisi, taktis, dan performa yang lebih baik.',
            'harga_modal' => 1200000,
            'harga_jual' => 1650000,
            'stok' => 25,
            'berat_gram' => 141,
            'spesifikasi_json' => [
                'DPI' => '8000 DPI',
                'Connectivity' => 'Bluetooth & Logi Bolt',
                'Battery' => 'Up to 70 days'
            ],
            'status' => 'aktif',
        ]);
        
        Produk::create([
            'kategori_id' => $kategoriSoftware->id,
            'nama' => 'Windows 11 Pro OEM',
            'slug' => 'windows-11-pro-oem',
            'deskripsi_pendek' => 'Sistem operasi terbaru dari Microsoft untuk profesional.',
            'deskripsi_lengkap' => 'Windows 11 mendekatkan Anda dengan apa yang Anda sukai. Versi Pro dilengkapi fitur keamanan tingkat lanjut dan manajemen bisnis.',
            'harga_modal' => 2000000,
            'harga_jual' => 2500000,
            'stok' => 100,
            'berat_gram' => 100, // DVD box
            'spesifikasi_json' => [
                'Type' => 'OEM License',
                'Media' => 'DVD Installer',
                'Bit' => '64-bit'
            ],
            'status' => 'aktif',
        ]);
    }
}
