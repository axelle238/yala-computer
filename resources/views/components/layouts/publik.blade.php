<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Yala Computer - Toko Komputer Terlengkap' }}</title>
    
    <!-- SEO Meta -->
    <meta name="description" content="{{ $meta_deskripsi ?? 'Pusat belanja komputer, laptop, dan aksesoris terlengkap dengan harga terbaik di Indonesia.' }}">
    <meta name="keywords" content="komputer, laptop, pc rakitan, sparepart, aksesoris, yala computer">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Yala Computer' }}">
    <meta property="og:description" content="{{ $meta_deskripsi ?? 'Belanja kebutuhan IT lengkap di Yala Computer.' }}">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-['Plus_Jakarta_Sans'] bg-gray-50 text-gray-900 antialiased overflow-x-hidden flex flex-col min-h-screen">

    <!-- Navigasi Utama -->
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <!-- Baris Atas (Info & Running Text) -->
        <div class="bg-blue-900 text-white py-2 px-4 hidden md:block overflow-hidden">
            <div class="container mx-auto flex justify-between items-center text-xs font-medium relative">
                <div class="flex gap-4 items-center bg-blue-900 z-10 pr-4">
                    <span><i class="fas fa-phone-alt mr-2"></i>{{ \App\Models\Pengaturan::ambil('telepon_toko', '+62 812-3456-7890') }}</span>
                    <span><i class="fas fa-envelope mr-2"></i>{{ \App\Models\Pengaturan::ambil('email_toko', 'info@yalacomputer.com') }}</span>
                </div>
                
                <div class="flex-1 px-8">
                    <div class="whitespace-nowrap animate-marquee">
                        <span class="inline-block px-4"><i class="fas fa-bullhorn mr-2"></i>{{ \App\Models\Pengaturan::ambil('running_text', 'Selamat datang di Yala Computer - Solusi Kebutuhan IT Anda!') }}</span>
                    </div>
                </div>

                <div class="flex gap-4 items-center bg-blue-900 z-10 pl-4">
                    <span>Buka: Senin - Sabtu (09:00 - 17:00)</span>
                </div>
            </div>
        </div>

        <!-- Baris Utama (Logo & Pencarian) -->
        <div class="container mx-auto px-4 py-4 flex items-center gap-4 md:gap-8">
            <!-- Logo -->
            <a href="{{ url('/') }}" wire:navigate class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-200 group-hover:rotate-6 transition-transform">
                    <i class="fas fa-laptop-code text-xl"></i>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-xl leading-none text-blue-900 tracking-tight">YALA</span>
                    <span class="text-[10px] font-bold text-blue-400 tracking-widest uppercase">Computer</span>
                </div>
            </a>

            <!-- Pencarian (Desktop) -->
            <div class="flex-1 hidden md:block max-w-2xl relative">
                <input type="text" placeholder="Cari laptop, monitor, atau sparepart..." class="w-full bg-gray-100 border-none rounded-xl py-3 px-5 pl-12 text-sm focus:ring-2 focus:ring-blue-500 transition-all">
                <i class="fas fa-search absolute left-4 top-3.5 text-gray-400"></i>
                <button class="absolute right-2 top-2 bg-blue-600 text-white px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-blue-700 transition-colors">
                    CARI
                </button>
            </div>

            <!-- Menu Kanan -->
            <div class="flex items-center gap-2 md:gap-4 ml-auto">
                <!-- Keranjang -->
                <livewire:publik.keranjang.ikon />

                <!-- User Account -->
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 bg-blue-50 hover:bg-blue-100 px-3 py-2 rounded-xl transition-colors">
                        <div class="w-6 h-6 rounded-full bg-blue-200 flex items-center justify-center text-blue-700 text-xs font-bold">
                            {{ substr(auth()->user()->nama, 0, 1) }}
                        </div>
                        <span class="text-xs font-bold text-blue-800 hidden md:inline">Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-blue-600 px-3 py-2">Masuk</a>
                    <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold px-5 py-2.5 rounded-xl shadow-lg shadow-blue-200 transition-all hidden md:inline-block">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>

        <!-- Menu Kategori (Navigasi Bawah) -->
        <div class="border-t border-gray-100 overflow-x-auto">
            <div class="container mx-auto px-4">
                <nav class="flex items-center gap-6 text-sm font-medium whitespace-nowrap">
                    <a href="{{ url('/') }}" wire:navigate class="py-3 border-b-2 {{ request()->is('/') ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-600 hover:text-blue-600' }}">Beranda</a>
                    <a href="{{ url('/katalog') }}" wire:navigate class="py-3 border-b-2 {{ request()->is('katalog') ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-600 hover:text-blue-600' }}">Semua Produk</a>
                    <a href="{{ url('/blog') }}" wire:navigate class="py-3 border-b-2 {{ request()->is('blog*') ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-600 hover:text-blue-600' }}">Blog & Edukasi</a>
                    <a href="#" class="py-3 border-b-2 border-transparent text-gray-600 hover:text-blue-600">Laptop</a>
                    <a href="#" class="py-3 border-b-2 border-transparent text-gray-600 hover:text-blue-600">Rakitan PC</a>
                    <a href="#" class="py-3 border-b-2 border-transparent text-gray-600 hover:text-blue-600">Aksesoris</a>
                    <a href="#" class="py-3 border-b-2 border-transparent text-red-500 hover:text-red-700 font-bold flex items-center gap-1">
                        <i class="fas fa-fire-alt"></i> Promo Spesial
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Konten Halaman -->
    <main class="flex-1">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- Tentang -->
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <span class="font-bold text-lg text-blue-900">YALA COMP</span>
                    </div>
                    <p class="text-sm text-gray-500 leading-relaxed mb-6">
                        Toko komputer terpercaya yang menyediakan berbagai kebutuhan teknologi mulai dari laptop, PC rakitan, hingga sparepart dengan garansi resmi dan pelayanan terbaik.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 hover:bg-blue-600 hover:text-white transition-all"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 hover:bg-pink-600 hover:text-white transition-all"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 hover:bg-green-600 hover:text-white transition-all"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Link Cepat -->
                <div>
                    <h3 class="font-bold text-gray-900 mb-6">Belanja</h3>
                    <ul class="space-y-3 text-sm text-gray-500">
                        <li><a href="{{ route('katalog') }}" wire:navigate class="hover:text-blue-600">Semua Produk</a></li>
                        <li><a href="{{ route('lacak') }}" wire:navigate class="hover:text-blue-600">Lacak Pesanan</a></li>
                        <li><a href="#" class="hover:text-blue-600">Promo Hari Ini</a></li>
                        <li><a href="#" class="hover:text-blue-600">Konfirmasi Pembayaran</a></li>
                    </ul>
                </div>

                <!-- Bantuan -->
                <div>
                    <h3 class="font-bold text-gray-900 mb-6">Bantuan</h3>
                    <ul class="space-y-3 text-sm text-gray-500">
                        <li><a href="{{ route('halaman', 'cara-pemesanan') }}" wire:navigate class="hover:text-blue-600">Cara Pemesanan</a></li>
                        <li><a href="{{ route('halaman', 'garansi') }}" wire:navigate class="hover:text-blue-600">Kebijakan Garansi</a></li>
                        <li><a href="{{ route('halaman', 'tentang-kami') }}" wire:navigate class="hover:text-blue-600">Tentang Kami</a></li>
                        <li><a href="{{ route('halaman', 'kontak') }}" wire:navigate class="hover:text-blue-600">Hubungi Kami</a></li>
                        <li><a href="{{ route('halaman', 'faq') }}" wire:navigate class="hover:text-blue-600">FAQ</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h3 class="font-bold text-gray-900 mb-6">Hubungi Kami</h3>
                    <ul class="space-y-4 text-sm text-gray-500">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt mt-1 text-blue-600"></i>
                            <span>Jl. Teknologi No. 123, Kawasan Digital, Jakarta Pusat 10110</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone mt-1 text-blue-600"></i>
                            <span>+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope mt-1 text-blue-600"></i>
                            <span>support@yalacomputer.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs text-gray-400">© 2026 Yala Computer. Hak Cipta Dilindungi.</p>
                <div class="flex items-center gap-2 text-gray-300 text-2xl">
                    <i class="fab fa-cc-visa"></i>
                    <i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-paypal"></i>
                </div>
            </div>
        </div>
    </footer>

    <livewire:komponen.notifikasi />
    @livewireScripts
</body>
</html>
