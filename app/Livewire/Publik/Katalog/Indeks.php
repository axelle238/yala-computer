<?php

/**
 * Komponen: Publik\Katalog\Indeks
 * Peran: Halaman pencarian dan filter produk lengkap
 */

namespace App\Livewire\Publik\Katalog;

use App\Models\Kategori;
use App\Models\Produk;
use Livewire\Component;
use Livewire\WithPagination;

class Indeks extends Component
{
    use WithPagination;

    // Filter
    public $cari = '';

    public $kategori_terpilih = '';

    public $urutan = 'terbaru'; // terbaru, termurah, termahal, abjad

    public $hanya_unggulan = false;

    protected $queryString = [
        'cari' => ['except' => ''],
        'kategori_terpilih' => ['except' => ''],
        'urutan' => ['except' => 'terbaru'],
        'hanya_unggulan' => ['except' => false],
    ];

    /**
     * Reset pagination saat filter berubah.
     */
    public function updated($property)
    {
        if (in_array($property, ['cari', 'kategori_terpilih', 'urutan', 'hanya_unggulan'])) {
            $this->resetPage();
        }
    }

    /**
     * Tambahkan ke keranjang (Aksi Cepat).
     */
    public function tambahKeKeranjang(int $produk_id, \App\Layanan\LayananKeranjang $layanan)
    {
        $produk = Produk::find($produk_id);
        if ($produk && $produk->stok?->jumlah > 0) {
            $layanan->tambah($produk_id, 1);
            $this->dispatch('keranjang-diperbarui');
            $this->dispatch('notifikasi', pesan: "{$produk->nama} ditambahkan ke keranjang!", tipe: 'sukses');
        } else {
            $this->dispatch('notifikasi', pesan: 'Gagal! Stok produk sedang kosong.', tipe: 'bahaya');
        }
    }

    /**
     * Render katalog.
     */
    public function render()
    {
        $produk = Produk::query()
            ->with(['kategori', 'stok'])
            ->where('apakah_aktif', true)
            ->when($this->cari, function ($q) {
                $q->where('nama', 'like', '%'.$this->cari.'%')
                    ->orWhere('deskripsi', 'like', '%'.$this->cari.'%');
            })
            ->when($this->kategori_terpilih, function ($q) {
                $q->whereHas('kategori', fn ($k) => $k->where('slug', $this->kategori_terpilih));
            })
            ->when($this->hanya_unggulan, fn ($q) => $q->where('apakah_unggulan', true));

        // Sorting
        $produk = match ($this->urutan) {
            'termurah' => $produk->orderBy('harga', 'asc'),
            'termahal' => $produk->orderBy('harga', 'desc'),
            'abjad' => $produk->orderBy('nama', 'asc'),
            default => $produk->latest(),
        };

        return view('livewire.publik.katalog.indeks', [
            'daftar_produk' => $produk->paginate(12),
            'daftar_kategori' => Kategori::withCount(['produk' => fn ($q) => $q->where('apakah_aktif', true)])->get(),
        ])->layout('components.layouts.publik', [
            'title' => 'Katalog Produk - Yala Computer',
            'meta_deskripsi' => 'Cari dan filter ribuan produk komputer, laptop, dan aksesoris di katalog lengkap Yala Computer.',
        ]);
    }
}
