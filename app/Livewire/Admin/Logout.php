<?php

/**
 * Komponen: Admin\Logout
 * Peran: Menangani proses keluar administrator
 */

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    /**
     * Proses Keluar.
     */
    public function keluar()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Render tombol logout sederhana.
     */
    public function render()
    {
        return <<<'HTML'
            <button wire:click="keluar" class="text-gray-400 hover:text-red-500 transition-colors">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        HTML;
    }
}
