<div x-data="{
    isModalOpen: false,
    modalTitle: '',
    modalMessage: '',
    modalButtonText: '',
    modalButtonColor: '#2c2622',
    modalAction: null,
    modalLoanId: null,
    openModal(action, loanId, userName, bookTitle) {
        this.modalAction = action;
        this.modalLoanId = loanId;
        const messages = {
            approve: `Setujui peminjaman dari <strong>${userName}</strong>?<br><br>Koleksi: <em>${bookTitle}</em>`,
            reject: `Tolak peminjaman dari <strong>${userName}</strong>?<br><br>Koleksi: <em>${bookTitle}</em>`,
            return: `Konfirmasi pengembalian dari <strong>${userName}</strong>?<br><br>Koleksi: <em>${bookTitle}</em>`
        };
        const titles = {
            approve: 'Setujui Peminjaman',
            reject: 'Tolak Peminjaman',
            return: 'Konfirmasi Pengembalian'
        };
        const colors = {
            approve: '#15803d',
            reject: '#991b1b',
            return: '#1e40af'
        };
        this.modalTitle = titles[action];
        this.modalMessage = messages[action];
        this.modalButtonText = action === 'approve' ? '[✓] Setujui' : action === 'reject' ? '[×] Tolak' : '[✓] Terima Kembali';
        this.modalButtonColor = colors[action];
        this.isModalOpen = true;
    },
    handleModalConfirm() {
        if (this.modalAction === 'approve') {
            this.$wire.approveLoan(this.modalLoanId);
        } else if (this.modalAction === 'reject') {
            this.$wire.rejectLoan(this.modalLoanId);
        } else if (this.modalAction === 'return') {
            this.$wire.returnLoan(this.modalLoanId);
        }
        this.isModalOpen = false;
    }
}" @keydown.escape="isModalOpen = false">
    <div class="space-y-10 text-ink">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between border-b-4 border-ink pb-6 gap-4">
            <div>
                <h2 class="text-4xl font-serif italic font-black uppercase tracking-tight">Manajemen Sirkulasi</h2>
                <div class="flex items-center gap-3 mt-3">
                    <span
                        class="px-3 py-1 bg-ink text-[#fcfaf5] font-mono text-[10px] font-black uppercase tracking-widest">
                        Buku Induk
                    </span>
                    <span class="font-mono text-xs uppercase tracking-[0.2em] text-ink font-bold">
                        Kendali Pustaka
                    </span>
                </div>
            </div>

            {{-- Loading Indicator Alpine --}}
            <div wire:loading
                class="px-4 py-2 border-2 border-ink border-dashed font-mono text-[10px] font-black uppercase text-ink animate-pulse bg-ink/5">
                Sinkronisasi Arsip...
            </div>
        </div>

        {{-- Filter & Search Card --}}
        <div class="bg-white border-2 border-ink p-8 shadow-[8px_8px_0px_#2c2420] relative">
            {{-- Ornamen Sudut (Isolasi Kertas) --}}
            <div class="absolute -top-3 -left-3 w-8 h-3 bg-ink/20 rotate-45"></div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                {{-- Status Filter --}}
                <div>
                    <label class="text-[12px] font-mono uppercase tracking-widest text-ink block mb-4 font-black">
                        Klasifikasi Status Arsip
                    </label>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['pending' => 'Menunggu', 'active' => 'Aktif', 'returned' => 'Selesai', 'cancelled' => 'Ditolak'] as $val => $label)
                                            <button wire:click="$set('filter', '{{ $val }}')"
                                                class="px-5 py-2 text-[10px] font-mono uppercase font-black tracking-widest transition-all border-2 border-ink {{ $filter === $val
                            ? 'bg-ink text-[#fcfaf5] translate-y-[4px] shadow-none'
                            : 'bg-transparent text-ink shadow-[4px_4px_0px_#2c2420] hover:bg-ink/5 active:translate-y-[4px] active:shadow-none' }}">
                                                {{ $label }}
                                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Search --}}
                <div>
                    <label class="text-[12px] font-mono uppercase tracking-widest text-ink block mb-4 font-black">
                        Pencarian Spesifik (Anggota / Judul)
                    </label>
                    <div class="relative">
                        <input wire:model.live.debounce.400ms="search" type="text"
                            placeholder="Ketik kata kunci untuk mencari..."
                            class="w-full bg-transparent border-0 border-b-[3px] border-ink focus:ring-0 focus:outile px-0 py-2 text-2xl font-serif italic text-ink placeholder:text-ink/20 transition-colors">
                        <div class="absolute right-0 bottom-3 text-ink">
                            <svg class="w-6 h-6 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="bg-surface border-2 border-ink overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-background text-xs uppercase tracking-widest border-b-2 border-ink">
                    <tr>
                        <th class="p-4 border-r border-ink">Anggota</th>
                        <th class="p-4 border-r border-ink">Koleksi Buku</th>
                        <th class="p-4 border-r border-ink">Catatan Waktu</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink text-ink">
                    @forelse($this->loans as $loan)
                        <tr class="hover:bg-background transition-colors">
                            <td class="p-4 border-r border-ink">
                                <div class="font-bold font-serif italic text-ink">{{ $loan->user->name }}</div>
                                <div class="text-xs text-muted font-mono mt-1">{{ $loan->user->email }}</div>
                            </td>
                            <td class="p-4 border-r border-ink">
                                <div class="font-bold font-serif italic text-ink">{{ $loan->book->title }}</div>
                                <div class="text-xs text-muted font-mono mt-1">{{ $loan->book->author }}</div>
                            </td>
                            <td class="p-4 font-mono text-xs border-r border-ink">
                                @if($filter === 'pending')
                                    <span class="block font-bold text-ink">Diajukan:</span>
                                    <span class="text-muted">{{ $loan->created_at->format('d/m/Y') }}</span>
                                @elseif($filter === 'active')
                                    <span class="block font-bold text-ink mb-1">Pinjam:
                                        {{ $loan->loan_date?->format('d/m/Y') }}</span>
                                    <span
                                        class="block font-bold {{ $loan->due_date?->isPast() ? 'text-red-700' : 'text-ink' }}">Kembali:
                                        {{ $loan->due_date?->format('d/m/Y') }}</span>
                                @else
                                    <span class="block font-bold text-ink">Diselesaikan:</span>
                                    <span class="text-muted">{{ $loan->return_date?->format('d/m/Y') }}</span>
                                @endif
                            </td>
                            <td class="p-4 text-right space-x-2">
                                @if($filter === 'pending')
                                    <button
                                        @click="openModal('approve', {{ $loan->id }}, '{{ addslashes($loan->user->name) }}', '{{ addslashes($loan->book->title) }}')"
                                        class="text-sm italic text-ink hover:text-green-700 transition">Setujui</button>
                                    <button
                                        @click="openModal('reject', {{ $loan->id }}, '{{ addslashes($loan->user->name) }}', '{{ addslashes($loan->book->title) }}')"
                                        class="text-sm italic text-red-800 hover:text-red-600 transition">Tolak</button>
                                @elseif($filter === 'active')
                                    <button
                                        @click="openModal('return', {{ $loan->id }}, '{{ addslashes($loan->user->name) }}', '{{ addslashes($loan->book->title) }}')"
                                        class="text-sm italic text-ink hover:text-blue-700 transition">Kembalikan</button>
                                @else
                                    <span class="text-xs text-muted italic">Terarsip</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-10 text-center italic text-muted">Belum ada catatan sirkulasi yang
                                terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="pt-6">
            {{ $this->loans->links() }}
        </div>
    </div>

    {{-- Modal Konfirmasi --}}
    <x-ui.confirmation-modal />
</div>