<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Command Center' }} | YALACORE Enterprise</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-['Plus_Jakarta_Sans'] bg-[#0F172A] text-slate-300 antialiased overflow-hidden selection:bg-blue-500 selection:text-white">

    <div class="flex h-screen overflow-hidden">
        <!-- Reaktif Sidebar -->
        <livewire:admin.komponen.sidebar />

        <!-- Main Workspace -->
        <main class="flex-1 flex flex-col min-w-0 bg-[#0F172A] relative overflow-hidden">
            <!-- Ambient Background Effects (Softened) -->
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-blue-600/5 rounded-full blur-[150px] -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-indigo-600/5 rounded-full blur-[150px] translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>

            <!-- Dashboard Header -->
            <header class="h-20 bg-[#1E293B]/80 backdrop-blur-2xl border-b border-white/5 flex items-center justify-between px-10 sticky top-0 z-40 shadow-sm">
                <div class="flex items-center gap-6">
                    <button class="lg:hidden text-slate-400 hover:text-white transition-colors">
                        <i class="fas fa-bars-staggered text-xl"></i>
                    </button>
                    <div class="flex flex-col">
                        <h1 class="text-xl font-black text-white tracking-tight">{{ $title ?? 'Dashboard' }}</h1>
                        <div class="flex items-center gap-2 text-[10px] text-slate-500 font-bold uppercase tracking-[0.2em]">
                            <span>YALACORE</span>
                            <i class="fas fa-chevron-right text-[8px]"></i>
                            <span class="text-blue-400">{{ request()->segment(2) ?? 'Home' }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-8">
                    <!-- System Status Indicators -->
                    <div class="flex items-center gap-4 border-l border-white/10 pl-8">
                        <div class="flex flex-col items-end">
                            <span class="text-[10px] font-black text-emerald-400 tracking-widest flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span> SYSTEM ONLINE
                            </span>
                            <span class="text-[9px] text-slate-500 font-mono">{{ now()->format('H:i:s') }} UTC</span>
                        </div>
                        <livewire:admin.komponen.notification-hub />
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
