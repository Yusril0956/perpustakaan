<div class="max-w-4xl mx-auto py-16 px-6">

    <div class="bg-[#fdfbf7] border-2 border-ink shadow-2xl">

        {{-- Header kartu arsip --}}
        <div class="border-b border-ink/20 px-10 py-6 flex justify-between items-center">

            <div>
                <h1 class="font-serif text-3xl italic font-black text-ink">
                    Arsip Koleksi
                </h1>

                <p class="text-[11px] font-mono uppercase tracking-[0.3em] text-ink/60">
                    Kartu Inventaris Perpustakaan
                </p>
            </div>

            <span class="text-xs font-mono uppercase bg-ink/5 border border-ink/20 px-3 py-1">
                ID #{{ $book->id }}
            </span>

        </div>


        <div class="grid md:grid-cols-[200px_1fr] gap-10 p-10">

            {{-- COVER --}}
            <div class="space-y-4">

                <div class="aspect-[2/3] border-2 border-ink bg-white shadow-lg overflow-hidden">

                    @if($book->cover_url)
                        <img src="{{ asset($book->cover_url) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-ink/40">
                            Tidak ada sampul
                        </div>
                    @endif

                </div>

                <div class="text-center text-[10px] font-mono uppercase text-ink/60">
                    Sampul Koleksi
                </div>

            </div>


            {{-- METADATA --}}
            <div class="space-y-6">

                <div>
                    <h2 class="font-serif text-3xl italic font-bold text-ink">
                        {{ $book->title }}
                    </h2>

                    <p class="text-lg text-ink/80 font-serif">
                        {{ $book->author }}
                    </p>
                </div>


                <div class="grid grid-cols-2 gap-x-10 gap-y-4 text-sm">

                    <div>
                        <p class="text-[10px] font-mono uppercase text-ink/60">
                            ISBN
                        </p>

                        <p class="font-serif text-lg">
                            {{ $book->isbn ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[10px] font-mono uppercase text-ink/60">
                            Kategori
                        </p>

                        <p class="font-serif text-lg">
                            {{ $book->category->name ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[10px] font-mono uppercase text-ink/60">
                            Stok
                        </p>

                        <p class="font-serif text-lg">
                            {{ $book->total_stock }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[10px] font-mono uppercase text-ink/60">
                            Ditambahkan
                        </p>

                        <p class="font-serif text-lg">
                            {{ $book->created_at->format('d M Y') }}
                        </p>
                    </div>

                </div>

            </div>

        </div>


        {{-- Deskripsi --}}
        <div class="border-t border-ink/20 p-10">

            <h3 class="text-xs font-mono uppercase tracking-widest text-ink mb-4">
                Catatan Pustakawan
            </h3>

            <p class="font-serif italic text-lg text-ink/80 leading-relaxed">
                {{ $book->description ?? 'Tidak ada catatan.' }}
            </p>

        </div>


        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="fixed top-6 right-6 z-50 bg-green-600 text-white px-6 py-3 rounded-lg shadow-xl">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="fixed top-6 right-6 z-50 bg-red-600 text-white px-6 py-3 rounded-lg shadow-xl">
                {{ session('error') }}
            </div>
        @endif

        {{-- Footer --}}
        <div class="border-t border-ink/20 px-10 py-6 flex justify-between items-center">

            <x-ui.button href="{{ url()->previous() }}" variant="ghost" size="sm">
                ← kembali ke rak
            </x-ui.button>

            @auth
                @if($canBorrow)
                    <x-ui.button wire:click="borrowBook" variant="outline">
                        Pinjam &rarr;
                    </x-ui.button>
                @else
                    @php
                        $user = auth()->user();
                        $hasBorrowed = \App\Models\Borrowing::where('user_id', $user->id)
                            ->where('book_id', $book->id)
                            ->whereNull('returned_at')
                            ->exists();
                    @endphp

                    @if($hasBorrowed)
                        <span class="text-sm font-mono text-amber-600 bg-amber-50 px-4 py-2 border border-amber-200">
                            ✓ Sedang Dipinjam
                        </span>
                    @elseif(!$user->hasRole('anggota'))
                        <span class="text-sm font-mono text-red-600 bg-red-50 px-4 py-2 border border-red-200">
                            Hanya Anggota
                        </span>
                    @else
                        <span class="text-sm font-mono text-gray-500 bg-gray-50 px-4 py-2 border border-gray-200">
                            Tidak Tersedia
                        </span>
                    @endif
                @endif
            @else
                <x-ui.button href="{{ route('login') }}" variant="outline">
                    Login untuk Pinjam &rarr;
                </x-ui.button>
            @endauth

        </div>

    </div>

</div>