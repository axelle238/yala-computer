<?php

namespace App\Livewire\Admin\Produk;

use App\Actions\Log\CatatAktivitas;
use App\Actions\Stok\ManajemenStok;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\RiwayatStok;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
    public $produkId;
    public $kategori_id;
    public $nama;
    public $slug;
    public $deskripsi_pendek;
    public $deskripsi_lengkap;
    public $harga_modal;
    public $harga_jual;
    public $stok;
    public $berat_gram;
    public $status = 'aktif';

    public function mount($id = null)
    {
        if ($id) {
            $produk = Produk::findOrFail($id);
            $this->produkId = $produk->id;
            $this->kategori_id = $produk->kategori_id;
            $this->nama = $produk->nama;
            $this->slug = $produk->slug;
            $this->deskripsi_pendek = $produk->deskripsi_pendek;
            $this->deskripsi_lengkap = $produk->deskripsi_lengkap;
            $this->harga_modal = $produk->harga_modal;
            $this->harga_jual = $produk->harga_jual;
            $this->stok = $produk->stok;
            $this->berat_gram = $produk->berat_gram;
            $this->status = $produk->status;
        }
    }

    public function updatedNama($value)
    {
        if (!$this->produkId) {
            $this->slug = Str::slug($value);
        }
    }

    public function simpan()
    {
        $this->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|unique:produk,slug,' . $this->produkId,
            'harga_modal' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'berat_gram' => 'required|integer|min:0',
            'status' => 'required|in:aktif,arsip',
        ]);

        $data = [
            'kategori_id' => $this->kategori_id,
            'nama' => $this->nama,
            'slug' => $this->slug,
            'deskripsi_pendek' => $this->deskripsi_pendek,
            'deskripsi_lengkap' => $this->deskripsi_lengkap,
            'harga_modal' => $this->harga_modal,
            'harga_jual' => $this->harga_jual,
            'stok' => $this->stok,
            'berat_gram' => $this->berat_gram,
            'status' => $this->status,
        ];

        if ($this->produkId) {
            $produk = Produk::find($this->produkId);
            $stokLama = $produk->stok;
            
            $produk->update($data);
            
            CatatAktivitas::catat('UPDATE_PRODUK', $this->nama, "Admin memperbarui data produk {$this->nama}");
            
            // Cek perubahan stok
            if ($stokLama != $this->stok) {
                $selisih = $this->stok - $stokLama;
                $jenis = $selisih > 0 ? 'masuk' : 'keluar';
                $jumlah = abs($selisih);
                
                RiwayatStok::create([
                    'produk_id' => $produk->id,
                    'pengguna_id' => auth()->id(),
                    'jenis' => $jenis,
                    'jumlah' => $jumlah,
                    'stok_awal' => $stokLama,
                    'stok_akhir' => $this->stok,
                    'keterangan' => 'Penyesuaian via Edit Produk',
                    'referensi' => 'Edit',
                ]);
            }
        } else {
            $produk = Produk::create($data);
            
            CatatAktivitas::catat('TAMBAH_PRODUK', $this->nama, "Admin menambahkan produk baru {$this->nama}");
            
            // Catat stok awal
            if ($this->stok > 0) {
                RiwayatStok::create([
                    'produk_id' => $produk->id,
                    'pengguna_id' => auth()->id(),
                    'jenis' => 'masuk',
                    'jumlah' => $this->stok,
                    'stok_awal' => 0,
                    'stok_akhir' => $this->stok,
                    'keterangan' => 'Stok Awal Produk Baru',
                    'referensi' => 'Baru',
                ]);
            }
        }

        session()->flash('message', 'Data produk berhasil disimpan.');
        return redirect()->route('admin.produk.index');
    }

    public function render()
    {
        return view('livewire.admin.produk.form', [
            'kategori_list' => Kategori::all()
        ])->layout('layouts.app');
    }
}
