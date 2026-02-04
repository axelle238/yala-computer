<?php

/**
 * Komponen: Publik\Artikel\Detail
 * Peran: Menampilkan isi lengkap satu artikel (Halaman SEO)
 */

namespace App\Livewire\Publik\Artikel;

use App\Models\Artikel;
use Illuminate\Support\Str;
use Livewire\Component;

class Detail extends Component
{
    public Artikel $artikel;

    public function mount($slug)
    {
        $this->artikel = Artikel::where('slug', $slug)
            ->where('apakah_diterbitkan', true)
            ->firstOrFail();
    }

    public function render()
    {
        // Ambil artikel terbaru lainnya
        $artikel_terbaru = Artikel::where('id', '!=', $this->artikel->id)
            ->where('apakah_diterbitkan', true)
            ->latest()
            ->take(3)
            ->get();

        return view('livewire.publik.artikel.detail', [
            'artikel_terbaru' => $artikel_terbaru,
        ])->layout('components.layouts.publik', [
            'title' => $this->artikel->meta_judul ?? $this->artikel->judul.' - Yala Computer',
            'meta_deskripsi' => $this->artikel->meta_deskripsi ?? Str::limit(strip_tags($this->artikel->konten), 160),
        ]);
    }
}
