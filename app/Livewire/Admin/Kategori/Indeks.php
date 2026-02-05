<?php

/**
 * Komponen: Admin\Kategori\Indeks
 * Peran: Manajemen data kategori produk (CRUD)
 * Fitur: Daftar, Tambah, Edit, Hapus, Validasi, Log Aktivitas
 */

namespace App\Livewire\Admin\Kategori;

use App\Models\Kategori;
use App\Traits\PencatatLog;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Indeks extends Component
{
    use PencatatLog, WithPagination;

    // State Halaman
    public $mode = 'tambah'; // tambah, edit

    public $id_kategori_diedit;

    // Filter
    public $cari = '';

    // Form Fields
    public $nama;

    public $deskripsi;

    public $ikon;

    protected $updatesQueryString = ['cari'];

    /**
     * Reset pagination saat mencari.
     */
    public function updatedCari()
    {
        $this->resetPage();
    }

    /**
     * Reset form ke mode tambah.
     */
    public function resetForm()
    {
        $this->mode = 'tambah';
        $this->id_kategori_diedit = null;
        $this->nama = '';
        $this->deskripsi = '';
        $this->ikon = '';
        $this->resetErrorBag();
    }

    /**
     * Siapkan form untuk edit.
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        $this->mode = 'edit';
        $this->id_kategori_diedit = $id;
        $this->nama = $kategori->nama;
        $this->deskripsi = $kategori->deskripsi;
        $this->ikon = $kategori->ikon;
        $this->resetErrorBag();
    }

    /**
     * Simpan data (Tambah/Update).
     */
    public function simpan()
    {
        $aturan = [
            'nama' => 'required|min:3|unique:kategori,nama,'.($this->id_kategori_diedit ?? 'NULL'),
            'deskripsi' => 'nullable|string',
            'ikon' => 'nullable|string',
        ];

        $this->validate($aturan);

        if ($this->mode == 'tambah') {
            $kategori = Kategori::create([
                'nama' => $this->nama,
                'slug' => Str::slug($this->nama),
                'deskripsi' => $this->deskripsi,
                'ikon' => $this->ikon ?: 'fas fa-box',
            ]);

            $this->catatAktivitas('tambah', 'Kategori', "Menginisialisasi node sektor baru: {$kategori->nama}");
            $this->dispatch('notifikasi', pesan: 'Node sektor berhasil diaktifkan dalam jaringan!', tipe: 'sukses');
        } else {
            $kategori = Kategori::findOrFail($this->id_kategori_diedit);
            $namaLama = $kategori->nama;

            $kategori->update([
                'nama' => $this->nama,
                'slug' => Str::slug($this->nama),
                'deskripsi' => $this->deskripsi,
                'ikon' => $this->ikon,
            ]);

            $this->catatAktivitas('update', 'Kategori', "Rekonfigurasi parameter sektor dari {$namaLama} menjadi {$kategori->nama}");
            $this->dispatch('notifikasi', pesan: 'Sinkronisasi ulang data sektor berhasil!', tipe: 'sukses');
        }

        $this->resetForm();
    }

    /**
     * Hapus kategori.
     */
    public function hapus($id)
    {
        $kategori = Kategori::findOrFail($id);

        // Cek relasi produk
        if ($kategori->produk()->exists()) {
            $this->dispatch('notifikasi', pesan: 'Protokol Ditolak! Sektor masih menampung aset aktif.', tipe: 'bahaya');

            return;
        }

        $nama = $kategori->nama;
        $kategori->delete();

        $this->catatAktivitas('hapus', 'Kategori', "Terminasi permanen node sektor: {$nama}");
        $this->dispatch('notifikasi', pesan: 'Node sektor berhasil dihapus dari grid sistem!', tipe: 'sukses');
        $this->resetForm();
    }

    /**
     * Render komponen.
     */
    public function render()
    {
        $kategori = Kategori::withCount('produk')
            ->when($this->cari, fn ($q) => $q->where('nama', 'like', '%'.$this->cari.'%'))
            ->orderBy('nama')
            ->paginate(10);

        return view('livewire.admin.kategori.indeks', [
            'daftar_kategori' => $kategori,
        ])->layout('components.layouts.app', ['title' => 'Manajemen Kategori']);
    }
}
