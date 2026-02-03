<?php

namespace App\Livewire\Kategori;

use App\Models\Kategori;
use App\Models\Produk;
use Livewire\Component;
use Livewire\WithPagination;

class Detail extends Component
{
    use WithPagination;
    use \App\Concerns\PunyaMetaSEO;

    public $kategori;

    public function mount($slug)
    {
        $this->kategori = Kategori::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $this->aturSEO(
            $this->kategori->nama,
            "Jual {$this->kategori->nama} berkualitas dengan harga terbaik di Yala Computer. Garansi resmi dan pengiriman cepat."
        );

        $produk = Produk::where('kategori_id', $this->kategori->id)
            ->where('status', 'aktif')
            ->latest()
            ->paginate(12);

        return view('livewire.kategori.detail', [
            'produk' => $produk
        ])->layout('layouts.toko', $this->ambilDataSEO());
    }
}
