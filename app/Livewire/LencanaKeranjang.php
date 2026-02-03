<?php

namespace App\Livewire;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

class LencanaKeranjang extends Component
{
    public $total = 0;

    protected $listeners = ['keranjangDiperbarui' => 'hitungTotal'];

    public function mount()
    {
        $this->hitungTotal();
    }

    public function hitungTotal()
    {
        if (Auth::check()) {
            $this->total = Keranjang::where('pengguna_id', Auth::id())->sum('jumlah');
        } else {
            $this->total = 0;
        }
    }

    public function render()
    {
        return view('livewire.lencana-keranjang');
    }
}