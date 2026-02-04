<aside class="w-72 bg-[#0B1120] text-gray-300 flex-shrink-0 flex flex-col hidden lg:flex border-r border-white/5 shadow-2xl shadow-black/50 overflow-hidden">
    <!-- Logo Section -->
    <div class="p-8 border-b border-white/5 bg-gradient-to-br from-blue-600/10 to-transparent">
        <div class="flex items-center gap-4 group">
            <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-[0_0_25px_-5px_rgba(37,99,235,0.6)] group-hover:scale-110 transition-all duration-500">
                <i class="fas fa-microchip text-2xl animate-pulse"></i>
            </div>
            <div class="flex flex-col">
                <span class="font-black text-2xl tracking-tighter text-white">YALA<span class="text-blue-500 font-light">CORE</span></span>
                <span class="text-[10px] font-black text-blue-400 uppercase tracking-[0.3em] -mt-1">Enterprise</span>
            </div>
        </div>
    </div>

    <!-- Navigation Scroll Area -->
    <nav class="flex-1 p-6 space-y-2 overflow-y-auto custom-scrollbar">
        
        <!-- Dashboard (Single) -->
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-[0_10px_20px_-5px_rgba(37,99,235,0.4)]' : 'hover:bg-white/5 hover:text-white' }}">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'bg-blue-500/10 text-blue-500 group-hover:bg-blue-500/20' }}">
                    <i class="fas fa-layer-group text-lg"></i>
                </div>
                <span class="font-bold text-sm tracking-wide">Command Center</span>
            </div>
            @if(request()->routeIs('admin.dashboard'))
                <div class="w-1.5 h-1.5 rounded-full bg-white shadow-[0_0_10px_white]"></div>
            @endif
        </a>

        <!-- Section Label -->
        <div class="pt-6 pb-2 px-4">
            <span class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">Siklus Bisnis</span>
        </div>

        <!-- Katalog & Stok (Dropdown) -->
        <div class="relative">
            <button wire:click="toggleMenu('katalog')" class="w-full flex items-center justify-between px-4 py-3.5 rounded-2xl hover:bg-white/5 transition-all duration-300 group {{ $menuTerbuka === 'katalog' || request()->routeIs('admin.produk*') || request()->routeIs('admin.kategori*') ? 'text-white' : '' }}">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-purple-500/10 text-purple-500 group-hover:bg-purple-500/20">
                        <i class="fas fa-boxes-stacked text-lg"></i>
                    </div>
                    <span class="font-bold text-sm tracking-wide">Katalog & Stok</span>
                </div>
                <i class="fas fa-chevron-right text-xs transition-transform duration-300 {{ $menuTerbuka === 'katalog' ? 'rotate-90' : '' }}"></i>
            </button>
            <div class="overflow-hidden transition-all duration-500 max-h-0 {{ $menuTerbuka === 'katalog' ? 'max-h-64 mt-2' : '' }}">
                <div class="pl-14 space-y-1">
                    <a href="{{ route('admin.produk') }}" wire:navigate class="block py-2.5 text-sm font-medium hover:text-blue-400 transition-colors {{ request()->routeIs('admin.produk*') ? 'text-blue-500 font-bold' : '' }}">Produk Inventori</a>
                    <a href="{{ route('admin.kategori') }}" wire:navigate class="block py-2.5 text-sm font-medium hover:text-blue-400 transition-colors {{ request()->routeIs('admin.kategori*') ? 'text-blue-500 font-bold' : '' }}">Klasifikasi</a>
                    <a href="#" class="block py-2.5 text-sm font-medium hover:text-blue-400 transition-colors opacity-50">Stok Opname</a>
                </div>
            </div>
        </div>

        <!-- Transaksi (Dropdown) -->
        <div class="relative">
            <button wire:click="toggleMenu('transaksi')" class="w-full flex items-center justify-between px-4 py-3.5 rounded-2xl hover:bg-white/5 transition-all duration-300 group {{ $menuTerbuka === 'transaksi' || request()->routeIs('admin.pesanan*') ? 'text-white' : '' }}">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-emerald-500/10 text-emerald-500 group-hover:bg-emerald-500/20">
                        <i class="fas fa-cash-register text-lg"></i>
                    </div>
                    <span class="font-bold text-sm tracking-wide">Transaksi</span>
                </div>
                <i class="fas fa-chevron-right text-xs transition-transform duration-300 {{ $menuTerbuka === 'transaksi' ? 'rotate-90' : '' }}"></i>
            </button>
            <div class="overflow-hidden transition-all duration-500 max-h-0 {{ $menuTerbuka === 'transaksi' ? 'max-h-64 mt-2' : '' }}">
                <div class="pl-14 space-y-1">
                    <a href="{{ route('admin.pesanan') }}" wire:navigate class="block py-2.5 text-sm font-medium hover:text-blue-400 transition-colors {{ request()->routeIs('admin.pesanan*') ? 'text-blue-500 font-bold' : '' }}">Pesanan Masuk</a>
                    <a href="{{ route('admin.laporan') }}" wire:navigate class="block py-2.5 text-sm font-medium hover:text-blue-400 transition-colors {{ request()->routeIs('admin.laporan*') ? 'text-blue-500 font-bold' : '' }}">Laporan Arus Kas</a>
                </div>
            </div>
        </div>

        <!-- CRM (Dropdown) -->
        <div class="relative">
            <button wire:click="toggleMenu('crm')" class="w-full flex items-center justify-between px-4 py-3.5 rounded-2xl hover:bg-white/5 transition-all duration-300 group {{ $menuTerbuka === 'crm' || request()->routeIs('admin.pelanggan*') ? 'text-white' : '' }}">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-orange-500/10 text-orange-500 group-hover:bg-orange-500/20">
                        <i class="fas fa-user-astronaut text-lg"></i>
                    </div>
                    <span class="font-bold text-sm tracking-wide">Pelanggan</span>
                </div>
                <i class="fas fa-chevron-right text-xs transition-transform duration-300 {{ $menuTerbuka === 'crm' ? 'rotate-90' : '' }}"></i>
            </button>
            <div class="overflow-hidden transition-all duration-500 max-h-0 {{ $menuTerbuka === 'crm' ? 'max-h-64 mt-2' : '' }}">
                <div class="pl-14 space-y-1">
                    <a href="{{ route('admin.pelanggan') }}" wire:navigate class="block py-2.5 text-sm font-medium hover:text-blue-400 transition-colors {{ request()->routeIs('admin.pelanggan*') ? 'text-blue-500 font-bold' : '' }}">Database Pelanggan</a>
                    <a href="{{ route('admin.administrator') }}" wire:navigate class="block py-2.5 text-sm font-medium hover:text-blue-400 transition-colors {{ request()->routeIs('admin.administrator*') ? 'text-blue-500 font-bold' : '' }}">Node Otoritas</a>
                    <a href="#" class="block py-2.5 text-sm font-medium hover:text-blue-400 transition-colors opacity-50">Ulasan & Feedback</a>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="pt-6 pb-2 px-4">
            <span class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">Infrastruktur</span>
        </div>

        <!-- Konten & SEO (Dropdown) -->
        <div class="relative">
            <button wire:click="toggleMenu('konten')" class="w-full flex items-center justify-between px-4 py-3.5 rounded-2xl hover:bg-white/5 transition-all duration-300 group {{ $menuTerbuka === 'konten' || request()->routeIs('admin.artikel*') ? 'text-white' : '' }}">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-blue-400/10 text-blue-400 group-hover:bg-blue-400/20">
                        <i class="fas fa-globe-americas text-lg"></i>
                    </div>
                    <span class="font-bold text-sm tracking-wide">Publikasi</span>
                </div>
                <i class="fas fa-chevron-right text-xs transition-transform duration-300 {{ $menuTerbuka === 'konten' ? 'rotate-90' : '' }}"></i>
            </button>
            <div class="overflow-hidden transition-all duration-500 max-h-0 {{ $menuTerbuka === 'konten' ? 'max-h-64 mt-2' : '' }}">
                <div class="pl-14 space-y-1">
                    <a href="{{ route('admin.artikel') }}" wire:navigate class="block py-2.5 text-sm font-medium hover:text-blue-400 transition-colors {{ request()->routeIs('admin.artikel*') ? 'text-blue-500 font-bold' : '' }}">Blog & Edukasi</a>
                    <a href="{{ route('admin.pengaturan') }}" wire:navigate class="block py-2.5 text-sm font-medium hover:text-blue-400 transition-colors {{ request()->routeIs('admin.pengaturan*') ? 'text-blue-500 font-bold' : '' }}">Portal Setting</a>
                </div>
            </div>
        </div>

        <!-- Audit & Log (Single) -->
        <a href="{{ route('admin.log') }}" wire:navigate class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.log*') ? 'bg-red-600 text-white shadow-[0_10px_20px_-5px_rgba(220,38,38,0.4)]' : 'hover:bg-white/5 hover:text-white' }}">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ request()->routeIs('admin.log*') ? 'bg-white/20' : 'bg-red-500/10 text-red-500 group-hover:bg-red-500/20' }}">
                <i class="fas fa-shield-cat text-lg"></i>
            </div>
            <span class="font-bold text-sm tracking-wide">Audit Trail</span>
        </a>

    </nav>

    <!-- User Profile Area -->
    <div class="p-6 border-t border-white/5 bg-black/20">
        <div class="flex items-center gap-4 p-3 rounded-2xl bg-white/5 border border-white/5">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-black shadow-lg">
                {{ substr(auth()->user()->nama, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-black text-white truncate">{{ auth()->user()->nama }}</p>
                <p class="text-[9px] font-bold text-blue-400 uppercase tracking-widest">Root Authority</p>
            </div>
            <livewire:admin.logout />
        </div>
    </div>
</aside>
