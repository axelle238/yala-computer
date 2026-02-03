<?php

namespace App\Livewire\Admin\Stok;

use App\Actions\Stok\ManajemenStok;
use App\Models\Produk;
use App\Models\RiwayatStok;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Tujuan: Mengelola stok produk dan melihat riwayat pergerakan stok.
 * Peran: Admin dapat melihat stok real-time, menambah/mengurangi stok manual, dan melihat log riwayat.
 */
class Index extends Component
{
    use WithPagination;

    public $cari = '';
    
    // Form Penyesuaian
    public $produkIdDipilih;
    public $jenisPenyesuaian = 'masuk'; // masuk / keluar
    public $jumlahPenyesuaian;
    public $keteranganPenyesuaian;

    public function updatingCari()
    {
        $this->resetPage();
    }

    public function pilihProduk($id)
    {
        $this->produkIdDipilih = $id;
        $this->reset(['jumlahPenyesuaian', 'keteranganPenyesuaian']);
        $this->jenisPenyesuaian = 'masuk';
    }

    public function batal()
    {
        $this->reset(['produkIdDipilih', 'jumlahPenyesuaian', 'keteranganPenyesuaian']);
    }

    public function simpanPenyesuaian()
    {
        $this->validate([
            'produkIdDipilih' => 'required|exists:produk,id',
            'jumlahPenyesuaian' => 'required|integer|min:1',
            'keteranganPenyesuaian' => 'required|string|max:255',
            'jenisPenyesuaian' => 'required|in:masuk,keluar',
        ]);

        try {
            if ($this->jenisPenyesuaian === 'masuk') {
                ManajemenStok::tambah(
                    $this->produkIdDipilih,
                    $this->jumlahPenyesuaian,
                    $this->keteranganPenyesuaian,
                    'Manual Admin'
                );
            } else {
                ManajemenStok::kurang(
                    $this->produkIdDipilih,
                    $this->jumlahPenyesuaian,
                    $this->keteranganPenyesuaian,
                    'Manual Admin'
                );
            }

            $this->dispatch('tampilkan-notifikasi', pesan: 'Stok berhasil diperbarui.');
            $this->batal();

        } catch (\Exception $e) {
            $this->addError('stok_error', $e->getMessage());
        }
    }

    public function render()
    {
        $stokProduk = Produk::where('nama', 'like', '%' . $this->cari . '%')
            ->orderBy('stok', 'asc') // Urutkan dari stok terkecil
            ->paginate(5, ['*'], 'produk_page');

        $riwayatStok = RiwayatStok::with(['produk', 'pengguna'])
            ->latest()
            ->paginate(10, ['*'], 'riwayat_page');

        return view('livewire.admin.stok.index', [
            'stokProduk' => $stokProduk,
            'riwayatStok' => $riwayatStok
        ])->layout('layouts.app');
    }
}
