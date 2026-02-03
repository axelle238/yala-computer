<?php

namespace App\Livewire\Admin\Pesanan;

use App\Models\Pesanan;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Tujuan: Mengelola daftar pesanan pelanggan untuk admin.
 * Peran: Menampilkan tabel pesanan dengan fitur filter status dan pencarian.
 */
class Index extends Component
{
    use WithPagination;

    public $cari = '';
    public $filterStatus = '';

    /**
     * Reset halaman saat pencarian diubah.
     */
    public function updatingCari()
    {
        $this->resetPage();
    }

    /**
     * Reset halaman saat filter status diubah.
     */
    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Pesanan::with('pengguna')
            ->where(function($q) {
                $q->where('nomor_invoice', 'like', '%' . $this->cari . '%')
                  ->orWhereHas('pengguna', function($queryUser) {
                      $queryUser->where('nama', 'like', '%' . $this->cari . '%');
                  });
            });

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        $daftarPesanan = $query->latest()->paginate(10);

        return view('livewire.admin.pesanan.index', [
            'daftarPesanan' => $daftarPesanan
        ])->layout('layouts.app');
    }
}
