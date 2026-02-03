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
    public $schemaOrg;

    /**
     * Mengatur metadata untuk halaman.
     * 
     * @param string $judul
     * @param string|null $deskripsi
     * @param string|null $gambar
     * @param array|null $schema
     */
    public function aturSEO(string $judul, ?string $deskripsi = null, ?string $gambar = null, ?array $schema = null)
    {
        $this->judulMeta = $judul . ' | Yala Computer';
        $this->deskripsiMeta = $deskripsi ?? 'Pusat belanja komputer dan kebutuhan IT terlengkap dengan harga kompetitif dan garansi resmi di Yala Computer.';
        $this->gambarMeta = $gambar ?? asset('favicon.svg');
        $this->schemaOrg = $schema;
    }

    /**
     * Mengembalikan array data SEO untuk dilempar ke layout.
     * @return array
     */
    public function ambilDataSEO()
    {
        return [
            'judulMeta' => $this->judulMeta,
            'deskripsiMeta' => $this->deskripsiMeta,
            'gambarMeta' => $this->gambarMeta,
            'schemaOrg' => $this->schemaOrg,
        ];
    }
}
