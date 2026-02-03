<?php

namespace App\Concerns;

/**
 * Trait PunyaMetaSEO
 * Tujuan: Mengelola metadata SEO secara dinamis di komponen Livewire.
 */
trait PunyaMetaSEO
{
    public $judulMeta;
    public $deskripsiMeta;
    public $gambarMeta;

    /**
     * Mengatur metadata untuk halaman.
     * 
     * @param string $judul
     * @param string|null $deskripsi
     * @param string|null $gambar
     */
    public function aturSEO(string $judul, ?string $deskripsi = null, ?string $gambar = null)
    {
        $this->judulMeta = $judul . ' | Yala Computer';
        $this->deskripsiMeta = $deskripsi ?? 'Pusat belanja komputer dan kebutuhan IT terlengkap dengan harga kompetitif dan garansi resmi di Yala Computer.';
        $this->gambarMeta = $gambar ?? asset('favicon.svg');
    }
}
