<?php

/**
 * Komponen: Admin\Dashboard
 * Peran: Menampilkan ringkasan statistik toko secara real-time
 */

namespace App\Livewire\Admin;

use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\Produk;
use Livewire\Component;

class Dashboard extends Component
{
    /**
     * Render komponen.
     */
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'total_produk' => Produk::count(),
            'total_pesanan' => Pesanan::count(),
            'total_pelanggan' => Pelanggan::count(),
            'total_pendapatan' => Pesanan::where('status_pembayaran', 'lunas')->sum('total_harga'),
            'pesanan_terbaru' => Pesanan::with('pelanggan')->latest()->take(6)->get(),
            'produk_stok_tipis' => Produk::whereHas('stok', fn ($q) => $q->where('jumlah', '<=', 5))->count(),
        ])->layout('components.layouts.app', ['title' => 'Dashboard Real-time']);
    }
}
