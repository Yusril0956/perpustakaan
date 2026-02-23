<div class="max-w-6xl mx-auto px-6">
    <div class="text-center mb-16">
        <h1 class="text-5xl font-bold text-ink mb-4 italic">Temukan Keajaiban di Antara Baris Kalimat</h1>
        <p class="text-muted text-lg italic">Menyimpan ribuan cerita dalam aroma kertas tua dan tinta digital.</p>
    </div>

    <div class="max-w-2xl mx-auto mb-20">
        <div class="bg-surface p-2 border">
            <input wire:model.live.debounce.300ms="search" type="text"
                class="w-full form-input text-xl py-4 placeholder:italic" placeholder="Cari judul atau penulis buku...">
        </div>
        <div wire:loading class="text-xs italic text-muted mt-2">Membolak-balik halaman...</div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-10">
        @forelse($books as $book)
            <div class="group relative">
                <div class="aspect-3/4 overflow-hidden shadow-sm transition-all duration-500 border-l">
                    <img src="{{ $book->cover_image }}" class="w-full h-full object-cover">
                </div>

                <div class="mt-4 bg-surface p-3 border-t">
                    <h3 class="font-bold text-ink text-lg leading-tight">{{ $book->title }}</h3>
                    <p class="text-sm italic text-muted">{{ $book->author }}</p>
                    <div class="mt-3 flex justify-between items-center border-t border-dashed pt-2">
                        <span class="text-[10px] font-mono text-muted">ID:
                            {{ str_pad($book->id, 5, '0', STR_PAD_LEFT) }}</span>
                        <button class="text-xs uppercase tracking-widest text-ink font-bold hover:text-muted">Lihat
                            Detail</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20 italic text-muted">
                Buku tidak ditemukan di rak kami...
            </div>
        @endforelse
    </div>
</div>
<div class="paper-card">
    <img src="{{ $book->cover_url }}" alt="{{ $book->title }}" class="w-full aspect-[3/4] object-cover rounded">
    <div class="p-3">
        <h3 class="text-sm font-medium text-ink">{{ $book->title }}</h3>
        <p class="text-xs text-muted">{{ $book->author }}</p>
    </div>
</div>