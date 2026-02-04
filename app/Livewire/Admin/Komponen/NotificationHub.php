<?php

/**
 * Komponen: Admin\Komponen\NotificationHub
 * Peran: Menampilkan daftar notifikasi sistem terbaru di header dashboard
 */

namespace App\Livewire\Admin\Komponen;

use App\Models\LogAktivitas;
use App\Models\Pesanan;
use Livewire\Component;

class NotificationHub extends Component
{
    public $jumlah_baru = 0;

    public $apakah_buka = false;

    /**
     * Render komponen.
     */
    public function render()
    {
        // Ambil aktivitas dan pesanan terbaru
        $notifikasi = collect();

        // 1. Pesanan Baru
        $pesanan = Pesanan::where('status_pesanan', 'baru')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($p) {
                return [
                    'tipe' => 'pesanan',
                    'judul' => 'Pesanan Masuk #'.$p->nomor_invoice,
                    'pesan' => 'Pesanan baru senilai Rp '.number_format($p->total_harga),
                    'waktu' => $p->created_at,
                    'ikon' => 'fas fa-cart-shopping',
                    'warna' => 'text-emerald-500 bg-emerald-500/10',
                ];
            });

        // 2. Log Penting
        $logs = LogAktivitas::whereIn('aksi', ['hapus', 'login'])
            ->latest('waktu')
            ->take(5)
            ->get()
            ->map(function ($l) {
                return [
                    'tipe' => 'log',
                    'judul' => strtoupper($l->aksi).' '.$l->target,
                    'pesan' => $l->pesan_naratif,
                    'waktu' => $l->waktu,
                    'ikon' => $l->aksi === 'hapus' ? 'fas fa-trash-can' : 'fas fa-key',
                    'warna' => $l->aksi === 'hapus' ? 'text-red-500 bg-red-500/10' : 'text-blue-500 bg-blue-500/10',
                ];
            });

        $semua = $notifikasi->concat($pesanan)->concat($logs)->sortByDesc('waktu')->take(10);
        $this->jumlah_baru = $pesanan->count();

        return view('livewire.admin.komponen.notification-hub', [
            'daftar_notifikasi' => $semua,
        ]);
    }
}
