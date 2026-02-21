<div>
    <div class="space-y-32 py-10">

        <section class="max-w-7xl mx-auto px-6">
            <div class="flex items-end gap-4 mb-10 border-b border-sepia-edge/20 pb-4">
                <x-heroicon-o-star class="w-8 h-8 text-coffee" />
                <h2 class="text-4xl font-bold italic text-ink">Pilihan Pustakawan</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                @foreach($recommendedBooks as $book)
                    <div
                        class="group relative flex flex-col md:flex-row gap-6 bg-white/30 p-6 border-l-4 border-coffee shadow-sm hover:shadow-xl transition-all">
                        <img src="{{ $book->cover_image }}" class="w-32 h-44 object-cover shadow-lg sepia-[0.3]">
                        <div class="flex flex-col justify-center">
                            <span class="text-[10px] tracking-[0.3em] text-coffee/60 uppercase">Edisi Terbatas</span>
                            <h3 class="text-xl font-bold italic text-ink mb-2">{{ $book->title }}</h3>
                            <p class="text-sm text-coffee/80 line-clamp-3 mb-4 italic leading-relaxed">
                                "{{ $book->description }}"</p>
                            <button
                                class="text-xs font-bold uppercase tracking-widest border-b border-coffee self-start hover:text-ink transition">Lihat
                                Arsip</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="bg-coffee/5 py-20 border-y border-sepia-edge/10">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <span class="text-xs uppercase tracking-[0.5em] text-coffee/50">Paling Sering Dibaca</span>
                    <h2 class="text-5xl font-bold italic text-ink mt-2">Koleksi Terpopuler</h2>
                    <div class="w-24 h-[1px] bg-sepia-edge mx-auto mt-6"></div>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-6 gap-8">
                    @foreach($popularBooks as $book)
                        <div class="space-y-3 group cursor-pointer">
                            <div class="relative overflow-hidden aspect-[3/4]">
                                <img src="{{ $book->cover_image }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 sepia-[0.2]">
                                <div
                                    class="absolute inset-0 bg-ink/20 opacity-0 group-hover:opacity-100 transition-opacity">
                                </div>
                            </div>
                            <h4 class="text-sm font-bold italic text-ink truncate">{{ $book->title }}</h4>
                            <div class="flex items-center gap-1 text-[10px] text-coffee/60 italic font-mono uppercase">
                                <x-heroicon-o-eye class="w-3 h-3" /> {{ $book->view_count }}x
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold italic text-ink">Jelajah Kategori</h2>
                    <p class="text-coffee/60 italic">Temukan buku berdasarkan genre dan arsip pengetahuan.</p>
                </div>
                <button
                    class="text-sm italic font-bold text-coffee hover:text-ink underline decoration-sepia-edge underline-offset-8">Lihat
                    Semua Kategori &rarr;</button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($categories as $category)
                    <a href="#"
                        class="group p-8 bg-parchment-base border border-sepia-edge/30 hover:bg-white transition-all flex justify-between items-center shadow-sm">
                        <div>
                            <h4 class="font-bold italic text-ink text-xl">{{ $category->name }}</h4>
                            <span class="text-xs text-coffee/50">{{ $category->books_count }} Koleksi Buku</span>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full border border-sepia-edge/30 flex items-center justify-center group-hover:bg-coffee group-hover:text-white transition-all">
                            <x-heroicon-o-arrow-right class="w-5 h-5" />
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 pb-20">
            <div class="mb-12 border-b-2 border-ink pb-4 flex justify-between items-center">
                <h2 class="text-2xl font-bold uppercase tracking-widest text-ink">Semua Arsip</h2>
                <div class="text-sm italic text-coffee">{{ $allBooks->total() }} Buku Ditemukan</div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
                @foreach($allBooks as $book)
                    <x-ui.book-card :book="$book" />
                @endforeach
            </div>

            <div class="mt-16">
                {{ $allBooks->links('vendor.pagination.vintage') }}
            </div>
        </section>
    </div>
</div>