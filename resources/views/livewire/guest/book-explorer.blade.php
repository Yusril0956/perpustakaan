<div>
    {{-- Alpine.js Scope --}}
    <div x-data="{ showModal: false }" @open-book-modal.window="showModal = true"
        @close-book-modal.window="showModal = false" @keydown.escape.window="showModal = false">

        <div class="space-y-20 py-10">

            {{-- REKOMENDASI --}}
            <section class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($recommendedBooks->take(2) as $book)
                        <div wire:key="recommended-{{ $book->id }}"
                            class="group relative flex gap-6 bg-parchment-light/50 border border-sepia-edge/30 p-6 hover:shadow-lg transition-all rounded-sm">
                            <img src="{{ $book->cover_url }}"
                                class="w-24 h-32 object-cover shadow-md flex-shrink-0 border-l-2 border-black/20"
                                alt="{{ $book->title }}">
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
                                <button wire:click="loadBookDetail({{ $book->id }})"
                                    class="flex items-center gap-1 text-xs font-bold uppercase tracking-widest text-coffee hover:text-ink transition self-start disabled:opacity-50">
                                    <span wire:loading.remove wire:target="loadBookDetail({{ $book->id }})">Lihat
                                        Selengkapnya</span>
                                    <span wire:loading wire:target="loadBookDetail({{ $book->id }})">Memuat...</span>
                                    <x-heroicon-o-arrow-long-right class="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- POPULER --}}
            <section class="bg-coffee/5 py-16 border-y border-sepia-edge/10">
                <div class="max-w-7xl mx-auto px-6">
                    <h2 class="flex items-center gap-3 text-3xl font-bold italic text-ink mb-8">
                        <x-heroicon-o-sparkles class="w-8 h-8 text-coffee" /> Buku Populer
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                        @foreach($popularBooks as $book)
                            <button wire:key="popular-{{ $book->id }}" type="button"
                                wire:click="loadBookDetail({{ $book->id }})"
                                class="group cursor-pointer text-left relative">
                                <div wire:loading wire:target="loadBookDetail({{ $book->id }})"
                                    class="absolute inset-0 z-10 bg-white/50 backdrop-blur-sm flex items-center justify-center">
                                    <span class="animate-spin text-coffee text-2xl">⚙</span>
                                </div>
                                <div
                                    class="relative overflow-hidden aspect-[3/4] mb-3 border border-sepia-edge/20 shadow-sm bg-white p-1">
                                    <img src="{{ $book->cover_url }}" alt="{{ $book->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 sepia-[0.1]">
                                </div>
                                <h4 class="text-xs font-bold italic text-ink truncate">{{ $book->title }}</h4>
                                <p class="text-[10px] text-coffee/60">{{ $book->author }}</p>
                            </button>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- DAFTAR SEMUA BUKU --}}
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
                                <button wire:key="category-{{ $category->id }}"
                                    wire:click="setCategory({{ $category->id }})"
                                    class="px-4 py-2 text-xs uppercase font-bold tracking-wider {{ $selectedCategory === $category->id ? 'bg-coffee text-parchment-light shadow-[2px_2px_0px_#2c2420]' : 'border border-sepia-edge/40 text-ink hover:bg-sepia-edge/10' }} rounded-sm transition">
                                    {{ $category->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-8 relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2">
                            <x-heroicon-o-magnifying-glass wire:loading.remove wire:target="search"
                                class="w-5 h-5 text-coffee/50" />
                            <span wire:loading wire:target="search"
                                class="animate-spin text-coffee/50 block w-5 h-5 text-center leading-none">⚙</span>
                        </div>
                        <input wire:model.live.debounce="500ms" type="text"
                            placeholder="Cari judul atau nama penulis..."
                            class="w-full pl-12 pr-4 py-3 border border-sepia-edge/40 rounded-sm bg-white/50 text-ink placeholder:text-coffee/50 italic focus:outline-none focus:border-coffee focus:ring-1 focus:ring-coffee/30">
                    </div>
                </div>

                @if($allBooks->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($allBooks as $book)
                            <div wire:key="book-{{ $book->id }}"
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
                                    <button type="button" wire:click="loadBookDetail({{ $book->id }})"
                                        class="group/btn flex items-center gap-1 text-[10px] font-bold uppercase tracking-widest text-coffee hover:text-ink transition-colors disabled:opacity-50">
                                        <span wire:loading.remove wire:target="loadBookDetail({{ $book->id }})">Detail</span>
                                        <span wire:loading wire:target="loadBookDetail({{ $book->id }})">Memuat...</span>
                                        <x-heroicon-o-arrow-right
                                            class="w-3 h-3 transform group-hover/btn:translate-x-1 transition-transform" />
                                    </button>

                                    @if($book->can_borrow > 0)
                                        <button type="button" wire:click="requestLoan({{ $book->id }})" wire:loading.attr="disabled"
                                            class="text-[10px] font-bold uppercase tracking-widest text-ink border-2 border-ink px-3 py-1 hover:bg-ink hover:text-parchment-light transition-colors shadow-[2px_2px_0px_#2c2420] active:translate-y-[2px] active:shadow-none disabled:opacity-50 disabled:cursor-wait">
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

        {{-- MODAL DETAIL BUKU (Alpine.js) --}}
        <div x-cloak x-show="showModal" class="fixed inset-0 z-[9999] flex justify-end">
            {{-- Backdrop --}}
            <div x-show="showModal" x-transition.opacity.duration.300ms @click="showModal = false"
                class="fixed inset-0 bg-ink/60 backdrop-blur-sm cursor-pointer"></div>

            {{-- Sidebar Modal --}}
            <div x-show="showModal" x-transition:enter="transform transition ease-out duration-300"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in duration-200" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="relative w-full md:w-[480px] h-full bg-[#f4ecd8] border-l-2 border-ink shadow-[-15px_0_30px_rgba(0,0,0,0.5)] overflow-y-auto">

                <div class="absolute top-0 left-8 w-16 h-4 bg-white/40 shadow-sm border border-black/5 rotate-[-2deg]">
                </div>

                @if($selectedBook)
                    <div class="p-8">
                        <div class="flex justify-end mb-6">
                            <button @click="showModal = false"
                                class="text-coffee/50 hover:text-red-800 transition p-2 border border-transparent hover:border-red-800/20 rounded-sm">
                                <x-heroicon-o-x-mark class="w-6 h-6" />
                            </button>
                        </div>

                        <div class="flex flex-col items-center mb-8">
                            <div
                                class="bg-white p-2 border border-sepia-edge/40 shadow-[4px_4px_0px_#d2b48c] mb-6 rotate-1">
                                <img src="{{ $selectedBook->cover_url }}" alt="{{ $selectedBook->title }}"
                                    class="w-32 h-48 object-cover sepia-[0.3]">
                            </div>
                            <h3 class="text-3xl font-bold italic text-ink text-center leading-tight mb-2">
                                {{ $selectedBook->title }}
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
                                    <x-heroicon-o-folder-open class="w-4 h-4 text-coffee" />
                                    {{ $selectedBook->category->name ?? 'Umum' }}
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
                                <p class="text-[10px] uppercase font-bold text-coffee/60 tracking-[0.2em] mb-1">Kode Identitas
                                    (ISBN)</p>
                                <p class="font-mono text-lg text-ink tracking-widest">{{ $selectedBook->isbn }}</p>
                            </div>
                        @endif

                        @if($selectedBook->description)
                            <div class="mb-10">
                                <h4
                                    class="flex items-center gap-2 text-xs uppercase font-bold text-coffee tracking-widest mb-3 border-b border-sepia-edge/30 pb-2">
                                    <x-heroicon-o-document-text class="w-4 h-4" /> Catatan Arsip
                                </h4>
                                <p class="text-sm italic text-ink leading-relaxed text-justify">{{ $selectedBook->description }}
                                </p>
                            </div>
                        @endif

                        <div class="pt-6 border-t-2 border-dashed border-sepia-edge/50 space-y-4">
                            @auth
                                @if($selectedBook->can_borrow > 0)
                                    <x-ui.button type="button" wire:click="requestLoan({{ $selectedBook->id }})" iconLeft="heroicon-o-bookmark-square"
                                        wire:loading.attr="disabled" class="w-full">
                                        <span wire:loading.remove wire:target="requestLoan">
                                            Ajukan Peminjaman</span>
                                    </x-ui.button>
                                @else
                                    <div
                                        class="w-full flex justify-center items-center gap-2 bg-red-900/10 text-red-900 px-4 py-4 font-bold uppercase tracking-widest text-sm border-2 border-red-900/20 border-dashed">
                                        <x-heroicon-o-no-symbol class="w-5 h-5" /> Maaf, stok buku ini habis.
                                    </div>
                                @endif
                            @else
                                <x-ui.button href="{{ route('login') }}" wire:navigate iconLeft="heroicon-o-key" class="w-full">
                                    Masuk Untuk Meminjam
                                </x-ui.button>
                            @endauth
                        </div>
                    </div>
                @else
                    <div class="h-full flex flex-col items-center justify-center space-y-4">
                        <span class="animate-spin text-4xl text-coffee">⚙</span>
                        <p class="text-xs font-mono font-bold tracking-widest text-coffee uppercase">Mengambil Berkas...</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>