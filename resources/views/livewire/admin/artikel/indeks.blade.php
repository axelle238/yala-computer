<div class="space-y-8">
    @if(!$apakah_menambah && !$apakah_mengedit)
        <!-- Daftar Artikel -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="relative w-full md:w-96">
                <input wire:model.live="cari" type="text" placeholder="Cari judul artikel..." class="w-full bg-white border-none rounded-2xl py-3 px-5 pl-12 text-sm shadow-sm focus:ring-2 focus:ring-blue-500 transition-all">
                <i class="fas fa-search absolute left-4 top-3.5 text-gray-300"></i>
            </div>
            <button wire:click="tambah" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-2xl shadow-lg shadow-blue-200 transition-all flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i>
                <span>TULIS ARTIKEL</span>
            </button>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-5 text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Artikel</th>
                            <th class="px-8 py-5 text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Kategori</th>
                            <th class="px-8 py-5 text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Penulis</th>
                            <th class="px-8 py-5 text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Status</th>
                            <th class="px-8 py-5 text-xs font-black text-gray-400 uppercase tracking-[0.2em] text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($daftar_artikel as $art)
                            <tr class="hover:bg-blue-50/30 transition-colors">
                                <td class="px-8 py-5">
                                    <p class="text-sm font-bold text-gray-900 mb-1">{{ $art->judul }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium">SLUG: {{ $art->slug }}</p>
                                </td>
                                <td class="px-8 py-5 text-sm font-medium text-gray-600">{{ $art->kategori }}</td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <i class="fas fa-user-circle text-blue-400"></i>
                                        {{ $art->penulis->nama ?? 'Sistem' }}
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $art->apakah_diterbitkan ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                        {{ $art->apakah_diterbitkan ? 'Terbit' : 'Draft' }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <div class="flex items-center justify-center gap-3">
                                        <button wire:click="edit({{ $art->id }})" class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-pen text-xs"></i>
                                        </button>
                                        <button class="w-9 h-9 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center text-gray-400 italic text-sm">Belum ada artikel yang ditulis.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-8 border-t border-gray-50">
                {{ $daftar_artikel->links() }}
            </div>
        </div>
    @else
        <!-- Form Editor -->
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-2xl overflow-hidden">
                <div class="p-10 border-b border-gray-50 bg-blue-50/30 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-black text-blue-900 tracking-tight">{{ $apakah_menambah ? 'Tulis Artikel Baru' : 'Edit Artikel' }}</h2>
                        <p class="text-xs text-blue-400 font-bold uppercase tracking-widest mt-1">Editor Konten SEO & Edukasi</p>
                    </div>
                    <button wire:click="batal" class="text-gray-400 hover:text-red-500 transition-colors">
                        <i class="fas fa-times-circle text-2xl"></i>
                    </button>
                </div>

                <form wire:submit="simpan" class="p-10 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="md:col-span-2 space-y-6">
                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Judul Artikel</label>
                                <input wire:model="judul" type="text" class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 text-lg font-bold text-gray-900 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Masukkan judul yang menarik...">
                                @error('judul') <span class="text-red-500 text-[10px] font-bold mt-2 block uppercase">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Isi Konten</label>
                                <textarea wire:model="konten" rows="15" class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 transition-all leading-relaxed" placeholder="Tuliskan isi artikel Anda di sini..."></textarea>
                                @error('konten') <span class="text-red-500 text-[10px] font-bold mt-2 block uppercase">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div class="bg-gray-50 rounded-3xl p-6 border border-gray-100">
                                <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6">Klasifikasi & Status</h3>
                                
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-600 mb-2 uppercase">Kategori</label>
                                        <select wire:model="kategori" class="w-full bg-white border-none rounded-xl py-3 px-4 text-sm shadow-sm focus:ring-2 focus:ring-blue-500">
                                            <option value="Berita">Berita</option>
                                            <option value="Tutorial">Tutorial</option>
                                            <option value="Review">Review Produk</option>
                                            <option value="Tips">Tips & Trik</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <div class="relative">
                                                <input type="checkbox" wire:model="apakah_diterbitkan" class="sr-only peer">
                                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                                            </div>
                                            <span class="text-xs font-bold text-gray-500 group-hover:text-gray-700 uppercase">Diterbitkan</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-blue-900 rounded-3xl p-6 text-white shadow-xl shadow-blue-900/20">
                                <h3 class="text-[10px] font-black text-blue-300 uppercase tracking-[0.2em] mb-4">Tips Penulisan</h3>
                                <ul class="text-[10px] space-y-3 leading-relaxed opacity-80 font-medium">
                                    <li class="flex gap-2"><i class="fas fa-check-circle text-blue-400"></i> Gunakan judul yang mengandung kata kunci (misal: Laptop Gaming).</li>
                                    <li class="flex gap-2"><i class="fas fa-check-circle text-blue-400"></i> Minimal 300 kata untuk optimasi SEO yang lebih baik.</li>
                                    <li class="flex gap-2"><i class="fas fa-check-circle text-blue-400"></i> Slug akan dihasilkan otomatis dari judul.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="pt-10 flex justify-end gap-4">
                        <button type="button" wire:click="batal" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-black py-4 px-10 rounded-2xl text-xs uppercase tracking-widest transition-all">BATAL</button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-black py-4 px-12 rounded-2xl text-xs uppercase tracking-widest shadow-xl shadow-blue-200 transition-all transform hover:-translate-y-1 active:scale-95">SIMPAN ARTIKEL</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
