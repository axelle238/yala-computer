<?php

namespace App\Livewire;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

class KeranjangBadge extends Component
{
    public $totalItem = 0;

    public function mount()
    {
        $this->hitungTotal();
    }

    #[On('keranjang-diupdate')] 
    public function hitungTotal()
    {
        $userId = Auth::id();
        $sessionId = Session::getId();

        $query = Keranjang::query();

        if ($userId) {
            $query->where('pengguna_id', $userId);
        } else {
            $query->where('session_id', $sessionId)->whereNull('pengguna_id');
        }

        $this->totalItem = $query->sum('jumlah');
    }

    public function render()
    {
        return view('livewire.keranjang-badge');
    }
}