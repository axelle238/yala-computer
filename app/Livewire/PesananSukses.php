<?php

namespace App\Livewire;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PesananSukses extends Component
{
    public $pesanan_id;

    public function mount($id)
    {
        $this->pesanan_id = $id;
        
        // Verifikasi kepemilikan
        $pesanan = Pesanan::where('id', $id)->where('pengguna_id', Auth::id())->firstOrFail();
    }

    public function render()
    {
        $pesanan = Pesanan::with('detailPesanan.produk')->findOrFail($this->pesanan_id);
        
        return view('livewire.pesanan-sukses', [
            'pesanan' => $pesanan
        ])->layout('layouts.toko');
    }
}
