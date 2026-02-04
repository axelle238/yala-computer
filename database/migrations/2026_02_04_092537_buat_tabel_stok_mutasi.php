<?php

/**
 * File Migrasi: Buat Tabel Stok Mutasi
 * Peran: Mencatat setiap perubahan pergerakan barang untuk transparansi inventori
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stok_mutasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
            $table->foreignId('pengguna_id')->nullable()->constrained('pengguna')->onDelete('set null');
            $table->integer('jumlah_awal');
            $table->integer('perubahan'); // Positif (+) untuk masuk, Negatif (-) untuk keluar
            $table->integer('jumlah_akhir');
            $table->string('jenis'); // masuk, keluar, penjualan, penyesuaian
            $table->text('keterangan')->nullable();
            $table->timestamp('waktu')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stok_mutasi');
    }
};
