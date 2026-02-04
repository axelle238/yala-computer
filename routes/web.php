<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Kategori\Indeks as KategoriIndeks;
use App\Livewire\Admin\Log\Indeks as LogIndeks;
use App\Livewire\Admin\Login;
use App\Livewire\Admin\Pelanggan\Indeks as PelangganIndeks;
use App\Livewire\Admin\Pengaturan\Indeks as PengaturanIndeks;
use App\Livewire\Admin\Pesanan\Indeks as PesananIndeks;
use App\Livewire\Admin\Produk\Indeks as ProdukIndeks;
use App\Livewire\Publik\Beranda;
use App\Livewire\Publik\Checkout\Indeks as CheckoutIndeks;
use App\Livewire\Publik\Checkout\Sukses as CheckoutSukses;
use App\Livewire\Publik\Katalog\Indeks as KatalogIndeks;
use App\Livewire\Publik\Keranjang\Indeks as KeranjangIndeks;
use App\Livewire\Publik\Produk\Detail as ProdukDetail;
use Illuminate\Support\Facades\Route;

/**
 * Route: Halaman Publik
 */
Route::get('/', Beranda::class)->name('beranda');
Route::get('/katalog', KatalogIndeks::class)->name('katalog');
Route::get('/produk/{slug}', ProdukDetail::class)->name('produk.detail');
Route::get('/keranjang', KeranjangIndeks::class)->name('keranjang');
Route::get('/checkout', CheckoutIndeks::class)->name('checkout');
Route::get('/terima-kasih', CheckoutSukses::class)->name('checkout.sukses');

/**
 * Route: Administrasi (Protected)
 */
Route::get('/masuk', Login::class)->name('login');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/produk', ProdukIndeks::class)->name('produk');
    Route::get('/kategori', KategoriIndeks::class)->name('kategori');
    Route::get('/pesanan', PesananIndeks::class)->name('pesanan');
    Route::get('/log', LogIndeks::class)->name('log');
    Route::get('/pengaturan', PengaturanIndeks::class)->name('pengaturan');
    Route::get('/pelanggan', PelangganIndeks::class)->name('pelanggan');
});
