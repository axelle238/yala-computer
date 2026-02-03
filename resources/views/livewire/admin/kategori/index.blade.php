<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Kolom Kiri: Form Inline (Tambah/Edit) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden sticky top-24">
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
                        <h3 class="font-bold text-lg">
                            {{ $kategoriIdEdit ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
                        </h3>
                        <p class="text-xs text-blue-100 opacity-80">Kelola pengelompokan produk toko Anda.</p>
                    </div>
                    
                    <form wire:submit.prevent="simpan" class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1 text-xs uppercase tracking-wider">Nama Kategori</label>
                            <input type="text" wire:model.live="nama" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition" placeholder="Contoh: Laptop Gaming">
                            @error('nama') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1 text-xs uppercase tracking-wider">Slug URL</label>
                            <input type="text" wire:model="slug" class="w-full rounded-xl border-gray-200 bg-gray-50 text-gray-500 text-sm" readonly>
                            <p class="text-[10px] text-gray-400 mt-1">* Slug digenerate otomatis untuk SEO.</p>
                            @error('slug') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-2 flex flex-col gap-2">
                            <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition transform active:scale-95 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                {{ $kategoriIdEdit ? 'Perbarui Kategori' : 'Simpan Kategori' }}
                            </button>
                            
                            @if($kategoriIdEdit)
                                <button type="button" wire:click="batal" class="w-full py-2 text-gray-500 hover:text-gray-700 text-sm font-medium transition">
                                    Batal Edit
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kolom Kanan: Daftar Kategori -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
                        <h3 class="font-bold text-gray-800 text-lg">Daftar Kategori Produk</h3>
                        
                        <div class="relative w-full md:w-64">
                            <input type="text" wire:model.live.debounce.300ms="cari" class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Cari kategori...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Nama Kategori</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Slug</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-400 uppercase tracking-widest">Jumlah Produk</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-400 uppercase tracking-widest">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @forelse($daftarKategori as $kat)
                                    <tr class="hover:bg-blue-50/30 transition group">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition">{{ $kat->nama }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <code class="px-2 py-1 bg-gray-100 rounded text-xs">{{ $kat->slug }}</code>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $kat->produk_count ?? $kat->produk()->count() }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right whitespace-nowrap space-x-2">
                                            <button wire:click="edit({{ $kat->id }})" class="p-2 text-gray-400 hover:text-blue-600 transition" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </button>
                                            <button wire:click="hapus({{ $kat->id }})" wire:confirm="Yakin ingin menghapus kategori ini? Semua produk di kategori ini akan ikut terhapus!" class="p-2 text-gray-400 hover:text-red-600 transition" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                            Belum ada kategori. Silakan tambah di panel kiri.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-50">
                        {{ $daftarKategori->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification (Global Reuse) -->
    <div 
        x-data="{ show: false, message: '' }" 
        x-on:tampilkan-notifikasi.window="show = true; message = $event.detail.pesan; setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-2 scale-95"
        class="fixed bottom-5 right-5 z-50 bg-white border border-gray-100 text-gray-800 px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4"
        style="display: none;"
    >
        <div class="p-2 bg-green-100 rounded-full text-green-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
        </div>
        <span class="font-bold text-sm" x-text="message"></span>
    </div>
</div>
