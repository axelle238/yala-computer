<?php

/**
 * File Migrasi: Buat Tabel Sistem Inti
 * Peran: Menyiapkan tabel dasar untuk sistem (pengguna, sesi, tembolok, pekerjaan)
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     * Tujuan: Membuat tabel pengguna dan tabel pendukung sistem.
     * Catatan: Nama kolom tabel sistem tetap menggunakan standar Laravel agar driver berfungsi.
     */
    public function up(): void
    {
        // Tabel Pengguna (Bisnis - bisa Bahasa Indonesia penuh)
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('surel')->unique();
            $table->timestamp('surel_diverifikasi_pada')->nullable();
            $table->string('kata_sandi');
            $table->rememberToken();
            $table->timestamps();
        });

        // Tabel Token Reset Kata Sandi
        Schema::create('token_reset_kata_sandi', function (Blueprint $table) {
            $table->string('surel')->primary();
            $table->string('token');
            $table->timestamp('dibuat_pada')->nullable();
        });

        // Tabel Sesi
        Schema::create('sesi', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('pengguna_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Tabel Tembolok
        Schema::create('tembolok', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        // Tabel Kunci Tembolok
        Schema::create('kunci_tembolok', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });

        // Tabel Pekerjaan
        Schema::create('pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        // Tabel Umpan Pekerjaan
        Schema::create('umpan_pekerjaan', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        // Tabel Pekerjaan Gagal
        Schema::create('pekerjaan_gagal', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
        Schema::dropIfExists('token_reset_kata_sandi');
        Schema::dropIfExists('sesi');
        Schema::dropIfExists('tembolok');
        Schema::dropIfExists('kunci_tembolok');
        Schema::dropIfExists('pekerjaan');
        Schema::dropIfExists('umpan_pekerjaan');
        Schema::dropIfExists('pekerjaan_gagal');
    }
};
