<?php

namespace App\Livewire\Produk;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Rincian extends Component
{
    public $produk;

    public function mount($slug)
    {
        $this->produk = Produk::where('slug', $slug)->where('status', 'aktif')->firstOrFail();
    }

    public function tambahKeKeranjang()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        Keranjang::updateOrCreate(
            [
                'pengguna_id' => auth()->id(),
                'produk_id' => $this->produk->id,
            ],
            [
                'jumlah' => DB::raw('jumlah + 1')
            ]
        );

        $this->dispatch('keranjangDiperbarui');
        $this->dispatch('tampilkan-notifikasi', pesan: "{$this->produk->nama} berhasil ditambahkan ke keranjang!");
    }

    public function render()
    {
        return view('livewire.produk.rincian')->layout('layouts.toko');
    }
}
