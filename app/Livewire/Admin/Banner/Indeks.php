<?php

/**
 * Komponen: Admin\Banner\Indeks
 * Peran: Manajemen banner promosi (CRUD)
 */

namespace App\Livewire\Admin\Banner;

use App\Models\Banner;
use App\Traits\PencatatLog;
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

    // Form
    public $judul;

    public $deskripsi;

    public $gambar;

    public $tautan_tombol;

    public $teks_tombol = 'Lihat Promo';

    public $urutan = 0;

    public $apakah_aktif = true;

    /**
     * Simpan data.
     */
    public function simpan()
    {
        $aturan = [
            'judul' => 'required|min:3',
            'deskripsi' => 'nullable',
            'teks_tombol' => 'required',
            'urutan' => 'integer',
        ];

        if ($this->apakah_menambah) {
            $aturan['gambar'] = 'required|image|max:2048';
        } else {
            $aturan['gambar'] = 'nullable|image|max:2048';
        }

        $this->validate($aturan);

        $jalur_gambar = $this->gambar ? $this->gambar->store('banner', 'public') : null;

        if ($this->apakah_menambah) {
            $banner = Banner::create([
                'judul' => $this->judul,
                'deskripsi' => $this->deskripsi,
                'gambar' => $jalur_gambar,
                'tautan_tombol' => $this->tautan_tombol,
                'teks_tombol' => $this->teks_tombol,
                'urutan' => $this->urutan,
                'apakah_aktif' => $this->apakah_aktif,
            ]);

            $this->catatAktivitas('tambah', 'Banner', "Menambahkan banner promosi baru: {$banner->judul}");
            $this->dispatch('notifikasi', pesan: 'Banner berhasil diterbitkan!', tipe: 'sukses');
        } else {
            $banner = Banner::findOrFail($this->id_dipilih);
            $data = [
                'judul' => $this->judul,
                'deskripsi' => $this->deskripsi,
                'tautan_tombol' => $this->tautan_tombol,
                'teks_tombol' => $this->teks_tombol,
                'urutan' => $this->urutan,
                'apakah_aktif' => $this->apakah_aktif,
            ];

            if ($jalur_gambar) {
                $data['gambar'] = $jalur_gambar;
            }

            $banner->update($data);

            $this->catatAktivitas('update', 'Banner', "Memperbarui banner: {$banner->judul}");
            $this->dispatch('notifikasi', pesan: 'Banner berhasil diperbarui!', tipe: 'sukses');
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
        $banner = Banner::findOrFail($id);
        $this->id_dipilih = $id;
        $this->judul = $banner->judul;
        $this->deskripsi = $banner->deskripsi;
        $this->tautan_tombol = $banner->tautan_tombol;
        $this->teks_tombol = $banner->teks_tombol;
        $this->urutan = $banner->urutan;
        $this->apakah_aktif = $banner->apakah_aktif;

        $this->apakah_mengedit = true;
    }

    public function hapus($id)
    {
        $banner = Banner::findOrFail($id);
        $judul = $banner->judul;
        $banner->delete();

        $this->catatAktivitas('hapus', 'Banner', "Menghapus banner: {$judul}");
        $this->dispatch('notifikasi', pesan: 'Banner berhasil dihapus!', tipe: 'info');
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
        $this->deskripsi = '';
        $this->gambar = null;
        $this->tautan_tombol = '';
        $this->teks_tombol = 'Lihat Promo';
        $this->urutan = 0;
        $this->apakah_aktif = true;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.banner.indeks', [
            'daftar_banner' => Banner::orderBy('urutan')->latest()->paginate(10),
        ])->layout('components.layouts.app', ['title' => 'Manajemen Banner']);
    }
}
