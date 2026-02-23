<div class="space-y-4">
    <!-- Header -->
    <div class="flex items-center gap-3 mb-6">
        <x-heroicon-o-book-open class="w-5 h-5 text-accent" />
        <h2 class="text-2xl font-semibold text-ink">Rak Buku Saya</h2>
        <span class="ml-auto text-sm text-muted">{{ count($loans) }} buku dipinjam</span>
    </div>

    @forelse ($loans as $loan)
        <div class="paper-card p-4 hover:shadow-md transition-shadow duration-200" style="border-left: 3px solid #6F4E37;">
            <div class="grid grid-cols-12 gap-4">
                <!-- Book Cover -->
                <div class="col-span-3 sm:col-span-2">
                    <div class="relative rounded overflow-hidden" style="aspect-ratio: 3/4; background: linear-gradient(135deg, #F6F2EA 0%, #FBF8F3 100%);">
                        <img 
                            src="{{ $loan->book->cover_url }}" 
                            alt="{{ $loan->book->title }}"
                            class="w-full h-full object-cover"
                            style="filter: sepia(0.1) brightness(1.02);"
                        >
                        <!-- Gloss Effect -->
                        <div class="absolute inset-0 bg-linear-to-br from-white/10 to-transparent pointer-events-none"></div>
                    </div>
                </div>

                <!-- Book & Loan Info -->
                <div class="col-span-9 sm:col-span-10 flex flex-col justify-between">
                    <!-- Title & Author -->
                    <div class="space-y-1">
                        <h3 class="font-semibold text-ink line-clamp-2">{{ $loan->book->title }}</h3>
                        @if ($loan->book->category)
                            <p class="text-sm text-muted">{{ $loan->book->category->name }}</p>
                        @endif
                    </div>

                    <!-- Loan Details Card (Slip Peminjaman) -->
                    <div class="mt-3 p-3 rounded" style="background: linear-gradient(135deg, #FBF8F3 0%, #F9F5F0 100%); border: 1px dashed #8B7D73;">
                        <div class="grid grid-cols-2 gap-3 text-xs">
                            <!-- Loan Date -->
                            <div>
                                <p class="text-muted uppercase tracking-wide">Dipinjam</p>
                                <p class="font-semibold text-ink">{{ $loan->loan_date->format('d M Y') }}</p>
                            </div>

                            <!-- Due Date -->
                            <div>
                                <p class="text-muted uppercase tracking-wide">Batas Kembali</p>
                                <p class="font-semibold" :class="{
                                    'text-red-600': Carbon\Carbon::now()->greaterThan($loan->due_date),
                                    'text-accent': Carbon\Carbon::now()->lessThanOrEqualTo($loan->due_date)
                                }">
                                    {{ $loan->due_date->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        <!-- Days Remaining -->
                        <div class="mt-2 pt-2 border-t border-muted/30 flex items-center justify-between">
                            @php
                                $daysRemaining = now()->diffInDays($loan->due_date, false);
                                $isOverdue = $daysRemaining < 0;
                            @endphp

                            @if ($isOverdue)
                                <span class="text-xs font-semibold text-red-600">⚠️ Terlambat {{ abs($daysRemaining) }} hari</span>
                            @else
                                <span class="text-xs text-muted">{{ $daysRemaining }} hari tersisa</span>
                            @endif

                            <div class="flex items-center gap-1 text-muted">
                                <x-heroicon-o-calendar class="w-3 h-3" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <!-- Empty State -->
        <div class="paper-card p-12 text-center" style="background: linear-gradient(135deg, rgba(111, 78, 55, 0.03) 0%, rgba(139, 125, 115, 0.03) 100%);">
            <x-heroicon-o-book-open class="w-12 h-12 text-muted/40 mx-auto mb-3" />
            <p class="text-muted mb-2">Belum ada buku yang dipinjam</p>
            <p class="text-sm text-muted/70">Jelajahi koleksi perpustakaan kami untuk menemukan buku favoritmu!</p>
        </div>
    @endforelse
</div>
