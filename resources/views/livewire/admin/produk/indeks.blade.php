<div>
    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Daftar Produk -->
        <div class="flex-1">
            <!-- Header Kontrol -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-6 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4 w-full md:w-auto">
                    <div class="relative flex-1 md:w-64">
                        <input wire:model.live="cari" type="text" placeholder="Cari nama produk..." class="w-full bg-gray-50 border-none rounded-xl py-3 px-5 pl-12 text-sm focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search absolute left-4 top-3.5 text-gray-300"></i>
                    </div>
                    <select wire:model.live="filter_kategori" class="bg-gray-50 border-none rounded-xl py-3 px-5 text-sm focus:ring-2 focus:ring-blue-500 min-w-[150px]">
                        <option value="">Semua Kategori</option>
                        @foreach($daftar_kategori as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                        @endforeach
                    </select>
                </div>
                
                <button wire:click="tampilkanFormTambah" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-blue-200 transition-all flex items-center justify-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>TAMBAH PRODUK</span>
                </button>
            </div>

            <!-- Tabel Data -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Produk</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Kategori</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Harga</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Stok</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($daftar_produk as $produk)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-300 overflow-hidden">
                                                @if($produk->gambar_utama)
                                                    <img src="{{ asset('storage/'.$produk->gambar_utama) }}" class="w-full h-full object-cover">
                                                @else
                                                    <i class="fas fa-image text-xl"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-900">{{ $produk->nama }}</p>
                                                <p class="text-[10px] text-gray-400 font-medium">SLUG: {{ $produk->slug }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[10px] font-bold uppercase">
                                            {{ $produk->kategori->nama }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-gray-900">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold {{ $produk->jumlah_stok <= 5 ? 'text-red-500' : 'text-gray-900' }}">
                                                {{ $produk->jumlah_stok }} Unit
                                            </span>
                                            @if($produk->jumlah_stok <= 5)
                                                <span class="text-[9px] text-red-400 font-bold uppercase tracking-tighter">Hampir Habis!</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button title="Edit" class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-100 transition-colors">
                                                <i class="fas fa-edit text-xs"></i>
                                            </button>
                                            <button title="Hapus" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic text-sm">
                                        Tidak ada produk ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-6 border-t border-gray-50">
                    {{ $daftar_produk->links() }}
                </div>
            </div>
        </div>

        <!-- Panel Form (Tambah/Edit) -->
        @if($apakah_menambah || $apakah_mengedit)
            <div class="w-full lg:w-96 flex-shrink-0">
                <div class="bg-white rounded-2xl border border-blue-100 shadow-xl shadow-blue-900/5 sticky top-24 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 bg-blue-50/50 flex items-center justify-between">
                        <h3 class="font-bold text-blue-900">
                            {{ $apakah_menambah ? 'Tambah Produk Baru' : 'Edit Produk' }}
                        </h3>
                        <button wire:click="batal" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <form wire:submit="simpan" class="p-6 space-y-5">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Nama Produk</label>
                            <input wire:model="nama" type="text" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Laptop Asus ROG">
                            @error('nama') <span class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Kategori</label>
                            <select wire:model="kategori_id" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kategori</option>
                                @foreach($daftar_kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id') <span class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Harga (Rp)</label>
                                <input wire:model="harga" type="number" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-blue-500">
                                @error('harga') <span class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Stok Awal</label>
                                <input wire:model="stok_awal" type="number" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-blue-500">
                                @error('stok_awal') <span class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Deskripsi Produk</label>
                            <textarea wire:model="deskripsi" rows="4" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-blue-500" placeholder="Jelaskan spesifikasi produk..."></textarea>
                            @error('deskripsi') <span class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex items-center gap-6 pt-2">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" wire:model="apakah_aktif" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-xs font-bold text-gray-500 group-hover:text-blue-600">Aktif</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" wire:model="apakah_unggulan" class="rounded border-gray-300 text-orange-600 focus:ring-orange-500">
                                <span class="text-xs font-bold text-gray-500 group-hover:text-orange-600">Unggulan</span>
                            </label>
                        </div>

                        <div class="pt-4 flex gap-3">
                            <button type="button" wire:click="batal" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3 rounded-xl transition-all">
                                BATAL
                            </button>
                            <button type="submit" class="flex-[2] bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-200 transition-all">
                                SIMPAN DATA
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </div>
</div>
