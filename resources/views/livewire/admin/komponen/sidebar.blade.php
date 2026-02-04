<aside class="w-72 bg-white text-slate-600 flex-shrink-0 flex flex-col hidden lg:flex border-r border-slate-200/60 shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-50">
    <!-- Logo Section (Enterprise Identity) -->
    <div class="p-8 border-b border-slate-100 bg-gradient-to-br from-blue-50/50 to-white">
        <div class="flex items-center gap-4 group cursor-pointer">
            <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-[0_8px_20px_rgba(37,99,235,0.3)] group-hover:scale-105 transition-all duration-500">
                <i class="fas fa-microchip text-2xl"></i>
            </div>
            <div class="flex flex-col">
                <span class="font-['Outfit'] font-black text-2xl tracking-tighter text-slate-900">YALA<span class="text-blue-600 font-light">CORE</span></span>
                <span class="text-[9px] font-bold text-blue-500 uppercase tracking-[0.3em] -mt-1 italic">Enterprise Hub</span>
            </div>
        </div>
    </div>

    <!-- Multi-Level Navigation -->
    <nav class="flex-1 p-6 space-y-2 overflow-y-auto custom-scrollbar">
        
        <!-- Command Center -->
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-[0_10px_25px_-5px_rgba(37,99,235,0.4)]' : 'hover:bg-slate-50 hover:text-blue-600' }}">
            <div class="flex items-center gap-4">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors shadow-sm' }}">
                    <i class="fas fa-chart-pie text-sm"></i>
                </div>
                <span class="font-bold text-sm tracking-wide">Command Center</span>
            </div>
        </a>

        <!-- Label -->
        <div class="pt-6 pb-2 px-4 flex items-center gap-4">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Logistics Hub</span>
            <div class="h-px bg-slate-100 flex-1"></div>
        </div>

        <!-- Inventori Dropdown -->
        <div class="relative bg-white rounded-2xl border border-transparent {{ $menuTerbuka === 'katalog' ? 'bg-slate-50/50 border-slate-100 shadow-sm' : '' }}">
            <button wire:click="toggleMenu('katalog')" class="w-full flex items-center justify-between px-4 py-3.5 hover:bg-slate-50 rounded-2xl transition-all duration-300 group">
                <div class="flex items-center gap-4">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-purple-50 text-purple-600 shadow-sm group-hover:bg-purple-600 group-hover:text-white transition-all">
                        <i class="fas fa-boxes-stacked text-sm"></i>
                    </div>
                    <span class="font-bold text-sm tracking-wide text-slate-700">Inventori</span>
                </div>
                <i class="fas fa-chevron-right text-[10px] transition-transform duration-300 {{ $menuTerbuka === 'katalog' ? 'rotate-90 text-purple-600' : 'text-slate-300' }}"></i>
            </button>
            <div class="overflow-hidden transition-all duration-500 max-h-0 {{ $menuTerbuka === 'katalog' ? 'max-h-64 mb-2' : '' }}">
                <div class="pl-14 space-y-1 pr-4">
                    <a href="{{ route('admin.produk') }}" wire:navigate class="block py-2.5 text-xs font-bold transition-colors {{ request()->routeIs('admin.produk*') ? 'text-purple-600' : 'text-slate-500 hover:text-purple-600' }}">Produk Katalog</a>
                    <a href="{{ route('admin.kategori') }}" wire:navigate class="block py-2.5 text-xs font-bold transition-colors {{ request()->routeIs('admin.kategori*') ? 'text-purple-600' : 'text-slate-500 hover:text-purple-600' }}">Sektor Kategori</a>
                </div>
            </div>
        </div>

        <!-- Transaksi Dropdown -->
        <div class="relative bg-white rounded-2xl border border-transparent {{ $menuTerbuka === 'transaksi' ? 'bg-slate-50/50 border-slate-100 shadow-sm' : '' }}">
            <button wire:click="toggleMenu('transaksi')" class="w-full flex items-center justify-between px-4 py-3.5 hover:bg-slate-50 rounded-2xl transition-all duration-300 group">
                <div class="flex items-center gap-4">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-emerald-50 text-emerald-600 shadow-sm group-hover:bg-emerald-600 group-hover:text-white transition-all">
                        <i class="fas fa-file-invoice-dollar text-sm"></i>
                    </div>
                    <span class="font-bold text-sm tracking-wide text-slate-700">Financials</span>
                </div>
                <i class="fas fa-chevron-right text-[10px] transition-transform duration-300 {{ $menuTerbuka === 'transaksi' ? 'rotate-90 text-emerald-600' : 'text-slate-300' }}"></i>
            </button>
            <div class="overflow-hidden transition-all duration-500 max-h-0 {{ $menuTerbuka === 'transaksi' ? 'max-h-64 mb-2' : '' }}">
                <div class="pl-14 space-y-1 pr-4">
                    <a href="{{ route('admin.pesanan') }}" wire:navigate class="block py-2.5 text-xs font-bold transition-colors {{ request()->routeIs('admin.pesanan*') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}">Orders Control</a>
                    <a href="{{ route('admin.laporan') }}" wire:navigate class="block py-2.5 text-xs font-bold transition-colors {{ request()->routeIs('admin.laporan*') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}">Revenue Matrix</a>
                </div>
            </div>
        </div>

        <!-- CRM Dropdown -->
        <div class="relative bg-white rounded-2xl border border-transparent {{ $menuTerbuka === 'crm' ? 'bg-slate-50/50 border-slate-100 shadow-sm' : '' }}">
            <button wire:click="toggleMenu('crm')" class="w-full flex items-center justify-between px-4 py-3.5 hover:bg-slate-50 rounded-2xl transition-all duration-300 group">
                <div class="flex items-center gap-4">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-rose-50 text-rose-600 shadow-sm group-hover:bg-rose-600 group-hover:text-white transition-all">
                        <i class="fas fa-users-viewfinder text-sm"></i>
                    </div>
                    <span class="font-bold text-sm tracking-wide text-slate-700">Entities</span>
                </div>
                <i class="fas fa-chevron-right text-[10px] transition-transform duration-300 {{ $menuTerbuka === 'crm' ? 'rotate-90 text-rose-600' : 'text-slate-300' }}"></i>
            </button>
            <div class="overflow-hidden transition-all duration-500 max-h-0 {{ $menuTerbuka === 'crm' ? 'max-h-64 mb-2' : '' }}">
                <div class="pl-14 space-y-1 pr-4">
                    <a href="{{ route('admin.pelanggan') }}" wire:navigate class="block py-2.5 text-xs font-bold transition-colors {{ request()->routeIs('admin.pelanggan*') ? 'text-rose-600' : 'text-slate-500 hover:text-rose-600' }}">User Base</a>
                    <a href="{{ route('admin.administrator') }}" wire:navigate class="block py-2.5 text-xs font-bold transition-colors {{ request()->routeIs('admin.administrator*') ? 'text-rose-600' : 'text-slate-500 hover:text-rose-600' }}">Auth Authority</a>
                </div>
            </div>
        </div>

        <!-- Infrastructure -->
        <div class="pt-6 pb-2 px-4 flex items-center gap-4">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Platform</span>
            <div class="h-px bg-slate-100 flex-1"></div>
        </div>

        <!-- Content Dropdown -->
        <div class="relative bg-white rounded-2xl border border-transparent {{ $menuTerbuka === 'konten' ? 'bg-slate-50/50 border-slate-100 shadow-sm' : '' }}">
            <button wire:click="toggleMenu('konten')" class="w-full flex items-center justify-between px-4 py-3.5 hover:bg-slate-50 rounded-2xl transition-all duration-300 group">
                <div class="flex items-center gap-4">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-blue-50 text-blue-600 shadow-sm group-hover:bg-blue-600 group-hover:text-white transition-all">
                        <i class="fas fa-globe text-sm"></i>
                    </div>
                    <span class="font-bold text-sm tracking-wide text-slate-700">Digital Assets</span>
                </div>
                <i class="fas fa-chevron-right text-[10px] transition-transform duration-300 {{ $menuTerbuka === 'konten' ? 'rotate-90 text-blue-600' : 'text-slate-300' }}"></i>
            </button>
            <div class="overflow-hidden transition-all duration-500 max-h-0 {{ $menuTerbuka === 'konten' ? 'max-h-64 mb-2' : '' }}">
                <div class="pl-14 space-y-1 pr-4">
                    <a href="{{ route('admin.artikel') }}" wire:navigate class="block py-2.5 text-xs font-bold transition-colors {{ request()->routeIs('admin.artikel*') ? 'text-blue-600' : 'text-slate-500 hover:text-blue-600' }}">Blog Engine</a>
                    <a href="{{ route('admin.pengaturan') }}" wire:navigate class="block py-2.5 text-xs font-bold transition-colors {{ request()->routeIs('admin.pengaturan*') ? 'text-blue-600' : 'text-slate-500 hover:text-blue-600' }}">Core Settings</a>
                </div>
            </div>
        </div>

        <!-- System Audit -->
        <a href="{{ route('admin.log') }}" wire:navigate class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-300 group {{ request()->routeIs('admin.log*') ? 'bg-slate-900 text-white shadow-xl' : 'hover:bg-slate-50 hover:text-red-600' }}">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center {{ request()->routeIs('admin.log*') ? 'bg-white/10' : 'bg-red-50 text-red-600 group-hover:bg-red-600 group-hover:text-white transition-all shadow-sm' }}">
                <i class="fas fa-terminal text-sm"></i>
            </div>
            <span class="font-bold text-sm tracking-wide">Kernel Logs</span>
        </a>

    </nav>

    <!-- User Node -->
    <div class="p-6 border-t border-slate-100 bg-slate-50/50">
        <div class="flex items-center gap-4 p-3 rounded-2xl bg-white border border-slate-200/60 shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-slate-800 to-slate-900 flex items-center justify-center text-white font-black text-xs shadow-md">
                {{ substr(auth()->user()->nama, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-black text-slate-900 truncate uppercase tracking-tighter">{{ auth()->user()->nama }}</p>
                <p class="text-[9px] font-bold text-blue-600 uppercase tracking-widest">Root Authorized</p>
            </div>
            <livewire:admin.logout />
        </div>
    </div>
</aside>
