<div x-data="{ confirming: null }">
    <div class="space-y-10 text-ink">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between border-b-4 border-ink pb-6 gap-4">
            <div>
                <h2 class="text-4xl font-serif italic font-black uppercase tracking-tight">Manajemen Sirkulasi</h2>
                <div class="flex items-center gap-3 mt-3">
                    <span
                        class="px-3 py-1 bg-ink text-[#fcfaf5] font-mono text-[10px] font-black uppercase tracking-widest">
                        Buku Induk
                    </span>
                    <span class="font-mono text-xs uppercase tracking-[0.2em] text-ink font-bold">
                        Kendali Pustaka
                    </span>
                </div>
            </div>

            {{-- Loading Indicator Alpine --}}
            <div wire:loading
                class="px-4 py-2 border-2 border-ink border-dashed font-mono text-[10px] font-black uppercase text-ink animate-pulse bg-ink/5">
                Sinkronisasi Arsip...
            </div>
        </div>

        {{-- Filter & Search Card --}}
        <div class="bg-white border-2 border-ink p-8 shadow-[8px_8px_0px_#2c2420] relative">
            {{-- Ornamen Sudut (Isolasi Kertas) --}}
            <div class="absolute -top-3 -left-3 w-8 h-3 bg-ink/20 rotate-45"></div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                {{-- Status Filter --}}
                <div>
                    <label class="text-[12px] font-mono uppercase tracking-widest text-ink block mb-4 font-black">
                        Klasifikasi Status Arsip
                    </label>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['pending' => 'Menunggu', 'active' => 'Aktif', 'returned' => 'Selesai', 'cancelled' => 'Ditolak'] as $val => $label)
                            <button wire:click="$set('filter', '{{ $val }}')" class="px-5 py-2 text-[10px] font-mono uppercase font-black tracking-widest transition-all border-2 border-ink {{ $filter === $val
                            ? 'bg-ink text-[#fcfaf5] translate-y-[4px] shadow-none'
                            : 'bg-transparent text-ink shadow-[4px_4px_0px_#2c2420] hover:bg-ink/5 active:translate-y-[4px] active:shadow-none' }}">
                            {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Search --}}
                <div>
                    <label class="text-[12px] font-mono uppercase tracking-widest text-ink block mb-4 font-black">
                        Pencarian Spesifik (Anggota / Judul)
                    </label>
                    <div class="relative">
                        <input wire:model.live.debounce.400ms="search" type="text"
                            placeholder="Ketik kata kunci untuk mencari..."
                            class="w-full bg-transparent border-0 border-b-[3px] border-ink focus:ring-0 focus:outile px-0 py-2 text-2xl font-serif italic text-ink placeholder:text-ink/20 transition-colors">
                        <div class="absolute right-0 bottom-3 text-ink">
                            <svg class="w-6 h-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table Section (Gaya Ledger/Buku Kas Besar) --}}
        <div class="bg-white border-2 border-ink overflow-hidden shadow-[12px_12px_0px_#2c2420]">
            <table class="w-full text-left border-collapse">
                <thead class="bg-ink text-[#fcfaf5] text-[11px] font-mono uppercase tracking-[0.2em]">
                    <tr>
                        <th class="p-5 border-r border-white/20 cursor-pointer hover:bg-coffee transition-colors w-1/4"
                            wire:click="sort('user_id')">
                            Identitas Anggota @if($sortBy === 'user_id') <span
                            class="text-white">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span> @endif
                        </th>
                        <th class="p-5 border-r border-white/20 cursor-pointer hover:bg-coffee transition-colors w-1/3"
                            wire:click="sort('book_id')">
                            Koleksi Pustaka @if($sortBy === 'book_id') <span
                            class="text-white">{{ $sortDir === 'asc' ? '↑' : '↓' }}</span> @endif
                        </th>
                        <th class="p-5 border-r border-white/20 w-1/5">Catatan Waktu</th>
                        <th class="p-5 text-right">Otorisasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-ink/20 text-ink">
                    @forelse($this->loans as $loan)
                        <tr class="hover:bg-ink/5 transition-colors group">
                            <td class="p-5 border-r-2 border-ink/20 align-top">
                                <div class="font-serif text-xl italic font-black text-ink">{{ $loan->user->name }}</div>
                                <div class="text-[10px] font-mono text-ink/60 mt-1 uppercase font-bold">
                                    {{ $loan->user->email }}
                                </div>
                            </td>
                            <td class="p-5 border-r-2 border-ink/20 align-top">
                                <div class="font-serif text-xl italic text-ink font-bold">{{ $loan->book->title }}</div>
                                <div class="text-[10px] font-mono text-ink/60 mt-1 uppercase tracking-widest font-bold">
                                    {{ $loan->book->author }}
                                </div>
                            </td>
                            <td class="p-5 border-r-2 border-ink/20 font-mono text-[11px] leading-relaxed align-top">
                                @if($filter === 'pending')
                                    <span class="block font-bold">Diajukan:</span>
                                    <span class="block text-ink/70">{{ $loan->created_at->format('d/m/Y') }}</span>
                                @elseif($filter === 'active')
                                    <div class="mb-2">
                                        <span class="block font-bold text-[9px] uppercase tracking-widest">Tgl Pinjam:</span>
                                        <span class="block">{{ $loan->loan_date?->format('d/m/Y') }}</span>
                                    </div>
                                    <div>
                                        <span
                                            class="block font-bold text-[9px] uppercase tracking-widest {{ $loan->due_date?->isPast() ? 'text-red-700' : '' }}">Batas
                                            Kembali:</span>
                                        <span class="block font-black {{ $loan->due_date?->isPast() ? 'text-red-700' : '' }}">
                                            {{ $loan->due_date?->format('d/m/Y') }}
                                        </span>
                                    </div>
                                @else
                                    <span class="block font-bold">Diselesaikan:</span>
                                    <span class="block text-ink/70">{{ $loan->return_date?->format('d/m/Y') }}</span>
                                @endif
                            </td>
                            <td class="p-5 text-right align-top">
                                <div class="flex justify-end gap-3" x-data="{ id: {{ $loan->id }} }">
                                    @if($filter === 'pending')
                                        <button @click="if(confirm('Setujui permohonan peminjaman ini?')) $wire.approveLoan(id)"
                                            class="px-4 py-2 text-[10px] font-mono font-black border-2 border-ink bg-transparent text-ink shadow-[3px_3px_0px_#2c2420] hover:bg-ink hover:text-[#fcfaf5] active:translate-y-[3px] active:shadow-none transition-all">
                                            [✓] SETUJUI
                                        </button>
                                        <button @click="if(confirm('Tolak permohonan ini?')) $wire.rejectLoan(id)"
                                            class="px-4 py-2 text-[10px] font-mono font-black border-2 border-red-800 bg-transparent text-red-800 shadow-[3px_3px_0px_#991b1b] hover:bg-red-800 hover:text-white active:translate-y-[3px] active:shadow-none transition-all">
                                            [×] TOLAK
                                        </button>
                                    @elseif($filter === 'active')
                                        <button
                                            @click="if(confirm('Pastikan fisik buku telah diterima dengan baik. Lanjutkan?')) $wire.returnLoan(id)"
                                            class="px-5 py-3 text-[10px] font-mono font-black border-2 border-ink bg-ink text-[#fcfaf5] shadow-[4px_4px_0px_rgba(0,0,0,0.3)] hover:bg-coffee active:translate-y-[4px] active:shadow-none transition-all">
                                            TERIMA KEMBALI &rarr;
                                        </button>
                                    @else
                                        <span
                                            class="inline-block px-3 py-1 border-2 border-ink/20 text-ink/40 font-mono text-[10px] font-black uppercase tracking-widest transform rotate-2">
                                            Terarsip
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-24 text-center bg-ink/5">
                                <div class="font-serif italic text-3xl text-ink/30 font-black">
                                    ~ Nihil ~
                                </div>
                                <div class="font-mono text-[10px] uppercase tracking-widest text-ink/40 mt-4 font-bold">
                                    Tidak ada catatan sirkulasi pada laci ini.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="pt-6">
            {{ $this->loans->links() }}
        </div>
    </div>
</div>