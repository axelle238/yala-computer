<?php

/**
 * Komponen: Admin\Pesanan\Indeks
 * Peran: Manajemen transaksi pesanan pelanggan
 * Fitur: Daftar, Filter Status, Detail Pesanan, Update Status, Log Aktivitas
 */

namespace App\Livewire\Admin\Pesanan;

use App\Models\Pesanan;
use App\Traits\PencatatLog;
use Livewire\Component;
use Livewire\WithPagination;

class Indeks extends Component
{
    use PencatatLog, WithPagination;

    // State
    public $pesanan_dipilih = null;

    // Filter
    public $cari = '';

    public $status_filter = '';

    protected $updatesQueryString = ['cari', 'status_filter'];

    /**
     * Reset pagination.
     */
    public function updatedCari()
    {
        $this->resetPage();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    /**
     * Pilih pesanan untuk melihat detail.
     */
    public function lihatDetail($id)
    {
        $this->pesanan_dipilih = Pesanan::with(['item.produk', 'pelanggan'])->findOrFail($id);
    }

    /**
     * Tutup panel detail.
     */
    public function tutupDetail()
    {
        $this->pesanan_dipilih = null;
    }

    /**
     * Update status pesanan.
     */
    public function updateStatus($tipe, $nilai)
    {
        if (! $this->pesanan_dipilih) {
            return;
        }

        $pesanan = Pesanan::find($this->pesanan_dipilih->id);
        $nilaiLama = $tipe == 'pembayaran' ? $pesanan->status_pembayaran : $pesanan->status_pesanan;

        if ($tipe == 'pembayaran') {
            $pesanan->update(['status_pembayaran' => $nilai]);
            $pesanLog = "Mengubah status pembayaran invoice #{$pesanan->nomor_invoice} dari {$nilaiLama} menjadi {$nilai}";
        } else {
            $pesanan->update(['status_pesanan' => $nilai]);
            $pesanLog = "Mengubah status pesanan invoice #{$pesanan->nomor_invoice} dari {$nilaiLama} menjadi {$nilai}";
        }

        $this->catatAktivitas('update', 'Pesanan', $pesanLog);
        $this->pesanan_dipilih = $pesanan->fresh(['item.produk', 'pelanggan']); // Refresh data

        $this->dispatch('notifikasi', pesan: 'Status berhasil diperbarui!', tipe: 'sukses');
    }

    /**
     * Render komponen.
     */
    public function render()
    {
        $pesanan = Pesanan::with('pelanggan')
            ->when($this->cari, function ($q) {
                $q->where('nomor_invoice', 'like', '%'.$this->cari.'%')
                    ->orWhereHas('pelanggan', fn ($p) => $p->where('nama', 'like', '%'.$this->cari.'%'));
            })
            ->when($this->status_filter, fn ($q) => $q->where('status_pesanan', $this->status_filter))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.pesanan.indeks', [
            'daftar_pesanan' => $pesanan,
        ])->layout('components.layouts.app', ['title' => 'Manajemen Pesanan']);
    }
}
