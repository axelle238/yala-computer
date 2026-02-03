<?php

namespace App\Livewire;

use App\Models\LogAktivitas;
use App\Models\Pengguna;
use App\Models\Pesanan;
use App\Models\Produk;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'totalPengguna' => Pengguna::count(),
            'totalProduk' => Produk::count(),
            'totalPesanan' => Pesanan::count(),
            'pendapatan' => Pesanan::where('status', 'selesai')->sum('total_bayar'),
            'logTerbaru' => LogAktivitas::with('pengguna')->latest('waktu')->take(10)->get()
        ])->layout('layouts.app'); // Menggunakan layout dashboard bawaan
    }
}
