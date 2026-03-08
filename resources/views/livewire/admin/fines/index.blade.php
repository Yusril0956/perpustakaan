<div
    x-data="{
        isModalOpen: false,
        isProcessing: false,
        fineId: null,
        userName: '',
        bookTitle: '',
        amount: 0,

        formatRp(n) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(n);
        },
        openPaidModal(id, name, title, amt) {
            this.fineId    = id;
            this.userName  = name;
            this.bookTitle = title;
            this.amount    = amt;
            this.isModalOpen = true;
        },
        async confirm() {
            this.isProcessing = true;
            await this.$wire.markAsPaid(this.fineId);
            this.isModalOpen  = false;
            this.isProcessing = false;
        }
    }"
    @keydown.escape="if (!isProcessing) isModalOpen = false"
>
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-2 border-ink pb-4 gap-4">
            <div>
                <h2 class="text-3xl font-bold italic font-serif">Manajemen Denda</h2>
                <p class="text-xs uppercase tracking-widest text-muted mt-1">Riwayat & Pelunasan Denda Perpustakaan</p>
            </div>
        </div>

        {{-- Flash --}}
        @if (session('success'))
            <div class="p-4 bg-green-50 border-2 border-green-600 text-green-800 font-serif italic flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Stat Cards --}}
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-surface border-2 border-ink p-5">
                <p class="text-xs uppercase tracking-widest text-muted mb-2">Belum Lunas</p>
                <p class="text-3xl font-bold font-mono text-red-700">{{ $stats['total_unpaid'] }}</p>
            </div>
            <div class="bg-surface border-2 border-ink p-5">
                <p class="text-xs uppercase tracking-widest text-muted mb-2">Lunas</p>
                <p class="text-3xl font-bold font-mono text-green-700">{{ $stats['total_paid'] }}</p>
            </div>
            <div class="bg-surface border-2 border-ink p-5">
                <p class="text-xs uppercase tracking-widest text-muted mb-2">Total Pemasukan</p>
                <p class="text-2xl font-bold font-mono text-ink">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- Filter Tab --}}
        <div class="flex gap-2 flex-wrap">
            @foreach (['' => 'Semua', 'UNPAID' => 'Belum Lunas', 'PAID' => 'Lunas'] as $val => $label)
                <button
                    wire:click="$set('filterStatus', '{{ $val }}')"
                    @class([
                        'text-xs uppercase tracking-widest font-bold px-3 py-1.5 border-2 transition-colors',
                        'border-ink bg-ink text-surface'   => $filterStatus === $val,
                        'border-ink/30 text-muted hover:border-ink hover:text-ink' => $filterStatus !== $val,
                    ])
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- Tabel Denda --}}
        <div class="bg-surface border-2 border-ink overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-background text-xs uppercase tracking-widest border-b-2 border-ink">
                    <tr>
                        <th class="p-4 border-r border-ink">Anggota</th>
                        <th class="p-4 border-r border-ink">Buku</th>
                        <th class="p-4 border-r border-ink">Jatuh Tempo</th>
                        <th class="p-4 border-r border-ink">Tgl Kembali</th>
                        <th class="p-4 border-r border-ink">Jumlah Denda</th>
                        <th class="p-4 border-r border-ink">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink">
                    @forelse ($fines as $fine)
                        <tr class="hover:bg-background transition-colors" wire:key="fine-{{ $fine->id }}">

                            <td class="p-4 border-r border-ink">
                                <div class="font-bold font-serif italic">{{ $fine->borrowing->user->name }}</div>
                                <div class="text-xs text-muted">{{ $fine->borrowing->user->email }}</div>
                            </td>

                            <td class="p-4 border-r border-ink">
                                <div class="font-bold font-serif italic">{{ $fine->borrowing->book->title }}</div>
                            </td>

                            <td class="p-4 border-r border-ink text-sm font-mono">
                                {{ \Carbon\Carbon::parse($fine->borrowing->due_at)->translatedFormat('d M Y') }}
                            </td>

                            <td class="p-4 border-r border-ink text-sm font-mono">
                                {{ $fine->borrowing->returned_at
                                    ? \Carbon\Carbon::parse($fine->borrowing->returned_at)->translatedFormat('d M Y')
                                    : '—' }}
                            </td>

                            <td class="p-4 border-r border-ink font-mono font-bold">
                                Rp {{ number_format($fine->amount, 0, ',', '.') }}
                            </td>

                            <td class="p-4 border-r border-ink">
                                @if ($fine->status === 'PAID')
                                    <span class="px-2 py-1 border border-green-700 bg-green-700 text-white text-xs font-bold uppercase tracking-widest">
                                        Lunas
                                    </span>
                                    @if ($fine->paid_at)
                                        <div class="text-xs text-muted mt-1 font-mono">
                                            {{ \Carbon\Carbon::parse($fine->paid_at)->translatedFormat('d M Y') }}
                                        </div>
                                    @endif
                                @else
                                    <span class="px-2 py-1 border border-red-700 text-red-700 text-xs font-bold uppercase tracking-widest">
                                        Belum Lunas
                                    </span>
                                @endif
                            </td>

                            <td class="p-4 text-center">
                                @if ($fine->status === 'UNPAID')
                                    <button
                                        @click="openPaidModal(
                                            {{ $fine->id }},
                                            '{{ addslashes($fine->borrowing->user->name) }}',
                                            '{{ addslashes($fine->borrowing->book->title) }}',
                                            {{ $fine->amount }}
                                        )"
                                        class="text-xs uppercase tracking-widest font-bold px-2 py-1 border border-green-700 text-green-700 hover:bg-green-700 hover:text-white transition-colors"
                                    >
                                        [✓] Tuntaskan
                                    </button>
                                @else
                                    <span class="text-xs text-muted italic">tuntas</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-10 text-center italic text-muted">
                                @if ($filterStatus)
                                    Tidak ada denda dengan status ini.
                                @else
                                    Belum ada catatan denda.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-4 border-t-2 border-ink border-dotted">
            {{ $fines->links('components.ui.pagination') }}
        </div>

    </div>

    {{-- ── Modal Konfirmasi Tuntaskan ────────────────────────────────────── --}}
    <div
        x-cloak
        x-show="isModalOpen"
        class="fixed inset-0 z-50 flex items-center justify-center"
    >
        <div
            class="absolute inset-0 bg-black/30"
            @click="if (!isProcessing) isModalOpen = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        ></div>

        <div
            class="relative z-10 bg-white border-2 border-ink max-w-md w-full mx-4"
            @click.stop
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
        >
            <div class="px-6 py-4 border-b border-ink/20">
                <h3 class="font-serif italic font-bold text-ink text-lg">Konfirmasi Pelunasan</h3>
            </div>

            <div class="px-6 py-6 space-y-3 text-sm font-serif text-ink/80">
                <p>Tandai denda berikut sebagai <strong class="text-green-700">LUNAS</strong>?</p>
                <div class="bg-gray-50 border border-ink/10 p-4 space-y-1.5 font-mono text-sm">
                    <div class="flex justify-between">
                        <span class="text-muted">Anggota</span>
                        <strong x-text="userName" class="text-right max-w-[60%] truncate"></strong>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-muted">Buku</span>
                        <strong x-text="bookTitle" class="text-right max-w-[60%] truncate"></strong>
                    </div>
                    <div class="flex justify-between border-t border-ink/10 pt-1.5 mt-1.5">
                        <span class="text-muted">Total Denda</span>
                        <strong x-text="formatRp(amount)"></strong>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-ink/20 flex gap-3 justify-end">
                <button
                    type="button"
                    @click="isModalOpen = false"
                    :disabled="isProcessing"
                    class="px-4 py-2 border border-ink/30 text-ink text-sm font-mono font-bold hover:bg-ink/5 transition disabled:opacity-40 disabled:cursor-not-allowed"
                >
                    Batal
                </button>
                <button
                    type="button"
                    @click="confirm()"
                    :disabled="isProcessing"
                    class="px-4 py-2 border-2 border-green-700 bg-green-700 text-white text-sm font-mono font-bold transition disabled:opacity-50 disabled:cursor-wait flex items-center gap-2"
                >
                    <span x-show="!isProcessing">[✓] Tandai Lunas</span>
                    <span x-cloak x-show="isProcessing" class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>