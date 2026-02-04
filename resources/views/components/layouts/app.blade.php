<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Command Center' }} | YALACORE Enterprise</title>
    
    <!-- SEO Meta -->
    <meta name="description" content="YALACORE High-technology Enterprise Resource Planning">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-['Plus_Jakarta_Sans'] bg-[#020617] text-slate-200 antialiased overflow-hidden">

    <div class="flex h-screen overflow-hidden">
        <!-- Reaktif Sidebar -->
        <livewire:admin.komponen.sidebar />

        <!-- Main Workspace -->
        <main class="flex-1 flex flex-col min-w-0 bg-[#020617] relative overflow-hidden">
            <!-- Ambient Background Effects -->
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-purple-600/10 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>

            <!-- Dashboard Header -->
            <header class="h-20 bg-[#0B1120]/50 backdrop-blur-2xl border-b border-white/5 flex items-center justify-between px-10 sticky top-0 z-40">
                <div class="flex items-center gap-6">
                    <button class="lg:hidden text-gray-400">
                        <i class="fas fa-bars-staggered text-xl"></i>
                    </button>
                    <div class="flex flex-col">
                        <h1 class="text-xl font-black text-white tracking-tight">{{ $title ?? 'Dashboard' }}</h1>
                        <div class="flex items-center gap-2 text-[10px] text-gray-500 font-bold uppercase tracking-[0.2em]">
                            <span>YALACORE</span>
                            <i class="fas fa-chevron-right text-[8px]"></i>
                            <span class="text-blue-500">{{ request()->segment(2) ?? 'Home' }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-8">
                    <!-- Global Command Search -->
                    <div class="relative hidden xl:block">
                        <input type="text" placeholder="Cari data atau perintah... (Cmd+K)" class="bg-white/5 border border-white/10 rounded-2xl py-2.5 px-5 pl-12 text-sm text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 w-80 transition-all outline-none">
                        <i class="fas fa-terminal absolute left-4 top-3 text-gray-500 text-xs"></i>
                    </div>
                    
                    <!-- System Status Indicators -->
                    <div class="flex items-center gap-4 border-l border-white/10 pl-8">
                        <div class="flex flex-col items-end">
                            <span class="text-[10px] font-black text-green-500 tracking-widest">SYSTEM ONLINE</span>
                            <span class="text-[9px] text-gray-500 font-mono">{{ now()->format('H:i:s') }} UTC</span>
                        </div>
                        <button class="w-12 h-12 flex items-center justify-center text-gray-400 hover:text-white hover:bg-white/5 rounded-2xl relative transition-all border border-white/5">
                            <i class="far fa-bell text-lg"></i>
                            <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full shadow-[0_0_10px_#3b82f6]"></span>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Scrollable Workspace Content -->
            <div class="flex-1 overflow-y-auto p-10 custom-scrollbar relative z-10">
                <div class="max-w-[1600px] mx-auto">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>

    <!-- Global Notification System (Toast) -->
    <livewire:komponen.notifikasi />

    @livewireScripts
</body>
</html>