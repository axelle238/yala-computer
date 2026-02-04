<?php

/**
 * File Migrasi: Buat Tabel Artikel
 * Peran: Menyimpan konten edukasi/berita untuk SEO dan informasi pelanggan
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->nullable()->constrained('pengguna')->onDelete('set null');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('konten');
            $table->string('gambar_sampul')->nullable();
            $table->string('kategori')->default('Berita');
            $table->boolean('apakah_diterbitkan')->default(true);
            $table->string('meta_judul')->nullable();
            $table->string('meta_deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};
