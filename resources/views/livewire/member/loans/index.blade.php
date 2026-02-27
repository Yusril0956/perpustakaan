<div>
    <div class="mb-8 border-b-2 border-ink pb-4">
        <h1 class="text-3xl font-black text-ink uppercase tracking-widest font-serif">
            Laci Arsip Pribadi
        </h1>
        <p class="text-ink/70 font-mono mt-1 text-sm">
            Daftar sirkulasi dokumen yang berada di bawah tanggung jawab Anda.
            <span class="block mt-2 font-bold italic text-ink bg-ink/5 p-2 border-l-2 border-ink inline-block">
                * Pengembalian dokumen hanya dapat dilakukan secara fisik melalui Meja Petugas (Admin).
            </span>
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach($loans as $loan)
        <div class="relative bg-[#fcfaf5] border-2 border-ink p-2 shadow-[8px_8px_0px_rgba(44,36,32,1)] transition-transform hover:-translate-y-1 hover:shadow-[12px_12px_0px_rgba(44,36,32,1)] duration-200">
            <div class="absolute inset-0 opacity-10 bg-[linear-gradient(transparent_95%,_#2c2420_100%)] bg-[length:100%_2rem] pointer-events-none"></div>

            <div class="border border-dashed border-ink/40 p-5 h-full flex flex-col relative z-10 bg-[#fcfaf5]/90">

                <div class="text-right mb-4">
                    <span class="text-[10px] font-mono border-b border-ink/30 pb-1 text-ink/60">
                        No. Reg: #SRK-2026-001
                    </span>
                </div>

                <div class="mb-6 flex-1">
                    <h2 class="text-xl font-bold font-serif leading-tight text-ink mb-2">
                        {{ $loan->book->title }}
                    </h2>
                    <p class="text-sm font-mono text-ink/70">Oleh: {{ $loan->book->author }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 border-y border-ink/20 py-3 mb-4 font-mono text-xs">
                    <div>
                        <span class="block text-ink/50 uppercase text-[9px] mb-1">Tgl. Ditarik</span>
                        <span class="font-bold text-ink">{{ $loan->loan_date }}</span>
                    </div>
                    <div>
                        <span class="block text-ink/50 uppercase text-[9px] mb-1">Tenggat Waktu</span>
                        <span class="font-bold text-ink">{{ $loan->due_date }}</span>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-auto pt-2">
                    <div class="transform -rotate-3">
                        @if ($loan->status === 'Dipinjam')
                        <span class="inline-block border-2 border-blue-700 text-blue-700 text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-sm opacity-80 bg-blue-50/50">
                            [ STATUS: {{ $loan->status }} ]
                        </span>
                        @elseif ($loan->status === 'Dikembalikan')
                        <span class="inline-block border-2 border-green-700 text-green-700 text
                            [10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-sm opacity-80 bg-green-50/50">
                            [ STATUS: {{ $loan->status }} ]
                        </span>
                        @elseif ($loan->status === 'Terlambat')
                        <span class="inline-block border-2 border-red-700 text-red-700 text
                            [10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-sm opacity-80 bg-red-50/50">
                            [ STATUS: {{ $loan->status }} ]
                        </span>
                        @else
                        <span class="inline-block border-2 border-gray-700 text-gray-700 text
                            [10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-sm opacity-80 bg-gray-50/50">
                            [ STATUS: {{ $loan->status }} ]
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>