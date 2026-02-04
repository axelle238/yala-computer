<?php

/**
 * Komponen: Publik\Halaman\Statis
 * Peran: Menampilkan halaman statis (Tentang Kami, Kontak, Bantuan) secara dinamis
 */

namespace App\Livewire\Publik\Halaman;

use Livewire\Component;

class Statis extends Component
{
    public $halaman;

    public $judul;

    public function mount($slug)
    {
        $this->halaman = $slug;

        $this->judul = match ($slug) {
            'tentang-kami' => 'Tentang Yala Computer',
            'kontak' => 'Hubungi Kami',
            'cara-pemesanan' => 'Panduan Pemesanan',
            'garansi' => 'Kebijakan Garansi',
            'faq' => 'Pertanyaan Umum (FAQ)',
            default => 'Halaman'
        };
    }

    public function render()
    {
        return view('livewire.publik.halaman.statis')
            ->layout('components.layouts.publik', ['title' => $this->judul.' - Yala Computer']);
    }
}
