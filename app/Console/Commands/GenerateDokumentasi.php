<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class GenerateDokumentasi extends Command
{
    /**
     * Nama dan signature command.
     *
     * @var string
     */
    protected $signature = 'dokumentasi:generate';

    /**
     * Deskripsi command.
     *
     * @var string
     */
    protected $description = 'Menghasilkan dokumentasi hidup sistem YALA COMPUTER secara otomatis';

    /**
     * Eksekusi command.
     */
    public function handle()
    {
        $this->info('Memulai pembaruan dokumentasi hidup...');

        // Baca file lama jika ada untuk mempertahankan metadata statis
        $path = storage_path('dokumentasi/dokumentasi_sistem.json');
        $dataLama = [];
        if (File::exists($path)) {
            $dataLama = json_decode(File::get($path), true);
        }

        $dataBaru = [
            'nama_sistem' => 'YALA COMPUTER - Sistem Toko Komputer',
            'versi' => $dataLama['versi'] ?? '1.0.0', // Pertahankan versi manual
            'status' => $dataLama['status'] ?? 'Stabil',
            'bahasa' => '100% Bahasa Indonesia',
            'framework' => 'Laravel ' . app()->version(),
            'waktu_generate' => now()->translatedFormat('l, d F Y H:i:s'),
            'aturan_utama' => [
                "Tanpa Modal (No Modals)",
                "SPA dengan Livewire",
                "SEO Terstruktur",
                "Log Aktivitas Naratif"
            ],
            'struktur_database' => $this->analisisDatabase(),
            'rute_sistem' => $this->analisisRute(),
            'modul_aktif' => $dataLama['modul_aktif'] ?? [],
        ];

        // Pastikan folder ada
        if (!File::exists(dirname($path))) {
            File::makeDirectory(dirname($path), 0755, true);
        }

        File::put($path, json_encode($dataBaru, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        $this->info('Dokumentasi berhasil diperbarui di: ' . $path);
    }

    /**
     * Menganalisis model untuk mendapatkan struktur database.
     */
    private function analisisDatabase()
    {
        $modelsPath = app_path('Models');
        $files = File::allFiles($modelsPath);
        $struktur = [];

        foreach ($files as $file) {
            $modelName = $file->getFilenameWithoutExtension();
            $class = "App\\Models\\$modelName";
            
            if (class_exists($class)) {
                try {
                    $model = new $class;
                    $struktur[$modelName] = [
                        'tabel' => $model->getTable(),
                        'kolom_dapat_diisi' => $model->getFillable(),
                        'tipe_kunci_utama' => $model->getKeyType(),
                        'relasi_perkiraan' => $this->tebakRelasi($class), // Fitur eksperimental
                    ];
                } catch (\Exception $e) {
                    // Abaikan jika model tidak bisa diinstansiasi
                }
            }
        }

        return $struktur;
    }

    /**
     * Menganalisis rute yang terdaftar.
     */
    private function analisisRute()
    {
        $routes = Route::getRoutes();
        $daftar = [];

        foreach ($routes as $route) {
            // Filter rute bawaan framework yang tidak relevan untuk dokumentasi bisnis
            if (!Str::startsWith($route->uri(), '_') && 
                !Str::startsWith($route->uri(), 'sanctum') && 
                !Str::startsWith($route->uri(), 'api')) {
                
                $middleware = $route->gatherMiddleware();
                $akses = in_array('auth', $middleware) ? 'Terbatas (Login)' : 'Publik';
                
                $daftar[] = [
                    'uri' => $route->uri(),
                    'nama_rute' => $route->getName(),
                    'akses' => $akses,
                    'method' => implode('|', $route->methods()),
                ];
            }
        }

        return $daftar;
    }

    /**
     * Mencoba menebak relasi berdasarkan method di model.
     * Membaca file model sebagai string untuk mencari return type relation.
     */
    private function tebakRelasi($class)
    {
        $relasi = [];
        $reflector = new \ReflectionClass($class);
        
        foreach ($reflector->getMethods() as $method) {
            // Abaikan method bawaan Eloquent
            if ($method->class == $class && $method->isPublic()) {
                $returnType = $method->getReturnType();
                if ($returnType && Str::contains($returnType, 'Relations')) {
                    $relasi[] = $method->getName();
                }
            }
        }
        
        return $relasi;
    }
}