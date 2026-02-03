<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Pengguna;

class PencarianGlobal extends Component
{
    public $query = '';
    public $hasil = [];

    public function updatedQuery()
    {
        $this->hasil = [];

        if (strlen($this->query) < 2) {
            return;
        }

        // Cari Produk
        $this->hasil['produk'] = Produk::where('nama', 'like', '%' . $this->query . '%')
            ->orWhere('slug', 'like', '%' . $this->query . '%')
            ->take(3)
            ->get();
            
        // Cari Pesanan (Invoice)
        $this->hasil['pesanan'] = Pesanan::where('nomor_invoice', 'like', '%' . $this->query . '%')
            ->take(3)
            ->get();
            
        // Cari Pengguna (Hanya Admin)
        if (auth()->user()?->peran === 'admin') {
             $this->hasil['pengguna'] = Pengguna::where('nama', 'like', '%' . $this->query . '%')
                ->orWhere('email', 'like', '%' . $this->query . '%')
                ->take(3)
                ->get();
        }
    }

    public function resetCari()
    {
        $this->query = '';
        $this->hasil = [];
    }

    public function render()
    {
        return view('livewire.pencarian-global');
    }
}
