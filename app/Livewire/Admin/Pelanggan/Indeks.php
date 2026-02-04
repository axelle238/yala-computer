<?php

/**
 * Komponen: Admin\Pelanggan\Indeks
 * Peran: Manajemen data pelanggan dan riwayat pesanan mereka.
 */

namespace App\Livewire\Admin\Pelanggan;

use App\Models\Pelanggan;
use Livewire\Component;
use Livewire\WithPagination;

class Indeks extends Component
{
    use WithPagination;

    public $cari = '';

    /**
     * Reset pagination.
     */
    public function updatedCari()
    {
        $this->resetPage();
    }

    /**
     * Render pelanggan.
     */
    public function render()
    {
        $pelanggan = Pelanggan::withCount('pesanan')
            ->when($this->cari, function ($q) {
                $q->where('nama', 'like', '%'.$this->cari.'%')
                    ->orWhere('surel', 'like', '%'.$this->cari.'%')
                    ->orWhere('telepon', 'like', '%'.$this->cari.'%');
            })
            ->latest()
            ->paginate(12);

        return view('livewire.admin.pelanggan.indeks', [
            'daftar_pelanggan' => $pelanggan,
        ])->layout('components.layouts.app', ['title' => 'Manajemen Pelanggan']);
    }
}
