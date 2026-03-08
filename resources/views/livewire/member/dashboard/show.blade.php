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
                        <a href="{{ route('explore') }}" wire:navigate
                            class="flex items-center gap-2 px-6 py-3 bg-ink text-[#fcfaf5] font-bold uppercase tracking-widest text-xs border-2 border-ink hover:bg-[#fcfaf5] hover:text-ink transition-colors shadow-[4px_4px_0px_#2c2420]">
                            <x-heroicon-o-magnifying-glass class="w-4 h-4 stroke-[2]" />
                            Jelajahi Koleksi
                        </a>
                        <a href="{{ route('member.wishlist.index') }}" wire:navigate
                            class="flex items-center gap-2 px-6 py-3 border-2 border-ink text-ink font-bold uppercase tracking-widest text-xs bg-transparent hover:bg-ink/5 transition-colors shadow-[4px_4px_0px_rgba(44,36,32,0.1)]">
                            <x-heroicon-o-bookmark class="w-4 h-4 stroke-[2]" />
                            Daftar Wishlist
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
            <h2 class="text-2xl font-black uppercase tracking-widest text-ink">Statistik Anggota</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <div
                class="bg-white border border-sepia-edge/40 border-t-4 !border-t-ink p-6 shadow-[3px_3px_0px_rgba(44,36,32,0.05)] hover:shadow-[5px_5px_0px_rgba(44,36,32,0.1)] transition-all relative">
                <div class="flex items-center justify-between mb-4 border-b border-dashed border-ink/20 pb-2">
                    <h3 class="text-[10px] uppercase font-bold tracking-widest text-coffee font-mono">Status Anggota
                    </h3>
                    <x-heroicon-o-user-circle class="w-5 h-5 text-ink/60" />
                </div>
                <div class="text-2xl font-black text-ink font-serif">Aktif</div>
                <p class="text-[11px] font-mono text-coffee/70 mt-3 uppercase tracking-wider">Terdaftar
                </p>
            </div>

            <div
                class="bg-white border border-sepia-edge/40 border-t-4 !border-t-yellow-600 p-6 shadow-[3px_3px_0px_rgba(44,36,32,0.05)] hover:shadow-[5px_5px_0px_rgba(44,36,32,0.1)] transition-all">
                <div class="flex items-center justify-between mb-4 border-b border-dashed border-ink/20 pb-2">
                    <h3 class="text-[10px] uppercase font-bold tracking-widest text-coffee font-mono">Koleksi Wishlist
                    </h3>
                    <x-heroicon-o-bookmark class="w-5 h-5 text-yellow-600/60" />
                </div>
                <div class="text-4xl font-black text-ink font-serif">0</div>
                <p class="text-[11px] font-mono text-coffee/70 mt-3 uppercase tracking-wider">Buku Ditandai</p>
            </div>

            <div
                class="bg-white border border-sepia-edge/40 border-t-4 !border-t-ink p-6 shadow-[3px_3px_0px_rgba(44,36,32,0.05)] hover:shadow-[5px_5px_0px_rgba(44,36,32,0.1)] transition-all">
                <div class="flex items-center justify-between mb-4 border-b border-dashed border-ink/20 pb-2">
                    <h3 class="text-[10px] uppercase font-bold tracking-widest text-coffee font-mono">Total Denda</h3>
                    <x-heroicon-o-banknotes class="w-5 h-5 text-ink/60" />
                </div>
                <div class="text-2xl font-black font-mono text-ink tracking-tighter">Rp0</div>
                <p class="text-[11px] font-mono text-coffee/70 mt-3 uppercase tracking-wider">Nihil Kewajiban</p>
            </div>
        </div>
    </section>

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