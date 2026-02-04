<?php

/**
 * Komponen: Publik\Artikel\Indeks
 * Peran: Menampilkan daftar artikel untuk pelanggan (Blog SEO)
 */

namespace App\Livewire\Publik\Artikel;

use App\Models\Artikel;
use Livewire\Component;
use Livewire\WithPagination;

class Indeks extends Component
{
    use WithPagination;

    public function render()
    {
        $artikel = Artikel::where('apakah_diterbitkan', true)
            ->latest()
            ->paginate(9);

        return view('livewire.publik.artikel.indeks', [
            'daftar_artikel' => $artikel,
        ])->layout('components.layouts.publik', ['title' => 'Blog & Edukasi IT - Yala Computer']);
    }
}
