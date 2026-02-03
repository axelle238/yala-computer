<?php

namespace App\Livewire\Produk;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Detail extends Component
{
    public $slug;
    public $jumlah = 1;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function tambahKeKeranjang()
    {
        $produk = Produk::where('slug', $this->slug)->firstOrFail();

        if ($this->jumlah > $produk->stok) {
            $this->js("alert('Stok tidak mencukupi!')"); // Nanti ganti Toast
            return;
        }

        $sessionId = Session::getId();
        $userId = Auth::id();

        // Cek apakah produk sudah ada di keranjang
        $query = Keranjang::where('produk_id', $produk->id);
        
        if ($userId) {
            $query->where('pengguna_id', $userId);
        } else {
            $query->where('session_id', $sessionId)->whereNull('pengguna_id');
        }

        $itemKeranjang = $query->first();

        if ($itemKeranjang) {
            $itemKeranjang->jumlah += $this->jumlah;
            $itemKeranjang->save();
        } else {
            Keranjang::create([
                'pengguna_id' => $userId,
                'session_id' => $userId ? null : $sessionId,
                'produk_id' => $produk->id,
                'jumlah' => $this->jumlah,
            ]);
        }

        $this->dispatch('keranjang-diupdate'); // Event untuk update badge navbar
        
        // Flash message or Toast
        session()->flash('message', 'Produk berhasil ditambahkan ke keranjang.');
        
        // Redirect atau stay? Stay is better for UX, use Toast.
        // Karena mandate "Non-blocking notification", kita akan pakai dispatch event browser
        $this->dispatch('tampilkan-notifikasi', pesan: "{$produk->nama} berhasil ditambahkan ke keranjang!");
    }

    public function render()
    {
        $produk = Produk::where('slug', $this->slug)->firstOrFail();
        
        // Produk Terkait (Simple logic: kategori sama, kecuali produk ini)
        $produkTerkait = Produk::where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $produk->id)
            ->take(4)
            ->get();

        return view('livewire.produk.detail', [
            'produk' => $produk,
            'produkTerkait' => $produkTerkait
        ])->layout('layouts.toko');
    }
}
