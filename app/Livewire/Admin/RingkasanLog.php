<?php

/**
 * Komponen: Admin\RingkasanLog
 * Peran: Menampilkan daftar log aktivitas terbaru secara ringkas
 */

namespace App\Livewire\Admin;

use App\Models\LogAktivitas;
use Livewire\Component;

class RingkasanLog extends Component
{
    /**
     * Render log terbaru.
     */
    public function render()
    {
        return view('livewire.admin.ringkasan-log', [
            'logs' => LogAktivitas::with('pengguna')->latest('waktu')->take(6)->get(),
        ]);
    }
}
