<div>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold italic text-ink">Profil Saya</h2>
            @if(!$isEditing)
                <button wire:click="toggleEdit" class="btn-primary">
                    ✎ Edit Profil
                </button>
            @endif
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif

        <!-- Profile Card -->
        <div class="paper-card">
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Profile Photo -->
                <div class="flex flex-col items-center">
                    <div class="relative">
                        <img src="{{ $user->profile_photo_url }}" 
                             alt="{{ $user->name }}" 
                             class="w-32 h-32 rounded-full object-cover border-4 border-accent shadow-md">
                        @if($isEditing)
                            <label for="photo-upload" class="absolute bottom-0 right-0 bg-accent text-white p-2 rounded-full cursor-pointer hover:bg-ink transition shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </label>
                            <input id="photo-upload" type="file" wire:model="photo" class="hidden" accept="image/*">
                        @endif
                    </div>
                    @if($isEditing && $photo)
                        <p class="text-sm text-muted mt-2 italic">Foto baru: {{ $photo->getClientOriginalName() }}</p>
                    @endif
                    <div class="mt-3 text-center">
                        @foreach($user->getRoleNames() as $role)
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-bold uppercase rounded">{{ $role }}</span>
                        @endforeach
                    </div>
                </div>

                <!-- Profile Info -->
                <div class="flex-1">
                    @if($isEditing)
                        <form wire:submit="save" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-muted mb-1">Nama</label>
                                    <input type="text" wire:model="name" class="form-input">
                                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-muted mb-1">Email</label>
                                    <input type="email" wire:model="email" class="form-input">
                                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-muted mb-1">No. Telepon</label>
                                    <input type="text" wire:model="phone" class="form-input" placeholder="Masukkan nomor telepon">
                                    @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-muted mb-1">Alamat</label>
                                    <input type="text" wire:model="address" class="form-input" placeholder="Masukkan alamat">
                                    @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="flex gap-3 pt-2">
                                <button type="submit" class="btn-primary">
                                    Simpan Perubahan
                                </button>
                                <button type="button" wire:click="toggleEdit" class="btn-ghost">
                                    Batal
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xl font-bold italic text-ink">{{ $user->name }}</h3>
                                <p class="text-muted text-sm">{{ $user->email }}</p>
                            </div>
                            
                            <div-cols-1 class="grid grid md:grid-cols-2 gap-4 pt-2">
                                <div>
                                    <p class="text-xs uppercase tracking-widest text-muted">No. Telepon</p>
                                    <p class="text-ink italic">{{ $user->phone ?: '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-widest text-muted">Alamat</p>
                                    <p class="text-ink italic">{{ $user->address ?: '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-widest text-muted">Terdaftar Sejak</p>
                                    <p class="text-ink italic">{{ $user->created_at->format('d F Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs uppercase tracking-widest text-muted">Status Email</p>
                                    @if($user->email_verified_at)
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-bold uppercase rounded">Terverifikasi</span>
                                    @else
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold uppercase rounded">Belum Verifikasi</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Active Loans -->
        @if($activeLoans->count() > 0)
        <div class="space-y-4">
            <h3 class="text-xl font-bold italic text-ink">Pinjaman Aktif</h3>
            <div class="bg-surface shadow-sm border overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-background text-xs uppercase tracking-widest text-muted border-b">
                        <tr>
                            <th class="p-4">Buku</th>
                            <th class="p-4">Tanggal Pinjam</th>
                            <th class="p-4">Batas Kembali</th>
                            <th class="p-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($activeLoans as $loan)
                            <tr class="hover:bg-surface transition">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        @if($loan->book && $loan->book->cover_url)
                                            <img src="{{ $loan->book->cover_url }}" alt="{{ $loan->book->title }}" class="w-10 h-14 object-cover">
                                        @else
                                            <div class="w-10 h-14 bg-muted/20 flex items-center justify-center">
                                                <span class="text-xs text-muted">N/A</span>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-bold text-ink italic">{{ $loan->book->title ?? 'Buku tidak tersedia' }}</div>
                                            <div class="text-xs text-muted">{{ $loan->book->author ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">{{ $loan->borrowed_at?->format('d F Y') ?? '-' }}</td>
                                <td class="p-4 text-sm">
                                    <span class="{{ $loan->due_date?->isPast() ? 'text-red-600 font-bold' : '' }}">
                                        {{ $loan->due_date?->format('d F Y') ?? '-' }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    @if($loan->status === 'borrowed')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold uppercase rounded">Dipinjam</span>
                                    @elseif($loan->status === 'returned')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-bold uppercase rounded">Dikembalikan</span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-bold uppercase rounded">Terlambat</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- Loan History -->
        <div class="space-y-4">
            <h3 class="text-xl font-bold italic text-ink">Riwayat Peminjaman</h3>
            @if($loans->count() > 0)
                <div class="bg-surface shadow-sm border overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-background text-xs uppercase tracking-widest text-muted border-b">
                            <tr>
                                <th class="p-4">Buku</th>
                                <th class="p-4">Tanggal Pinjam</th>
                                <th class="p-4">Tanggal Kembali</th>
                                <th class="p-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($loans as $loan)
                                <tr class="hover:bg-surface transition">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            @if($loan->book && $loan->book->cover_url)
                                                <img src="{{ $loan->book->cover_url }}" alt="{{ $loan->book->title }}" class="w-10 h-14 object-cover">
                                            @else
                                                <div class="w-10 h-14 bg-muted/20 flex items-center justify-center">
                                                    <span class="text-xs text-muted">N/A</span>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="font-bold text-ink italic">{{ $loan->book->title ?? 'Buku tidak tersedia' }}</div>
                                                <div class="text-xs text-muted">{{ $loan->book->author ?? '' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-sm">{{ $loan->borrowed_at?->format('d F Y') ?? '-' }}</td>
                                    <td class="p-4 text-sm">
                                        {{ $loan->returned_at?->format('d F Y') ?? '-' }}
                                    </td>
                                    <td class="p-4">
                                        @if($loan->status === 'borrowed')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold uppercase rounded">Dipinjam</span>
                                        @elseif($loan->status === 'returned')
                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-bold uppercase rounded">Dikembalikan</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-bold uppercase rounded">Terlambat</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="paper-card p-8 text-center">
                    <p class="italic text-muted">Belum ada riwayat peminjaman.</p>
                </div>
            @endif
        </div>
    </div>
</div>
