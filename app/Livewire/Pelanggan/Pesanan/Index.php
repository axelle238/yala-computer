<?php

namespace App\Livewire\Pelanggan\Pesanan;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Tujuan: Menampilkan daftar pesanan milik pelanggan yang sedang login.
 * Peran: Memberikan akses riwayat transaksi bagi pelanggan.
 */
class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $riwayatPesanan = Pesanan::where('pengguna_id', Auth::id())
            ->latest()
            ->paginate(5);

        return view('livewire.pelanggan.pesanan.index', [
            'riwayatPesanan' => $riwayatPesanan
        ])->layout('layouts.toko');
    }
}
