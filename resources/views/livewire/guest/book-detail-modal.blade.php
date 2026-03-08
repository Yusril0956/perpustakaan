@if($showDetailModal && $selectedBook)
    <div class="fixed inset-0 z-[9999] flex justify-end">
        <div class="fixed inset-0 bg-ink/60 backdrop-blur-sm transition-opacity" wire:click="closeDetail()"></div>

        <div
            class="relative w-full md:w-[480px] h-full bg-[#f4ecd8] border-2 shadow-[-15px_0_30px_rgba(0,0,0,0.5)] overflow-y-auto transform transition-transform">

            <div class="absolute top-0 left-8 w-16 h-4 bg-white/40 shadow-sm border border-black/5 rotate-[-2deg]"></div>

            <div class="p-8">
                <div class="flex justify-end mb-6">
                    <button wire:click="closeDetail()"
                        class="text-coffee/50 hover:text-red-800 transition p-2 border border-transparent hover:border-red-800/20 rounded-sm">
                        <x-heroicon-o-x-mark class="w-6 h-6" />
                    </button>
                </div>

                <div class="flex flex-col items-center mb-8">
                    <div class="bg-white p-2 border border-sepia-edge/40 shadow-[4px_4px_0px_#d2b48c] mb-6 rotate-1">
                        <img src="{{ $selectedBook->cover_url }}" alt="{{ $selectedBook->title }}"
                            class="w-32 h-48 object-cover sepia-[0.3]">
                    </div>
                    <h3 class="text-3xl font-bold italic text-ink text-center leading-tight mb-2">{{ $selectedBook->title }}
                    </h3>
                    <p
                        class="text-coffee font-mono text-sm tracking-wider uppercase border-b border-dashed border-sepia-edge/50 pb-4 w-full text-center">
                        Oleh: {{ $selectedBook->author }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="border border-sepia-edge/40 p-3 bg-white/30 relative">
                        <div
                            class="absolute -top-2 left-2 bg-[#f4ecd8] px-1 text-[9px] uppercase font-bold text-coffee/60 tracking-widest">
                            Kategori</div>
                        <div class="text-sm font-bold text-ink flex items-center gap-2 mt-1">
                            <x-heroicon-o-folder-open class="w-4 h-4 text-coffee" /> {{ $selectedBook->category->name }}
                        </div>
                    </div>
                    <div class="border border-sepia-edge/40 p-3 bg-white/30 relative">
                        <div
                            class="absolute -top-2 left-2 bg-[#f4ecd8] px-1 text-[9px] uppercase font-bold text-coffee/60 tracking-widest">
                            Status</div>
                        <div
                            class="text-sm font-bold mt-1 flex items-center gap-2 {{ $selectedBook->can_borrow > 0 ? 'text-green-800' : 'text-red-800' }}">
                            <x-heroicon-o-archive-box class="w-4 h-4" />
                            @if($selectedBook->can_borrow > 0)
                                {{ $selectedBook->can_borrow }}/{{ $selectedBook->total_stock }} Tersedia
                            @else
                                Sedang Dipinjam
                            @endif
                        </div>
                    </div>
                </div>

                @if($selectedBook->isbn)
                    <div class="mb-8 p-4 border-2 border-double border-sepia-edge/30 bg-ink/5">
                        <p class="text-[10px] uppercase font-bold text-coffee/60 tracking-[0.2em] mb-1">Kode Identitas (ISBN)
                        </p>
                        <p class="font-mono text-lg text-ink tracking-widest">{{ $selectedBook->isbn }}</p>
                    </div>
                @endif

                @if($selectedBook->description)
                    <div class="mb-10">
                        <h4
                            class="flex items-center gap-2 text-xs uppercase font-bold text-coffee tracking-widest mb-3 border-b border-sepia-edge/30 pb-2">
                            <x-heroicon-o-document-text class="w-4 h-4" /> Catatan Arsip
                        </h4>
                        <p class="text-sm italic text-ink leading-relaxed text-justify">{{ $selectedBook->description }}</p>
                    </div>
                @endif

                <div class="pt-6 border-t-2 border-dashed border-sepia-edge/50 space-y-4">
                    <div
                        class="w-full flex justify-center items-center gap-2 bg-yellow-900/10 text-yellow-900 px-4 py-4 font-bold uppercase tracking-widest text-sm border-2 border-yellow-900/20">
                        <x-heroicon-o-clock class="w-5 h-5" /> Layanan peminjaman sementara ditutup.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif