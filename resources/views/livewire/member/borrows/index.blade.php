<div>
    <div class="space-y-6">
        {{-- Header Section --}}
        <section class="mb-8 border-b-2 border-double border-sepia-edge/30 pb-4">
            <div class="flex justify-between items-end">
                <div>
                    <h1 class="text-4xl font-bold italic text-ink mb-1 font-serif">Riwayat Peminjaman</h1>
                    <p class="text-coffee/70 text-sm font-mono tracking-tight">>> Koleksi Buku Saya</p>
                </div>
                <div class="text-right border border-sepia-edge/30 p-2 bg-white/40 shadow-[2px_2px_0px_#d2b48c]">
                    <p
                        class="text-[10px] text-coffee/60 uppercase tracking-widest font-bold mb-1 border-b border-sepia-edge/20 pb-1">
                        Total Pinjaman</p>
                    <p class="text-sm font-bold text-ink font-mono">{{ $borrowings->total() }} Buku</p>
                </div>
            </div>
        </section>

        {{-- Filter Status --}}
        <div class="flex gap-2 flex-wrap">
            <span class="text-xs font-bold uppercase tracking-widest text-coffee/60 py-2">Filter:</span>
            <a href="{{ request()->url() }}"
                class="px-3 py-1 text-xs font-bold uppercase tracking-widest border {{ !$status ? 'bg-ink text-white border-ink' : 'border-sepia-edge/40 text-coffee hover:border-ink' }}">
                Semua
            </a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}"
                class="px-3 py-1 text-xs font-bold uppercase tracking-widest border {{ $status == 'active' ? 'bg-blue-700 text-white border-blue-700' : 'border-sepia-edge/40 text-coffee hover:border-blue-700' }}">
                Aktif
            </a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'returned']) }}"
                class="px-3 py-1 text-xs font-bold uppercase tracking-widest border {{ $status == 'returned' ? 'bg-green-700 text-white border-green-700' : 'border-sepia-edge/40 text-coffee hover:border-green-700' }}">
                Dikembalikan
            </a>
            <a href="{{ request()->fullUrlWithQuery(['status' => 'overdue']) }}"
                class="px-3 py-1 text-xs font-bold uppercase tracking-widest border {{ $status == 'overdue' ? 'bg-red-800 text-white border-red-800' : 'border-sepia-edge/40 text-coffee hover:border-red-800' }}">
                Terlambat
            </a>
        </div>

        {{-- Card Grid Layout --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($borrowings as $borrowing)
                @php
                    $dueAt = \Carbon\Carbon::parse($borrowing->due_at);
                    $isOverdue = now()->startOfDay()->greaterThan($dueAt->startOfDay()) && !$borrowing->returned_at;
                    $daysLate = $isOverdue ? (int) now()->startOfDay()->diffInDays($dueAt->startOfDay()) : 0;
                    $isReturned = $borrowing->status === 'RETURNED' || $borrowing->returned_at;
                @endphp

                <div
                    class="bg-[#fcfaf5] border-2 border-sepia-edge/40 p-0 relative hover:shadow-[6px_6px_0px_#2c2420] transition-all duration-200 group flex flex-col h-full">
                    {{-- Book Cover Area --}}
                    <div
                        class="h-40 bg-gradient-to-br from-ink/5 via-ink/10 to-ink/5 flex items-center justify-center border-b-2 border-dashed border-sepia-edge/30 relative overflow-hidden">
                        <div class="absolute inset-0 opacity-30">
                            <div class="absolute top-2 left-2 w-4 h-4 border-t-2 border-l-2 border-ink/20"></div>
                            <div class="absolute top-2 right-2 w-4 h-4 border-t-2 border-r-2 border-ink/20"></div>
                            <div class="absolute bottom-2 left-2 w-4 h-4 border-b-2 border-l-2 border-ink/20"></div>
                            <div class="absolute bottom-2 right-2 w-4 h-4 border-b-2 border-r-2 border-ink/20"></div>
                        </div>
                        <img src="{{ $borrowing->book->cover_url }}" alt="{{ $borrowing->book->title }}"
                            class="h-32 w-auto object-cover shadow-[4px_4px_0px_rgba(44,36,32,0.15)] relative z-10 group-hover:scale-105 transition-transform duration-300" loading="lazy">
                    </div>

                    {{-- Content --}}
                    <div class="p-4 flex-1 flex flex-col">
                        {{-- Status Badge --}}
                        <div class="mb-3">
                            @if($isReturned)
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-1 border border-green-700 bg-green-700 text-white text-[10px] font-bold uppercase tracking-widest">
                                    <x-heroicon-o-check-circle class="w-3 h-3" /> Dikembalikan
                                </span>
                            @elseif($isOverdue)
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-1 border border-red-800 bg-red-800 text-white text-[10px] font-bold uppercase tracking-widest animate-pulse">
                                    <x-heroicon-o-exclamation-triangle class="w-3 h-3" /> Terlambat
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-1 border border-blue-700 bg-blue-700 text-white text-[10px] font-bold uppercase tracking-widest">
                                    <x-heroicon-o-clock class="w-3 h-3" /> Dipinjam
                                </span>
                            @endif
                        </div>

                        {{-- Title & Author --}}
                        <h3 class="font-bold font-serif italic text-ink text-lg leading-tight mb-1 line-clamp-2 min-h-[3.5rem]"
                            title="{{ $borrowing->book->title }}">
                            {{ $borrowing->book->title }}
                        </h3>
                        <p class="text-xs text-coffee/80 uppercase tracking-wider mb-4">{{ $borrowing->book->author }}</p>

                        {{-- Divider --}}
                        <div class="border-t border-dashed border-sepia-edge/30 mb-3"></div>

                        {{-- Dates - Info Table Style --}}
                        <div class="space-y-2 text-sm font-mono flex-1">
                            <div class="flex justify-between items-center py-1 border-b border-sepia-edge/10">
                                <span class="text-[10px] uppercase tracking-widest text-coffee/50">Dipinjam</span>
                                <span
                                    class="text-ink font-bold text-xs">{{ \Carbon\Carbon::parse($borrowing->borrowed_at)->translatedFormat('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-1 border-b border-sepia-edge/10">
                                <span class="text-[10px] uppercase tracking-widest text-coffee/50">Jatuh Tempo</span>
                                <span class="{{ $isOverdue ? 'text-red-700 font-bold' : 'text-ink font-bold' }} text-xs">
                                    {{ $dueAt->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            @if($isReturned)
                                <div class="flex justify-between items-center py-1">
                                    <span class="text-[10px] uppercase tracking-widest text-coffee/50">Dikembalikan</span>
                                    <span
                                        class="text-green-700 font-bold text-xs">{{ \Carbon\Carbon::parse($borrowing->returned_at)->translatedFormat('d M Y') }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Overdue Alert --}}
                        @if($isOverdue && !$isReturned)
                            <div class="mt-3 p-2 bg-red-50 border border-red-200 flex items-center justify-center gap-2">
                                <x-heroicon-o-exclamation-triangle class="w-4 h-4 text-red-700" />
                                <span class="text-xs text-red-700 font-bold">
                                    ⚠ Terlambat {{ $daysLate }} hari - Denda: Rp
                                    {{ number_format($daysLate * 5000, 0, ',', '.') }}
                                </span>
                            </div>
                        @endif

                        {{-- Days Remaining --}}
                        @if(!$isOverdue && !$isReturned)
                                            @php
                                                $daysRemaining = now()->startOfDay()->diffInDays($dueAt->startOfDay(), false);
                                            @endphp
                             <div
                                                class="mt-3 p-2 bg-[#f4ecd8] border border-sepia-edge/30 flex items-center justify-center gap-2">
                                                <x-heroicon-o-clock class="w-4 h-4 text-coffee" />
                                                <span class="text-xs text-coffee font-bold">
                                                    @if($daysRemaining == 0)
                                                        Jatuh tempo hari ini
                                                    @elseif($daysRemaining == 1)
                                                        1 hari tersisa
                                                    @else
                                                        {{ $daysRemaining }} hari tersisa
                                                    @endif
                                                </span>
                                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-[#fcfaf5] border-2 border-sepia-edge/40 p-12 text-center relative">
                        <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-ink/20"></div>
                        <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-ink/20"></div>
                        <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-ink/20"></div>
                        <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-ink/20"></div>

                        <x-heroicon-o-book-open class="w-16 h-16 text-coffee/30 mx-auto mb-4" />
                        <p class="italic text-coffee text-lg mb-2">Anda belum pernah meminjam buku.</p>
                        <p class="text-coffee/60 text-sm mb-6">Silakan jelajahi koleksi perpustakaan kami</p>
                        <a href="{{ route('explore') }}" wire:navigate
                            class="inline-flex items-center gap-2 px-6 py-3 bg-ink text-white text-xs font-bold uppercase tracking-widest hover:bg-[#2c2420] transition shadow-[4px_4px_0px_rgba(44,36,32,0.2)] hover:shadow-[2px_2px_0px_rgba(44,36,32,0.2)] hover:translate-x-[2px] hover:translate-y-[2px]">
                            <x-heroicon-o-magnifying-glass class="w-4 h-4" />
                            Jelajahi Koleksi
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($borrowings->hasPages())
            <div class="mt-8 flex justify-center border-t border-sepia-edge/30 pt-6">
                {{ $borrowings->links('components.ui.pagination') }}
            </div>
        @endif
    </div>
</div>