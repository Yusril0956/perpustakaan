<div>
    <div class="space-y-8 text-ink">
        <div class="border-b-2 border-ink pb-4">
            <h2 class="text-3xl font-bold italic font-serif">Manajemen Peminjaman</h2>
            <p class="text-xs uppercase tracking-widest text-muted mt-1">Buku Induk Sirkulasi Pustaka</p>
        </div>

        <div class="bg-surface p-6 border border-ink shadow-sm relative">
            <div class="absolute top-0 left-0 w-2 h-full bg-ink"></div>

            <div class="mb-6">
                <label class="text-xs uppercase tracking-widest text-muted block mb-3 font-bold">Kategori Status Arsip</label>
                <div class="flex flex-wrap gap-3">
                    @foreach(['pending' => 'Menunggu', 'active' => 'Aktif', 'returned' => 'Dikembalikan', 'cancelled' => 'Ditolak'] as $value => $label)
                    <button wire:click="$set('filter', '{{ $value }}')"
                        class="px-4 py-2 text-xs uppercase font-bold tracking-widest transition-all duration-200 
                            {{ $filter === $value 
                                ? 'bg-coffee text-parchment-light shadow-[4px_4px_0px_#2c2420] border border-[#2c2420] -translate-y-0.5' 
                                : 'border border-ink text-ink hover:bg-ink hover:text-surface' }}">
                        {{ $label }}
                    </button>
                    @endforeach
                </div>
            </div>

            <div class="pt-4 border-t border-ink/20 border-dashed">
                <label class="text-xs uppercase tracking-widest text-muted block mb-2 font-bold">Pencarian Sirkulasi</label>
                <input wire:model.live.debounce="300ms" type="text" placeholder="Ketik nama anggota atau judul pustaka..."
                    class="w-full bg-transparent border-0 border-b-2 border-ink border-dashed focus:border-solid focus:ring-0 px-0 py-2 text-xl font-serif italic placeholder:text-muted/50 text-ink">
            </div>
        </div>

        <div class="bg-surface border-2 border-ink overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-background text-xs uppercase tracking-widest border-b-2 border-ink">
                    <tr>
                        <th class="p-4 border-r border-ink/20">Identitas Anggota</th>
                        <th class="p-4 border-r border-ink/20">Judul Pustaka</th>
                        <th class="p-4 border-r border-ink/20">Keterangan Waktu</th>
                        <th class="p-4 border-r border-ink/20">Status</th>
                        <th class="p-4 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink/20 text-ink">
                    @forelse($loans as $loan)
                    <tr class="hover:bg-background transition-colors group">
                        <td class="p-4 border-r border-ink/20 align-top">
                            <div class="font-bold font-serif text-lg italic">{{ $loan->user->name }}</div>
                            <div class="text-xs font-mono text-muted mt-1">{{ $loan->user->email }}</div>
                        </td>
                        <td class="p-4 border-r border-ink/20 align-top">
                            <div class="font-bold font-serif italic">{{ $loan->book->title }}</div>
                            <div class="text-xs uppercase tracking-wider text-muted mt-1">{{ $loan->book->author }}</div>
                        </td>
                        <td class="p-4 text-xs font-mono border-r border-ink/20 leading-relaxed align-top whitespace-nowrap">
                            @if($filter === 'pending')
                            <div>Diajukan: {{ $loan->booking_date->format('d M Y') }}</div>
                            @elseif($filter === 'active')
                            <div>Diberikan: {{ $loan->loan_date?->format('d M Y') ?? '-' }}</div>
                            <div class="{{ $loan->due_date?->isPast() ? 'text-red-800 font-bold' : '' }}">
                                Batas: {{ $loan->due_date?->format('d M Y') ?? '-' }}
                            </div>
                            @elseif($filter === 'returned')
                            <div>Dikembalikan: {{ $loan->return_date?->format('d M Y') ?? '-' }}</div>
                            @else
                            <div>Tercatat: {{ $loan->booking_date->format('d M Y') }}</div>
                            @endif
                        </td>
                        <td class="p-4 border-r border-ink/20 align-top">
                            <span class="inline-block px-2 py-1 text-xs font-bold uppercase tracking-widest border
                                    {{ $loan->status === 'pending' ? 'border-ink border-dashed text-ink' : '' }}
                                    {{ $loan->status === 'active' ? 'bg-ink border-ink text-surface' : '' }}
                                    {{ $loan->status === 'returned' ? 'bg-background border-ink text-muted' : '' }}
                                    {{ $loan->status === 'cancelled' ? 'border-2 border-red-800 text-red-800' : '' }}">
                                {{ match ($loan->status) {
                                        'pending' => 'Menunggu',
                                        'active' => 'Aktif',
                                        'returned' => 'Selesai',
                                        'cancelled' => 'Ditolak',
                                        default => $loan->status
                                    } }}
                            </span>
                        </td>
                        <td class="p-4 text-right space-x-2 whitespace-nowrap align-top">
                            @if($filter === 'pending')
                            <button wire:click="approveLoan({{ $loan->id }})"
                                class="inline-block text-xs uppercase tracking-widest font-bold px-2 py-1 border border-transparent hover:border-ink hover:bg-ink hover:text-surface transition-colors">
                                [✓ Setujui]
                            </button>
                            <button wire:click="rejectLoan({{ $loan->id }})"
                                class="inline-block text-xs uppercase tracking-widest font-bold px-2 py-1 text-red-800 border border-transparent hover:border-red-800 hover:bg-red-800 hover:text-surface transition-colors">
                                [× Tolak]
                            </button>
                            @elseif($filter === 'active')
                            <button wire:click="returnLoan({{ $loan->id }})"
                                class="inline-block text-xs uppercase tracking-widest font-bold px-2 py-1 border border-transparent hover:border-ink hover:bg-ink hover:text-surface transition-colors">
                                [↵ Terima Kembali]
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center border-dashed border-ink/30 bg-background/50">
                            <p class="font-serif italic text-muted text-lg">
                                Tidak ada data peminjaman {{ match ($filter) {
                                        'pending' => 'menunggu',
                                        'active' => 'aktif',
                                        'returned' => 'yang dikembalikan',
                                        'cancelled' => 'yang ditolak',
                                        default => ''
                                    } }} dalam arsip saat ini.
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-4 border-t-2 border-ink border-dotted">
            {{ $loans->links('vendor.pagination.vintage') }}
        </div>
    </div>
</div>