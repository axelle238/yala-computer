<?php

namespace App\Observers;

use App\Actions\Log\CatatAktivitas;
use App\Models\Produk;

class ProdukObserver
{
    /**
     * Handle the Produk "created" event.
     */
    public function created(Produk $produk): void
    {
        CatatAktivitas::catat(
            'TAMBAH_PRODUK',
            $produk->nama,
            "Produk baru '{$produk->nama}' berhasil ditambahkan.",
            'success',
            ['id' => $produk->id, 'harga' => $produk->harga_jual]
        );
    }

    /**
     * Handle the Produk "updated" event.
     */
    public function updated(Produk $produk): void
    {
        // Cek apa yang berubah penting
        $changes = $produk->getChanges();
        unset($changes['updated_at']);
        
        // Skip jika tidak ada perubahan signifikan (misal cuma timestamp)
        if (empty($changes)) return;

        $pesan = "Produk '{$produk->nama}' diperbarui.";
        
        if (array_key_exists('stok', $changes)) {
            $pesan .= " Stok berubah menjadi {$produk->stok}.";
        }
        if (array_key_exists('harga_jual', $changes)) {
            $pesan .= " Harga jual berubah menjadi Rp " . number_format($produk->harga_jual, 0, ',', '.');
        }
        if (array_key_exists('status', $changes)) {
            $pesan .= " Status berubah menjadi {$produk->status}.";
        }

        CatatAktivitas::catat(
            'UPDATE_PRODUK',
            $produk->nama,
            $pesan,
            'info',
            $changes
        );
    }

    /**
     * Handle the Produk "deleted" event.
     */
    public function deleted(Produk $produk): void
    {
        CatatAktivitas::catat(
            'HAPUS_PRODUK',
            $produk->nama,
            "Produk '{$produk->nama}' telah dihapus (diarsipkan).",
            'warning',
            ['id' => $produk->id]
        );
    }
}
