<?php

/**
 * Komponen: Publik\Checkout\Indeks
 * Peran: Halaman penyelesaian pesanan (Form data diri & Konfirmasi)
 */

namespace App\Livewire\Publik\Checkout;

use App\Layanan\LayananKeranjang;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\PesananItem;
use App\Models\Stok;
use App\Traits\PencatatLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class Indeks extends Component
{
    use PencatatLog;

    // Form Data
    public $nama;

    public $surel;

    public $telepon;

    public $alamat;

    public $catatan;

    /**
     * Inisialisasi halaman.
     */
    public function mount(LayananKeranjang $layanan)
    {
        if ($layanan->jumlahItem() === 0) {
            return redirect()->route('keranjang');
        }
    }

    /**
     * Proses Pemesanan.
     */
    public function buatPesanan(LayananKeranjang $layanan)
    {
        $this->validate([
            'nama' => 'required|min:3',
            'surel' => 'required|email',
            'telepon' => 'required|numeric',
            'alamat' => 'required|min:10',
        ]);

        $items = $layanan->ambilSemua();
        $total = $layanan->totalHarga();

        try {
            DB::beginTransaction();

            // 1. Simpan/Ambil Pelanggan (Logika Tamu)
            $pelanggan = Pelanggan::firstOrCreate(
                ['surel' => $this->surel],
                [
                    'nama' => $this->nama,
                    'telepon' => $this->telepon,
                    'alamat' => $this->alamat,
                ]
            );

            // 2. Buat Header Pesanan
            $nomor_invoice = 'INV-'.strtoupper(Str::random(4)).'-'.date('YmdHi');
            $pesanan = Pesanan::create([
                'nomor_invoice' => $nomor_invoice,
                'pelanggan_id' => $pelanggan->id,
                'total_harga' => $total,
                'status_pembayaran' => 'pending',
                'status_pesanan' => 'baru',
                'catatan_pembeli' => $this->catatan,
            ]);

            // 3. Simpan Item & Update Stok
            foreach ($items as $item) {
                PesananItem::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $item['id'],
                    'kuantitas' => $item['kuantitas'],
                    'harga_satuan' => $item['harga'],
                    'subtotal' => $item['harga'] * $item['kuantitas'],
                ]);

                // Kurangi Stok
                $stok = Stok::where('produk_id', $item['id'])->first();
                if ($stok) {
                    $stok->decrement('jumlah', $item['kuantitas']);
                }
            }

            // 4. Catat Log
            $this->catatAktivitas(
                'tambah',
                'Pesanan',
                "Pesanan baru #{$nomor_invoice} dibuat oleh {$pelanggan->nama} senilai Rp ".number_format($total)
            );

            DB::commit();

            // 5. Kosongkan Keranjang & Redirect
            $layanan->kosongkan();
            $this->dispatch('keranjang-diperbarui');

            session()->flash('sukses_order', [
                'invoice' => $nomor_invoice,
                'total' => $total,
            ]);

            return redirect()->route('checkout.sukses');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notifikasi', pesan: 'Terjadi kesalahan sistem: '.$e->getMessage(), tipe: 'bahaya');
        }
    }

    /**
     * Render halaman checkout.
     */
    public function render(LayananKeranjang $layanan)
    {
        return view('livewire.publik.checkout.indeks', [
            'items' => $layanan->ambilSemua(),
            'total' => $layanan->totalHarga(),
        ])->layout('components.layouts.publik', ['title' => 'Checkout - Yala Computer']);
    }
}
