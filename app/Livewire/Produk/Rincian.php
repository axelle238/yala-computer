<?php

namespace App\Livewire\Produk;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Rincian extends Component
{
    use \App\Concerns\PunyaMetaSEO;

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
        $schema = [
            '@context' => 'https://schema.org/',
            '@type' => 'Product',
            'name' => $this->produk->nama,
            'description' => $this->produk->deskripsi_pendek ?? substr($this->produk->deskripsi_lengkap, 0, 160),
            'image' => asset('favicon.svg'), // Placeholder, nanti ganti real image
            'sku' => $this->produk->id,
            'offers' => [
                '@type' => 'Offer',
                'url' => route('produk.rincian', $this->produk->slug),
                'priceCurrency' => 'IDR',
                'price' => $this->produk->harga_jual,
                'availability' => $this->produk->stok > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
            ],
        ];

        $this->aturSEO(
            $this->produk->nama,
            $this->produk->deskripsi_pendek ?? substr($this->produk->deskripsi_lengkap, 0, 160),
            null,
            $schema
        );

        return view('livewire.produk.rincian')->layout('layouts.toko', $this->ambilDataSEO());
    }
}
