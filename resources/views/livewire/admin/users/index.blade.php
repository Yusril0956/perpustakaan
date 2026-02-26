<div>
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold italic text-ink">Manajemen Pengguna</h2>
            <a href="{{ route('admin.users.create') }}"
                class="bg-coffee text-parchment-light px-6 py-2.5 rounded-sm shadow-[4px_4px_0px_#2c2420] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all duration-200 text-xs font-bold uppercase tracking-[0.2em] flex items-center gap-2">
                <x-heroicon-o-plus class="w-5 h-5" />Tambah
            </a>
        </div>

        <div class="paper-card p-4">
            <input wire:model.live.debounce.300ms="search" type="text"
                placeholder="Cari pengguna berdasarkan nama atau email..." class="form-input text-lg italic">
        </div>

        <div class="bg-surface shadow-sm border overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-background text-xs uppercase tracking-widest text-muted border-b">
                    <tr>
                        <th class="p-4">Nama</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Role</th>
                        <th class="p-4">Status Verifikasi</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($users as $user)
                        <tr class="hover:bg-surface transition">
                            <td class="p-4">
                                <div class="font-bold text-ink italic">{{ $user->name }}</div>
                            </td>
                            <td class="p-4 text-sm">{{ $user->email }}</td>
                            <td class="p-4 text-sm">
                                @foreach($user->getRoleNames() as $role)
                                    <span
                                        class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-bold uppercase rounded">{{ $role }}</span>
                                @endforeach
                            </td>
                            <td class="p-4 text-sm">
                                @if($user->email_verified_at)
                                    <span
                                        class="px-2 py-1 bg-green-100 text-green-800 text-xs font-bold uppercase">Terverifikasi</span>
                                @else
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold uppercase">Belum
                                        Verifikasi</span>
                                @endif
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" wire:navigate
                                    class="text-sm italic text-muted hover:text-ink">Edit</a>
                                <button wire:click="delete({{ $user->id }})"
                                    wire:confirm="Apakah Anda yakin ingin menghapus pengguna ini?"
                                    class="text-sm italic text-muted hover:text-ink">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center italic text-muted">Belum ada pengguna yang
                                terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links('vendor.pagination.vintage') }}
        </div>
    </div>
</div>