<?php

namespace App\Livewire\Pelanggan\Pesanan;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

/**
 * Tujuan: Menampilkan detail pesanan untuk pelanggan.
 * Peran: Read-only view untuk rincian transaksi pribadi.
 */
class Detail extends Component
{
    public $pesanan;

    public function mount($id)
    {
        // Pastikan pesanan milik pengguna yang sedang login
        $this->pesanan = Pesanan::with(['detailPesanan.produk', 'pengguna'])
            ->where('id', $id)
            ->where('pengguna_id', Auth::id())
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.pelanggan.pesanan.detail')
            ->layout('layouts.toko');
    }
}
