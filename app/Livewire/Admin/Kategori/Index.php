<?php

namespace App\Livewire\Admin\Kategori;

use App\Actions\Log\CatatAktivitas;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Tujuan: Mengelola data kategori produk (CRUD Inline).
 * Peran: Menambah, mengedit, dan menghapus kategori tanpa pindah halaman atau modal.
 */
class Index extends Component
{
    use WithPagination;

    public $nama;
    public $slug;
    public $kategoriIdEdit = null;
    public $cari = '';

    protected $rules = [
        'nama' => 'required|min:3|max:255',
        'slug' => 'required|unique:kategori,slug',
    ];

    /**
     * Otomatis generate slug saat nama diketik.
     */
    public function updatedNama($value)
    {
        $this->slug = Str::slug($value);
    }

    /**
     * Menyiapkan form untuk mode edit.
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        $this->kategoriIdEdit = $id;
        $this->nama = $kategori->nama;
        $this->slug = $kategori->slug;
    }

    /**
     * Reset form ke mode tambah.
     */
    public function batal()
    {
        $this->reset(['nama', 'slug', 'kategoriIdEdit']);
        $this->resetErrorBag();
    }

    /**
     * Menyimpan kategori (Tambah atau Update).
     */
    public function simpan()
    {
        $rules = $this->rules;
        if ($this->kategoriIdEdit) {
            $rules['slug'] = 'required|unique:kategori,slug,' . $this->kategoriIdEdit;
        }

        $this->validate($rules);

        if ($this->kategoriIdEdit) {
            $kategori = Kategori::findOrFail($this->kategoriIdEdit);
            $kategori->update([
                'nama' => $this->nama,
                'slug' => $this->slug,
            ]);
            
            CatatAktivitas::catat('UPDATE_KATEGORI', $this->nama, "Admin memperbarui kategori: {$this->nama}");
            $pesan = "Kategori berhasil diperbarui!";
        } else {
            Kategori::create([
                'nama' => $this->nama,
                'slug' => $this->slug,
            ]);
            
            CatatAktivitas::catat('TAMBAH_KATEGORI', $this->nama, "Admin menambah kategori baru: {$this->nama}");
            $pesan = "Kategori baru berhasil ditambahkan!";
        }

        $this->batal();
        $this->dispatch('tampilkan-notifikasi', pesan: $pesan);
    }

    /**
     * Menghapus kategori.
     */
    public function hapus($id)
    {
        $kategori = Kategori::findOrFail($id);
        $namaKategori = $kategori->nama;
        $kategori->delete();

        CatatAktivitas::catat('HAPUS_KATEGORI', $namaKategori, "Admin menghapus kategori: {$namaKategori}");
        $this->dispatch('tampilkan-notifikasi', pesan: "Kategori {$namaKategori} berhasil dihapus!");
    }

    public function render()
    {
        $daftarKategori = Kategori::where('nama', 'like', '%' . $this->cari . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.kategori.index', [
            'daftarKategori' => $daftarKategori
        ])->layout('layouts.app');
    }
}
