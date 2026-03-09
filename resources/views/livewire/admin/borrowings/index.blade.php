<div class="space-y-6">

    {{-- Header --}}
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold italic text-ink">Manajemen Peminjaman</h2>
        <x-ui.button iconLeft="heroicon-o-plus" href="{{ route('admin.borrowings.create') }}" wire:navigate size="sm">
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
        <div class="p-4 bg-orange-50 border-2 border-orange-500 text-orange-800 font-serif italic flex items-center gap-2">
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
                            <button
                                onclick="if(confirm('Kembalikan buku {{ addslashes($borrowing->book->title) }}?\n\n{{ $isOverdue ? 'Buku terlambat ' . $daysLate . ' hari. Denda Rp ' . number_format($daysLate * 1000, 0, ',', '.') . ' akan dicatat.' : 'Dikembalikan tepat waktu. Tidak ada denda.' }}')) { Livewire.dispatch('return-book', { borrowingId: {{ $borrowing->id }} }); }"
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