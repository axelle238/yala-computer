<?php

namespace App\Livewire;

use App\Models\Produk;
use Livewire\Component;

class Beranda extends Component
{
    public function render()
    {
        $produkTerbaru = Produk::with('kategori')
            ->where('status', 'aktif')
            ->latest()
            ->take(8)
            ->get();

        return view('livewire.beranda', [
            'produkTerbaru' => $produkTerbaru
        ])->layout('layouts.toko');
    }
}
