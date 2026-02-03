<?php

use App\Livewire\Beranda;
use Illuminate\Support\Facades\Route;

Route::get('/', Beranda::class)->name('home');

use App\Livewire\Dashboard;

Route::get('dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
