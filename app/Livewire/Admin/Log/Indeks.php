<?php

/**
 * Komponen: Admin\Log\Indeks
 * Peran: Menampilkan jejak audit sistem secara lengkap dan naratif.
 */

namespace App\Livewire\Admin\Log;

use App\Models\LogAktivitas;
use Livewire\Component;
use Livewire\WithPagination;

class Indeks extends Component
{
    use WithPagination;

    public $cari = '';

    public $filter_aksi = '';

    /**
     * Reset pagination.
     */
    public function updatedCari()
    {
        $this->resetPage();
    }

    /**
     * Render log.
     */
    public function render()
    {
        $logs = LogAktivitas::with('pengguna')
            ->when($this->cari, function ($q) {
                $q->where('pesan_naratif', 'like', '%'.$this->cari.'%')
                    ->orWhere('target', 'like', '%'.$this->cari.'%');
            })
            ->when($this->filter_aksi, fn ($q) => $q->where('aksi', $this->filter_aksi))
            ->latest('waktu')
            ->paginate(15);

        return view('livewire.admin.log.indeks', [
            'daftar_log' => $logs,
        ])->layout('components.layouts.app', ['title' => 'Log Aktivitas Sistem']);
    }
}
