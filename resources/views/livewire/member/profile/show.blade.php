<div>
    <div class="space-y-10 text-ink">

        {{-- Header --}}
        <div class="border-b-2 border-ink pb-4">
            <h2 class="text-3xl font-bold italic font-serif">Profil Peminjam</h2>
            <p class="text-xs uppercase tracking-widest text-muted mt-1">Kartu Informasi & Riwayat</p>
        </div>

        {{-- Profile Card --}}
        <div class="paper-card p-6 md:p-8 border border-ink shadow-sm bg-surface relative">
            <div class="flex flex-col md:flex-row gap-8">

                {{-- FOTO (UPLOAD + DELETE ONLY) --}}
                <div class="flex flex-col items-center flex-shrink-0">

                    <label class="relative group cursor-pointer">

                        <img src="{{ $user->profile_photo_url }}"
                            class="w-32 h-40 object-cover border-2 border-ink transition-all duration-300">

                        <input type="file" wire:model="photo" class="hidden" accept="image/*">

                        {{-- Hover Upload Overlay --}}
                        <div class="absolute inset-0 bg-ink/80 flex flex-col items-center justify-center
                            opacity-0 group-hover:opacity-100 transition">

                            <x-heroicon-o-arrow-up-tray class="w-6 h-6 text-white mb-1" />

                            <span class="text-[10px] text-white uppercase tracking-widest font-bold">
                                Ganti
                            </span>

                        </div>
                    </label>

                    {{-- DELETE --}}
                    @if($user->profile_photo_path)
                        <button wire:click="removePhoto"
                            class="mt-3 text-xs uppercase tracking-widest border border-ink px-3 py-1 hover:bg-ink hover:text-surface transition">
                            Hapus Foto
                        </button>
                    @endif

                    {{-- ROLES --}}
                    <div class="mt-4 flex flex-wrap justify-center gap-2">
                        @foreach($user->getRoleNames() as $role)
                            <span class="px-2 py-1 border border-ink text-xs font-bold uppercase tracking-widest">
                                {{ $role }}
                            </span>
                        @endforeach
                    </div>

                </div>

                {{-- INFO READ ONLY --}}
                <div class="flex-1 border-t md:border-t-0 md:border-l border-ink/30 pt-6 md:pt-0 md:pl-8">

                    <div class="space-y-6">
                        <div class="border-b border-ink/20 pb-4">
                            <h3 class="text-2xl font-bold font-serif">{{ $user->name }}</h3>
                            <p class="text-muted text-sm font-mono mt-1">{{ $user->email }}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4">
                            <div>
                                <p class="text-xs uppercase tracking-widest text-muted mb-1">No. Telepon</p>
                                <p class="font-serif text-lg">{{ $user->phone ?: '—' }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-widest text-muted mb-1">Alamat</p>
                                <p class="font-serif text-lg leading-snug">{{ $user->address ?: '—' }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-widest text-muted mb-1">Terdaftar Sejak</p>
                                <p class="font-mono text-sm">{{ $user->created_at->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-widest text-muted mb-1">Status Keanggotaan</p>
                                @if($user->email_verified_at)
                                    <span
                                        class="inline-block px-2 py-1 border border-ink text-xs font-bold uppercase tracking-widest">
                                        Sah / Terverifikasi
                                    </span>
                                @else
                                    <span
                                        class="inline-block px-2 py-1 border border-ink border-dashed text-xs font-bold uppercase tracking-widest">
                                        Belum Diverifikasi
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($activeLoans->count() > 0)
            <div class="space-y-4">
                <h3 class="text-xl font-bold italic font-serif flex items-center gap-2">
                    <span class="w-8 h-px bg-ink inline-block"></span> Pinjaman Berjalan
                </h3>

                <div class="bg-surface border-2 border-ink overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-background text-xs uppercase tracking-widest border-b-2 border-ink">
                            <tr>
                                <th class="p-4 border-r border-ink/20">Buku</th>
                                <th class="p-4 border-r border-ink/20">Tgl Pinjam</th>
                                <th class="p-4 border-r border-ink/20">Batas</th>
                                <th class="p-4">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-ink/20">
                            @foreach($activeLoans as $loan)
                                <tr>
                                    <td class="p-4 border-r border-ink/20 font-serif">
                                        {{ $loan->book->title ?? 'Tidak tersedia' }}
                                    </td>
                                    <td class="p-4 text-sm font-mono border-r border-ink/20">
                                        {{ $loan->borrowed_at?->format('d/m/Y') ?? '-' }}
                                    </td>
                                    <td class="p-4 text-sm font-mono border-r border-ink/20">
                                        {{ $loan->due_date?->format('d/m/Y') ?? '-' }}
                                    </td>
                                    <td class="p-4">
                                        <span class="text-xs uppercase border border-ink px-2 py-1">
                                            {{ $loan->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        @endif

        @role('anggota')
        <div class="space-y-4">
            <h3 class="text-xl font-bold italic font-serif flex items-center gap-2">
                <span class="w-8 h-px bg-ink inline-block"></span> Arsip Peminjaman
            </h3>
            @if($loans->count() > 0)
                <div class="bg-surface border border-ink overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-background text-xs uppercase tracking-widest border-b border-ink">
                            <tr>
                                <th class="p-4 border-r border-ink/20">Buku / Judul Pustaka</th>
                                <th class="p-4 border-r border-ink/20">Tgl. Pinjam</th>
                                <th class="p-4 border-r border-ink/20">Tgl. Kembali</th>
                                <th class="p-4">Status Akhir</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-ink/20 text-muted">
                            @foreach($loans as $loan)
                                <tr class="hover:bg-background hover:text-ink transition-colors">
                                    <td class="p-4 border-r border-ink/20">
                                        <div class="font-serif italic">{{ $loan->book->title ?? 'Pustaka tidak tersedia' }}
                                        </div>
                                    </td>
                                    <td class="p-4 text-sm font-mono border-r border-ink/20">
                                        {{ $loan->borrowed_at?->format('d/m/Y') ?? '-' }}</td>
                                    <td class="p-4 text-sm font-mono border-r border-ink/20">
                                        {{ $loan->returned_at?->format('d/m/Y') ?? '-' }}
                                    </td>
                                    <td class="p-4 text-sm uppercase tracking-wider font-bold">
                                        @if($loan->status === 'returned')
                                            Selesai
                                        @else
                                            {{ $loan->status }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="paper-card p-8 text-center border border-ink border-dashed">
                    <p class="font-serif italic text-muted">Belum ada catatan arsip peminjaman.</p>
                </div>
            @endif
        </div>
        @endrole
    </div>
</div>