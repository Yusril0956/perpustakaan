<div x-data="{
        isModalOpen: false,
        isProcessing: false,
        borrowingId: null,
        bookTitle: '',
        isOverdue: false,
        daysOverdue: 0,

        openReturnModal(id, title, overdue, days) {
            this.borrowingId = id;
            this.bookTitle   = title;
            this.isOverdue   = overdue;
            this.daysOverdue = days;
            this.isModalOpen = true;
        },
        async confirm() {
            this.isProcessing = true;
            await this.$wire.returnBook(this.borrowingId);
            this.isModalOpen  = false;
            this.isProcessing = false;
        }
    }" @keydown.escape="if (!isProcessing) isModalOpen = false">

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold italic text-ink">Manajemen Peminjaman</h2>
            <x-ui.button iconLeft="heroicon-o-plus" href="{{ route('admin.borrowings.create') }}" wire:navigate
                size="sm">
                Pinjamkan Buku
            </x-ui.button>
        </div>

        {{-- Flash --}}
        @if (session('success'))
            <div class="p-4 bg-green-50 border-2 border-green-600 text-green-800 font-serif italic flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif
        @if (session('warning'))
            <div
                class="p-4 bg-orange-50 border-2 border-orange-500 text-orange-800 font-serif italic flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
                {{ session('warning') }}
            </div>
        @endif

        {{-- Tabel --}}
        <div class="bg-surface border-2 border-ink overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-background text-xs uppercase tracking-widest border-b-2 border-ink">
                    <tr>
                        <th class="p-4 border-r border-ink">Anggota</th>
                        <th class="p-4 border-r border-ink">Buku</th>
                        <th class="p-4 border-r border-ink">Tgl Pinjam</th>
                        <th class="p-4 border-r border-ink">Jatuh Tempo</th>
                        <th class="p-4 border-r border-ink">Status</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink text-ink">
                    @forelse ($borrowings as $borrowing)
                        @php
                            $dueAt = \Carbon\Carbon::parse($borrowing->due_at);
                            $isOverdue = now()->startOfDay()->greaterThan($dueAt->startOfDay());
                            $daysLate = $isOverdue ? (int) now()->startOfDay()->diffInDays($dueAt->startOfDay()) : 0;
                        @endphp
                        <tr class="hover:bg-background transition-colors" wire:key="borrowing-{{ $borrowing->id }}">

                            <td class="p-4 border-r border-ink">
                                <div class="font-bold font-serif italic">{{ $borrowing->user->name }}</div>
                                <div class="text-xs text-muted">{{ $borrowing->user->email }}</div>
                            </td>

                            <td class="p-4 border-r border-ink">
                                <div class="font-bold font-serif italic">{{ $borrowing->book->title }}</div>
                                <div class="text-xs text-muted">{{ $borrowing->book->author }}</div>
                            </td>

                            <td class="p-4 border-r border-ink text-sm font-mono">
                                {{ \Carbon\Carbon::parse($borrowing->borrowed_at)->translatedFormat('d M Y') }}
                            </td>

                            <td class="p-4 border-r border-ink text-sm font-mono">
                                <span @class(['text-red-700 font-bold' => $isOverdue])>
                                    {{ $dueAt->translatedFormat('d M Y') }}
                                </span>
                                @if ($isOverdue)
                                    <div class="text-xs text-red-600 mt-0.5">{{ $daysLate }} hari lalu</div>
                                @endif
                            </td>

                            <td class="p-4 border-r border-ink">
                                @if ($isOverdue)
                                    <span
                                        class="px-2 py-1 border border-red-800 text-red-800 text-xs font-bold uppercase tracking-widest">
                                        Terlambat
                                    </span>
                                @else
                                    <span
                                        class="px-2 py-1 border border-ink bg-ink text-surface text-xs font-bold uppercase tracking-widest">
                                        Dipinjam
                                    </span>
                                @endif
                            </td>

                            <td class="p-4 text-right">
                                <button @click="openReturnModal(
                                            {{ $borrowing->id }},
                                            '{{ addslashes($borrowing->book->title) }}',
                                            {{ $isOverdue ? 'true' : 'false' }},
                                            {{ $daysLate }}
                                        )"
                                    class="text-xs uppercase tracking-widest font-bold px-2 py-1 border border-transparent hover:border-green-700 hover:bg-green-700 hover:text-white transition-colors text-green-700">
                                    [✓] Kembalikan
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-10 text-center italic text-muted">
                                Tidak ada peminjaman aktif saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $borrowings->links('components.ui.pagination') }}
        </div>
    </div>

    {{-- ── Modal Konfirmasi Pengembalian ─────────────────────────────────── --}}
    <div x-cloak x-show="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center"
        @keydown.escape.window="if (!isProcessing) isModalOpen = false">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/30" @click="if (!isProcessing) isModalOpen = false"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        {{-- Panel --}}
        <div class="relative z-10 bg-white border-2 border-ink max-w-md w-full mx-4" @click.stop
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
            <div class="px-6 py-4 border-b border-ink/20">
                <h3 class="font-serif italic font-bold text-ink text-lg">Konfirmasi Pengembalian</h3>
            </div>

            <div class="px-6 py-6 space-y-3">
                <p class="text-sm text-ink/80 font-serif">
                    Kembalikan buku <strong x-text="bookTitle"></strong>?
                </p>

                {{-- Peringatan denda --}}
                <div x-show="isOverdue"
                    class="p-3 bg-orange-50 border border-orange-400 text-sm text-orange-800 font-serif">
                    <strong>⚠ Terlambat <span x-text="daysOverdue"></span> hari.</strong>
                    Denda sebesar
                    <strong x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(daysOverdue * 1000)"></strong>
                    akan otomatis dicatat.
                </div>

                <div x-show="!isOverdue"
                    class="p-3 bg-green-50 border border-green-400 text-sm text-green-800 font-serif">
                    ✓ Dikembalikan tepat waktu. Tidak ada denda.
                </div>
            </div>

            <div class="px-6 py-4 border-t border-ink/20 flex gap-3 justify-end">
                <button type="button" @click="isModalOpen = false" :disabled="isProcessing"
                    class="px-4 py-2 border border-ink/30 text-ink text-sm font-mono font-bold hover:bg-ink/5 transition disabled:opacity-40 disabled:cursor-not-allowed">
                    Batal
                </button>
                <button type="button" @click="confirm()" :disabled="isProcessing"
                    class="px-4 py-2 border-2 border-green-700 bg-green-700 text-white text-sm font-mono font-bold transition disabled:opacity-50 disabled:cursor-wait flex items-center gap-2">
                    <span x-show="!isProcessing">[✓] Kembalikan</span>
                    <span x-cloak x-show="isProcessing" class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>
            </div>
        </div>
    </div>

</div>