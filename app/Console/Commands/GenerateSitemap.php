<?php

namespace App\Console\Commands;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Command GenerateSitemap
 * Tujuan: Menghasilkan file sitemap.xml secara otomatis berdasarkan data produk dan kategori.
 */
class GenerateSitemap extends Command
{
    protected $signature = 'seo:sitemap';
    protected $description = 'Menghasilkan file sitemap.xml untuk SEO';

    public function handle()
    {
        $this->info('Memulai pembuatan sitemap...');

        $urls = [];
        $baseUrl = config('app.url');

        // Halaman Utama
        $urls[] = [
            'loc' => $baseUrl,
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'daily',
            'priority' => '1.0'
        ];

        // Produk Aktif
        $produk = Produk::where('status', 'aktif')->get();
        foreach ($produk as $p) {
            $urls[] = [
                'loc' => $baseUrl . '/produk/' . $p->slug,
                'lastmod' => $p->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ];
        }

        // Kategori
        $kategori = Kategori::all();
        foreach ($kategori as $k) {
            $urls[] = [
                'loc' => $baseUrl . '/kategori/' . $k->slug,
                'lastmod' => $k->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.5'
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($url['loc']) . '</loc>';
            $xml .= '<lastmod>' . $url['lastmod'] . '</lastmod>';
            $xml .= '<changefreq>' . $url['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $url['priority'] . '</priority>';
            $xml .= '</url>';
        }
        
        $xml .= '</urlset>';

        File::put(public_path('sitemap.xml'), $xml);

        $this->info('Sitemap berhasil dibuat di: ' . public_path('sitemap.xml'));
    }
}
