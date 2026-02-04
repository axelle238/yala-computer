<?php

/**
 * Komponen: Publik\Beranda
 * Peran: Halaman utama toko yang menampilkan promo, kategori, dan produk unggulan.
 */

namespace App\Livewire\Publik;

use App\Models\Banner;
use App\Models\Kategori;
use App\Models\Produk;
use Livewire\Component;

class Beranda extends Component
{
    /**
     * Render komponen beranda.
     */
    public function render()
    {
        return view('livewire.publik.beranda', [
            'daftar_banner' => Banner::where('apakah_aktif', true)->orderBy('urutan')->get(),
            'produk_unggulan' => Produk::with('kategori', 'stok')
                ->where('apakah_aktif', true)
                ->where('apakah_unggulan', true)
                ->latest()
                ->take(8)
                ->get(),

            'produk_terbaru' => Produk::with('kategori', 'stok')
                ->where('apakah_aktif', true)
                ->latest()
                ->take(8)
                ->get(),

            'kategori_populer' => Kategori::take(6)->get(),
        ])->layout('components.layouts.publik');
    }
}
