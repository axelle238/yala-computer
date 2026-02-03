<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class GenerateDokumentasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dokumentasi:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate dokumentasi sistem otomatis (JSON)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai generasi dokumentasi...');

        $data = [
            'nama_sistem' => 'Yala Computer System',
            'waktu_generate' => now()->toDateTimeString(),
            'versi_laravel' => app()->version(),
            'database' => $this->getDatabaseStructure(),
            'routes' => $this->getRoutes(),
            'modul_aktif' => [
                'Otentikasi (Fortify)',
                'Manajemen Produk',
                'Manajemen Pesanan',
                'Log Aktivitas',
                'Frontend Toko',
                'Dashboard Admin'
            ]
        ];

        $path = storage_path('dokumentasi');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        File::put($path . '/dokumentasi_sistem.json', json_encode($data, JSON_PRETTY_PRINT));

        $this->info('Dokumentasi berhasil dibuat di: ' . $path . '/dokumentasi_sistem.json');
    }

    private function getDatabaseStructure()
    {
        $modelsPath = app_path('Models');
        $files = File::allFiles($modelsPath);
        $structures = [];

        foreach ($files as $file) {
            $modelName = $file->getFilenameWithoutExtension();
            $class = "App\\Models\\$modelName";
            
            if (class_exists($class)) {
                $model = new $class;
                $structures[] = [
                    'model' => $modelName,
                    'tabel' => $model->getTable(),
                    'primary_key' => $model->getKeyName(),
                    'fillable' => $model->getFillable(),
                ];
            }
        }

        return $structures;
    }

    private function getRoutes()
    {
        $routes = Route::getRoutes();
        $list = [];

        foreach ($routes as $route) {
            if (!Str::startsWith($route->uri(), '_') && !Str::startsWith($route->uri(), 'sanctum')) {
                $list[] = [
                    'method' => implode('|', $route->methods()),
                    'uri' => $route->uri(),
                    'name' => $route->getName(),
                    'action' => $route->getActionName(),
                ];
            }
        }

        return $list;
    }
}
