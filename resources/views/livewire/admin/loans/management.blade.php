<div>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold italic text-ink">Manajemen Peminjaman</h2>
        </div>

        <!-- Filter & Search -->
        <div class="paper-card p-4 space-y-4">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex gap-2 flex-wrap">
                    @foreach(['pending' => 'Menunggu', 'active' => 'Aktif', 'returned' => 'Dikembalikan', 'cancelled' => 'Ditolak'] as $value => $label)
                        <button wire:click="$set('filter', '{{ $value }}')"
                            class="px-4 py-2 text-xs uppercase font-bold tracking-wider {{ $filter === $value ? 'bg-coffee text-parchment-light shadow-[2px_2px_0px_#d2b48c]' : 'border border-sepia-edge/40 text-ink hover:bg-sepia-edge/10' }} rounded-sm transition">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>
            <input wire:model.live.debounce="300ms" type="text" placeholder="Cari nama anggota atau judul buku..."
                class="form-input text-lg italic w-full">
        </div>

        <!-- Table -->
        <div class="bg-surface shadow-sm border overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-background text-xs uppercase tracking-widest text-muted border-b">
                    <tr>
                        <th class="p-4">Anggota</th>
                        <th class="p-4">Judul Buku</th>
                        <th class="p-4">Tanggal</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($loans as $loan)
                                        <tr class="hover:bg-surface/50 transition">
                                            <td class="p-4">
                                                <div class="font-bold text-ink italic">{{ $loan->user->name }}</div>
                                                <div class="text-xs text-muted">{{ $loan->user->email }}</div>
                                            </td>
                                            <td class="p-4">
                                                <div class="font-bold text-ink italic">{{ $loan->book->title }}</div>
                                                <div class="text-xs text-muted">{{ $loan->book->author }}</div>
                                            </td>
                                            <td class="p-4 text-xs font-mono">
                                                @if($filter === 'pending')
                                                    <div>{{ $loan->booking_date->format('d M Y') }}</div>
                                                @elseif($filter === 'active')
                                                    <div>Diberikan: {{ $loan->loan_date?->format('d M Y') ?? '-' }}</div>
                                                    <div>Kembali: {{ $loan->due_date?->format('d M Y') ?? '-' }}</div>
                                                @elseif($filter === 'returned')
                                                    <div>Dikembalikan: {{ $loan->return_date?->format('d M Y') ?? '-' }}</div>
                                                @else
                                                    <div>{{ $loan->booking_date->format('d M Y') }}</div>
                                                @endif
                                            </td>
                                            <td class="p-4">
                                                <span
                                                    class="inline-block px-3 py-1 text-[10px] uppercase font-bold tracking-wider rounded-sm
                                                                                                {{ $loan->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                                                                {{ $loan->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                                                                                                {{ $loan->status === 'returned' ? 'bg-blue-100 text-blue-800' : '' }}
                                                                                                {{ $loan->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                                    {{ match ($loan->status) {
                            'pending' => 'Menunggu',
                            'active' => 'Aktif',
                            'returned' => 'Dikembalikan',
                            'cancelled' => 'Ditolak',
                            default => $loan->status
                        } }}
                                                </span>
                                            </td>
                                            <td class="p-4 text-right space-x-2">
                                                @if($filter === 'pending')
                                                    <button wire:click="approveLoan({{ $loan->id }})"
                                                        class="text-sm italic text-green-700 hover:text-green-900 font-bold">Setujui</button>
                                                    <button wire:click="rejectLoan({{ $loan->id }})"
                                                        class="text-sm italic text-red-700 hover:text-red-900 font-bold">Tolak</button>
                                                @elseif($filter === 'active')
                                                    <button wire:click="returnLoan({{ $loan->id }})"
                                                        class="text-sm italic text-blue-700 hover:text-blue-900 font-bold">Terima
                                                        Kembali</button>
                                                @endif
                                            </td>
                                        </tr>
                    @empty
                                        <tr>
                                            <td colspan="5" class="p-10 text-center italic text-muted">
                                                Tidak ada data peminjaman {{ match ($filter) {
                            'pending' => 'menunggu',
                            'active' => 'aktif',
                            'returned' => 'yang dikembalikan',
                            'cancelled' => 'yang ditolak',
                            default => ''
                        } }}.
                                            </td>
                                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $loans->links('vendor.pagination.vintage') }}
        </div>
    </div>
</div>