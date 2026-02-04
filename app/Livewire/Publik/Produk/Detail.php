<?php

/**
 * Komponen: Publik\Produk\Detail
 * Peran: Halaman detail satu produk lengkap dengan SEO dan opsi pembelian
 */

namespace App\Livewire\Publik\Produk;

use App\Models\Produk;
use Illuminate\Support\Str;
use Livewire\Component;

class Detail extends Component
{
    public Produk $produk;

    public $jumlah_beli = 1;

    /**
     * Mount komponen dengan binding model berdasarkan slug.
     */
    public function mount($slug)
    {
        $this->produk = Produk::with(['kategori', 'stok'])
            ->where('slug', $slug)
            ->where('apakah_aktif', true)
            ->firstOrFail();
    }

    /**
     * Tambah jumlah pembelian.
     */
    public function tambahJumlah()
    {
        if ($this->jumlah_beli < $this->produk->jumlah_stok) {
            $this->jumlah_beli++;
        }
    }

    /**
     * Kurangi jumlah pembelian.
     */
    public function kurangJumlah()
    {
        if ($this->jumlah_beli > 1) {
            $this->jumlah_beli--;
        }
    }

    /**
     * Tambahkan ke keranjang (Implementasi Nyata).
     */
    public function tambahKeKeranjang(\App\Layanan\LayananKeranjang $layanan)
    {
        $layanan->tambah($this->produk->id, $this->jumlah_beli);

        $this->dispatch('keranjang-diperbarui');
        $this->dispatch('notifikasi', pesan: "{$this->produk->nama} berhasil ditambahkan ke keranjang!", tipe: 'sukses');
    }

    /**
     * Render halaman detail.
     */
    public function render()
    {
        // Ambil produk terkait (kategori sama, kecuali produk ini)
        $produk_terkait = Produk::where('kategori_id', $this->produk->kategori_id)
            ->where('id', '!=', $this->produk->id)
            ->where('apakah_aktif', true)
            ->take(4)
            ->get();

        return view('livewire.publik.produk.detail', [
            'produk_terkait' => $produk_terkait,
        ])->layout('components.layouts.publik', [
            'title' => $this->produk->meta_judul ?? $this->produk->nama.' - Yala Computer',
            'meta_deskripsi' => $this->produk->meta_deskripsi ?? Str::limit(strip_tags($this->produk->deskripsi), 160),
        ]);
    }
}
