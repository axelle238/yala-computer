<?php

/**
 * Komponen: Admin\Pengguna\Indeks
 * Peran: Manajemen otorisasi dan identitas pengguna internal (Admin/Staf)
 */

namespace App\Livewire\Admin\Pengguna;

use App\Models\Pengguna;
use App\Traits\PencatatLog;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Indeks extends Component
{
    use PencatatLog, WithPagination;

    // State
    public $apakah_menambah = false;

    public $apakah_mengedit = false;

    public $id_dipilih;

    // Form
    public $nama;

    public $surel;

    public $kata_sandi;

    public $konfirmasi_kata_sandi;

    /**
     * Simpan data pengguna baru atau perbarui data lama.
     */
    public function simpan()
    {
        $aturan = [
            'nama' => 'required|min:3',
            'surel' => 'required|email|unique:pengguna,surel,'.($this->id_dipilih ?? 'NULL'),
        ];

        if ($this->apakah_menambah || $this->kata_sandi) {
            $aturan['kata_sandi'] = 'required|min:8';
            $aturan['konfirmasi_kata_sandi'] = 'same:kata_sandi';
        }

        $this->validate($aturan);

        if ($this->apakah_menambah) {
            $user = Pengguna::create([
                'nama' => $this->nama,
                'surel' => $this->surel,
                'kata_sandi' => Hash::make($this->kata_sandi),
            ]);

            $this->catatAktivitas('tambah', 'Administrator', "Mendaftarkan otorisasi baru untuk: {$user->nama}");
            $this->dispatch('notifikasi', pesan: 'Administrator berhasil didaftarkan!', tipe: 'sukses');
        } else {
            $user = Pengguna::findOrFail($this->id_dipilih);
            $data = [
                'nama' => $this->nama,
                'surel' => $this->surel,
            ];

            if ($this->kata_sandi) {
                $data['kata_sandi'] = Hash::make($this->kata_sandi);
            }

            $user->update($data);

            $this->catatAktivitas('update', 'Administrator', "Memperbarui parameter identitas: {$user->nama}");
            $this->dispatch('notifikasi', pesan: 'Data administrator diperbarui!', tipe: 'sukses');
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
        $user = Pengguna::findOrFail($id);
        $this->id_dipilih = $id;
        $this->nama = $user->nama;
        $this->surel = $user->surel;
        $this->apakah_mengedit = true;
    }

    public function hapus($id)
    {
        if ($id === auth()->id()) {
            $this->dispatch('notifikasi', pesan: 'Gagal! Tidak dapat menghapus node aktif sendiri.', tipe: 'bahaya');

            return;
        }

        $user = Pengguna::findOrFail($id);
        $nama = $user->nama;
        $user->delete();

        $this->catatAktivitas('hapus', 'Administrator', "Memutus akses node authority: {$nama}");
        $this->dispatch('notifikasi', pesan: 'Akses administrator dicabut!', tipe: 'sukses');
    }

    public function batal()
    {
        $this->apakah_menambah = false;
        $this->apakah_mengedit = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->nama = '';
        $this->surel = '';
        $this->kata_sandi = '';
        $this->konfirmasi_kata_sandi = '';
        $this->id_dipilih = null;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.pengguna.indeks', [
            'daftar_admin' => Pengguna::latest()->paginate(10),
        ])->layout('components.layouts.app', ['title' => 'Otoritas Sistem']);
    }
}
