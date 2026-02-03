<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel Kategori
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Tabel Produk
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi_pendek')->nullable();
            $table->longText('deskripsi_lengkap')->nullable();
            $table->decimal('harga_modal', 15, 2)->default(0);
            $table->decimal('harga_jual', 15, 2)->default(0);
            $table->integer('stok')->default(0);
            $table->integer('berat_gram')->default(0);
            $table->json('spesifikasi_json')->nullable(); // CPU: Intel i5, RAM: 8GB
            $table->json('gambar_json')->nullable(); // Array path gambar
            $table->enum('status', ['aktif', 'arsip'])->default('aktif');
            $table->timestamps();
        });

        // Tabel Pesanan
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_invoice')->unique(); // INV-YYYYMMDD-XXXX
            $table->foreignId('pengguna_id')->constrained('pengguna')->onDelete('cascade');
            $table->decimal('total_barang', 15, 2);
            $table->decimal('biaya_pengiriman', 15, 2)->default(0);
            $table->decimal('total_bayar', 15, 2);
            $table->enum('status', ['menunggu_pembayaran', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('menunggu_pembayaran');
            $table->text('catatan')->nullable();
            $table->json('informasi_pengiriman_json')->nullable(); // Snapshot alamat saat beli
            $table->timestamps();
        });

        // Tabel Detail Pesanan
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanan')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 15, 2); // Harga saat dibeli
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
        });

        // Tabel Log Aktivitas
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->nullable()->constrained('pengguna')->nullOnDelete();
            $table->string('aksi'); // TAMBAH_PRODUK, UPDATE_STOK, LOGIN
            $table->string('target')->nullable(); // Nama Produk / ID Pesanan
            $table->text('pesan_naratif'); // "Admin X mengubah stok Laptop Y"
            $table->json('meta_json')->nullable(); // Data teknis tambahan
            $table->timestamp('waktu')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
        Schema::dropIfExists('detail_pesanan');
        Schema::dropIfExists('pesanan');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('kategori');
    }
};
