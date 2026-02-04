<?php

/**
 * File Migrasi: Buat Tabel Banner
 * Peran: Menyimpan data banner promosi untuk slideshow halaman depan
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('gambar');
            $table->string('tautan_tombol')->nullable(); // Link tujuan (misal: /katalog?promo=ramadhan)
            $table->string('teks_tombol')->default('Lihat Promo');
            $table->integer('urutan')->default(0);
            $table->boolean('apakah_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banner');
    }
};
