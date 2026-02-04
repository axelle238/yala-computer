<?php

/**
 * Komponen: Publik\Lacak\Indeks
 * Peran: Halaman publik untuk melacak status pesanan berdasarkan nomor invoice.
 */

namespace App\Livewire\Publik\Lacak;

use App\Models\Pesanan;
use Livewire\Component;

class Indeks extends Component
{
    public $nomor_invoice;

    public $hasil_pencarian = null;

    public $pesan_error = '';

    /**
     * Cari pesanan.
     */
    public function cariPesanan()
    {
        $this->validate([
            'nomor_invoice' => 'required|min:5',
        ]);

        $pesanan = Pesanan::with(['item.produk', 'pelanggan'])
            ->where('nomor_invoice', $this->nomor_invoice)
            ->first();

        if ($pesanan) {
            $this->hasil_pencarian = $pesanan;
            $this->pesan_error = '';
        } else {
            $this->hasil_pencarian = null;
            $this->pesan_error = 'Pesanan dengan nomor invoice tersebut tidak ditemukan.';
        }
    }

    /**
     * Render halaman lacak.
     */
    public function render()
    {
        return view('livewire.publik.lacak.indeks')
            ->layout('components.layouts.publik', ['title' => 'Lacak Pesanan - Yala Computer']);
    }
}
