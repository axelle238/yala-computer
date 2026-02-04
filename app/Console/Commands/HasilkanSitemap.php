<?php

/**
 * Command: HasilkanSitemap
 * Peran: Menghasilkan file sitemap.xml untuk keperluan SEO Technical.
 */

namespace App\Console\Commands;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class HasilkanSitemap extends Command
{
    protected $signature = 'seo:sitemap';

    protected $description = 'Menghasilkan sitemap.xml untuk Google Search Console';

    public function handle(): void
    {
        $this->info('Memulai pembuatan sitemap...');

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // 1. Halaman Statis Utama
        $halaman_statis = [
            ['url' => route('beranda'), 'prioritas' => '1.0', 'frekuensi' => 'daily'],
            ['url' => route('katalog'), 'prioritas' => '0.9', 'frekuensi' => 'daily'],
            ['url' => route('keranjang'), 'prioritas' => '0.5', 'frekuensi' => 'weekly'],
        ];

        foreach ($halaman_statis as $hal) {
            $xml .= $this->buatNode($hal['url'], $hal['prioritas'], $hal['frekuensi']);
        }

        // 2. Dinamis: Produk
        $produk = Produk::where('apakah_aktif', true)->get();
        foreach ($produk as $p) {
            $xml .= $this->buatNode(route('produk.detail', $p->slug), '0.8', 'weekly');
        }

        // 3. Dinamis: Kategori (Filter Katalog)
        $kategori = Kategori::all();
        foreach ($kategori as $k) {
            $xml .= $this->buatNode(route('katalog', ['kategori_terpilih' => $k->slug]), '0.7', 'weekly');
        }

        $xml .= '</urlset>';

        File::put(public_path('sitemap.xml'), $xml);

        $this->info('Sitemap berhasil dibuat di: '.public_path('sitemap.xml'));
    }

    private function buatNode($url, $prioritas, $frekuensi): string
    {
        $node = '<url>';
        $node .= '<loc>'.htmlspecialchars($url).'</loc>';
        $node .= '<lastmod>'.now()->toAtomString().'</lastmod>';
        $node .= '<changefreq>'.$frekuensi.'</changefreq>';
        $node .= '<priority>'.$prioritas.'</priority>';
        $node .= '</url>';

        return $node;
    }
}
