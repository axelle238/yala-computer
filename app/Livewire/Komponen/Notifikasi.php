<?php

/**
 * Komponen: Komponen\Notifikasi
 * Peran: Menampilkan pesan toast non-blocking untuk interaksi pengguna
 */

namespace App\Livewire\Komponen;

use Livewire\Attributes\On;
use Livewire\Component;

class Notifikasi extends Component
{
    public $pesan;

    public $tipe = 'sukses'; // sukses, info, peringatan, bahaya

    public $apakah_tampil = false;

    /**
     * Listener untuk event notifikasi.
     */
    #[On('notifikasi')]
    public function tampilkan($pesan, $tipe = 'sukses')
    {
        $this->pesan = $pesan;
        $this->tipe = $tipe;
        $this->apakah_tampil = true;

        // Auto hide setelah 3 detik
        $this->dispatch('notifikasi-tampil');
    }

    /**
     * Sembunyikan notifikasi.
     */
    public function sembunyikan()
    {
        $this->apakah_tampil = false;
    }

    /**
     * Render komponen.
     */
    public function render()
    {
        return view('livewire.komponen.notifikasi');
    }
}
