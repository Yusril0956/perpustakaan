<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-parchment-base via-white to-parchment-light">
        <!-- Hero Section -->
        <div class="max-w-7xl mx-auto px-6 py-16">
            <section class="text-center mb-24">
                <div class="mb-8">
                    <div
                        class="inline-flex items-center gap-2 bg-coffee/10 px-4 py-2 rounded-full text-coffee text-sm font-medium mb-6">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Sistem Perpustakaan Digital Modern
                    </div>
                </div>

                <h1 class="text-6xl md:text-8xl font-bold text-ink mb-8 italic tracking-tight leading-tight">
                    Arsip Cerita & <br>
                    <span class="text-coffee">Pengetahuan Abadi</span>
                </h1>

                <div class="flex justify-center items-center gap-4 mb-12">
                    <div class="h-[1px] w-24 bg-sepia-edge"></div>
                    <p class="text-coffee italic text-lg">Menjelajahi masa lalu melalui tinta digital</p>
                    <div class="h-[1px] w-24 bg-sepia-edge"></div>
                </div>

                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto mb-12">
                    <form action="{{ route('login') }}" method="GET" class="relative">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Cari judul buku, penulis, atau kategori..."
                                class="w-full pl-12 pr-4 py-4 bg-white/90 backdrop-blur-sm border-2 border-coffee/20 rounded-xl focus:border-coffee focus:ring-0 text-lg italic placeholder-coffee/50 shadow-lg">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                <svg class="w-6 h-6 text-coffee/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>
                        <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-coffee text-parchment-base px-6 py-2 rounded-lg font-semibold hover:bg-coffee/90 transition-all duration-300 shadow-md">
                            Cari
                        </button>
                    </form>
                    <p class="text-center text-coffee/60 text-sm mt-2 italic">Masuk untuk mengakses fitur pencarian lengkap</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 bg-coffee text-parchment-base px-8 py-4 rounded-lg font-semibold hover:bg-coffee/90 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Masuk ke Akun
                    </a>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center gap-2 border-2 border-coffee text-coffee px-8 py-4 rounded-lg font-semibold hover:bg-coffee hover:text-parchment-base transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Daftar Anggota Baru
                    </a>
                </div>
            </section>

            <!-- Features Grid -->
            <section class="grid md:grid-cols-3 gap-8 mb-24">
                <div
                    class="bg-white/70 backdrop-blur-sm p-8 rounded-xl border border-sepia-edge/20 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-coffee/10 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-coffee" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-ink mb-4 text-center italic">Koleksi Lengkap</h3>
                    <p class="text-coffee/80 text-center leading-relaxed">
                        Ribuan judul buku dari berbagai kategori siap menemani perjalanan intelektual Anda. Dari novel
                        klasik hingga buku pengetahuan terkini.
                    </p>
                </div>

                <div
                    class="bg-white/70 backdrop-blur-sm p-8 rounded-xl border border-sepia-edge/20 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-coffee/10 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-coffee" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-ink mb-4 text-center italic">Akses Cepat</h3>
                    <p class="text-coffee/80 text-center leading-relaxed">
                        Sistem pencarian canggih memungkinkan Anda menemukan buku impian dalam hitungan detik. Tidak
                        perlu antri berjam-jam.
                    </p>
                </div>

                <div
                    class="bg-white/70 backdrop-blur-sm p-8 rounded-xl border border-sepia-edge/20 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-coffee/10 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-coffee" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-ink mb-4 text-center italic">Keamanan Terjamin</h3>
                    <p class="text-coffee/80 text-center leading-relaxed">
                        Data pribadi Anda aman bersama kami. Sistem keamanan berlapis memastikan privasi dan keamanan
                        informasi Anda.
                    </p>
                </div>
            </section>

            <!-- Stats Section -->
            <section class="bg-coffee text-parchment-base rounded-2xl p-12 mb-24 shadow-2xl">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold italic mb-4">Angka-angka Pustaka Kami</h2>
                    <p class="text-parchment-base/80">Prestasi yang terus berkembang bersama komunitas pembaca</p>
                </div>

                <div class="grid md:grid-cols-4 gap-8 text-center">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-4xl font-bold mb-2">2,500+</div>
                        <div class="text-parchment-base/80">Judul Buku</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-4xl font-bold mb-2">1,200+</div>
                        <div class="text-parchment-base/80">Anggota Aktif</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-4xl font-bold mb-2">15,000+</div>
                        <div class="text-parchment-base/80">Peminjaman</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                        <div class="text-4xl font-bold mb-2">98%</div>
                        <div class="text-parchment-base/80">Kepuasan</div>
                    </div>
                </div>
            </section>

            <!-- Featured Books Section -->
            <section class="mb-24">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-ink italic mb-4">Koleksi Terbaru Kami</h2>
                    <p class="text-coffee/80 text-lg">Jelajahi buku-buku terbaru yang siap menemani perjalanan
                        intelektual Anda</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $featuredBooks = \App\Models\Book::with('category')->latest()->take(8)->get();
                    @endphp

                    @forelse($featuredBooks as $book)
                        <div
                            class="bg-white/70 backdrop-blur-sm rounded-xl border border-sepia-edge/20 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                            <div
                                class="aspect-[3/4] bg-gradient-to-br from-coffee/10 to-sepia-edge/10 flex items-center justify-center p-4">
                                @if($book->cover_image)
                                    <img src="{{ $book->cover_image }}" alt="{{ $book->title }}"
                                        class="w-full h-full object-cover rounded-lg shadow-md">
                                @else
                                    <div class="w-full h-full bg-coffee/20 rounded-lg flex items-center justify-center">
                                        <svg class="w-12 h-12 text-coffee/60" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="p-4">
                                <div class="mb-2">
                                    <span
                                        class="inline-block bg-coffee/10 text-coffee text-xs px-2 py-1 rounded-full font-medium">
                                        {{ $book->category->name ?? 'Umum' }}
                                    </span>
                                </div>

                                <h3 class="font-bold text-ink mb-2 line-clamp-2 italic text-sm leading-tight"
                                    title="{{ $book->title }}">
                                    {{ $book->title }}
                                </h3>

                                <p class="text-coffee/70 text-xs mb-3 italic">
                                    oleh {{ $book->author }}
                                </p>

                                <div class="flex items-center justify-between text-xs text-coffee/60">
                                    <span>Stok: {{ $book->available_stock }}/{{ $book->total_stock }}</span>
                                    @if($book->available_stock > 0)
                                        <span class="text-green-600 font-medium">Tersedia</span>
                                    @else
                                        <span class="text-red-600 font-medium">Habis</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="w-16 h-16 text-coffee/40 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <p class="text-coffee/60 italic">Koleksi buku sedang disiapkan...</p>
                        </div>
                    @endforelse
                </div>

                <div class="text-center mt-8">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 bg-coffee text-parchment-base px-6 py-3 rounded-lg font-semibold hover:bg-coffee/90 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Jelajahi Semua Koleksi
                    </a>
                </div>
            </section>

            <!-- About Section -->
            <section class="bg-parchment-base border border-sepia-edge/30 rounded-2xl p-12 shadow-inner text-center">
                <div class="max-w-4xl mx-auto">
                    <h3 class="text-3xl font-bold text-ink mb-6 italic">Tentang Pustaka Arsip</h3>
                    <p class="text-coffee/90 leading-relaxed text-lg mb-8">
                        Ini bukan sekadar database. Ini adalah upaya kami merawat ingatan kolektif bangsa.
                        Setiap halaman yang Anda baca di sini adalah bagian dari sejarah yang kami digitalkan
                        agar tetap hidup di meja-meja belajar generasi mendatang.
                    </p>

                    <div class="grid md:grid-cols-2 gap-8 text-left">
                        <div class="bg-white/50 p-6 rounded-lg">
                            <h4 class="font-bold text-ink mb-3 italic">Visi Kami</h4>
                            <p class="text-coffee/80">Menjadi jembatan antara pengetahuan masa lalu dan inovasi masa
                                depan melalui teknologi digital.</p>
                        </div>
                        <div class="bg-white/50 p-6 rounded-lg">
                            <h4 class="font-bold text-ink mb-3 italic">Misi Kami</h4>
                            <p class="text-coffee/80">Menyediakan akses mudah dan merata terhadap khazanah pengetahuan
                                untuk semua lapisan masyarakat.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-guest-layout>