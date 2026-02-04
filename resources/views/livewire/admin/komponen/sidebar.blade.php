<aside class="w-72 bg-[#1E293B] text-slate-400 flex-shrink-0 flex flex-col hidden lg:flex border-r border-white/5 shadow-2xl z-50">
    <!-- Logo Section -->
    <div class="p-8 border-b border-white/5 bg-gradient-to-br from-blue-600/5 to-transparent">
        <div class="flex items-center gap-4 group cursor-pointer">
            <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-[0_0_20px_rgba(37,99,235,0.4)] group-hover:scale-105 transition-all duration-500">
                <i class="fas fa-microchip text-2xl"></i>
            </div>
            <div class="flex flex-col">
                <span class="font-black text-2xl tracking-tighter text-white">YALA<span class="text-blue-400 font-light">CORE</span></span>
                <span class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] -mt-1">Enterprise</span>
            </div>
        </div>
    </div>

    <!-- Navigation Scroll Area -->
    <nav class="flex-1 p-6 space-y-2 overflow-y-auto custom-scrollbar">
        
        <!-- Dashboard (Single) -->
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center justify-between px-4 py-3.5 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-[0_8px_16px_-4px_rgba(37,99,235,0.3)]' : 'hover:bg-slate-800 hover:text-white' }}">
            <div class="flex items-center gap-4">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'bg-slate-800 text-slate-400 group-hover:bg-blue-500/20 group-hover:text-blue-400' }}">
                    <i class="fas fa-grid-2 text-sm"></i>
                </div>
                <span class="font-bold text-sm tracking-wide">Command Center</span>
            </div>
        </a>

        <!-- Section Label -->
        <div class="pt-6 pb-2 px-4 flex items-center gap-4">
            <span class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em]">Operational</span>
            <div class="h-px bg-slate-800 flex-1"></div>
        </div>

        <!-- Katalog & Stok (Dropdown) -->
        <div class="relative bg-[#172033] rounded-2xl overflow-hidden mb-2">
            <button wire:click="toggleMenu('katalog')" class="w-full flex items-center justify-between px-4 py-3.5 hover:bg-slate-800 transition-all duration-300 group {{ $menuTerbuka === 'katalog' || request()->routeIs('admin.produk*') || request()->routeIs('admin.kategori*') ? 'bg-slate-800/50 text-white' : '' }}">
                <div class="flex items-center gap-4">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-purple-500/10 text-purple-400 group-hover:bg-purple-500/20 shadow-inner">
                        <i class="fas fa-cubes-stacked text-sm"></i>
                    </div>
                    <span class="font-bold text-sm tracking-wide">Inventori</span>
                </div>
                <i class="fas fa-chevron-right text-[10px] transition-transform duration-300 {{ $menuTerbuka === 'katalog' ? 'rotate-90 text-purple-400' : 'text-slate-600' }}"></i>
            </button>
            <div class="overflow-hidden transition-all duration-500 max-h-0 {{ $menuTerbuka === 'katalog' ? 'max-h-64' : '' }}">
                <div class="bg-black/20 py-2 space-y-1">
                    <a href="{{ route('admin.produk') }}" wire:navigate class="flex items-center gap-3 px-14 py-2 text-xs font-bold hover:text-white transition-colors {{ request()->routeIs('admin.produk*') ? 'text-purple-400 border-r-2 border-purple-400' : 'text-slate-500' }}">
                        <span>Produk Katalog</span>
                    </a>
                    <a href="{{ route('admin.kategori') }}" wire:navigate class="flex items-center gap-3 px-14 py-2 text-xs font-bold hover:text-white transition-colors {{ request()->routeIs('admin.kategori*') ? 'text-purple-400 border-r-2 border-purple-400' : 'text-slate-500' }}">
                        <span>Kategori Sektor</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Transaksi (Dropdown) -->
        <div class="relative bg-[#172033] rounded-2xl overflow-hidden mb-2">
            <button wire:click="toggleMenu('transaksi')" class="w-full flex items-center justify-between px-4 py-3.5 hover:bg-slate-800 transition-all duration-300 group {{ $menuTerbuka === 'transaksi' || request()->routeIs('admin.pesanan*') ? 'bg-slate-800/50 text-white' : '' }}">
                <div class="flex items-center gap-4">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-emerald-500/10 text-emerald-400 group-hover:bg-emerald-500/20 shadow-inner">
                        <i class="fas fa-money-bill-transfer text-sm"></i>
                    </div>
                    <span class="font-bold text-sm tracking-wide">Transaksi</span>
                </div>
                <i class="fas fa-chevron-right text-[10px] transition-transform duration-300 {{ $menuTerbuka === 'transaksi' ? 'rotate-90 text-emerald-400' : 'text-slate-600' }}"></i>
            </button>
            <div class="overflow-hidden transition-all duration-500 max-h-0 {{ $menuTerbuka === 'transaksi' ? 'max-h-64' : '' }}">
                <div class="bg-black/20 py-2 space-y-1">
                    <a href="{{ route('admin.pesanan') }}" wire:navigate class="flex items-center gap-3 px-14 py-2 text-xs font-bold hover:text-white transition-colors {{ request()->routeIs('admin.pesanan*') ? 'text-emerald-400 border-r-2 border-emerald-400' : 'text-slate-500' }}">
                        <span>Pesanan Masuk</span>
                    </a>
                    <a href="{{ route('admin.laporan') }}" wire:navigate class="flex items-center gap-3 px-14 py-2 text-xs font-bold hover:text-white transition-colors {{ request()->routeIs('admin.laporan*') ? 'text-emerald-400 border-r-2 border-emerald-400' : 'text-slate-500' }}">
                        <span>Laporan Keuangan</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- CRM (Dropdown) -->
        <div class="relative bg-[#172033] rounded-2xl overflow-hidden mb-2">
            <button wire:click="toggleMenu('crm')" class="w-full flex items-center justify-between px-4 py-3.5 hover:bg-slate-800 transition-all duration-300 group {{ $menuTerbuka === 'crm' || request()->routeIs('admin.pelanggan*') || request()->routeIs('admin.administrator*') ? 'bg-slate-800/50 text-white' : '' }}">
                <div class="flex items-center gap-4">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-orange-500/10 text-orange-400 group-hover:bg-orange-500/20 shadow-inner">
                        <i class="fas fa-users-rays text-sm"></i>
                    </div>
                    <span class="font-bold text-sm tracking-wide">Pengguna</span>
                </div>
                <i class="fas fa-chevron-right text-[10px] transition-transform duration-300 {{ $menuTerbuka === 'crm' ? 'rotate-90 text-orange-400' : 'text-slate-600' }}"></i>
            </button>
            <div class="overflow-hidden transition-all duration-500 max-h-0 {{ $menuTerbuka === 'crm' ? 'max-h-64' : '' }}">
                <div class="bg-black/20 py-2 space-y-1">
                    <a href="{{ route('admin.pelanggan') }}" wire:navigate class="flex items-center gap-3 px-14 py-2 text-xs font-bold hover:text-white transition-colors {{ request()->routeIs('admin.pelanggan*') ? 'text-orange-400 border-r-2 border-orange-400' : 'text-slate-500' }}">
                        <span>Database Pelanggan</span>
                    </a>
                    <a href="{{ route('admin.administrator') }}" wire:navigate class="flex items-center gap-3 px-14 py-2 text-xs font-bold hover:text-white transition-colors {{ request()->routeIs('admin.administrator*') ? 'text-orange-400 border-r-2 border-orange-400' : 'text-slate-500' }}">
                        <span>Akses Otoritas</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Section Label -->
        <div class="pt-6 pb-2 px-4 flex items-center gap-4">
            <span class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em]">Infrastruktur</span>
            <div class="h-px bg-slate-800 flex-1"></div>
        </div>

        <!-- Konten & SEO (Dropdown) -->
        <div class="relative bg-[#172033] rounded-2xl overflow-hidden mb-2">
            <button wire:click="toggleMenu('konten')" class="w-full flex items-center justify-between px-4 py-3.5 hover:bg-slate-800 transition-all duration-300 group {{ $menuTerbuka === 'konten' || request()->routeIs('admin.artikel*') || request()->routeIs('admin.pengaturan*') ? 'bg-slate-800/50 text-white' : '' }}">
                <div class="flex items-center gap-4">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-blue-400/10 text-blue-400 group-hover:bg-blue-400/20 shadow-inner">
                        <i class="fas fa-network-wired text-sm"></i>
                    </div>
                    <span class="font-bold text-sm tracking-wide">Publikasi</span>
                </div>
                <i class="fas fa-chevron-right text-[10px] transition-transform duration-300 {{ $menuTerbuka === 'konten' ? 'rotate-90 text-blue-400' : 'text-slate-600' }}"></i>
            </button>
            <div class="overflow-hidden transition-all duration-500 max-h-0 {{ $menuTerbuka === 'konten' ? 'max-h-64' : '' }}">
                <div class="bg-black/20 py-2 space-y-1">
                    <a href="{{ route('admin.artikel') }}" wire:navigate class="flex items-center gap-3 px-14 py-2 text-xs font-bold hover:text-white transition-colors {{ request()->routeIs('admin.artikel*') ? 'text-blue-400 border-r-2 border-blue-400' : 'text-slate-500' }}">
                        <span>Blog & Edukasi</span>
                    </a>
                    <a href="{{ route('admin.pengaturan') }}" wire:navigate class="flex items-center gap-3 px-14 py-2 text-xs font-bold hover:text-white transition-colors {{ request()->routeIs('admin.pengaturan*') ? 'text-blue-400 border-r-2 border-blue-400' : 'text-slate-500' }}">
                        <span>Konfigurasi Sistem</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Audit & Log (Single) -->
        <a href="{{ route('admin.log') }}" wire:navigate class="flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.log*') ? 'bg-red-500/10 text-red-400 shadow-sm border border-red-500/20' : 'hover:bg-slate-800 hover:text-white' }}">
            <div class="w-9 h-9 rounded-lg flex items-center justify-center {{ request()->routeIs('admin.log*') ? 'bg-red-500/20' : 'bg-slate-800 text-slate-400 group-hover:bg-red-500/20 group-hover:text-red-400' }}">
                <i class="fas fa-shield-halved text-sm"></i>
            </div>
            <span class="font-bold text-sm tracking-wide">Audit Trail</span>
        </a>

    </nav>

    <!-- User Profile Area -->
    <div class="p-6 border-t border-white/5 bg-[#172033]">
        <div class="flex items-center gap-4 p-3 rounded-xl bg-slate-800/50 border border-white/5">
            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-black shadow-lg">
                {{ substr(auth()->user()->nama, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-black text-white truncate">{{ auth()->user()->nama }}</p>
                <p class="text-[9px] font-bold text-blue-400 uppercase tracking-widest">Administrator</p>
            </div>
            <livewire:admin.logout />
        </div>
    </div>
</aside>