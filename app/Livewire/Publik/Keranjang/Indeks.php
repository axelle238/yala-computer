<?php

/**
 * Komponen: Publik\Keranjang\Indeks
 * Peran: Halaman ringkasan keranjang belanja pelanggan
 */

namespace App\Livewire\Publik\Keranjang;

use App\Layanan\LayananKeranjang;
use Livewire\Component;

class Indeks extends Component
{
    /**
     * Hapus item dari keranjang.
     */
    public function hapusItem(int $id, LayananKeranjang $layanan)
    {
        $layanan->hapus($id);
        $this->dispatch('keranjang-diperbarui');
        $this->dispatch('notifikasi', pesan: 'Produk dihapus dari keranjang.', tipe: 'info');
    }

    /**
     * Perbarui kuantitas.
     */
    public function perbaruiKuantitas(int $id, int $jumlah, LayananKeranjang $layanan)
    {
        $layanan->perbarui($id, $jumlah);
        $this->dispatch('keranjang-diperbarui');
    }

    /**
     * Render halaman keranjang.
     */
    public function render(LayananKeranjang $layanan)
    {
        return view('livewire.publik.keranjang.indeks', [
            'items' => $layanan->ambilSemua(),
            'total' => $layanan->totalHarga(),
        ])->layout('components.layouts.publik', ['title' => 'Keranjang Belanja - Yala Computer']);
    }
}
