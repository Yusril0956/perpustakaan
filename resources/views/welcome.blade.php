<x-guest-layout>
    <div class="min-h-screen bg-[#fcfaf5] text-ink relative overflow-hidden selection:bg-ink selection:text-[#fcfaf5]">

        <div
            class="absolute inset-0 opacity-[0.03] pointer-events-none bg-[url('https://www.transparenttextures.com/patterns/natural-paper.png')] z-0">
        </div>

        <div class="max-w-7xl mx-auto px-6 py-16 relative z-10">

            <section class="text-center mb-24 border-b-4 border-double border-ink pb-16">
                <div class="mb-8">
                    <div
                        class="inline-flex items-center gap-2 border-2 border-ink bg-ink/5 px-4 py-1 text-ink text-xs font-mono font-black uppercase tracking-widest mb-6 shadow-[4px_4px_0px_rgba(44,36,32,1)]">
                        <x-heroicon-s-archive-box class="w-4 h-4" />
                        [ Dokumen Publik - Terbuka Untuk Umum ]
                    </div>
                </div>

                <h1
                    class="text-6xl md:text-8xl font-black text-ink mb-6 font-serif uppercase tracking-tight leading-none">
                    Arsip Cerita <br>
                    <span class="border-b-4 border-ink">Pengetahuan Abadi</span>
                </h1>

                <div
                    class="flex justify-center items-center gap-4 mb-12 font-mono text-sm uppercase tracking-widest text-ink/70">
                    <div class="h-px w-16 bg-ink/50"></div>
                    <p>Menjelajahi masa lalu melalui tinta digital</p>
                    <div class="h-px w-16 bg-ink/50"></div>
                </div>

                @if (!auth()->check())
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <a href="{{ route('login') }}" wire:navigate
                        class="inline-flex items-center gap-2 bg-ink text-[#fcfaf5] border-2 border-ink px-8 py-3 font-mono text-sm font-black uppercase tracking-widest shadow-[6px_6px_0px_rgba(44,36,32,1)] hover:translate-y-1 hover:shadow-[2px_2px_0px_rgba(44,36,32,1)] transition-all">
                        <x-heroicon-o-key class="w-5 h-5" />
                        Akses Masuk
                    </a>
                    <a href="{{ route('register') }}" wire:navigate
                        class="inline-flex items-center gap-2 bg-[#fcfaf5] text-ink border-2 border-ink px-8 py-3 font-mono text-sm font-black uppercase tracking-widest shadow-[6px_6px_0px_rgba(44,36,32,1)] hover:translate-y-1 hover:shadow-[2px_2px_0px_rgba(44,36,32,1)] transition-all">
                        <x-heroicon-o-document-plus class="w-5 h-5" />
                        Registrasi Baru
                    </a>
                </div>
                @endif
                
            </section>

            <section class="grid md:grid-cols-3 gap-8 mb-24">
                <div class="bg-[#fcfaf5] p-8 border-2 border-ink shadow-[8px_8px_0px_rgba(44,36,32,1)] relative">
                    <div class="absolute top-0 right-0 bg-ink text-[#fcfaf5] font-mono text-[10px] px-2 py-1 uppercase">
                        Bab 01</div>
                    <div
                        class="w-12 h-12 border-2 border-ink flex items-center justify-center mb-6 transform -rotate-3 bg-ink/5">
                        <x-heroicon-o-book-open class="w-6 h-6 text-ink" />
                    </div>
                    <h3 class="text-xl font-black font-serif text-ink mb-3 uppercase">Koleksi Lengkap</h3>
                    <p class="text-ink/80 font-mono text-xs leading-relaxed text-justify">
                        Ribuan literatur dari berbagai kategori siap menemani perjalanan intelektual Anda. Dari naskah
                        klasik hingga jurnal terkini.
                    </p>
                </div>

                <div class="bg-[#fcfaf5] p-8 border-2 border-ink shadow-[8px_8px_0px_rgba(44,36,32,1)] relative">
                    <div class="absolute top-0 right-0 bg-ink text-[#fcfaf5] font-mono text-[10px] px-2 py-1 uppercase">
                        Bab 02</div>
                    <div
                        class="w-12 h-12 border-2 border-ink flex items-center justify-center mb-6 transform rotate-3 bg-ink/5">
                        <x-heroicon-o-bolt class="w-6 h-6 text-ink" />
                    </div>
                    <h3 class="text-xl font-black font-serif text-ink mb-3 uppercase">Pencarian Kilat</h3>
                    <p class="text-ink/80 font-mono text-xs leading-relaxed text-justify">
                        Sistem indeksasi canggih memungkinkan Anda melacak letak rak dokumen dalam hitungan detik. Tanpa
                        perlu membuka laci manual.
                    </p>
                </div>

                <div class="bg-[#fcfaf5] p-8 border-2 border-ink shadow-[8px_8px_0px_rgba(44,36,32,1)] relative">
                    <div class="absolute top-0 right-0 bg-ink text-[#fcfaf5] font-mono text-[10px] px-2 py-1 uppercase">
                        Bab 03</div>
                    <div
                        class="w-12 h-12 border-2 border-ink flex items-center justify-center mb-6 transform -rotate-2 bg-ink/5">
                        <x-heroicon-o-shield-check class="w-6 h-6 text-ink" />
                    </div>
                    <h3 class="text-xl font-black font-serif text-ink mb-3 uppercase">Kerahasiaan Terjaga</h3>
                    <p class="text-ink/80 font-mono text-xs leading-relaxed text-justify">
                        Log sirkulasi dan data pribadi terenkripsi dengan protokol keamanan berlapis. Privasi pembaca
                        adalah sumpah kami.
                    </p>
                </div>
            </section>

            <section class="border-4 border-double border-ink p-1 relative mb-24">
                <div class="bg-ink text-[#fcfaf5] p-12 text-center">
                    <h2 class="text-3xl font-black font-serif uppercase mb-4">Statistik Inventaris</h2>
                    <p class="font-mono text-sm text-[#fcfaf5]/70 mb-12">Laporan sirkulasi harian - Diperbarui secara
                        otomatis</p>

                    <div class="grid md:grid-cols-4 gap-8">
                        <div class="border border-dashed border-[#fcfaf5]/30 p-6 relative">
                            <div class="text-4xl font-black font-serif mb-2">2,500+</div>
                            <div class="font-mono text-xs uppercase tracking-widest text-[#fcfaf5]/70">Naskah</div>
                        </div>
                        <div class="border border-dashed border-[#fcfaf5]/30 p-6">
                            <div class="text-4xl font-black font-serif mb-2">1,200+</div>
                            <div class="font-mono text-xs uppercase tracking-widest text-[#fcfaf5]/70">Anggota</div>
                        </div>
                        <div class="border border-dashed border-[#fcfaf5]/30 p-6">
                            <div class="text-4xl font-black font-serif mb-2">15,000+</div>
                            <div class="font-mono text-xs uppercase tracking-widest text-[#fcfaf5]/70">Sirkulasi</div>
                        </div>
                        <div class="border border-dashed border-[#fcfaf5]/30 p-6">
                            <div class="text-4xl font-black font-serif mb-2">98%</div>
                            <div class="font-mono text-xs uppercase tracking-widest text-[#fcfaf5]/70">Presisi</div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-24">
                <div class="flex items-end justify-between border-b-2 border-ink pb-4 mb-8">
                    <div>
                        <h2 class="text-3xl font-black font-serif text-ink uppercase">Koleksi Terkini</h2>
                        <p class="font-mono text-sm text-ink/70 mt-2">Arsip yang baru saja masuk ke brankas kami.</p>
                    </div>
                    <a href="{{ route('login') }}" wire:navigate
                        class="font-mono text-xs font-black uppercase text-ink hover:underline decoration-2 underline-offset-4 hidden md:block">
                        Lihat Seluruh Indeks &rarr;
                    </a>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $featuredBooks = \App\Models\Book::with('category')->latest()->take(4)->get();
                    @endphp

                    @forelse($featuredBooks as $book)
                        <div
                            class="group bg-[#fcfaf5] border-2 border-ink p-3 shadow-[6px_6px_0px_rgba(44,36,32,1)] hover:-translate-y-1 hover:shadow-[10px_10px_0px_rgba(44,36,32,1)] transition-all flex flex-col">

                            <div class="aspect-[3/4] border-2 border-ink mb-4 relative overflow-hidden bg-ink/5 p-1">
                                @if($book->cover_image)
                                    <img src="{{ $book->cover_image }}" alt="{{ $book->title }}"
                                        class="w-full h-full object-cover filter sepia-[30%] grayscale-[20%] group-hover:filter-none transition-all duration-500">
                                @else
                                    <div
                                        class="w-full h-full flex flex-col items-center justify-center border border-dashed border-ink/40">
                                        <x-heroicon-o-photo class="w-8 h-8 text-ink/30 mb-2" />
                                        <span class="font-mono text-[10px] text-ink/40 uppercase">Tanpa Sampul</span>
                                    </div>
                                @endif

                                <div
                                    class="absolute top-2 right-2 bg-[#fcfaf5] border border-ink px-2 py-0.5 font-mono text-[9px] font-black uppercase shadow-sm">
                                    {{ $book->category->name ?? 'UMUM' }}
                                </div>
                            </div>

                            <div class="flex-1 flex flex-col">
                                <h3 class="font-black font-serif text-lg text-ink line-clamp-2 leading-tight mb-1 uppercase"
                                    title="{{ $book->title }}">
                                    {{ $book->title }}
                                </h3>
                                <p class="text-ink/70 font-mono text-[10px] uppercase mb-4">
                                    PENA: {{ $book->author }}
                                </p>

                                <div
                                    class="mt-auto pt-3 border-t border-dashed border-ink/30 flex items-center justify-between font-mono text-[10px] font-black uppercase">
                                    <span>STOK: {{ $book->available_stock }}/{{ $book->total_stock }}</span>
                                    @if($book->available_stock > 0)
                                        <span class="text-ink border border-ink px-1.5 py-0.5 bg-green-500/20">TERSEDIA</span>
                                    @else
                                        <span class="text-ink border border-ink px-1.5 py-0.5 bg-red-500/20">DIPINJAM</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-16 border-2 border-dashed border-ink bg-ink/5">
                            <x-heroicon-o-archive-box-x-mark class="w-12 h-12 text-ink/30 mx-auto mb-3" />
                            <p class="font-mono text-sm text-ink/60 uppercase font-black">Laci arsip masih kosong.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            <section class="bg-[#fcfaf5] border-4 border-ink p-1 shadow-[12px_12px_0px_rgba(44,36,32,1)] relative">
                <div class="absolute top-2 left-2 w-3 h-3 border-t-2 border-l-2 border-ink"></div>
                <div class="absolute top-2 right-2 w-3 h-3 border-t-2 border-r-2 border-ink"></div>
                <div class="absolute bottom-2 left-2 w-3 h-3 border-b-2 border-l-2 border-ink"></div>
                <div class="absolute bottom-2 right-2 w-3 h-3 border-b-2 border-r-2 border-ink"></div>

                <div class="border border-ink p-10 text-center relative z-10">
                    <h3
                        class="text-3xl font-black font-serif text-ink mb-6 uppercase tracking-widest border-b-2 border-dashed border-ink/30 inline-block pb-2">
                        Manifesto Pustaka</h3>
                    <p class="font-mono text-sm text-ink/80 leading-loose max-w-3xl mx-auto mb-10 text-justify">
                        Sistem ini bukan sekadar pangkalan data. Ini adalah upaya kami merawat ingatan kolektif. Setiap
                        naskah yang Anda akses di sini adalah bagian dari sejarah yang kami digitalkan agar tetap
                        beresonansi di meja-meja belajar generasi mendatang, menentang kelapukan waktu dan pelapukan
                        kertas.
                    </p>

                    <div class="grid md:grid-cols-2 gap-0 border-2 border-ink text-left">
                        <div class="p-6 border-b-2 md:border-b-0 md:border-r-2 border-ink bg-ink/5">
                            <h4 class="font-black font-serif text-ink mb-2 uppercase text-lg">I. Visi Utama</h4>
                            <p class="font-mono text-xs text-ink/70 leading-relaxed text-justify">Menjadi jembatan
                                perantara antara mahakarya pengetahuan masa lalu dengan pemikiran inovatif masa depan
                                melalui implementasi teknologi pengarsipan digital.</p>
                        </div>
                        <div class="p-6 bg-[#fcfaf5]">
                            <h4 class="font-black font-serif text-ink mb-2 uppercase text-lg">II. Misi Operasional</h4>
                            <p class="font-mono text-xs text-ink/70 leading-relaxed text-justify">Menyediakan akses
                                sirkulasi dokumen yang terstruktur, presisi, dan merata terhadap seluruh khazanah
                                literatur untuk semua lapisan intelektual masyarakat.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-guest-layout>