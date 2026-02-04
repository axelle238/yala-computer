<?php

/**
 * Command: HasilkanDokumentasiSistem
 * Peran: Menghasilkan file JSON yang berisi dokumentasi teknis sistem saat ini
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class HasilkanDokumentasiSistem extends Command
{
    /**
     * Nama dan tanda tangan perintah console.
     *
     * @var string
     */
    protected $signature = 'dokumentasi:hasilkan';

    /**
     * Deskripsi perintah console.
     *
     * @var string
     */
    protected $description = 'Menghasilkan dokumentasi sistem otomatis dalam format JSON';

    /**
     * Eksekusi perintah console.
     */
    public function handle(): void
    {
        $this->info('Menghasilkan dokumentasi sistem...');

        $jalurDokumen = storage_path('dokumentasi');
        if (! File::exists($jalurDokumen)) {
            File::makeDirectory($jalurDokumen, 0755, true);
        }

        $data = [
            'nama_sistem' => 'Yala Computer',
            'versi_laravel' => app()->version(),
            'terakhir_diperbarui' => now()->toDateTimeString(),
            'modul_aktif' => [
                'Manajemen Produk',
                'Manajemen Kategori',
                'Manajemen Stok',
                'Manajemen Pesanan',
                'Manajemen Pelanggan',
                'Log Aktivitas Naratif',
                'SEO Teknis',
            ],
            'database' => $this->ambilStrukturDatabase(),
            'endpoint' => $this->ambilDaftarRoute(),
            'status_sistem' => 'Aktif & Stabil',
        ];

        File::put($jalurDokumen.'/dokumentasi_sistem.json', json_encode($data, JSON_PRETTY_PRINT));

        $this->info('Dokumentasi berhasil disimpan di: '.$jalurDokumen.'/dokumentasi_sistem.json');
    }

    /**
     * Mengambil daftar tabel dan kolom.
     */
    private function ambilStrukturDatabase(): array
    {
        $tabelDatabase = [];
        // Kita daftar tabel utama saja untuk dokumentasi
        $daftarTabel = [
            'pengguna', 'kategori', 'produk', 'stok',
            'pelanggan', 'pesanan', 'pesanan_item', 'log_aktivitas',
        ];

        foreach ($daftarTabel as $namaTabel) {
            if (Schema::hasTable($namaTabel)) {
                $tabelDatabase[$namaTabel] = Schema::getColumnListing($namaTabel);
            }
        }

        return $tabelDatabase;
    }

    /**
     * Mengambil daftar route aplikasi.
     */
    private function ambilDaftarRoute(): array
    {
        return collect(Route::getRoutes())->map(function ($route) {
            return [
                'metode' => $route->methods()[0],
                'uri' => $route->uri(),
                'nama' => $route->getName(),
            ];
        })->filter(fn ($r) => ! str_starts_with($r['uri'], '_') && ! str_starts_with($r['uri'], 'sanctum'))->values()->toArray();
    }
}
