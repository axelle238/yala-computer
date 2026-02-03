<?php

namespace App\Livewire\Keranjang;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Index extends Component
{
    public function increment($id)
    {
        $item = Keranjang::findOrFail($id);
        
        // Cek stok produk
        if ($item->jumlah < $item->produk->stok) {
            $item->increment('jumlah');
            $this->dispatch('keranjang-diupdate');
        } else {
            $this->dispatch('tampilkan-notifikasi', pesan: 'Stok maksimal tercapai!');
        }
    }

    public function decrement($id)
    {
        $item = Keranjang::findOrFail($id);
        
        if ($item->jumlah > 1) {
            $item->decrement('jumlah');
            $this->dispatch('keranjang-diupdate');
        }
    }

    public function hapus($id)
    {
        Keranjang::destroy($id);
        $this->dispatch('keranjang-diupdate');
        $this->dispatch('tampilkan-notifikasi', pesan: 'Item dihapus dari keranjang.');
    }

    public function render()
    {
        $userId = Auth::id();
        $sessionId = Session::getId();

        $query = Keranjang::with('produk');

        if ($userId) {
            $query->where('pengguna_id', $userId);
        } else {
            $query->where('session_id', $sessionId)->whereNull('pengguna_id');
        }

        $items = $query->get();
        
        // Hitung total
        $subtotal = $items->sum(function($item) {
            return $item->jumlah * $item->produk->harga_jual;
        });

        return view('livewire.keranjang.index', [
            'items' => $items,
            'subtotal' => $subtotal
        ])->layout('layouts.toko');
    }
}
