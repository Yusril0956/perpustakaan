<div>
    <!-- Header -->
    <section class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold italic text-ink mb-2">Dashboard Admin</h1>
                <p class="text-coffee/60 text-sm">Kelola sistem perpustakaan dengan data real-time</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-muted uppercase tracking-widest">Hari ini</p>
                <p class="text-lg font-bold text-ink">{{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
        </div>
    </section>

    <!-- Key Statistics Grid (6 cols) -->
    <section class="mb-12">
        <div class="flex items-center gap-2 mb-6">
            <x-heroicon-o-chart-pie class="w-6 h-6 text-coffee" />
            <h2 class="text-xl font-bold italic text-ink">Statistik Utama</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
            <!-- Total Users -->
            <div
                class="bg-blue-50/40 border-l-4 border-blue-500 p-4 rounded-sm shadow-sm hover:shadow-[2px_2px_0px_#d2b48c] transition">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-[10px] uppercase font-bold tracking-widest text-coffee/60">Anggota</p>
                    <x-heroicon-o-users class="w-5 h-5 text-blue-500/60" />
                </div>
                <p class="text-2xl font-bold text-ink">{{ $totalUsers }}</p>
                <p class="text-xs text-coffee/50 mt-1">total member aktif</p>
            </div>

            <!-- Total Books -->
            <div
                class="bg-purple-50/40 border-l-4 border-purple-500 p-4 rounded-sm shadow-sm hover:shadow-[2px_2px_0px_#d2b48c] transition">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-[10px] uppercase font-bold tracking-widest text-coffee/60">Buku</p>
                    <x-heroicon-o-book-open class="w-5 h-5 text-purple-500/60" />
                </div>
                <p class="text-2xl font-bold text-ink">{{ $totalBooks }}</p>
                <p class="text-xs text-coffee/50 mt-1">dalam katalog</p>
            </div>

            <!-- Active Loans -->
            <div
                class="bg-green-50/40 border-l-4 border-green-600 p-4 rounded-sm shadow-sm hover:shadow-[2px_2px_0px_#d2b48c] transition">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-[10px] uppercase font-bold tracking-widest text-coffee/60">Aktif</p>
                    <x-heroicon-o-check-circle class="w-5 h-5 text-green-600/60" />
                </div>
                <p class="text-2xl font-bold text-ink">{{ $activeLoans }}</p>
                <p class="text-xs text-coffee/50 mt-1">peminjaman aktif</p>
            </div>

            <!-- Pending Loans -->
            <div
                class="bg-yellow-50/40 border-l-4 border-yellow-600 p-4 rounded-sm shadow-sm hover:shadow-[2px_2px_0px_#d2b48c] transition">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-[10px] uppercase font-bold tracking-widest text-coffee/60">Pending</p>
                    <x-heroicon-o-clock class="w-5 h-5 text-yellow-600/60" />
                </div>
                <p class="text-2xl font-bold text-ink">{{ $pendingLoans }}</p>
                <p class="text-xs text-coffee/50 mt-1">menunggu persetujuan</p>
            </div>

            <!-- Overdue Loans -->
            <div
                class="bg-red-50/40 border-l-4 border-red-600 p-4 rounded-sm shadow-sm hover:shadow-[2px_2px_0px_#d2b48c] transition">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-[10px] uppercase font-bold tracking-widest text-coffee/60">Terlamabat</p>
                    <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-red-600/60" />
                </div>
                <p class="text-2xl font-bold text-red-700">{{ $overdueLoans }}</p>
                <p class="text-xs text-coffee/50 mt-1">butuh follow-up</p>
            </div>

            <!-- Total Pending Fines -->
            <div
                class="bg-orange-50/40 border-l-4 border-orange-600 p-4 rounded-sm shadow-sm hover:shadow-[2px_2px_0px_#d2b48c] transition">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-[10px] uppercase font-bold tracking-widest text-coffee/60">Denda</p>
                    <x-heroicon-o-banknotes class="w-5 h-5 text-orange-600/60" />
                </div>
                <p class="text-xl font-bold text-orange-700 font-mono">Rp
                    {{ number_format($totalPendingFines, 0, ',', '.') }}</p>
                <p class="text-xs text-coffee/50 mt-1">outstanding</p>
            </div>
        </div>
    </section>

    <!-- Inventory Status -->
    <section class="mb-12">
        <div class="flex items-center gap-2 mb-6">
            <x-heroicon-o-cube class="w-6 h-6 text-coffee" />
            <h2 class="text-xl font-bold italic text-ink">Status Inventori</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Stok Normal -->
            <div class="bg-gradient-to-br from-green-50 to-green-50/50 border border-green-200 p-6 rounded-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <x-heroicon-o-check-circle class="w-6 h-6 text-green-600" />
                    </div>
                    <h3 class="font-bold text-ink text-lg">Stok Normal</h3>
                </div>
                <p class="text-3xl font-bold text-green-700">{{ $totalBooks - $lowStockBooks - $outOfStockBooks }}</p>
                <p class="text-xs text-green-600 mt-2">Buku tersedia cukup</p>
            </div>

            <!-- Low Stock -->
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-50/50 border border-yellow-200 p-6 rounded-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <x-heroicon-o-exclamation-circle class="w-6 h-6 text-yellow-600" />
                    </div>
                    <h3 class="font-bold text-ink text-lg">Stok Terbatas</h3>
                </div>
                <p class="text-3xl font-bold text-yellow-700">{{ $lowStockBooks }}</p>
                <p class="text-xs text-yellow-600 mt-2">Perlu pemesanan</p>
            </div>

            <!-- Out of Stock -->
            <div class="bg-gradient-to-br from-red-50 to-red-50/50 border border-red-200 p-6 rounded-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <x-heroicon-o-x-circle class="w-6 h-6 text-red-600" />
                    </div>
                    <h3 class="font-bold text-ink text-lg">Habis</h3>
                </div>
                <p class="text-3xl font-bold text-red-700">{{ $outOfStockBooks }}</p>
                <p class="text-xs text-red-600 mt-2">Tidak tersedia</p>
            </div>
        </div>
    </section>

    <!-- Main Content Grid: Left (Pending & Recent) + Right (Popular & Members) -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
        <!-- LEFT: Pending Requests -->
        <div class="lg:col-span-2">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-clock class="w-6 h-6 text-coffee" />
                    <h2 class="text-xl font-bold italic text-ink">Permintaan Menunggu ({{ $pendingLoans }})</h2>
                </div>
                <a href="{{ route('admin.loans.management') }}"
                    class="text-sm italic text-coffee hover:text-ink underline">Lihat semua →</a>
            </div>

            @if ($pendingRequests->count() > 0)
                <div class="space-y-3">
                    @foreach ($pendingRequests as $loan)
                        <div
                            class="bg-yellow-50/40 border border-yellow-200/50 p-4 rounded-sm hover:shadow-[2px_2px_0px_#d2b48c] transition flex items-center justify-between">
                            <div class="flex items-center gap-4 flex-1">
                                <img src="{{ $loan->book->cover_url }}" alt="{{ $loan->book->title }}"
                                    class="w-10 h-16 object-cover rounded-sm shadow-sm">
                                <div class="flex-1">
                                    <p class="font-bold text-ink italic text-sm">{{ $loan->book->title }}</p>
                                    <p class="text-xs text-coffee/60">{{ $loan->user->name }} •
                                        {{ $loan->booking_date->diffForHumans() }}</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.loans.management') }}"
                                class="px-3 py-1 bg-coffee text-parchment-light text-xs font-bold uppercase rounded-sm hover:bg-coffee/90 transition">
                                Review
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-blue-50/30 border border-dashed border-blue-200 p-6 text-center rounded-sm">
                    <x-heroicon-o-check-circle class="w-8 h-8 mx-auto text-blue-400/50 mb-2" />
                    <p class="text-sm italic text-coffee/60">Tidak ada permintaan menunggu</p>
                </div>
            @endif
        </div>

        <!-- RIGHT: Popular Books -->
        <div>
            <div class="flex items-center gap-2 mb-6">
                <x-heroicon-o-star class="w-6 h-6 text-coffee" />
                <h2 class="text-xl font-bold italic text-ink">Buku Paling Populer</h2>
            </div>

            <div class="space-y-3">
                @foreach ($popularBooks as $index => $book)
                    <div class="bg-white/50 border border-sepia-edge/20 p-3 rounded-sm">
                        <div class="flex items-start gap-3">
                            <div class="text-lg font-bold text-coffee/40 min-w-max">{{ $index + 1 }}.</div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-ink italic text-sm truncate">{{ $book->title }}</p>
                                <p class="text-xs text-coffee/60 line-clamp-2">{{ $book->author }}</p>
                                <p class="text-xs text-green-600 font-semibold mt-1">{{ $book->loans_count }} dipinjam</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Recent Activities Section -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Loans -->
        <div>
            <div class="flex items-center gap-2 mb-6">
                <x-heroicon-o-document-text class="w-6 h-6 text-coffee" />
                <h2 class="text-xl font-bold italic text-ink">Aktivitas Terbaru</h2>
            </div>

            <div class="space-y-2">
                @forelse ($recentLoans as $loan)
                                <div
                                    class="bg-white/40 border-l-2 {{ $loan->status === 'pending' ? 'border-yellow-500' : ($loan->status === 'active' ? 'border-green-500' : 'border-blue-500') }} p-3 rounded-sm text-sm">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <p class="font-semibold text-ink italic">
                                                @if ($loan->status === 'pending')
                                                    {{ $loan->user->name }}
                                                    <span class="text-coffee/60">meminta</span> {{ $loan->book->title }}
                                                @elseif ($loan->status === 'active')
                                                    {{ $loan->user->name }}
                                                    <span class="text-coffee/60">meminjam</span> {{ $loan->book->title }}
                                                @elseif ($loan->status === 'returned')
                                                    {{ $loan->user->name }}
                                                    <span class="text-coffee/60">kembalikan</span> {{ $loan->book->title }}
                                                @else
                                                    {{ $loan->user->name }}
                                                    <span class="text-coffee/60">batalkan</span> {{ $loan->book->title }}
                                                @endif
                                            </p>
                                            <p class="text-xs text-muted mt-1">{{ $loan->updated_at->diffForHumans() }}</p>
                                        </div>
                                        <span
                                            class="px-2 py-1 text-[10px] font-bold uppercase rounded-sm {{ $loan->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($loan->status === 'active' ? 'bg-green-100 text-green-800' : ($loan->status === 'returned' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                                            {{ match ($loan->status) {
                        'pending' => 'Pending',
                        'active' => 'Aktif',
                        'returned' => 'Kembali',
                        'cancelled' => 'Batal',
                        default => $loan->status
                    } }}
                                        </span>
                                    </div>
                                </div>
                @empty
                    <p class="text-sm italic text-coffee/60 text-center py-8">Tidak ada aktivitas</p>
                @endforelse
            </div>
        </div>

        <!-- Most Active Members -->
        <div>
            <div class="flex items-center gap-2 mb-6">
                <x-heroicon-o-users class="w-6 h-6 text-coffee" />
                <h2 class="text-xl font-bold italic text-ink">Anggota Paling Aktif</h2>
            </div>

            <div class="space-y-3">
                @forelse ($activeMembers as $member)
                    <div
                        class="bg-white/50 border border-sepia-edge/20 p-4 rounded-sm flex items-center justify-between hover:shadow-[2px_2px_0px_#d2b48c] transition">
                        <div>
                            <p class="font-bold text-ink italic">{{ $member->name }}</p>
                            <p class="text-xs text-coffee/60">{{ $member->email }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-green-600">{{ $member->loans_count }}</p>
                            <p class="text-[10px] text-coffee/50 uppercase font-bold">aktif</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm italic text-coffee/60 text-center py-8">Tidak ada member aktif</p>
                @endforelse
            </div>
        </div>
    </section>
</div>