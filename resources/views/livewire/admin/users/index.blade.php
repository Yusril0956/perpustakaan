<div>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold italic text-ink">Manajemen Pengguna</h2>
            <button type="button" onclick="window.location.href='/'"
                class="btn-primary">
                + Tambah Pengguna Baru
            </button>
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
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-bold uppercase rounded">{{ $role }}</span>
                                @endforeach
                            </td>
                            <td class="p-4 text-sm">
                                @if($user->email_verified_at)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-bold uppercase">Terverifikasi</span>
                                @else
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold uppercase">Belum Verifikasi</span>
                                @endif
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <button class="text-sm italic text-muted hover:text-ink">Edit</button>
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
