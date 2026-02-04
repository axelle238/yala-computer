<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Yala Computer' }}</title>
    
    <!-- SEO Meta -->
    <meta name="description" content="{{ $meta_description ?? 'Sistem Toko Komputer Yala Computer - Solusi Kebutuhan Teknologi Anda' }}">
    <meta name="keywords" content="komputer, laptop, sparepart, yala computer, toko komputer indonesia">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-['Plus_Jakarta_Sans'] bg-gray-50 text-gray-900 antialiased overflow-x-hidden">

    <div class="flex min-h-screen">
        <!-- Sidebar Navigation (Admin) -->
        @auth
            <aside class="w-64 bg-white border-r border-gray-200 flex-shrink-0 flex flex-col hidden lg:flex">
                <div class="p-6 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                        <i class="fas fa-laptop-code text-xl"></i>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-blue-900">YALA COMP</span>
                </div>
                
                <nav class="flex-1 p-4 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="fas fa-chart-pie w-5"></i>
                        Dashboard
                    </a>
                    
                    <div class="pt-4 pb-2 px-4">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Manajemen Data</span>
                    </div>
                    
                    <a href="{{ route('admin.produk') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.produk*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="fas fa-box-open w-5"></i>
                        Produk
                    </a>
                    <a href="{{ route('admin.kategori') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.kategori*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="fas fa-tags w-5"></i>
                        Kategori
                    </a>
                    <a href="{{ route('admin.pesanan') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.pesanan*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="fas fa-shopping-cart w-5"></i>
                        Pesanan
                    </a>
                    <a href="{{ route('admin.pelanggan') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.pelanggan*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="fas fa-user-friends w-5"></i>
                        Pelanggan
                    </a>
                    
                    <div class="pt-4 pb-2 px-4">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sistem</span>
                    </div>
                    <a href="{{ route('admin.log') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.log*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="fas fa-history w-5"></i>
                        Log Aktivitas
                    </a>
                    <a href="{{ route('admin.pengaturan') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('admin.pengaturan*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                        <i class="fas fa-cog w-5"></i>
                        Pengaturan
                    </a>
                </nav>
                
                <div class="p-4 border-t border-gray-100">
                    <div class="flex items-center gap-3 px-4 py-3">
                        <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-xs">
                            {{ substr(auth()->user()->nama, 0, 1) }}
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <p class="text-xs font-bold text-gray-900 truncate">{{ auth()->user()->nama }}</p>
                            <p class="text-[10px] text-gray-500 truncate">Administrator</p>
                        </div>
                        <livewire:admin.logout />
                    </div>
                </div>
            </aside>
        @endauth

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Header -->
            <header class="h-16 bg-white/80 backdrop-blur-md border-b border-gray-200 flex items-center justify-between px-6 sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <button class="lg:hidden text-gray-500">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-lg font-semibold text-gray-800">{{ $title ?? 'Dashboard' }}</h1>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" placeholder="Cari data..." class="bg-gray-100 border-none rounded-lg py-2 px-4 pl-10 text-sm focus:ring-2 focus:ring-blue-500 w-64">
                        <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
                    </div>
                    
                    <button class="w-10 h-10 flex items-center justify-center text-gray-500 hover:bg-gray-100 rounded-full relative">
                        <i class="far fa-bell text-lg"></i>
                        <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>
                </div>
            </header>

            <!-- Page Content -->
            <div class="flex-1 overflow-y-auto p-6 md:p-8 bg-gray-50/50">
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- Notification Container (Toast) -->
    <livewire:komponen.notifikasi />

    @livewireScripts
</body>
</html>
