<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Yala Computer' }} - Masa Depan Teknologi</title>
    
    <!-- SEO Meta -->
    <meta name="description" content="{{ $meta_deskripsi ?? 'Pusat belanja komputer, laptop, dan aksesoris terlengkap dengan harga terbaik di Indonesia.' }}">
    <meta name="keywords" content="komputer, laptop, pc rakitan, sparepart, aksesoris, yala computer">
    <meta name="robots" content="index, follow">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-['Plus_Jakarta_Sans'] bg-slate-50 text-slate-900 antialiased overflow-x-hidden flex flex-col min-h-screen">

    <!-- Top Bar (Running Text) -->
    <div class="bg-[#0F172A] text-white py-2 overflow-hidden relative z-50">
        <div class="container mx-auto flex justify-between items-center text-xs font-medium relative">
            <div class="flex gap-6 items-center bg-[#0F172A] z-10 pr-6 pl-4 h-full absolute left-0 top-0 hidden md:flex">
                <span class="text-blue-400 font-bold tracking-wider"><i class="fas fa-bolt mr-2"></i>FLASH SALE</span>
            </div>
            
            <div class="flex-1 px-4 md:px-32">
                <div class="whitespace-nowrap animate-marquee">
                    <span class="inline-block px-4"><i class="fas fa-bullhorn mr-2 text-orange-500"></i>{{ \App\Models\Pengaturan::ambil('running_text', 'Selamat datang di Yala Computer - Solusi Kebutuhan IT Anda!') }}</span>
                    <span class="inline-block px-4 text-slate-500">|</span>
                    <span class="inline-block px-4"><i class="fas fa-truck-fast mr-2 text-emerald-500"></i>Gratis Ongkir untuk Pembelian di atas 5 Juta!</span>
                </div>
            </div>

            <div class="flex gap-4 items-center bg-[#0F172A] z-10 pl-6 pr-4 h-full absolute right-0 top-0 hidden md:flex">
                <a href="#" class="hover:text-blue-400 transition-colors"><i class="fab fa-whatsapp"></i></a>
                <a href="#" class="hover:text-pink-500 transition-colors"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <header class="bg-white/80 backdrop-blur-xl border-b border-slate-200/60 sticky top-0 z-40 transition-all duration-300">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <a href="{{ url('/') }}" wire:navigate class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-[0_4px_14px_rgba(37,99,235,0.3)] group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-cube text-xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-['Outfit'] font-black text-xl leading-none text-slate-900 tracking-tight group-hover:text-blue-600 transition-colors">YALA<span class="text-blue-600">COMP</span></span>
                        <span class="text-[9px] font-bold text-slate-400 tracking-[0.2em] uppercase">Tech Store</span>
                    </div>
                </a>

                <!-- Search Bar -->
                <div class="flex-1 hidden md:block max-w-xl mx-auto">
                    <div class="relative group">
                        <input type="text" placeholder="Cari perangkat impianmu..." class="w-full bg-slate-100/50 border border-slate-200 rounded-2xl py-3 px-5 pl-12 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all focus:bg-white shadow-inner">
                        <i class="fas fa-search absolute left-4 top-3.5 text-slate-400 group-hover:text-blue-500 transition-colors"></i>
                        <div class="absolute right-2 top-2 px-2 py-1 bg-white border border-slate-200 rounded-lg text-[10px] font-bold text-slate-400 hidden lg:block">CTRL+K</div>
                    </div>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center gap-3 md:gap-6">
                    <livewire:publik.keranjang.ikon />

                    @auth
                        <div class="hidden md:flex items-center gap-3 pl-6 border-l border-slate-200">
                            <div class="text-right hidden lg:block">
                                <p class="text-xs font-bold text-slate-900">{{ auth()->user()->nama }}</p>
                                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider">Member</p>
                            </div>
                            <a href="{{ route('admin.dashboard') }}" class="w-10 h-10 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 font-black hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                {{ substr(auth()->user()->nama, 0, 1) }}
                            </a>
                        </div>
                    @else
                        <div class="hidden md:flex items-center gap-3">
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 px-4 py-2 transition-colors">Masuk</a>
                            <a href="#" class="bg-[#0F172A] hover:bg-blue-700 text-white text-sm font-bold px-6 py-2.5 rounded-xl shadow-lg shadow-blue-900/20 hover:shadow-blue-600/30 transition-all transform hover:-translate-y-0.5">
                                Daftar
                            </a>
                        </div>
                    @endauth
                    
                    <!-- Mobile Menu Button -->
                    <button class="md:hidden text-slate-600 text-xl">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Secondary Nav -->
        <div class="border-t border-slate-100 bg-white/50 backdrop-blur-sm hidden md:block">
            <div class="container mx-auto px-4">
                <nav class="flex items-center gap-8 text-sm font-medium overflow-x-auto">
                    <div class="flex items-center gap-2 pr-6 border-r border-slate-200 py-3">
                        <i class="fas fa-bars text-slate-400"></i>
                        <span class="font-bold text-slate-700 uppercase tracking-wider text-xs">Kategori</span>
                    </div>
                    
                    <a href="{{ url('/') }}" wire:navigate class="py-3 border-b-2 {{ request()->is('/') ? 'border-blue-600 text-blue-600 font-bold' : 'border-transparent text-slate-500 hover:text-blue-600' }} transition-colors">Beranda</a>
                    <a href="{{ url('/katalog') }}" wire:navigate class="py-3 border-b-2 {{ request()->is('katalog') && !request('hanya_unggulan') ? 'border-blue-600 text-blue-600 font-bold' : 'border-transparent text-slate-500 hover:text-blue-600' }} transition-colors">Katalog Produk</a>
                    <a href="{{ url('/blog') }}" wire:navigate class="py-3 border-b-2 {{ request()->is('blog*') ? 'border-blue-600 text-blue-600 font-bold' : 'border-transparent text-slate-500 hover:text-blue-600' }} transition-colors">Blog & Edukasi</a>
                    
                    <div class="flex-1"></div>
                    
                    <a href="{{ route('katalog', ['hanya_unggulan' => true]) }}" wire:navigate class="py-3 flex items-center gap-2 text-rose-500 font-bold hover:text-rose-600 transition-colors">
                        <i class="fas fa-fire-flame-curved"></i> Promo Spesial
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Konten Halaman -->
    <main class="flex-1">
        {{ $slot }}
    </main>

    <!-- Modern Footer -->
    <footer class="bg-[#0F172A] text-slate-300 pt-20 pb-8 mt-20 relative overflow-hidden">
        <!-- Ambient Light -->
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-blue-600/5 rounded-full blur-[120px] -translate-y-1/2 pointer-events-none"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Brand Info -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white">
                            <i class="fas fa-cube text-lg"></i>
                        </div>
                        <span class="font-['Outfit'] font-black text-2xl text-white tracking-tight">YALA<span class="text-blue-500">COMP</span></span>
                    </div>
                    <p class="text-sm leading-relaxed text-slate-400">
                        Destinasi utama untuk para enthusiast teknologi. Kami menyediakan perangkat keras terbaik dengan jaminan kualitas dan layanan purna jual profesional.
                    </p>
                    <div class="flex gap-4 pt-2">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-pink-500 hover:text-white transition-all"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-green-500 hover:text-white transition-all"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Navigasi -->
                <div>
                    <h4 class="font-bold text-white mb-6 uppercase tracking-widest text-xs">Eksplorasi</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[8px] text-slate-600"></i> Laptop Gaming</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[8px] text-slate-600"></i> Komponen PC</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[8px] text-slate-600"></i> Aksesoris</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[8px] text-slate-600"></i> Rakit PC</a></li>
                    </ul>
                </div>

                <!-- Bantuan -->
                <div>
                    <h4 class="font-bold text-white mb-6 uppercase tracking-widest text-xs">Dukungan</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-blue-400 transition-colors">Lacak Pesanan</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors">Kebijakan Garansi</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition-colors">Pusat Bantuan</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h4 class="font-bold text-white mb-6 uppercase tracking-widest text-xs">Hubungi Kami</h4>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-location-dot mt-1 text-blue-500"></i>
                            <span>Jl. Teknologi No. 88, Cyber City<br>Jakarta Selatan, 12000</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone text-blue-500"></i>
                            <span>+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-blue-500"></i>
                            <span>hello@yalacomp.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-slate-500 font-mono">© 2026 YALA COMPUTER. All Rights Reserved.</p>
                <div class="flex items-center gap-4 text-slate-500 text-2xl">
                    <i class="fab fa-cc-visa hover:text-white transition-colors"></i>
                    <i class="fab fa-cc-mastercard hover:text-white transition-colors"></i>
                    <i class="fab fa-cc-paypal hover:text-white transition-colors"></i>
                </div>
            </div>
        </div>
    </footer>

    <livewire:komponen.notifikasi />
    @livewireScripts
</body>
</html>