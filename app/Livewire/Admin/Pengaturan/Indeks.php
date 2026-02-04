<?php

/**
 * Komponen: Admin\Pengaturan\Indeks
 * Peran: Mengelola konfigurasi dinamis aplikasi (Nama Toko, Alamat, Kontak, dll).
 */

namespace App\Livewire\Admin\Pengaturan;

use App\Models\Pengaturan;
use App\Traits\PencatatLog;
use Livewire\Component;

class Indeks extends Component
{
    use PencatatLog;

    public $nama_toko;

    public $telepon_toko;

    public $alamat_toko;

    public $email_toko;

    public $running_text;

    /**
     * Inisialisasi data.
     */
    public function mount()
    {
        $this->nama_toko = Pengaturan::ambil('nama_toko', 'Yala Computer');
        $this->telepon_toko = Pengaturan::ambil('telepon_toko', '+62 812-3456-7890');
        $this->alamat_toko = Pengaturan::ambil('alamat_toko', 'Jl. Teknologi No. 123, Jakarta');
        $this->email_toko = Pengaturan::ambil('email_toko', 'info@yalacomputer.com');
        $this->running_text = Pengaturan::ambil('running_text', 'Selamat datang di Yala Computer - Solusi Kebutuhan IT Anda!');
    }

    /**
     * Simpan pengaturan.
     */
    public function simpan()
    {
        $data = [
            'nama_toko' => $this->nama_toko,
            'telepon_toko' => $this->telepon_toko,
            'alamat_toko' => $this->alamat_toko,
            'email_toko' => $this->email_toko,
            'running_text' => $this->running_text,
        ];

        foreach ($data as $kunci => $nilai) {
            Pengaturan::updateOrCreate(['kunci' => $kunci], ['nilai' => $nilai]);
        }

        $this->catatAktivitas('update', 'Pengaturan', 'Memperbarui konfigurasi umum sistem.');
        $this->dispatch('notifikasi', pesan: 'Pengaturan berhasil disimpan!', tipe: 'sukses');
    }

    /**
     * Render komponen.
     */
    public function render()
    {
        return view('livewire.admin.pengaturan.indeks')
            ->layout('components.layouts.app', ['title' => 'Pengaturan Sistem']);
    }
}
