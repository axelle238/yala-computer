<div class="min-h-screen flex items-center justify-center bg-blue-900/5 backdrop-blur-sm -m-8">
    <div class="w-full max-w-md bg-white p-10 rounded-3xl shadow-2xl shadow-blue-900/10 border border-gray-100">
        <div class="text-center mb-10">
            <div class="w-20 h-20 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-blue-200 mx-auto mb-6 rotate-3">
                <i class="fas fa-laptop-code text-3xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-blue-900 mb-2">Selamat Datang</h2>
            <p class="text-gray-500 text-sm">Silakan masuk ke panel administrasi Yala Computer</p>
        </div>

        <form wire:submit="masuk" class="space-y-6">
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Alamat Surel</label>
                <div class="relative">
                    <input wire:model="surel" type="email" class="w-full bg-gray-50 border-none rounded-xl py-4 px-5 pl-12 text-sm focus:ring-2 focus:ring-blue-500 transition-all" placeholder="admin@yalacomputer.com">
                    <i class="fas fa-envelope absolute left-4 top-4.5 text-gray-300"></i>
                </div>
                @error('surel') <span class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Kata Sandi</label>
                <div class="relative">
                    <input wire:model="kata_sandi" type="password" class="w-full bg-gray-50 border-none rounded-xl py-4 px-5 pl-12 text-sm focus:ring-2 focus:ring-blue-500 transition-all" placeholder="••••••••">
                    <i class="fas fa-lock absolute left-4 top-4.5 text-gray-300"></i>
                </div>
                @error('kata_sandi') <span class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" wire:model="ingat_saya" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-xs font-medium text-gray-500 group-hover:text-gray-700">Ingat Saya</span>
                </label>
                <a href="#" class="text-xs font-bold text-blue-600 hover:underline">Lupa Kata Sandi?</a>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-2">
                <span>MASUK SEKARANG</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </button>
        </form>

        <div class="mt-10 pt-10 border-t border-gray-100 text-center">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Sistem Internal - Yala Computer © 2026</p>
        </div>
    </div>
</div>
