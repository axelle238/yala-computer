<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $judulMeta ?? 'Yala Computer - Toko Komputer Terlengkap' }}</title>
    <meta name="description" content="{{ $deskripsiMeta ?? 'Pusat belanja komputer dan kebutuhan IT terlengkap dengan harga kompetitif dan garansi resmi.' }}">
    <meta name="keywords" content="toko komputer, laptop gaming, aksesoris komputer, yala computer, sparepart pc">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $judulMeta ?? 'Yala Computer' }}">
    <meta property="og:description" content="{{ $deskripsiMeta ?? 'Pusat belanja komputer dan kebutuhan IT terlengkap.' }}">
    <meta property="og:image" content="{{ $gambarMeta ?? asset('favicon.svg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $judulMeta ?? 'Yala Computer' }}">
    <meta property="twitter:description" content="{{ $deskripsiMeta ?? 'Pusat belanja komputer dan kebutuhan IT terlengkap.' }}">
    <meta property="twitter:image" content="{{ $gambarMeta ?? asset('favicon.svg') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxStyles
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 min-h-screen flex flex-col">
    @fluxScripts
    
    <!-- Navbar -->
    <header class="sticky top-0 z-50 w-full border-b border-gray-200 bg-white/80 backdrop-blur-md">
        <div class="container mx-auto px-4 h-16 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2 font-bold text-xl tracking-tight text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-2.25-1.313M21 7.5v2.25m0-2.25l-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3l2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75l2.25-1.313M12 21.75V19.5m0 2.25l-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
                </svg>
                YALA COMPUTER
            </a>

            <div class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-600">
                <a href="/" class="hover:text-blue-600 transition">Beranda</a>
                <a href="#" class="hover:text-blue-600 transition">Laptop</a>
                <a href="#" class="hover:text-blue-600 transition">Komponen</a>
                <a href="#" class="hover:text-blue-600 transition">Aksesoris</a>
            </div>

            <div class="flex items-center gap-4">
                <!-- Search Icon (Mobile/Desktop) -->
                <button class="p-2 text-gray-500 hover:bg-gray-100 rounded-full transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>

                <!-- Keranjang -->
                <livewire:lencana-keranjang />

                @auth
                    <div class="flex items-center gap-3 ml-2 pl-4 border-l border-gray-200">
                        <a href="{{ route('pesanan.saya') }}" class="text-sm font-bold text-gray-700 hover:text-blue-600 transition flex items-center gap-2">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Pesanan Saya
                        </a>
                        @if(auth()->user()->peran === 'admin')
                            <a href="{{ route('dasbor') }}" class="px-4 py-2 text-xs font-bold text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition">Admin Panel</a>
                        @endif
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Keluar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2.5 text-sm font-bold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 border-t border-gray-800">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-white text-lg font-bold mb-4">YALA COMPUTER</h3>
                <p class="text-sm text-gray-400">Pusat belanja komputer dan kebutuhan IT terlengkap dengan harga kompetitif dan garansi resmi.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Layanan</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-blue-400">Cara Pembelian</a></li>
                    <li><a href="#" class="hover:text-blue-400">Pengiriman</a></li>
                    <li><a href="#" class="hover:text-blue-400">Garansi Produk</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Kategori</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-blue-400">Laptop & PC</a></li>
                    <li><a href="#" class="hover:text-blue-400">Komponen</a></li>
                    <li><a href="#" class="hover:text-blue-400">Aksesoris</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Kontak</h4>
                <p class="text-sm text-gray-400">Jl. Teknologi No. 123, Jakarta</p>
                <p class="text-sm text-gray-400 mt-2">support@yala-computer.com</p>
            </div>
        </div>
        <div class="container mx-auto px-4 mt-8 pt-8 border-t border-gray-800 text-center text-xs text-gray-500">
            &copy; 2026 Yala Computer. All rights reserved.
        </div>
    </footer>
</body>
</html>
