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
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->nullable()->constrained('pengguna')->nullOnDelete();
            $table->string('tipe')->default('info'); // info, success, warning, danger
            $table->string('aksi'); // CREATE_PRODUCT, LOGIN, etc
            $table->string('target')->nullable(); // Nama entity yg diubah
            $table->text('pesan'); // Pesan teknis
            $table->text('pesan_naratif')->nullable(); // Narasi untuk manusia
            $table->json('meta_json')->nullable(); // Data teknis/snapshot
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
            
            // Indexing untuk performa query log
            $table->index(['created_at', 'tipe']);
            $table->index('pengguna_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};