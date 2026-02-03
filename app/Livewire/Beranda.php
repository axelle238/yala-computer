<?php

namespace App\Livewire;

use App\Models\Produk;
use Livewire\Component;

class Beranda extends Component
{
    use \App\Concerns\PunyaMetaSEO;

    public function render()
    {
        $this->aturSEO(
            'Toko Komputer Terlengkap & Terpercaya',
            'Cari Laptop, Komponen PC, dan Aksesoris berkualitas hanya di Yala Computer. Garansi resmi dan harga terbaik.'
        );

        $produkTerbaru = Produk::with('kategori')
            ->where('status', 'aktif')
            ->latest()
            ->take(8)
            ->get();

        return view('livewire.beranda', [
            'produkTerbaru' => $produkTerbaru
        ])->layout('layouts.toko', $this->ambilDataSEO());
    }
}
