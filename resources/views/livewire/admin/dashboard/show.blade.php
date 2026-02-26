<div>
    <section class="mb-8 border-b-2 border-double border-sepia-edge/30 pb-4">
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-4xl font-bold italic text-ink mb-1 font-serif">Dashboard Arsip</h1>
                <p class="text-coffee/70 text-sm font-mono tracking-tight">>> Sistem Manajemen Pustaka Utama</p>
            </div>
            <div class="text-right border border-sepia-edge/30 p-2 bg-white/40 shadow-[2px_2px_0px_#d2b48c]">
                <p class="text-[10px] text-coffee/60 uppercase tracking-widest font-bold mb-1 border-b border-sepia-edge/20 pb-1">Tanggal Perekaman</p>
                <p class="text-sm font-bold text-ink font-mono">{{ now()->translatedFormat('d M Y') }}</p>
            </div>
        </div>
    </section>

    <section class="mb-10">
        <div class="flex items-center gap-2 mb-4">
            <h2 class="text-lg font-bold uppercase tracking-widest text-ink/80 border-b border-ink/80 pb-1">I. Ringkasan Indeks</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
            @php
                $statCards = [
                    ['label' => 'Anggota', 'value' => $totalUsers, 'sub' => 'Aktif', 'icon' => 'users'],
                    ['label' => 'Katalog', 'value' => $totalBooks, 'sub' => 'Judul', 'icon' => 'book-open'],
                    ['label' => 'Dipinjam', 'value' => $activeLoans, 'sub' => 'Sirkulasi', 'icon' => 'check-circle'],
                    ['label' => 'Tertahan', 'value' => $pendingLoans, 'sub' => 'Pending', 'icon' => 'clock'],
                    ['label' => 'Terlambat', 'value' => $overdueLoans, 'sub' => 'Overdue', 'icon' => 'exclamation-triangle', 'alert' => true],
                    ['label' => 'Denda', 'value' => 'Rp ' . number_format($totalPendingFines, 0, ',', '.'), 'sub' => 'Tertunggak', 'icon' => 'banknotes', 'alert' => true],
                ];
            @endphp

            @foreach($statCards as $card)
            <div class="bg-[#fcfaf5] border border-sepia-edge/40 p-3 relative hover:shadow-[3px_3px_0px_#2c2420] transition-shadow duration-200 group">
                <div class="flex justify-between items-start mb-3 border-b border-dashed border-sepia-edge/30 pb-2">
                    <p class="text-[10px] uppercase font-bold tracking-widest text-coffee">{{ $card['label'] }}</p>
                    <x-dynamic-component :component="'heroicon-o-' . $card['icon']" class="w-4 h-4 text-coffee/40 group-hover:text-ink transition-colors" />
                </div>
                <p class="text-2xl font-bold {{ isset($card['alert']) && $card['alert'] && $card['value'] > 0 ? 'text-red-800' : 'text-ink' }} font-serif">
                    {{ $card['value'] }}
                </p>
                <p class="text-[10px] text-coffee/60 uppercase tracking-wider mt-1">{{ $card['sub'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <section class="mb-12">
        <div class="flex items-center gap-2 mb-4">
            <h2 class="text-lg font-bold uppercase tracking-widest text-ink/80 border-b border-ink/80 pb-1">II. Status Fisik Buku</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white/40 border-2 border-ink p-5 relative shadow-[4px_4px_0px_#2c2420]">
                <div class="absolute -top-3 left-4 bg-[#f4ecd8] px-2 text-[10px] font-bold uppercase tracking-widest text-ink border border-ink">
                    Stok Aman
                </div>
                <div class="flex justify-between items-end mt-2">
                    <div>
                        <p class="text-4xl font-bold text-ink font-serif">{{ $totalBooks - $lowStockBooks - $outOfStockBooks }}</p>
                        <p class="text-xs text-coffee font-mono mt-1">> Tersedia di rak</p>
                    </div>
                    <x-heroicon-o-check-circle class="w-8 h-8 text-ink/20" />
                </div>
            </div>

            <div class="bg-[#fcfaf5] border-2 border-dashed border-yellow-800/60 p-5 relative">
                <div class="absolute -top-3 left-4 bg-[#f4ecd8] px-2 text-[10px] font-bold uppercase tracking-widest text-yellow-900 border border-yellow-800/60">
                    Menipis
                </div>
                <div class="flex justify-between items-end mt-2">
                    <div>
                        <p class="text-4xl font-bold text-yellow-900 font-serif">{{ $lowStockBooks }}</p>
                        <p class="text-xs text-yellow-800/70 font-mono mt-1">> Perlu restock</p>
                    </div>
                    <x-heroicon-o-exclamation-circle class="w-8 h-8 text-yellow-800/20" />
                </div>
            </div>

            <div class="bg-red-50/30 border-2 border-double border-red-800 p-5 relative">
                <div class="absolute -top-3 left-4 bg-[#f4ecd8] px-2 text-[10px] font-bold uppercase tracking-widest text-red-900 border border-red-800">
                    Kosong
                </div>
                <div class="flex justify-between items-end mt-2">
                    <div>
                        <p class="text-4xl font-bold text-red-900 font-serif">{{ $outOfStockBooks }}</p>
                        <p class="text-xs text-red-800/70 font-mono mt-1">> Nol sirkulasi</p>
                    </div>
                    <x-heroicon-o-x-circle class="w-8 h-8 text-red-800/20" />
                </div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
        <div class="lg:col-span-2">
            <div class="flex items-center justify-between mb-4 border-b border-sepia-edge/30 pb-2">
                <h2 class="text-lg font-bold italic text-ink font-serif">Permintaan Tertunda ({{ $pendingLoans }})</h2>
                <a href="{{ route('admin.loans.management') }}" class="text-xs uppercase tracking-widest text-coffee hover:text-ink transition-colors group flex items-center gap-1">
                    Buka Laci <x-heroicon-o-arrow-right class="w-3 h-3 group-hover:translate-x-1 transition-transform" />
                </a>
            </div>

            @if ($pendingRequests->count() > 0)
                <div class="space-y-3">
                    @foreach ($pendingRequests as $loan)
                        <div class="bg-[#fcfaf5] border-l-4 border-yellow-800/40 border-y border-r border-sepia-edge/30 p-3 flex items-center justify-between group hover:bg-white transition-colors">
                            <div class="flex items-center gap-4 flex-1">
                                <img src="{{ $loan->book->cover_url }}" alt="{{ $loan->book->title }}" class="w-10 h-14 object-cover border border-sepia-edge/50 grayscale-[30%] sepia-[20%]">
                                <div>
                                    <p class="font-bold text-ink text-sm">{{ $loan->book->title }}</p>
                                    <p class="text-xs text-coffee/80 font-mono mt-0.5">Pemohon: {{ $loan->user->name }} | {{ $loan->booking_date->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.loans.management') }}" class="text-[10px] font-bold uppercase tracking-widest text-ink border-b border-ink/30 hover:border-ink pb-0.5 transition-all">
                                Tinjau
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="border-2 border-dashed border-sepia-edge/30 p-8 text-center bg-white/30">
                    <p class="text-sm italic text-coffee/60 font-serif">Tidak ada tumpukan map permohonan hari ini.</p>
                </div>
            @endif
        </div>

        <div>
            <div class="mb-4 border-b border-sepia-edge/30 pb-2">
                <h2 class="text-lg font-bold italic text-ink font-serif">Katalog Terpopuler</h2>
            </div>

            <div class="space-y-0 border border-sepia-edge/30 bg-[#fcfaf5]">
                @foreach ($popularBooks as $index => $book)
                    <div class="p-3 border-b border-dashed border-sepia-edge/30 last:border-b-0 flex items-start gap-3 hover:bg-white transition-colors">
                        <div class="text-sm font-mono font-bold text-coffee/40 mt-0.5">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}.</div>
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-ink text-sm truncate">{{ $book->title }}</p>
                            <p class="text-[10px] text-coffee/80 uppercase tracking-wider mt-1">{{ $book->author }}</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs font-mono font-bold text-ink">{{ $book->loans_count }}x</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
            <div class="mb-4 border-b border-sepia-edge/30 pb-2">
                <h2 class="text-lg font-bold italic text-ink font-serif">Log Aktivitas Pustaka</h2>
            </div>

            <div class="bg-white/50 border border-sepia-edge/40 p-1 font-mono text-sm">
                @forelse ($recentLoans as $loan)
                    <div class="flex items-start gap-3 p-2 border-b border-sepia-edge/20 last:border-0 hover:bg-[#fcfaf5]">
                        <div class="text-coffee/50 text-xs w-16 shrink-0 pt-0.5">
                            {{ $loan->updated_at->format('H:i') }}
                        </div>
                        <div class="flex-1 text-xs leading-relaxed text-ink/80">
                            <span class="font-bold text-ink">{{ $loan->user->name }}</span>
                            @if ($loan->status === 'pending') meminta 
                            @elseif ($loan->status === 'active') meminjam 
                            @elseif ($loan->status === 'returned') mengembalikan 
                            @else membatalkan 
                            @endif
                            <span class="italic text-coffee">{{ $loan->book->title }}</span>
                        </div>
                        <div class="shrink-0">
                            @php
                                $stampClass = match($loan->status) {
                                    'pending' => 'border-yellow-800 text-yellow-800 rotate-[-2deg]',
                                    'active' => 'border-green-800 text-green-800 rotate-[1deg]',
                                    'returned' => 'border-ink text-ink rotate-[-1deg]',
                                    default => 'border-red-800 text-red-800 rotate-[2deg]'
                                };
                                $stampText = match($loan->status) {
                                    'pending' => 'PENDING',
                                    'active' => 'AKTIF',
                                    'returned' => 'KEMBALI',
                                    default => 'BATAL'
                                };
                            @endphp
                            <span class="inline-block px-1.5 py-0.5 text-[8px] font-bold tracking-widest uppercase border-2 {{ $stampClass }} opacity-80">
                                {{ $stampText }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-xs italic text-coffee/60 text-center py-4">-- Akhir dari log pita --</p>
                @endforelse
            </div>
        </div>

        <div>
            <div class="mb-4 border-b border-sepia-edge/30 pb-2">
                <h2 class="text-lg font-bold italic text-ink font-serif">Peminjam Paling Aktif</h2>
            </div>

            <div class="grid grid-cols-1 gap-3">
                @forelse ($activeMembers as $member)
                    <div class="bg-transparent border border-sepia-edge/40 p-3 flex items-center justify-between border-l-4 border-l-ink hover:pl-4 transition-all duration-300">
                        <div>
                            <p class="font-bold text-ink">{{ $member->name }}</p>
                            <p class="text-[10px] font-mono text-coffee/70">{{ $member->email }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-[10px] text-coffee/60 uppercase tracking-widest font-bold">Total Pinjaman:</p>
                            <p class="text-xl font-bold text-ink font-serif border border-sepia-edge/40 px-2 bg-white/50">{{ $member->loans_count }}</p>
                        </div>
                    </div>
                @empty
                    <div class="border-2 border-dashed border-sepia-edge/30 p-8 text-center bg-white/30">
                        <p class="text-sm italic text-coffee/60 font-serif">Belum ada rekam jejak peminjam.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>