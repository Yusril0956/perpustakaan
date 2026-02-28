<div>
    <!-- Detail Modal Include -->
    @include('livewire.guest.book-detail-modal')

    <div class="space-y-20 py-10">
        <section class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($recommendedBooks->take(2) as $book)
                    <div
                        class="group relative flex gap-6 bg-parchment-light/50 border border-sepia-edge/30 p-6 hover:shadow-lg transition-all rounded-sm">
                        <img src="{{ $book->cover_url }}"
                            class="w-24 h-32 object-cover shadow-md flex-shrink-0 border-l-2 border-black/20">
                        <div class="flex flex-col justify-between flex-1">
                            <div>
                                <div
                                    class="flex items-center gap-1 text-[10px] tracking-widest text-coffee/80 uppercase font-bold mb-1">
                                    <x-heroicon-s-star class="w-3 h-3 text-yellow-700/80" /> Pilihan Kami
                                </div>
                                <h3 class="text-lg font-bold italic text-ink mb-2 group-hover:text-coffee transition">
                                    {{ $book->title }}
                                </h3>
                                <p class="text-xs text-coffee/70 italic line-clamp-2">{{ $book->author }}</p>
                            </div>
                            <button wire:click="showDetail({{ $book->id }})"
                                class="flex items-center gap-1 text-xs font-bold uppercase tracking-widest text-coffee hover:text-ink transition self-start">
                                Lihat Selengkapnya <x-heroicon-o-arrow-long-right class="w-4 h-4" />
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="bg-coffee/5 py-16 border-y border-sepia-edge/10">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="flex items-center gap-3 text-3xl font-bold italic text-ink mb-8">
                    <x-heroicon-o-sparkles class="w-8 h-8 text-coffee" /> Buku Populer
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                    @foreach($popularBooks as $book)
                        <button type="button" wire:click="showDetail({{ $book->id }})"
                            class="group cursor-pointer text-left">
                            <div
                                class="relative overflow-hidden aspect-[3/4] mb-3 border border-sepia-edge/20 shadow-sm bg-white p-1">
                                <img src="{{ $book->cover_url }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 sepia-[0.1]">
                            </div>
                            <h4 class="text-xs font-bold italic text-ink truncate">{{ $book->title }}</h4>
                            <p class="text-[10px] text-coffee/60">{{ $book->author }}</p>
                        </button>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 pb-20">
            <div class="mb-12">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
                    <div>
                        <h2 class="text-3xl font-bold italic text-ink mb-1">Jelajahi Koleksi</h2>
                        <p class="text-sm text-coffee/60">{{ $allBooks->total() }} naskah tersedia</p>
                    </div>
                    <div class="flex gap-2 flex-wrap">
                        <button wire:click="setTab('all')"
                            class="px-4 py-2 text-xs uppercase font-bold tracking-wider {{ $currentTab === 'all' ? 'bg-coffee text-parchment-light shadow-[2px_2px_0px_#2c2420]' : 'border border-sepia-edge/40 text-ink hover:bg-sepia-edge/10' }} rounded-sm transition">
                            Semua
                        </button>
                        @foreach($categories->take(3) as $category)
                            <button wire:click="setCategory({{ $category->id }})"
                                class="px-4 py-2 text-xs uppercase font-bold tracking-wider {{ $selectedCategory === $category->id ? 'bg-coffee text-parchment-light shadow-[2px_2px_0px_#2c2420]' : 'border border-sepia-edge/40 text-ink hover:bg-sepia-edge/10' }} rounded-sm transition">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="mb-8 relative">
                    <x-heroicon-o-magnifying-glass
                        class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-coffee/50" />
                    <input wire:model.live.debounce="300ms" type="text" placeholder="Cari judul atau nama penulis..."
                        class="w-full pl-12 pr-4 py-3 border border-sepia-edge/40 rounded-sm bg-white/50 text-ink placeholder:text-coffee/50 italic focus:outline-none focus:border-coffee focus:ring-1 focus:ring-coffee/30">
                </div>
            </div>

            @if($allBooks->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6" x-data="{ componentId: @this.id }">
                    @foreach($allBooks as $book)
                        <div
                            class="group relative bg-white/40 backdrop-blur-sm border border-sepia-edge/30 p-4 shadow-sm hover:shadow-[4px_4px_0px_#d2b48c] transition-all duration-300 rounded-sm overflow-hidden flex flex-col h-full">
                            <div
                                class="relative aspect-[3/4] overflow-hidden shadow-md border-l-4 border-ink/20 mb-3 bg-white p-1">
                                <img src="{{ $book->cover_url }}" alt="{{ $book->title }}"
                                    class="w-full h-full object-cover sepia-[0.2] group-hover:sepia-0 transition-all duration-700">

                                <div
                                    class="absolute top-2 right-2 bg-parchment-base text-[10px] font-bold px-2 py-1 border border-sepia-edge/50 shadow-sm">
                                    @if($book->can_borrow > 0)
                                        <span class="text-green-800">Tersedia {{ $book->can_borrow }}</span>
                                    @else
                                        <span class="text-red-800">Dipinjam</span>
                                    @endif
                                </div>
                            </div>

                            <div class="space-y-2 flex-1">
                                <div
                                    class="flex items-center gap-1 text-[10px] font-mono text-coffee/60 uppercase tracking-widest">
                                    <x-heroicon-o-tag class="w-3 h-3" /> {{ $book->category->name }}
                                </div>
                                <h3
                                    class="text-sm font-bold text-ink italic leading-tight group-hover:text-coffee transition-colors line-clamp-2">
                                    {{ $book->title }}
                                </h3>
                                <p class="text-xs text-coffee/70 italic">{{ $book->author }}</p>
                            </div>

                            <div class="mt-4 pt-3 border-t border-sepia-edge/30 flex items-center justify-between">

                                <button type="button" wire:click="showDetail({{ $book->id }})"
                                    class="group/btn flex items-center gap-1 text-[10px] font-bold uppercase tracking-widest text-coffee hover:text-ink transition-colors">
                                    Lihat Detail
                                    <x-heroicon-o-arrow-right
                                        class="w-3 h-3 transform group-hover/btn:translate-x-1 transition-transform" />
                                </button>

                                @if($book->can_borrow > 0)
                                    <button type="button" wire:click="requestLoan({{ $book->id }})"
                                        class="text-[10px] font-bold uppercase tracking-widest text-ink border-2 border-ink px-3 py-1 hover:bg-ink hover:text-parchment-light transition-colors shadow-[2px_2px_0px_#2c2420] active:translate-y-[2px] active:shadow-none">
                                        Pinjam
                                    </button>
                                @else
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-widest text-red-800/60 border-2 border-red-800/20 border-dashed px-3 py-1 cursor-not-allowed rotate-[-2deg]">
                                        Dipinjam
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-16">
                    {{ $allBooks->links('components.ui.pagination') }}
                </div>
            @else
                <div class="text-center py-24 border-2 border-dashed border-sepia-edge/30 bg-white/20">
                    <x-heroicon-o-archive-box-x-mark class="w-16 h-16 mx-auto text-coffee/30 mb-4" />
                    <h3 class="text-xl font-bold italic text-ink mb-2">Arsip Tidak Ditemukan</h3>
                    <p class="text-sm text-coffee/60 mb-6">Mungkin naskah yang Anda cari ada di rak lain.</p>
                    <button wire:click="setTab('all')"
                        class="px-6 py-2 text-xs uppercase font-bold tracking-wider bg-coffee text-parchment-light rounded-sm hover:bg-ink transition shadow-[3px_3px_0px_#2c2420]">
                        Kembali ke Semua Naskah
                    </button>
                </div>
            @endif
        </section>
    </div>
</div>