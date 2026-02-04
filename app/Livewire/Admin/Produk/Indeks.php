<?php

/**
 * Komponen: Admin\Produk\Indeks
 * Peran: Manajemen data produk komputer (Daftar, Tambah, Edit, Hapus)
 * Fitur: Pencarian real-time, Tanpa Modal, Log Aktivitas Naratif
 */

namespace App\Livewire\Admin\Produk;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Stok;
use App\Traits\PencatatLog;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Indeks extends Component
{
    use PencatatLog, WithFileUploads, WithPagination;

    // State Halaman
    public $apakah_menambah = false;

    public $apakah_mengedit = false;

    public $id_produk_dipilih;

    // Filter & Cari
    public $cari = '';

    public $filter_kategori = '';

    // Form Fields
    public $kategori_id;

    public $nama;

    public $deskripsi;

    public $harga;

    public $gambar_utama;

    public $galeri_baru = [];

    public $apakah_aktif = true;

    public $apakah_unggulan = false;

    public $stok_awal = 0;

    protected $updatesQueryString = ['cari', 'filter_kategori'];

    /**
     * Reset pagination saat mencari.
     */
    public function updatedCari()
    {
        $this->resetPage();
    }

    /**
     * Tampilkan form tambah.
     */
    public function tampilkanFormTambah()
    {
        $this->resetForm();
        $this->apakah_menambah = true;
        $this->apakah_mengedit = false;
    }

    /**
     * Simpan produk baru.
     */
    public function simpan()
    {
        $this->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'nama' => 'required|min:3',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok_awal' => 'required|integer|min:0',
            'gambar_utama' => 'nullable|image|max:2048',
            'galeri_baru.*' => 'nullable|image|max:2048',
        ]);

        $jalur_utama = $this->gambar_utama ? $this->gambar_utama->store('produk', 'public') : null;

        $galeri = [];
        if ($this->galeri_baru) {
            foreach ($this->galeri_baru as $g) {
                $galeri[] = $g->store('produk/galeri', 'public');
            }
        }

        $slug = Str::slug($this->nama).'-'.rand(1000, 9999);

        if ($this->apakah_menambah) {
            $produk = Produk::create([
                'kategori_id' => $this->kategori_id,
                'nama' => $this->nama,
                'slug' => $slug,
                'deskripsi' => $this->deskripsi,
                'harga' => $this->harga,
                'gambar_utama' => $jalur_utama,
                'galeri_gambar' => $galeri,
                'apakah_aktif' => $this->apakah_aktif,
                'apakah_unggulan' => $this->apakah_unggulan,
            ]);

            // Simpan Stok
            Stok::create([
                'produk_id' => $produk->id,
                'jumlah' => $this->stok_awal,
                'catatan' => 'Stok awal saat pembuatan produk.',
            ]);

            $this->catatAktivitas(
                'tambah',
                'Produk',
                "Berhasil mendaftarkan produk baru: {$produk->nama}"
            );
        } else {
            $produk = Produk::findOrFail($this->id_produk_dipilih);

            $data = [
                'kategori_id' => $this->kategori_id,
                'nama' => $this->nama,
                'deskripsi' => $this->deskripsi,
                'harga' => $this->harga,
                'apakah_aktif' => $this->apakah_aktif,
                'apakah_unggulan' => $this->apakah_unggulan,
            ];

            if ($jalur_utama) {
                $data['gambar_utama'] = $jalur_utama;
            }
            if (! empty($galeri)) {
                $data['galeri_gambar'] = array_merge($produk->galeri_gambar ?? [], $galeri);
            }

            $produk->update($data);

            $this->catatAktivitas(
                'update',
                'Produk',
                "Memperbarui parameter teknis produk: {$produk->nama}"
            );
        }

        $this->dispatch('notifikasi', pesan: 'Siklus data produk berhasil disinkronkan!', tipe: 'sukses');
        $this->batal();
    }

    /**
     * Sembunyikan form.
     */
    public function batal()
    {
        $this->apakah_menambah = false;
        $this->apakah_mengedit = false;
        $this->resetForm();
    }

    /**
     * Reset field form.
     */
    private function resetForm()
    {
        $this->kategori_id = '';
        $this->nama = '';
        $this->deskripsi = '';
        $this->harga = '';
        $this->gambar_utama = null;
        $this->galeri_baru = [];
        $this->apakah_aktif = true;
        $this->apakah_unggulan = false;
        $this->stok_awal = 0;
    }

    /**
     * Siapkan form edit.
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $this->id_produk_dipilih = $id;
        $this->kategori_id = $produk->kategori_id;
        $this->nama = $produk->nama;
        $this->deskripsi = $produk->deskripsi;
        $this->harga = $produk->harga;
        $this->apakah_aktif = $produk->apakah_aktif;
        $this->apakah_unggulan = $produk->apakah_unggulan;
        $this->stok_awal = $produk->jumlah_stok;

        $this->apakah_mengedit = true;
        $this->apakah_menambah = false;
    }

    /**
     * Hapus produk.
     */
    public function hapus($id)
    {
        $produk = Produk::findOrFail($id);
        $nama = $produk->nama;
        $produk->delete();

        $this->catatAktivitas('hapus', 'Produk', "Resource produk dimusnahkan dari sistem: {$nama}");
        $this->dispatch('notifikasi', pesan: 'Data produk berhasil dimusnahkan!', tipe: 'info');
    }

    /**
     * Render komponen.
     */
    public function render()
    {
        $produk = Produk::query()
            ->with(['kategori', 'stok'])
            ->when($this->cari, fn ($q) => $q->where('nama', 'like', '%'.$this->cari.'%'))
            ->when($this->filter_kategori, fn ($q) => $q->where('kategori_id', $this->filter_kategori))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.produk.indeks', [
            'daftar_produk' => $produk,
            'daftar_kategori' => Kategori::orderBy('nama')->get(),
        ])->layout('components.layouts.app', ['title' => 'Manajemen Produk']);
    }
}
