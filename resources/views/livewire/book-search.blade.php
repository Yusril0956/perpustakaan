<div class="max-w-6xl mx-auto px-6">
    <div class="text-center mb-16">
        <h1 class="text-5xl font-bold text-ink mb-4 italic">Temukan Keajaiban di Antara Baris Kalimat</h1>
        <p class="text-coffee/80 text-lg italic">Menyimpan ribuan cerita dalam aroma kertas tua dan tinta digital.</p>
    </div>

    <div class="max-w-2xl mx-auto mb-20">
        <div class="bg-parchment-base p-2 shadow-inner border border-sepia-edge/50">
            <input wire:model.live.debounce.300ms="search" type="text"
                class="w-full bg-transparent border-b border-coffee/30 focus:border-coffee border-t-0 border-x-0 focus:ring-0 text-xl py-4 placeholder:italic placeholder:text-coffee/40"
                placeholder="Cari judul atau penulis buku...">
        </div>
        <div wire:loading class="text-xs italic text-coffee mt-2 animate-pulse">Membolak-balik halaman...</div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-10">
        @forelse($books as $book)
            <div class="group relative">
                <div
                    class="aspect-[3/4] overflow-hidden shadow-[10px_10px_20px_rgba(0,0,0,0.2)] group-hover:shadow-[15px_15px_30px_rgba(0,0,0,0.3)] transition-all duration-500 border-l-4 border-black/10">
                    <img src="{{ $book->cover_image }}"
                        class="w-full h-full object-cover sepia-[0.3] group-hover:sepia-0 transition duration-500">
                </div>

                <div class="mt-4 bg-white/40 p-3 border-t border-sepia-edge/20 backdrop-blur-sm">
                    <h3 class="font-bold text-ink text-lg leading-tight">{{ $book->title }}</h3>
                    <p class="text-sm italic text-coffee/80">{{ $book->author }}</p>
                    <div class="mt-3 flex justify-between items-center border-t border-dashed border-sepia-edge/40 pt-2">
                        <span class="text-[10px] font-mono text-coffee">ID:
                            {{ str_pad($book->id, 5, '0', STR_PAD_LEFT) }}</span>
                        <button class="text-xs uppercase tracking-widest text-ink font-bold hover:text-coffee">Lihat
                            Detail</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20 italic text-coffee">
                Buku tidak ditemukan di rak kami...
            </div>
        @endforelse
    </div>
</div>