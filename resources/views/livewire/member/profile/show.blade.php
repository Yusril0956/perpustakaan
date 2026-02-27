<div>
    <div class="space-y-10 text-ink">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-2 border-ink pb-4 gap-4">
            <div>
                <h2 class="text-3xl font-bold italic font-serif">Profil Peminjam</h2>
                <p class="text-xs uppercase tracking-widest text-muted mt-1">Kartu Informasi & Riwayat</p>
            </div>
            @if(!$isEditing)
            <button wire:click="toggleEdit" class="btn-primary text-sm uppercase tracking-widest px-6 py-2 border border-ink hover:bg-ink hover:text-surface transition-colors">
                [✎] Ubah Data
            </button>
            @endif
        </div>

        @if(session('success'))
        <div class="p-4 border border-ink bg-surface italic text-sm text-center">
            * {{ session('success') }} *
        </div>
        @endif

        <div class="paper-card p-6 md:p-8 border border-ink shadow-sm bg-surface relative">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="flex flex-col items-center flex-shrink-0">
                    <div class="relative p-1 border-2 border-ink">
                        <img src="{{ $user->profile_photo_url }}"
                            alt="{{ $user->name }}"
                            class="w-32 h-40 object-cover grayscale hover:grayscale-0 transition-all duration-500">
                        @if($isEditing)
                        <label for="photo-upload" class="absolute -bottom-3 -right-3 bg-background border border-ink text-ink p-2 cursor-pointer hover:bg-ink hover:text-background transition-colors shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </label>
                        <input id="photo-upload" type="file" wire:model="photo" class="hidden" accept="image/*">
                        @endif
                    </div>
                    @if($isEditing && $photo)
                    <p class="text-xs text-muted mt-4 italic truncate w-32 text-center">Berkas: {{ $photo->getClientOriginalName() }}</p>
                    @endif
                    <div class="mt-4 flex flex-wrap justify-center gap-2">
                        @foreach($user->getRoleNames() as $role)
                        <span class="px-2 py-1 border border-ink text-xs font-bold uppercase tracking-widest">{{ $role }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="flex-1 border-t md:border-t-0 md:border-l border-ink/30 pt-6 md:pt-0 md:pl-8">
                    @if($isEditing)
                    <form wire:submit="save" class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs uppercase tracking-widest text-muted mb-1">Nama Lengkap</label>
                                <input type="text" wire:model="name" class="form-input w-full border-b border-ink bg-transparent rounded-none focus:ring-0 px-0 py-1" placeholder="Nama Anda">
                                @error('name') <span class="text-red-600 italic text-xs mt-1 block">* {{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs uppercase tracking-widest text-muted mb-1">Surat Elektronik (Email)</label>
                                <input type="email" wire:model="email" class="form-input w-full border-b border-ink bg-transparent rounded-none focus:ring-0 px-0 py-1" placeholder="email@contoh.com">
                                @error('email') <span class="text-red-600 italic text-xs mt-1 block">* {{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs uppercase tracking-widest text-muted mb-1">No. Telepon</label>
                                <input type="text" wire:model="phone" class="form-input w-full border-b border-ink bg-transparent rounded-none focus:ring-0 px-0 py-1" placeholder="+62...">
                                @error('phone') <span class="text-red-600 italic text-xs mt-1 block">* {{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs uppercase tracking-widest text-muted mb-1">Alamat Tinggal</label>
                                <input type="text" wire:model="address" class="form-input w-full border-b border-ink bg-transparent rounded-none focus:ring-0 px-0 py-1" placeholder="Alamat lengkap">
                                @error('address') <span class="text-red-600 italic text-xs mt-1 block">* {{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex gap-4 pt-4 mt-4 border-t border-ink/20">
                            <button type="submit" class="btn-primary px-6 py-2 bg-ink text-surface border border-ink hover:bg-surface hover:text-ink transition-colors uppercase text-xs tracking-widest font-bold">
                                Simpan Dokumen
                            </button>
                            <button type="button" wire:click="toggleEdit" class="btn-ghost px-6 py-2 border border-ink/30 hover:border-ink transition-colors uppercase text-xs tracking-widest">
                                Batal
                            </button>
                        </div>
                    </form>
                    @else
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
                                <span class="inline-block px-2 py-1 border border-ink text-xs font-bold uppercase tracking-widest">Sah / Terverifikasi</span>
                                @else
                                <span class="inline-block px-2 py-1 border border-ink border-dashed text-xs font-bold uppercase tracking-widest">Belum Diverifikasi</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
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
                            <th class="p-4 border-r border-ink/20">Buku / Judul Pustaka</th>
                            <th class="p-4 border-r border-ink/20">Tgl. Pinjam</th>
                            <th class="p-4 border-r border-ink/20">Batas Kembali</th>
                            <th class="p-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ink/20">
                        @foreach($activeLoans as $loan)
                        <tr class="hover:bg-background transition-colors">
                            <td class="p-4 border-r border-ink/20">
                                <div class="flex items-center gap-4">
                                    @if($loan->book && $loan->book->cover_url)
                                    <img src="{{ $loan->book->cover_url }}" alt="Cover" class="w-12 h-16 object-cover border border-ink p-0.5">
                                    @else
                                    <div class="w-12 h-16 border border-ink border-dashed flex items-center justify-center p-0.5">
                                        <span class="text-[10px] text-muted uppercase">Tanpa Sampul</span>
                                    </div>
                                    @endif
                                    <div>
                                        <div class="font-bold font-serif">{{ $loan->book->title ?? 'Pustaka tidak tersedia' }}</div>
                                        <div class="text-xs text-muted uppercase tracking-wider mt-1">{{ $loan->book->author ?? 'Penulis Anonim' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-sm font-mono border-r border-ink/20">{{ $loan->borrowed_at?->format('d/m/Y') ?? '-' }}</td>
                            <td class="p-4 text-sm font-mono border-r border-ink/20">
                                <span class="{{ $loan->due_date?->isPast() ? 'text-red-600 font-bold border-b border-red-600' : '' }}">
                                    {{ $loan->due_date?->format('d/m/Y') ?? '-' }}
                                </span>
                            </td>
                            <td class="p-4">
                                @if($loan->status === 'borrowed')
                                <span class="text-xs font-bold uppercase tracking-widest border border-ink px-2 py-1">Di Tangan</span>
                                @elseif($loan->status === 'returned')
                                <span class="text-xs font-bold uppercase tracking-widest border border-ink px-2 py-1 bg-ink text-surface">Kembali</span>
                                @else
                                <span class="text-xs font-bold uppercase tracking-widest border-2 border-red-800 text-red-800 px-2 py-1">Lewat Tenggat</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

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
                                <div class="font-serif italic">{{ $loan->book->title ?? 'Pustaka tidak tersedia' }}</div>
                            </td>
                            <td class="p-4 text-sm font-mono border-r border-ink/20">{{ $loan->borrowed_at?->format('d/m/Y') ?? '-' }}</td>
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
    </div>
</div>