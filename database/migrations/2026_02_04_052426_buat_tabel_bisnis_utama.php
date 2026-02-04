<?php

/**
 * File Migrasi: Buat Tabel Bisnis Utama
 * Peran: Menyiapkan tabel untuk alur bisnis e-commerce (produk, pesanan, log)
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        // Tabel Kategori
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->string('ikon')->nullable();
            $table->timestamps();
        });

        // Tabel Produk
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi');
            $table->decimal('harga', 15, 2);
            $table->string('gambar_utama')->nullable();
            $table->json('galeri_gambar')->nullable();
            $table->boolean('apakah_aktif')->default(true);
            $table->boolean('apakah_unggulan')->default(false);
            $table->string('meta_judul')->nullable();
            $table->string('meta_deskripsi')->nullable();
            $table->timestamps();
        });

        // Tabel Stok
        Schema::create('stok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
            $table->integer('jumlah');
            $table->string('catatan')->nullable();
            $table->timestamps();
        });

        // Tabel Pelanggan
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('surel')->unique();
            $table->string('telepon')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kata_sandi')->nullable();
            $table->timestamps();
        });

        // Tabel Pesanan
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_invoice')->unique();
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggan')->onDelete('set null');
            $table->decimal('total_harga', 15, 2);
            $table->string('status_pembayaran')->default('pending'); // pending, lunas, gagal
            $table->string('status_pesanan')->default('baru'); // baru, diproses, dikirim, selesai, batal
            $table->text('catatan_pembeli')->nullable();
            $table->timestamps();
        });

        // Tabel Pesanan Item
        Schema::create('pesanan_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanan')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
            $table->integer('kuantitas');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
        });

        // Tabel Log Aktivitas
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->nullable()->constrained('pengguna')->onDelete('set null');
            $table->string('aksi'); // tambah, update, hapus, login, dll
            $table->string('target')->nullable(); // nama tabel atau entitas
            $table->text('pesan_naratif');
            $table->json('meta_json')->nullable();
            $table->timestamp('waktu')->useCurrent();
        });

        // Tabel Pengaturan
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('kunci')->unique();
            $table->text('nilai')->nullable();
            $table->string('grup')->default('umum');
            $table->timestamps();
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
        Schema::dropIfExists('log_aktivitas');
        Schema::dropIfExists('pesanan_item');
        Schema::dropIfExists('pesanan');
        Schema::dropIfExists('pelanggan');
        Schema::dropIfExists('stok');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('kategori');
    }
};
