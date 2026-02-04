<?php

/**
 * Komponen: Publik\Keranjang\Ikon
 * Peran: Menampilkan ikon keranjang dengan jumlah item real-time di header
 */

namespace App\Livewire\Publik\Keranjang;

use App\Layanan\LayananKeranjang;
use Livewire\Attributes\On;
use Livewire\Component;

class Ikon extends Component
{
    public $jumlah = 0;

    /**
     * Inisialisasi jumlah.
     */
    public function mount(LayananKeranjang $layanan)
    {
        $this->jumlah = $layanan->jumlahItem();
    }

    /**
     * Listener saat keranjang berubah.
     */
    #[On('keranjang-diperbarui')]
    public function perbaruiJumlah(LayananKeranjang $layanan)
    {
        $this->jumlah = $layanan->jumlahItem();
    }

    /**
     * Render ikon.
     */
    public function render()
    {
        return <<<'HTML'
            <a href="{{ route('keranjang') }}" wire:navigate class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 rounded-full relative group transition-colors">
                <i class="fas fa-shopping-cart text-lg group-hover:text-blue-600"></i>
                @if($jumlah > 0)
                    <span class="absolute top-1 right-1 w-4 h-4 bg-orange-500 text-white text-[9px] font-bold flex items-center justify-center rounded-full border-2 border-white">
                        {{ $jumlah }}
                    </span>
                @endif
            </a>
        HTML;
    }
}
