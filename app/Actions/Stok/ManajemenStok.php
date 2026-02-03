<?php

namespace App\Actions\Stok;

use App\Models\Produk;
use App\Models\RiwayatStok;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManajemenStok
{
    /**
     * Menambah stok produk dan mencatat riwayatnya.
     *
     * @param int $produkId
     * @param int $jumlah
     * @param string $keterangan
     * @param string|null $referensi
     * @return void
     */
    public static function tambah(int $produkId, int $jumlah, string $keterangan = 'Penambahan Stok Manual', ?string $referensi = null): void
    {
        DB::transaction(function () use ($produkId, $jumlah, $keterangan, $referensi) {
            $produk = Produk::lockForUpdate()->find($produkId);
            
            if (!$produk) {
                throw new \Exception("Produk dengan ID {$produkId} tidak ditemukan.");
            }

            $stokAwal = $produk->stok;
            $stokAkhir = $stokAwal + $jumlah;

            $produk->update(['stok' => $stokAkhir]);

            RiwayatStok::create([
                'produk_id' => $produk->id,
                'pengguna_id' => Auth::id(), // Bisa null jika dijalankan oleh sistem background
                'jenis' => 'masuk',
                'jumlah' => $jumlah,
                'stok_awal' => $stokAwal,
                'stok_akhir' => $stokAkhir,
                'keterangan' => $keterangan,
                'referensi' => $referensi,
            ]);
        });
    }

    /**
     * Mengurangi stok produk dan mencatat riwayatnya.
     *
     * @param int $produkId
     * @param int $jumlah
     * @param string $keterangan
     * @param string|null $referensi
     * @return void
     */
    public static function kurang(int $produkId, int $jumlah, string $keterangan = 'Pengurangan Stok', ?string $referensi = null): void
    {
        DB::transaction(function () use ($produkId, $jumlah, $keterangan, $referensi) {
            $produk = Produk::lockForUpdate()->find($produkId);
            
            if (!$produk) {
                throw new \Exception("Produk dengan ID {$produkId} tidak ditemukan.");
            }

            if ($produk->stok < $jumlah) {
                throw new \Exception("Stok produk {$produk->nama} tidak mencukupi. Sisa: {$produk->stok}, Diminta: {$jumlah}");
            }

            $stokAwal = $produk->stok;
            $stokAkhir = $stokAwal - $jumlah;

            $produk->update(['stok' => $stokAkhir]);

            RiwayatStok::create([
                'produk_id' => $produk->id,
                'pengguna_id' => Auth::id(),
                'jenis' => 'keluar',
                'jumlah' => $jumlah,
                'stok_awal' => $stokAwal,
                'stok_akhir' => $stokAkhir,
                'keterangan' => $keterangan,
                'referensi' => $referensi,
            ]);
        });
    }
}
