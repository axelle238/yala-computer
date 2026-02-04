<?php

/**
 * Komponen: Publik\Checkout\Sukses
 * Peran: Menampilkan pesan terima kasih dan instruksi pembayaran setelah checkout berhasil
 */

namespace App\Livewire\Publik\Checkout;

use Livewire\Component;

class Sukses extends Component
{
    public $data_order;

    /**
     * Ambil data dari session flash.
     */
    public function mount()
    {
        $this->data_order = session('sukses_order');

        if (! $this->data_order) {
            return redirect()->route('beranda');
        }
    }

    /**
     * Render halaman sukses.
     */
    public function render()
    {
        return view('livewire.publik.checkout.sukses')
            ->layout('components.layouts.publik', ['title' => 'Pesanan Berhasil - Yala Computer']);
    }
}
