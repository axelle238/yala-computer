<?php

/**
 * Komponen: Admin\Komponen\Sidebar
 * Peran: Navigasi utama admin dengan dukungan dropdown menu yang reaktif
 */

namespace App\Livewire\Admin\Komponen;

use Livewire\Component;

class Sidebar extends Component
{
    public $menuTerbuka = null; // Menyimpan ID menu yang sedang terbuka

    /**
     * Toggle dropdown menu.
     */
    public function toggleMenu($nama)
    {
        if ($this->menuTerbuka === $nama) {
            $this->menuTerbuka = null;
        } else {
            $this->menuTerbuka = $nama;
        }
    }

    /**
     * Render sidebar.
     */
    public function render()
    {
        return view('livewire.admin.komponen.sidebar');
    }
}
