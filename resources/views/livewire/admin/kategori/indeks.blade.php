<div>
    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Daftar Kategori -->
        <div class="flex-1 order-2 lg:order-1">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row items-center justify-between gap-4">
                    <h2 class="font-bold text-gray-900">Daftar Kategori</h2>
                    <div class="relative w-full md:w-64">
                        <input wire:model.live="cari" type="text" placeholder="Cari kategori..." class="w-full bg-gray-50 border-none rounded-xl py-2 px-4 pl-10 text-sm focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Nama & Ikon</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Slug</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Produk</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($daftar_kategori as $kategori)
                                <tr class="hover:bg-gray-50/50 transition-colors {{ $id_kategori_diedit == $kategori->id ? 'bg-blue-50/50' : '' }}">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                                                <i class="{{ $kategori->ikon }} text-lg"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-900">{{ $kategori->nama }}</p>
                                                <p class="text-xs text-gray-400 truncate max-w-[200px]">{{ $kategori->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-mono text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ $kategori->slug }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $kategori->produk_count > 0 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                            {{ $kategori->produk_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button wire:click="edit({{ $kategori->id }})" title="Edit" class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-100 transition-colors">
                                                <i class="fas fa-edit text-xs"></i>
                                            </button>
                                            <button 
                                                wire:click="hapus({{ $kategori->id }})"
                                                wire:confirm="Yakin ingin menghapus kategori ini? Produk terkait mungkin akan terpengaruh."
                                                title="Hapus" 
                                                class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors"
                                            >
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic text-sm">
                                        Tidak ada kategori ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-6 border-t border-gray-50">
                    {{ $daftar_kategori->links() }}
                </div>
            </div>
        </div>

        <!-- Panel Form (Sticky) -->
        <div class="w-full lg:w-80 flex-shrink-0 order-1 lg:order-2">
            <div class="bg-white rounded-2xl border border-blue-100 shadow-xl shadow-blue-900/5 sticky top-24">
                <div class="p-6 border-b border-gray-50 bg-blue-50/50 flex items-center justify-between">
                    <h3 class="font-bold text-blue-900">
                        {{ $mode == 'tambah' ? 'Buat Kategori Baru' : 'Edit Kategori' }}
                    </h3>
                    @if($mode == 'edit')
                        <button wire:click="resetForm" class="text-xs text-red-500 hover:underline font-bold">Batal</button>
                    @endif
                </div>
                
                <form wire:submit="simpan" class="p-6 space-y-5">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Nama Kategori</label>
                        <input wire:model="nama" type="text" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Laptop Gaming">
                        @error('nama') <span class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Kode Ikon (FontAwesome)</label>
                        <div class="relative">
                            <input wire:model="ikon" type="text" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 pl-10 text-sm focus:ring-2 focus:ring-blue-500" placeholder="fas fa-laptop">
                            <div class="absolute left-3 top-3 w-5 h-5 flex items-center justify-center text-gray-400">
                                @if($ikon) <i class="{{ $ikon }}"></i> @else <i class="fas fa-icons"></i> @endif
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1">Gunakan class icon dari FontAwesome 6.</p>
                        @error('ikon') <span class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Deskripsi Singkat</label>
                        <textarea wire:model="deskripsi" rows="3" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-blue-500" placeholder="Deskripsi untuk keperluan SEO..."></textarea>
                        @error('deskripsi') <span class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-200 transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>{{ $mode == 'tambah' ? 'SIMPAN KATEGORI' : 'PERBARUI DATA' }}</span>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
