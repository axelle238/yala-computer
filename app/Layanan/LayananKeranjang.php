<?php

/**
 * Layanan: LayananKeranjang
 * Peran: Menangani logika keranjang belanja menggunakan session
 */

namespace App\Layanan;

use App\Models\Produk;
use Illuminate\Support\Facades\Session;

class LayananKeranjang
{
    protected $nama_kunci = 'keranjang_yala';

    /**
     * Ambil semua item di keranjang.
     */
    public function ambilSemua(): array
    {
        return Session::get($this->nama_kunci, []);
    }

    /**
     * Tambah produk ke keranjang.
     */
    public function tambah(int $produk_id, int $kuantitas = 1): void
    {
        $keranjang = $this->ambilSemua();
        $produk = Produk::find($produk_id);

        if (! $produk) {
            return;
        }

        if (isset($keranjang[$produk_id])) {
            $keranjang[$produk_id]['kuantitas'] += $kuantitas;
        } else {
            $keranjang[$produk_id] = [
                'id' => $produk->id,
                'nama' => $produk->nama,
                'harga' => (float) $produk->harga,
                'gambar' => $produk->gambar_utama,
                'slug' => $produk->slug,
                'kuantitas' => $kuantitas,
            ];
        }

        Session::put($this->nama_kunci, $keranjang);
    }

    /**
     * Update kuantitas item.
     */
    public function perbarui(int $produk_id, int $kuantitas): void
    {
        $keranjang = $this->ambilSemua();

        if (isset($keranjang[$produk_id])) {
            if ($kuantitas <= 0) {
                unset($keranjang[$produk_id]);
            } else {
                $keranjang[$produk_id]['kuantitas'] = $kuantitas;
            }
        }

        Session::put($this->nama_kunci, $keranjang);
    }

    /**
     * Hapus item dari keranjang.
     */
    public function hapus(int $produk_id): void
    {
        $keranjang = $this->ambilSemua();

        if (isset($keranjang[$produk_id])) {
            unset($keranjang[$produk_id]);
        }

        Session::put($this->nama_kunci, $keranjang);
    }

    /**
     * Kosongkan keranjang.
     */
    public function kosongkan(): void
    {
        Session::forget($this->nama_kunci);
    }

    /**
     * Hitung total harga.
     */
    public function totalHarga(): float
    {
        $total = 0;
        foreach ($this->ambilSemua() as $item) {
            $total += $item['harga'] * $item['kuantitas'];
        }

        return $total;
    }

    /**
     * Hitung jumlah item unik.
     */
    public function jumlahItem(): int
    {
        return count($this->ambilSemua());
    }
}
