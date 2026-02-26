<div>
    <!-- Header with Greeting -->
    <section class="relative mb-12">
        <div class="bg-gradient-to-r from-coffee/5 to-coffee/10 border border-sepia-edge/20 rounded-sm overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8 relative">
                <!-- Left side: Greeting -->
                <div class="flex flex-col justify-center">
                    <h1 class="text-4xl font-bold italic text-ink mb-2">
                        Selamat Datang, {{ $user->name }}! 👋
                    </h1>
                    <p class="text-lg text-coffee/70 italic">
                        Kelola koleksi pribadi Anda dan jelajahi arsip digital perpustakaan kami.
                    </p>
                    <div class="mt-6 flex gap-3 flex-wrap">
                        <a href="{{ route('explore') }}"
                            class="px-6 py-3 bg-coffee text-parchment-light font-bold uppercase tracking-wider text-sm rounded-sm hover:bg-coffee/90 transition shadow-[3px_3px_0px_#d2b48c]">
                            🔍 Jelajahi Koleksi
                        </a>
                        <a href="{{ route('member.loans.index') }}"
                            class="px-6 py-3 border-2 border-coffee text-coffee font-bold uppercase tracking-wider text-sm rounded-sm hover:bg-coffee hover:text-parchment-light transition">
                            📚 Pinjaman Saya
                        </a>
                    </div>
                </div>

                <!-- Right side: Decorative -->
                <div class="hidden md:flex items-center justify-center">
                    <div class="relative">
                        <div class="absolute inset-0 bg-coffee/10 blur-2xl rounded-full"></div>
                        <x-heroicon-o-book-open class="w-40 h-40 text-coffee/20 relative" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Grid -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold italic text-ink mb-6">📊 Statistik Peminjaman</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Active Loans -->
            <div
                class="group relative bg-white/40 backdrop-blur-sm border-l-4 border-green-600 p-6 shadow-sm hover:shadow-[4px_4px_0px_#d2b48c] transition-all rounded-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm uppercase font-bold tracking-widest text-coffee/60">Buku Aktif</h3>
                    <x-heroicon-o-book-open class="w-6 h-6 text-green-600/60" />
                </div>
                <div class="text-3xl font-bold text-ink italic">{{ $activeLoans->count() }}</div>
                <p class="text-xs text-coffee/50 mt-2">dari
                    {{ $user->loans->where('status', '!=', 'pending')->count() }}
                    total</p>
            </div>

            <!-- Pending Requests -->
            <div
                class="group relative bg-white/40 backdrop-blur-sm border-l-4 border-yellow-600 p-6 shadow-sm hover:shadow-[4px_4px_0px_#d2b48c] transition-all rounded-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm uppercase font-bold tracking-widest text-coffee/60">Menunggu</h3>
                    <x-heroicon-o-clock class="w-6 h-6 text-yellow-600/60" />
                </div>
                <div class="text-3xl font-bold text-ink italic">{{ $pendingLoans->count() }}</div>
                <p class="text-xs text-coffee/50 mt-2">permintaan pending</p>
            </div>

            <!-- Overdue Books -->
            <div
                class="group relative bg-white/40 backdrop-blur-sm border-l-4 {{ $overdueLoans->count() > 0 ? 'border-red-600' : 'border-blue-600' }} p-6 shadow-sm hover:shadow-[4px_4px_0px_#d2b48c] transition-all rounded-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm uppercase font-bold tracking-widest text-coffee/60">Terlamabat</h3>
                    <x-heroicon-o-exclamation-triangle
                        class="w-6 h-6 {{ $overdueLoans->count() > 0 ? 'text-red-600/60' : 'text-blue-600/60' }}" />
                </div>
                <div
                    class="text-3xl font-bold {{ $overdueLoans->count() > 0 ? 'text-red-700' : 'text-blue-700' }} italic">
                    {{ $overdueLoans->count() }}
                </div>
                <p class="text-xs text-coffee/50 mt-2">
                    {{ $overdueLoans->count() > 0 ? 'segera kembalikan!' : 'tidak ada' }}</p>
            </div>

            <!-- Total Fines -->
            <div
                class="group relative bg-white/40 backdrop-blur-sm border-l-4 {{ $totalFines > 0 ? 'border-red-600' : 'border-green-600' }} p-6 shadow-sm hover:shadow-[4px_4px_0px_#d2b48c] transition-all rounded-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm uppercase font-bold tracking-widest text-coffee/60">Total Denda</h3>
                    <x-heroicon-o-banknotes
                        class="w-6 h-6 {{ $totalFines > 0 ? 'text-red-600/60' : 'text-green-600/60' }}" />
                </div>
                <div class="text-2xl font-bold {{ $totalFines > 0 ? 'text-red-700' : 'text-ink' }} italic font-mono">
                    Rp {{ number_format($totalFines, 0, ',', '.') }}
                </div>
                <p class="text-xs text-coffee/50 mt-2">{{ $totalFines > 0 ? 'bayar sekarang' : 'aman' }}</p>
            </div>
        </div>
    </section>

    <!-- Active Loans Section -->
    @if ($activeLoans->count() > 0)
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold italic text-ink">📖 Buku yang Sedang Dipinjam</h2>
                <a href="{{ route('member.loans.index') }}"
                    class="text-sm italic text-coffee hover:text-ink underline">Lihat Semua →</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($activeLoans->take(3) as $loan)
                    <div
                        class="bg-white/50 border border-sepia-edge/30 rounded-sm overflow-hidden hover:shadow-[4px_4px_0px_#d2b48c] transition-all">
                        <!-- Book Cover -->
                        <div class="relative aspect-[3/4] overflow-hidden bg-white p-2">
                            <img src="{{ $loan->book->cover_url }}" alt="{{ $loan->book->title }}"
                                class="w-full h-full object-cover sepia-[0.1]">
                        </div>

                        <!-- Book Info -->
                        <div class="p-4 space-y-3">
                            <div>
                                <h3 class="font-bold text-ink italic line-clamp-2">{{ $loan->book->title }}</h3>
                                <p class="text-xs text-coffee/60 italic">{{ $loan->book->author }}</p>
                            </div>

                            <!-- Due Date -->
                            <div class="space-y-1">
                                <div
                                    class="text-[10px] uppercase font-bold tracking-widest {{ now()->greaterThan($loan->due_date) ? 'text-red-700' : 'text-green-700' }}">
                                    {{ now()->greaterThan($loan->due_date) ? '⚠️ Terlamabat' : '✓ Tepat Waktu' }}
                                </div>
                                <div class="text-sm font-mono">
                                    <div class="text-muted text-[10px]">Kembali sebelum:</div>
                                    <div class="font-bold text-ink">{{ $loan->due_date->format('d M Y') }}</div>
                                </div>
                            </div>

                            <!-- Days Left -->
                            @php
                                $daysLeft = now()->diffInDays($loan->due_date, false);
                            @endphp
                            <div class="bg-parchment-light/50 p-2 rounded-sm">
                                <div class="text-center font-bold {{ $daysLeft < 0 ? 'text-red-700' : 'text-coffee' }}">
                                    @if ($daysLeft < 0)
                                        {{ abs($daysLeft) }} hari terlamabat
                                    @elseif($daysLeft <= 3)
                                        ⏰ {{ $daysLeft }} hari lagi
                                    @else
                                        {{ $daysLeft }} hari tersisa
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($activeLoans->count() > 3)
                <div class="mt-6 text-center">
                    <a href="{{ route('member.loans.index') }}"
                        class="inline-block px-6 py-2 border-2 border-coffee text-coffee font-bold uppercase tracking-wider text-sm rounded-sm hover:bg-coffee hover:text-parchment-light transition">
                        Lihat {{ $activeLoans->count() - 3 }} Buku Lainnya
                    </a>
                </div>
            @endif
        </section>
    @else
        <section class="mb-12 bg-blue-50/30 border-2 border-dashed border-blue-200 rounded-sm p-8 text-center">
            <x-heroicon-o-book-open class="w-16 h-16 mx-auto text-blue-400/50 mb-4" />
            <h3 class="text-lg font-bold italic text-ink mb-2">Belum Ada Pinjaman Aktif</h3>
            <p class="text-coffee/60 mb-6">Mulai jelajahi koleksi pustaka dan pinjam buku favorit Anda.</p>
            <a href="{{ route('explore') }}"
                class="inline-block px-6 py-2 bg-coffee text-parchment-light font-bold uppercase tracking-wider text-sm rounded-sm hover:bg-coffee/90 transition shadow-[3px_3px_0px_#d2b48c]">
                🔍 Jelajahi Sekarang
            </a>
        </section>
    @endif

    <!-- Pending Requests Section -->
    @if ($pendingLoans->count() > 0)
        <section class="mb-12">
            <h2 class="text-2xl font-bold italic text-ink mb-6">⏳ Permintaan Menunggu Persetujuan</h2>

            <div class="space-y-3">
                @foreach ($pendingLoans as $loan)
                    <div class="bg-yellow-50/50 border-l-4 border-yellow-500 p-4 flex items-center justify-between rounded-sm">
                        <div class="flex items-center gap-4 flex-1">
                            <img src="{{ $loan->book->cover_url }}" alt="{{ $loan->book->title }}"
                                class="w-12 h-16 object-cover rounded-sm shadow-sm">
                            <div class="flex-1">
                                <h3 class="font-bold text-ink italic">{{ $loan->book->title }}</h3>
                                <p class="text-xs text-coffee/60">
                                    Diminta pada: {{ $loan->booking_date->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span
                                class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 text-[10px] font-bold uppercase rounded-sm">
                                Menunggu
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <!-- Recent Returns Section -->
    @if ($returnedLoans->count() > 0)
        <section class="mb-12">
            <h2 class="text-2xl font-bold italic text-ink mb-6">✅ Riwayat Pengembalian</h2>

            <div class="space-y-3">
                @foreach ($returnedLoans as $loan)
                    <div class="bg-blue-50/50 border-l-4 border-blue-500 p-4 flex items-center justify-between rounded-sm">
                        <div class="flex items-center gap-4 flex-1">
                            <img src="{{ $loan->book->cover_url }}" alt="{{ $loan->book->title }}"
                                class="w-12 h-16 object-cover rounded-sm shadow-sm">
                            <div class="flex-1">
                                <h3 class="font-bold text-ink italic">{{ $loan->book->title }}</h3>
                                <p class="text-xs text-coffee/60">
                                    Dikembalikan: {{ $loan->return_date?->format('d M Y') ?? '-' }}
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span
                                class="inline-block px-3 py-1 bg-green-100 text-green-800 text-[10px] font-bold uppercase rounded-sm">
                                Dikembalikan
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($user->loans->where('status', 'returned')->count() > 5)
                <div class="mt-6 text-center">
                    <a href="{{ route('member.loans.index') }}" class="text-sm italic text-coffee hover:text-ink underline">
                        Lihat semua riwayat pengembalian →
                    </a>
                </div>
            @endif
        </section>
    @endif

    <!-- Tips Section -->
    <section class="bg-gradient-to-r from-coffee/5 to-coffee/10 border border-sepia-edge/20 rounded-sm p-8">
        <h2 class="text-2xl font-bold italic text-ink mb-6">💡 Tips & Informasi</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-calendar class="w-5 h-5 text-coffee" />
                    <h3 class="font-bold text-ink italic">Durasi Peminjaman</h3>
                </div>
                <p class="text-sm text-coffee/70">Setiap buku dapat dipinjam selama 7 hari dari tanggal persetujuan.</p>
            </div>

            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-banknotes class="w-5 h-5 text-coffee" />
                    <h3 class="font-bold text-ink italic">Denda Keterlambatan</h3>
                </div>
                <p class="text-sm text-coffee/70">Denda Rp 5.000 per hari jika pengembalian melebihi jatuh tempo.</p>
            </div>

            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-document-check class="w-5 h-5 text-coffee" />
                    <h3 class="font-bold text-ink italic">Perawatan Buku</h3>
                </div>
                <p class="text-sm text-coffee/70">Jaga kondisi buku tetap prima dan hindari kerusakan saat membaca.</p>
            </div>
        </div>
    </section>
</div>