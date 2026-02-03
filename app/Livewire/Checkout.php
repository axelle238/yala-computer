<?php

namespace App\Livewire;

use App\Actions\Log\CatatAktivitas;
use App\Models\DetailPesanan;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Checkout extends Component
{
    public $nama_penerima;
    public $nomor_telepon;
    public $alamat_lengkap;
    public $catatan;
    
    public $ekspedisi = 'jne'; // Default dummy
    public $biaya_pengiriman = 25000; // Flat rate dummy

    public function mount()
    {
        $user = Auth::user();
        $this->nama_penerima = $user->nama;
        $this->nomor_telepon = $user->nomor_telepon;
        $this->alamat_lengkap = $user->alamat_lengkap;
    }

    public function buatPesanan()
    {
        $this->validate([
            'nama_penerima' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'ekspedisi' => 'required',
        ]);

        $userId = Auth::id();
        $items = Keranjang::where('pengguna_id', $userId)->with('produk')->get();

        if ($items->isEmpty()) {
            return redirect()->route('keranjang');
        }

        // Cek stok lagi sebelum finalisasi
        foreach ($items as $item) {
            if ($item->jumlah > $item->produk->stok) {
                $this->addError('stok', "Stok produk {$item->produk->nama} tidak mencukupi.");
                return;
            }
        }

        DB::beginTransaction();

        try {
            $totalBarang = $items->sum(fn($item) => $item->jumlah * $item->produk->harga_jual);
            $totalBayar = $totalBarang + $this->biaya_pengiriman;
            $nomorInvoice = 'INV/' . date('Ymd') . '/' . mt_rand(1000, 9999);

            // 1. Buat Pesanan Header
            $pesanan = Pesanan::create([
                'nomor_invoice' => $nomorInvoice,
                'pengguna_id' => $userId,
                'total_barang' => $totalBarang,
                'biaya_pengiriman' => $this->biaya_pengiriman,
                'total_bayar' => $totalBayar,
                'status' => 'menunggu_pembayaran',
                'catatan' => $this->catatan,
                'informasi_pengiriman_json' => [
                    'nama_penerima' => $this->nama_penerima,
                    'nomor_telepon' => $this->nomor_telepon,
                    'alamat_lengkap' => $this->alamat_lengkap,
                    'ekspedisi' => $this->ekspedisi,
                ],
            ]);

            // 2. Buat Detail Pesanan & Kurangi Stok
            foreach ($items as $item) {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $item->produk_id,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->produk->harga_jual,
                    'subtotal' => $item->jumlah * $item->produk->harga_jual,
                ]);

                // Kurangi Stok via Helper untuk mencatat riwayat
                \App\Actions\Stok\ManajemenStok::kurang(
                    $item->produk_id, 
                    $item->jumlah, 
                    'Penjualan #' . $nomorInvoice, 
                    $pesanan->id
                );
            }

            // 3. Hapus Keranjang
            Keranjang::where('pengguna_id', $userId)->delete();

            // 4. Catat Log Aktivitas
            CatatAktivitas::catat(
                'BUAT_PESANAN',
                $nomorInvoice,
                "{$this->nama_penerima} membuat pesanan baru senilai Rp " . number_format($totalBayar, 0, ',', '.')
            );

            DB::commit();

            // Redirect ke halaman sukses / riwayat pesanan (sementara ke dashboard atau halaman khusus sukses)
            return redirect()->route('pesanan.sukses', ['id' => $pesanan->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('transaksi', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $items = Keranjang::where('pengguna_id', Auth::id())->with('produk')->get();
        $subtotal = $items->sum(fn($item) => $item->jumlah * $item->produk->harga_jual);
        $totalBayar = $subtotal + $this->biaya_pengiriman;

        return view('livewire.checkout', [
            'items' => $items,
            'subtotal' => $subtotal,
            'totalBayar' => $totalBayar
        ])->layout('layouts.toko');
    }
}
