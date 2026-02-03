<?php

namespace App\Livewire\Admin\Produk;

use App\Actions\Log\CatatAktivitas;
use App\Models\Produk;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function hapus($id)
    {
        $produk = Produk::find($id);
        
        if ($produk) {
            $namaProduk = $produk->nama;
            $produk->delete();
            
            CatatAktivitas::catat('HAPUS_PRODUK', $namaProduk, "Admin menghapus produk {$namaProduk}");
            
            // Notification dispatch
             $this->dispatch('tampilkan-notifikasi', pesan: "Produk {$namaProduk} berhasil dihapus.");
        }
    }

    public function render()
    {
        $produk = Produk::where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('deskripsi_pendek', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.produk.index', [
            'produk' => $produk
        ])->layout('layouts.app');
    }
}
