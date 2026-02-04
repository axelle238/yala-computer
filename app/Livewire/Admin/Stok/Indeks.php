<?php

/**
 * Komponen: Admin\Stok\Indeks
 * Peran: Kontrol pusat mutasi stok (Stock In/Out) dan buku besar inventori
 */

namespace App\Livewire\Admin\Stok;

use App\Models\Produk;
use App\Models\Stok;
use App\Models\StokMutasi;
use App\Traits\PencatatLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Indeks extends Component
{
    use PencatatLog, WithPagination;

    // State
    public $produk_dipilih = null;

    public $jenis_aksi = 'masuk'; // masuk, keluar

    public $jumlah = 1;

    public $keterangan = '';

    // Filter
    public $cari_produk = '';

    /**
     * Pilih produk untuk mutasi.
     */
    public function pilihProduk($id)
    {
        $this->produk_dipilih = Produk::with('stok')->findOrFail($id);
        $this->resetErrorBag();
    }

    /**
     * Jalankan mutasi stok.
     */
    public function eksekusiMutasi()
    {
        if (! $this->produk_dipilih) {
            return;
        }

        $this->validate([
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $stok = Stok::where('produk_id', $this->produk_dipilih->id)->first();
            $jumlah_awal = $stok->jumlah;
            $perubahan = $this->jenis_aksi === 'masuk' ? $this->jumlah : -$this->jumlah;
            $jumlah_akhir = $jumlah_awal + $perubahan;

            if ($jumlah_akhir < 0) {
                throw new \Exception('Stok tidak mencukupi untuk pengurangan ini.');
            }

            // 1. Update Tabel Stok
            $stok->update(['jumlah' => $jumlah_akhir]);

            // 2. Catat di Buku Besar (Mutasi)
            StokMutasi::create([
                'produk_id' => $this->produk_dipilih->id,
                'pengguna_id' => Auth::id(),
                'jumlah_awal' => $jumlah_awal,
                'perubahan' => $perubahan,
                'jumlah_akhir' => $jumlah_akhir,
                'jenis' => $this->jenis_aksi,
                'keterangan' => $this->keterangan ?: "Penyesuaian stok {$this->jenis_aksi} secara manual.",
            ]);

            // 3. Catat Log Sistem
            $this->catatAktivitas(
                'update',
                'Stok',
                "Mutasi stok {$this->jenis_aksi}: {$this->produk_dipilih->nama} ({$perubahan} unit). Stok akhir: {$jumlah_akhir}"
            );

            DB::commit();

            $this->dispatch('notifikasi', pesan: 'Mutasi stok berhasil disinkronkan!', tipe: 'sukses');
            $this->resetForm();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notifikasi', pesan: 'Gagal: '.$e->getMessage(), tipe: 'bahaya');
        }
    }

    public function resetForm()
    {
        $this->produk_dipilih = null;
        $this->jumlah = 1;
        $this->keterangan = '';
        $this->jenis_aksi = 'masuk';
    }

    public function render()
    {
        $produk = Produk::with('stok', 'kategori')
            ->when($this->cari_produk, fn ($q) => $q->where('nama', 'like', '%'.$this->cari_produk.'%'))
            ->latest()
            ->paginate(8, ['*'], 'halProduk');

        $riwayat = StokMutasi::with(['produk', 'operator'])
            ->latest('waktu')
            ->paginate(10, ['*'], 'halRiwayat');

        return view('livewire.admin.stok.indeks', [
            'daftar_produk' => $produk,
            'riwayat_mutasi' => $riwayat,
        ])->layout('components.layouts.app', ['title' => 'Manajemen Stok & Mutasi']);
    }
}
