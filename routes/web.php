<?php

use App\Livewire\Beranda;
use App\Livewire\Dashboard;
use App\Livewire\Admin\Produk\Index as AdminProdukIndex;
use App\Livewire\Checkout;
use App\Livewire\Keranjang\Index as KeranjangIndex;
use App\Livewire\PesananSukses;
use App\Livewire\Produk\Detail;
use Illuminate\Support\Facades\Route;

Route::get('/', Beranda::class)->name('home');
Route::get('/produk/{slug}', Detail::class)->name('produk.detail');
Route::get('/keranjang', KeranjangIndex::class)->name('keranjang');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/checkout', Checkout::class)->name('checkout');
    Route::get('/pesanan/sukses/{id}', PesananSukses::class)->name('pesanan.sukses');
    
    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::get('/produk', AdminProdukIndex::class)->name('produk.index');
        Route::get('/produk/tambah', App\Livewire\Admin\Produk\Form::class)->name('produk.tambah');
        Route::get('/produk/{id}/edit', App\Livewire\Admin\Produk\Form::class)->name('produk.edit');
    });
});

Route::get('dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
