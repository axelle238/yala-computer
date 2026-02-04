<?php

/**
 * Komponen: Admin\Artikel\Indeks
 * Peran: Manajemen konten artikel (Blog/SEO)
 */

namespace App\Livewire\Admin\Artikel;

use App\Models\Artikel;
use App\Traits\PencatatLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Indeks extends Component
{
    use PencatatLog, WithFileUploads, WithPagination;

    // State
    public $apakah_menambah = false;

    public $apakah_mengedit = false;

    public $id_dipilih;

    // Filter
    public $cari = '';

    // Form
    public $judul;

    public $kategori = 'Berita';

    public $konten;

    public $gambar_sampul;

    public $apakah_diterbitkan = true;

    /**
     * Reset pagination.
     */
    public function updatedCari()
    {
        $this->resetPage();
    }

    /**
     * Simpan data.
     */
    public function simpan()
    {
        $this->validate([
            'judul' => 'required|min:5',
            'konten' => 'required',
            'kategori' => 'required',
        ]);

        $slug = Str::slug($this->judul).'-'.rand(100, 999);

        if ($this->apakah_menambah) {
            $artikel = Artikel::create([
                'pengguna_id' => Auth::id(),
                'judul' => $this->judul,
                'slug' => $slug,
                'konten' => $this->konten,
                'kategori' => $this->kategori,
                'apakah_diterbitkan' => $this->apakah_diterbitkan,
            ]);

            $this->catatAktivitas('tambah', 'Artikel', "Membuat artikel baru: {$artikel->judul}");
            $this->dispatch('notifikasi', pesan: 'Artikel berhasil diterbitkan!', tipe: 'sukses');
        } else {
            $artikel = Artikel::findOrFail($this->id_dipilih);
            $artikel->update([
                'judul' => $this->judul,
                'konten' => $this->konten,
                'kategori' => $this->kategori,
                'apakah_diterbitkan' => $this->apakah_diterbitkan,
            ]);

            $this->catatAktivitas('update', 'Artikel', "Memperbarui artikel: {$artikel->judul}");
            $this->dispatch('notifikasi', pesan: 'Artikel berhasil diperbarui!', tipe: 'sukses');
        }

        $this->batal();
    }

    public function tambah()
    {
        $this->resetForm();
        $this->apakah_menambah = true;
    }

    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        $this->id_dipilih = $id;
        $this->judul = $artikel->judul;
        $this->konten = $artikel->konten;
        $this->kategori = $artikel->kategori;
        $this->apakah_diterbitkan = $artikel->apakah_diterbitkan;
        $this->apakah_mengedit = true;
    }

    public function batal()
    {
        $this->apakah_menambah = false;
        $this->apakah_mengedit = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->judul = '';
        $this->konten = '';
        $this->kategori = 'Berita';
        $this->apakah_diterbitkan = true;
        $this->resetErrorBag();
    }

    public function render()
    {
        $artikel = Artikel::with('penulis')
            ->when($this->cari, fn ($q) => $q->where('judul', 'like', '%'.$this->cari.'%'))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.artikel.indeks', [
            'daftar_artikel' => $artikel,
        ])->layout('components.layouts.app', ['title' => 'Manajemen Artikel']);
    }
}
