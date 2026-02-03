<?php

use App\Livewire\Beranda;
use App\Livewire\Dasbor;
use App\Livewire\Admin\Produk\Index as AdminProdukIndex;
use App\Livewire\Pemesanan;
use App\Livewire\Keranjang\Index as KeranjangIndex;
use App\Livewire\PesananSukses;
use App\Livewire\Produk\Rincian;
use Illuminate\Support\Facades\Route;

Route::get('/', Beranda::class)->name('beranda');
Route::get('/produk/{slug}', Rincian::class)->name('produk.rincian');
Route::get('/kategori/{slug}', App\Livewire\Kategori\Detail::class)->name('kategori.detail');
Route::get('/keranjang', KeranjangIndex::class)->name('keranjang');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/pemesanan', Pemesanan::class)->name('pemesanan');
    Route::get('/pesanan/sukses/{id}', PesananSukses::class)->name('pesanan.sukses');
    Route::get('/pesanan-saya', App\Livewire\Pelanggan\Pesanan\Index::class)->name('pesanan.saya');
    Route::get('/pesanan-saya/{id}', App\Livewire\Pelanggan\Pesanan\Detail::class)->name('pesanan.saya.detail');
    
    // Rute Admin
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::get('/produk', AdminProdukIndex::class)->name('produk.index');
        Route::get('/produk/tambah', App\Livewire\Admin\Produk\Form::class)->name('produk.tambah');
        Route::get('/produk/{id}/edit', App\Livewire\Admin\Produk\Form::class)->name('produk.edit');
        
        // Pesanan
        Route::get('/pesanan', App\Livewire\Admin\Pesanan\Index::class)->name('pesanan.index');
        Route::get('/pesanan/{id}', App\Livewire\Admin\Pesanan\Detail::class)->name('pesanan.detail');

        // Kategori
        Route::get('/kategori', App\Livewire\Admin\Kategori\Index::class)->name('kategori.index');

        // Stok
        Route::get('/stok', App\Livewire\Admin\Stok\Index::class)->name('stok.index');
    });
});

Route::get('dasbor', Dasbor::class)
    ->middleware(['auth', 'verified'])
    ->name('dasbor');

require __DIR__.'/settings.php';
