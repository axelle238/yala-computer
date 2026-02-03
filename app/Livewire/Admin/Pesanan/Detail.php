<?php

namespace App\Livewire\Admin\Pesanan;

use App\Actions\Log\CatatAktivitas;
use App\Models\Pesanan;
use Livewire\Component;

/**
 * Tujuan: Menampilkan detail pesanan spesifik dan mengelola statusnya.
 * Peran: Melihat informasi pelanggan, item pesanan, dan update status.
 */
class Detail extends Component
{
    public $pesananId;
    public $statusBaru;

    public function mount($id)
    {
        $this->pesananId = $id;
        $pesanan = Pesanan::findOrFail($id);
        $this->statusBaru = $pesanan->status;
    }

    /**
     * Memperbarui status pesanan.
     */
    public function updateStatus($status)
    {
        $pesanan = Pesanan::findOrFail($this->pesananId);
        $statusLama = $pesanan->status;
        
        $pesanan->update(['status' => $status]);
        $this->statusBaru = $status;

        // Catat Log Aktivitas
        CatatAktivitas::catat(
            'UPDATE_STATUS_PESANAN',
            $pesanan->nomor_invoice,
            "Admin mengubah status pesanan {$pesanan->nomor_invoice} dari " . str_replace('_', ' ', $statusLama) . " menjadi " . str_replace('_', ' ', $status)
        );

        $this->dispatch('tampilkan-notifikasi', pesan: "Status pesanan {$pesanan->nomor_invoice} berhasil diperbarui!");
    }

    public function render()
    {
        $pesanan = Pesanan::with(['pengguna', 'detailPesanan.produk'])->findOrFail($this->pesananId);

        return view('livewire.admin.pesanan.detail', [
            'pesanan' => $pesanan
        ])->layout('layouts.app');
    }
}
