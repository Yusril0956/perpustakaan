<div class="font-serif">
    <section class="relative mb-12">
        <div
            class="bg-[#fcfaf5] border-2 border-sepia-edge/50 shadow-[6px_6px_0px_rgba(44,36,32,0.07)] p-2 rounded-sm relative">
            <div class="absolute top-2 left-2 w-3 h-3 border-t-2 border-l-2 border-ink/30"></div>
            <div class="absolute top-2 right-2 w-3 h-3 border-t-2 border-r-2 border-ink/30"></div>
            <div class="absolute bottom-2 left-2 w-3 h-3 border-b-2 border-l-2 border-ink/30"></div>
            <div class="absolute bottom-2 right-2 w-3 h-3 border-b-2 border-r-2 border-ink/30"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8 relative border border-dashed border-sepia-edge/30">
                <div class="flex flex-col justify-center">
                    <div class="flex items-center gap-2 mb-3">
                        <x-heroicon-o-sparkles class="w-6 h-6 text-coffee" />
                        <span
                            class="text-[10px] font-mono uppercase tracking-[0.3em] text-coffee font-bold border-b border-coffee/30">Form.
                            Registrasi Pustaka</span>
                    </div>
                    <h1 class="text-4xl font-black text-ink mb-4 uppercase tracking-wide leading-tight">
                        Selamat Datang,<br>
                        <span class="italic font-serif">{{ $user->name }}</span>
                    </h1>
                    <p class="text-base text-coffee/80 italic leading-relaxed">
                        Silakan kelola koleksi bacaan pribadi Anda dan telusuri arsip digital perpustakaan kami dengan
                        seksama.
                    </p>
                    <div class="mt-8 flex gap-4 flex-wrap">
                        <a href="{{ route('explore') }}"
                            class="flex items-center gap-2 px-6 py-3 bg-ink text-[#fcfaf5] font-bold uppercase tracking-widest text-xs border-2 border-ink hover:bg-[#fcfaf5] hover:text-ink transition-colors shadow-[4px_4px_0px_#2c2420]">
                            <x-heroicon-o-magnifying-glass class="w-4 h-4 stroke-[2]" />
                            Jelajahi Koleksi
                        </a>
                        <a href="{{ route('member.loans.index') }}"
                            class="flex items-center gap-2 px-6 py-3 border-2 border-ink text-ink font-bold uppercase tracking-widest text-xs bg-transparent hover:bg-ink/5 transition-colors shadow-[4px_4px_0px_rgba(44,36,32,0.1)]">
                            <x-heroicon-o-book-open class="w-4 h-4 stroke-[2]" />
                            Sirkulasi Saya
                        </a>
                    </div>
                </div>

                <div class="hidden md:flex items-center justify-center">
                    <div class="relative w-48 h-48 flex items-center justify-center">
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                            class="w-40 h-40 object-cover rounded-full border-4 border-ink/30 shadow-[4px_4px_0px_rgba(44,36,32,0.1)]">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-12">
        <div class="flex items-center gap-3 mb-6 border-b-2 border-double border-sepia-edge/40 pb-2">
            <x-heroicon-o-chart-bar class="w-6 h-6 text-ink stroke-[1.5]" />
            <h2 class="text-2xl font-black uppercase tracking-widest text-ink">Statistik Sirkulasi</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <div
                class="bg-white border border-sepia-edge/40 border-t-4 !border-t-ink p-6 shadow-[3px_3px_0px_rgba(44,36,32,0.05)] hover:shadow-[5px_5px_0px_rgba(44,36,32,0.1)] transition-all relative">
                <div class="flex items-center justify-between mb-4 border-b border-dashed border-ink/20 pb-2">
                    <h3 class="text-[10px] uppercase font-bold tracking-widest text-coffee font-mono">Buku Aktif</h3>
                    <x-heroicon-o-bookmark class="w-5 h-5 text-ink/60" />
                </div>
                <div class="text-4xl font-black text-ink font-serif">{{ $activeLoans->count() }}</div>
                <p class="text-[11px] font-mono text-coffee/70 mt-3 uppercase tracking-wider">Dari
                    {{ $user->loans->where('status', '!=', 'pending')->count() }} Total
                </p>
            </div>

            <div
                class="bg-white border border-sepia-edge/40 border-t-4 !border-t-yellow-600 p-6 shadow-[3px_3px_0px_rgba(44,36,32,0.05)] hover:shadow-[5px_5px_0px_rgba(44,36,32,0.1)] transition-all">
                <div class="flex items-center justify-between mb-4 border-b border-dashed border-ink/20 pb-2">
                    <h3 class="text-[10px] uppercase font-bold tracking-widest text-coffee font-mono">Menunggu</h3>
                    <x-heroicon-o-clock class="w-5 h-5 text-yellow-600/60" />
                </div>
                <div class="text-4xl font-black text-ink font-serif">{{ $pendingLoans->count() }}</div>
                <p class="text-[11px] font-mono text-coffee/70 mt-3 uppercase tracking-wider">Permohonan</p>
            </div>

            <div
                class="bg-white border border-sepia-edge/40 border-t-4 {{ $overdueLoans->count() > 0 ? '!border-t-red-700 bg-red-50/30' : '!border-t-ink' }} p-6 shadow-[3px_3px_0px_rgba(44,36,32,0.05)] hover:shadow-[5px_5px_0px_rgba(44,36,32,0.1)] transition-all">
                <div class="flex items-center justify-between mb-4 border-b border-dashed border-ink/20 pb-2">
                    <h3
                        class="text-[10px] uppercase font-bold tracking-widest {{ $overdueLoans->count() > 0 ? 'text-red-800' : 'text-coffee' }} font-mono">
                        Terlambat</h3>
                    <x-heroicon-o-exclamation-triangle
                        class="w-5 h-5 {{ $overdueLoans->count() > 0 ? 'text-red-700/80' : 'text-ink/60' }}" />
                </div>
                <div
                    class="text-4xl font-black font-serif {{ $overdueLoans->count() > 0 ? 'text-red-800' : 'text-ink' }}">
                    {{ $overdueLoans->count() }}
                </div>
                <p
                    class="text-[11px] font-mono {{ $overdueLoans->count() > 0 ? 'text-red-800/80 font-bold' : 'text-coffee/70' }} mt-3 uppercase tracking-wider">
                    {{ $overdueLoans->count() > 0 ? 'Sanksi Menanti!' : 'Catatan Bersih' }}
                </p>
            </div>

            <div
                class="bg-white border border-sepia-edge/40 border-t-4 {{ $totalFines > 0 ? '!border-t-red-700 bg-red-50/30' : '!border-t-ink' }} p-6 shadow-[3px_3px_0px_rgba(44,36,32,0.05)] hover:shadow-[5px_5px_0px_rgba(44,36,32,0.1)] transition-all">
                <div class="flex items-center justify-between mb-4 border-b border-dashed border-ink/20 pb-2">
                    <h3 class="text-[10px] uppercase font-bold tracking-widest text-coffee font-mono">Kewajiban Denda
                    </h3>
                    <x-heroicon-o-banknotes class="w-5 h-5 {{ $totalFines > 0 ? 'text-red-700/80' : 'text-ink/60' }}" />
                </div>
                <div
                    class="text-2xl font-black font-mono {{ $totalFines > 0 ? 'text-red-800' : 'text-ink' }} tracking-tighter">
                    Rp{{ number_format($totalFines, 0, ',', '.') }}
                </div>
                <p
                    class="text-[11px] font-mono {{ $totalFines > 0 ? 'text-red-800/80 font-bold' : 'text-coffee/70' }} mt-3 uppercase tracking-wider">
                    {{ $totalFines > 0 ? 'Segera Lunasi' : 'Nihil Kewajiban' }}
                </p>
            </div>
        </div>
    </section>

    @if ($activeLoans->count() > 0)
        <section class="mb-14 border-t-4 border-double border-sepia-edge/30 pt-8 relative">
            <div class="flex items-end justify-between mb-6">
                <div>
                    <span
                        class="text-[10px] font-mono uppercase tracking-widest text-coffee/80 bg-[#fcfaf5] px-2 relative top-2 ml-4">Dokumen
                        Tersirkulasi</span>
                    <h2 class="text-2xl font-black uppercase tracking-widest text-ink mt-1 flex items-center gap-3">
                        <x-heroicon-o-document-text class="w-6 h-6" /> Buku Dalam Peminjaman
                    </h2>
                </div>
                <a href="{{ route('member.loans.index') }}"
                    class="text-[11px] font-mono uppercase tracking-widest text-ink border-b border-ink hover:text-coffee transition-colors pb-0.5 font-bold">
                    Buka Laci Arsip →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($activeLoans->take(3) as $loan)
                    <div class="bg-[#fcfaf5] border-2 border-ink p-1 shadow-[5px_5px_0px_rgba(44,36,32,0.15)] group relative">
                        <div class="absolute top-0 right-4 w-6 h-full border-x border-ink/10 bg-white/50 z-0"></div>

                        <div class="bg-white border border-sepia-edge/30 h-full p-4 relative z-10">
                            <div class="flex gap-4">
                                <div class="w-24 shrink-0 border border-ink/20 bg-gray-50 p-1 shadow-sm">
                                    <div class="aspect-[3/4] overflow-hidden">
                                        <img src="{{ $loan->book->cover_url }}" alt="{{ $loan->book->title }}"
                                            class="w-full h-full object-cover sepia-[0.3] contrast-125 grayscale-[0.2]">
                                    </div>
                                </div>

                                <div class="flex-1 flex flex-col">
                                    <div class="mb-auto">
                                        <h3 class="font-bold text-ink text-base leading-snug line-clamp-2">
                                            {{ $loan->book->title }}
                                        </h3>
                                        <p
                                            class="text-[11px] font-mono text-coffee/80 mt-1 pb-2 border-b border-dashed border-sepia-edge/50">
                                            Oleh: {{ $loan->book->author }}</p>
                                    </div>

                                    <div class="mt-4 bg-[#f9f7f1] border border-ink/10 p-2 flex items-center justify-between">
                                        <div>
                                            <div class="text-[9px] uppercase font-mono tracking-widest text-coffee/70 mb-0.5">
                                                Batas Pengembalian</div>
                                            <div class="text-xs font-black font-mono text-ink">
                                                {{ $loan->due_date->format('d M Y') }}
                                            </div>
                                        </div>

                                        @php
                                            $daysLeft = now()->diffInDays($loan->due_date, false);
                                        @endphp

                                        <div class="text-right">
                                            @if ($daysLeft < 0)
                                                <div
                                                    class="flex items-center gap-1 text-[10px] font-mono font-bold text-red-800 uppercase bg-red-100 px-1.5 py-0.5 border border-red-800/30">
                                                    <x-heroicon-s-x-circle class="w-3 h-3" /> {{ abs($daysLeft) }}H Lewat
                                                </div>
                                            @elseif($daysLeft <= 3)
                                                <div
                                                    class="flex items-center gap-1 text-[10px] font-mono font-bold text-yellow-800 uppercase bg-yellow-100 px-1.5 py-0.5 border border-yellow-800/30">
                                                    <x-heroicon-s-exclamation-triangle class="w-3 h-3" /> {{ $daysLeft }} Hari Lagi
                                                </div>
                                            @else
                                                <div
                                                    class="flex items-center gap-1 text-[10px] font-mono font-bold text-ink uppercase">
                                                    <x-heroicon-o-clock class="w-3 h-3" /> {{ $daysLeft }} Hari Sisa
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($activeLoans->count() > 3)
                <div class="mt-8 text-center">
                    <a href="{{ route('member.loans.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-2 border-2 border-ink text-ink font-bold font-mono uppercase tracking-widest text-xs hover:bg-ink hover:text-white transition shadow-[3px_3px_0px_rgba(44,36,32,0.1)]">
                        <x-heroicon-o-archive-box class="w-4 h-4 stroke-[2]" /> Buka {{ $activeLoans->count() - 3 }} Dokumen
                        Lainnya
                    </a>
                </div>
            @endif
        </section>
    @else
        <section
            class="mb-14 border-2 border-dashed border-sepia-edge/50 bg-[#f9f7f1] rounded-sm p-10 text-center relative overflow-hidden">
            <x-heroicon-o-inbox class="w-16 h-16 mx-auto text-coffee/20 mb-4 stroke-1 relative z-10" />
            <h3 class="text-xl font-black uppercase tracking-widest text-ink mb-2 relative z-10">Laci Peminjaman Kosong</h3>
            <p class="text-coffee/70 font-mono text-xs uppercase tracking-wider mb-6 relative z-10">Tidak ada dokumen yang
                sedang Anda pinjam saat ini.</p>
            <a href="{{ route('explore') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-ink text-[#fcfaf5] font-bold uppercase tracking-widest text-xs border-2 border-ink hover:bg-[#fcfaf5] hover:text-ink transition-colors shadow-[4px_4px_0px_#2c2420] relative z-10">
                <x-heroicon-o-magnifying-glass class="w-4 h-4 stroke-[2]" /> Telusuri Katalog Utama
            </a>
            <div class="absolute inset-0 z-0 opacity-10 flex flex-col justify-between pt-10 pointer-events-none">
                <div class="h-px bg-ink w-full"></div>
                <div class="h-px bg-ink w-full"></div>
                <div class="h-px bg-ink w-full"></div>
                <div class="h-px bg-ink w-full"></div>
            </div>
        </section>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        @if ($pendingLoans->count() > 0)
            <section class="border border-sepia-edge/40 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-5 border-b border-dashed border-ink/20 pb-3">
                    <x-heroicon-o-clock class="w-5 h-5 text-ink stroke-[1.5]" />
                    <h2 class="text-lg font-black uppercase tracking-widest text-ink">Menunggu Persetujuan</h2>
                </div>

                <div class="space-y-4">
                    @foreach ($pendingLoans as $loan)
                        <div class="flex items-center gap-4 bg-[#f9f7f1] p-3 border-l-4 border-yellow-700">
                            <div class="w-10 shrink-0 aspect-[3/4] border border-ink/20 overflow-hidden">
                                <img src="{{ $loan->book->cover_url }}" alt="{{ $loan->book->title }}"
                                    class="w-full h-full object-cover grayscale">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-ink text-sm line-clamp-1">{{ $loan->book->title }}</h3>
                                <p class="text-[10px] font-mono text-coffee/60 uppercase mt-0.5">
                                    Dimohon Tgl: {{ $loan->booking_date->format('d/m/Y') }}
                                </p>
                            </div>
                            <div
                                class="border-2 border-yellow-700 text-yellow-800 text-[9px] font-black uppercase tracking-widest px-2 py-1 transform -rotate-3 opacity-80">
                                Pending
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($returnedLoans->count() > 0)
            <section class="border border-sepia-edge/40 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-5 border-b border-dashed border-ink/20 pb-3">
                    <x-heroicon-o-archive-box-arrow-down class="w-5 h-5 text-ink stroke-[1.5]" />
                    <h2 class="text-lg font-black uppercase tracking-widest text-ink">Riwayat Pengembalian</h2>
                </div>

                <div class="space-y-4">
                    @foreach ($returnedLoans as $loan)
                        <div
                            class="flex items-center gap-4 bg-gray-50/50 p-3 border-l-4 border-ink/40 opacity-70 hover:opacity-100 transition-opacity">
                            <div class="w-10 shrink-0 aspect-[3/4] border border-ink/20 overflow-hidden">
                                <img src="{{ $loan->book->cover_url }}" alt="{{ $loan->book->title }}"
                                    class="w-full h-full object-cover grayscale opacity-80">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-ink text-sm line-clamp-1">{{ $loan->book->title }}</h3>
                                <p class="text-[10px] font-mono text-coffee/60 uppercase mt-0.5">
                                    Dikembalikan: {{ $loan->return_date?->format('d/m/Y') ?? '-' }}
                                </p>
                            </div>
                            <div
                                class="border-2 border-ink/60 text-ink/80 text-[9px] font-black uppercase tracking-widest px-2 py-1 transform rotate-2">
                                Tuntas
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($user->loans->where('status', 'returned')->count() > 5)
                    <div class="mt-5 text-center pt-3 border-t border-ink/10">
                        <a href="{{ route('member.loans.index') }}"
                            class="text-[11px] font-mono font-bold uppercase tracking-widest text-ink border-b border-ink hover:text-coffee transition-colors">
                            Buka Arsip Lengkap →
                        </a>
                    </div>
                @endif
            </section>
        @endif
    </div>

    <section class="border-4 border-double border-sepia-edge/40 bg-[#fcfaf5] p-8 shadow-sm">
        <div class="flex items-center gap-3 mb-8 pb-3 border-b-2 border-ink">
            <x-heroicon-o-information-circle class="w-7 h-7 text-ink stroke-[1.5]" />
            <h2 class="text-2xl font-black uppercase tracking-widest text-ink">Maklumat Pustaka</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 relative">
            <div class="hidden md:block absolute top-0 bottom-0 left-[33%] w-px bg-ink/10"></div>
            <div class="hidden md:block absolute top-0 bottom-0 left-[66%] w-px bg-ink/10"></div>

            <div class="space-y-3">
                <div class="flex items-center gap-2 mb-2">
                    <span class="bg-ink text-white font-mono text-xs px-2 py-0.5 font-bold">Pasal 1</span>
                </div>
                <h3 class="font-bold text-ink uppercase tracking-wide text-sm">Ketentuan Durasi</h3>
                <p class="text-[13px] text-coffee/80 leading-relaxed font-serif">Setiap dokumen atau buku diizinkan
                    untuk disirkulasikan selama maksimal <span class="font-black text-ink underline">7 hari
                        kalender</span> terhitung sejak stempel persetujuan diberikan.</p>
            </div>

            <div class="space-y-3">
                <div class="flex items-center gap-2 mb-2">
                    <span class="bg-ink text-white font-mono text-xs px-2 py-0.5 font-bold">Pasal 2</span>
                </div>
                <h3 class="font-bold text-ink uppercase tracking-wide text-sm">Sanksi Keterlambatan</h3>
                <p class="text-[13px] text-coffee/80 leading-relaxed font-serif">Keterlambatan pengembalian arsip akan
                    dikenakan sanksi denda administratif sebesar <span
                        class="font-black text-red-800 font-mono">Rp5.000</span> untuk setiap hari keterlambatan.</p>
            </div>

            <div class="space-y-3">
                <div class="flex items-center gap-2 mb-2">
                    <span class="bg-ink text-white font-mono text-xs px-2 py-0.5 font-bold">Pasal 3</span>
                </div>
                <h3 class="font-bold text-ink uppercase tracking-wide text-sm">Perawatan Fisik</h3>
                <p class="text-[13px] text-coffee/80 leading-relaxed font-serif">Anggota diwajibkan menjaga keutuhan
                    lembar dan sampul arsip. Kerusakan pada dokumen sirkulasi menjadi tanggung jawab peminjam
                    sepenuhnya.</p>
            </div>
        </div>
    </section>
</div>