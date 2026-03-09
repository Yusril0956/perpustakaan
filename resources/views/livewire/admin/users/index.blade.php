<div class="space-y-8 text-ink">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-2 border-ink pb-4 gap-4">
            <div>
                <h2 class="text-3xl font-bold italic font-serif">Manajemen Pengguna</h2>
                <p class="text-xs uppercase tracking-widest text-muted mt-1">Daftar Keanggotaan & Pegawai</p>
            </div>
            <x-ui.button iconLeft="heroicon-o-plus" href="{{ route('admin.users.create') }}" wire:navigate size="sm">
                Tambah
            </x-ui.button>
        </div>

        {{-- Search --}}
        <div class="max-w-2xl mx-auto mb-12">
            <div class="relative flex shadow-[8px_8px_0px_rgba(44,36,32,1)]
                        focus-within:shadow-[4px_4px_0px_rgba(44,36,32,1)]
                        focus-within:translate-y-1 focus-within:translate-x-1 transition-all">
                <div class="relative flex-1">
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="CARI NAMA ATAU EMAIL..."
                        class="w-full pl-12 pr-4 py-4 bg-[#fcfaf5] border-2 border-ink border-r-0
                               focus:ring-0 font-mono text-sm placeholder-ink/40 uppercase"
                    >
                    <div class="absolute left-4 top-1/2 -translate-y-1/2">
                        <x-heroicon-o-magnifying-glass class="w-6 h-6 text-ink/60" />
                    </div>
                </div>
                <div class="bg-ink text-[#fcfaf5] px-8 py-4 font-mono font-black uppercase tracking-widest
                            border-2 border-ink flex items-center justify-center select-none">
                    Lacak
                </div>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="bg-surface border-2 border-ink overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-background text-xs uppercase tracking-widest border-b-2 border-ink">
                    <tr>
                        <th class="p-0 border-r border-ink w-1/3">
                            <button
                                wire:click="setSortBy('name')"
                                class="w-full flex items-center justify-between p-4 focus:outline-none
                                       hover:bg-ink hover:text-surface transition-colors group"
                            >
                                <span>Identitas Pengguna</span>
                                <span class="text-[10px] {{ $sortBy === 'name' ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}">
                                    @if($sortBy === 'name' && $sortDir === 'asc') ▲
                                    @elseif($sortBy === 'name' && $sortDir === 'desc') ▼
                                    @else ▲▼ @endif
                                </span>
                            </button>
                        </th>
                        <th class="p-0 border-r border-ink">
                            <button
                                wire:click="setSortBy('email')"
                                class="w-full flex items-center justify-between p-4 focus:outline-none
                                       hover:bg-ink hover:text-surface transition-colors group"
                            >
                                <span>Kontak (Email)</span>
                                <span class="text-[10px] {{ $sortBy === 'email' ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}">
                                    @if($sortBy === 'email' && $sortDir === 'asc') ▲
                                    @elseif($sortBy === 'email' && $sortDir === 'desc') ▼
                                    @else ▲▼ @endif
                                </span>
                            </button>
                        </th>
                        <th class="p-4 border-r border-ink text-left align-middle select-none">Peran</th>
                        <th class="p-0 border-r border-ink w-28">
                            <button
                                wire:click="setSortBy('verify')"
                                class="w-full flex items-center justify-center gap-2 p-4 focus:outline-none
                                       hover:bg-ink hover:text-surface transition-colors group text-center"
                            >
                                <span>Status</span>
                                <span class="text-[10px] {{ $sortBy === 'verify' ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}">
                                    @if($sortBy === 'verify' && $sortDir === 'asc') ▲
                                    @elseif($sortBy === 'verify' && $sortDir === 'desc') ▼
                                    @else ▲▼ @endif
                                </span>
                            </button>
                        </th>
                        <th class="p-4 text-right select-none">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink text-ink relative">

                    {{-- Loading overlay --}}
                    <div
                        wire:loading.class.remove="hidden"
                        class="hidden absolute inset-0 z-10 bg-surface/50 backdrop-blur-sm transition-all duration-300"
                    ></div>

                    @forelse($users as $user)
                        <tr class="hover:bg-background transition-colors group" wire:key="user-{{ $user->id }}">

                            <td class="p-4 border-r border-ink">
                                <div class="font-bold font-serif text-lg italic">{{ $user->name }}</div>
                            </td>

                            <td class="p-4 text-sm font-mono border-r border-ink">
                                {{ $user->email }}
                            </td>

                            <td class="p-4 border-r border-ink">
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($user->getRoleNames() as $role)
                                        <span class="px-2 py-1 border border-ink text-[10px] font-bold uppercase tracking-widest">
                                            {{ $role }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>

                            <td class="p-4 border-r border-ink text-center">
                                <button
                                    type="button"
                                    onclick="if(confirm('{{ $user->verify ? 'Membatalkan pengesahan' : 'Mengesahkan' }} akun {{ addslashes($user->name) }}?\n\nStatus pengguna akan diperbarui di sistem.')) { Livewire.dispatch('toggle-verify-user', { userId: {{ $user->id }} }); }"
                                    class="focus:outline-none hover:scale-105 hover:-translate-y-0.5 transition-transform"
                                    title="Klik untuk ubah status verifikasi"
                                >
                                    @if($user->verify)
                                        <span class="inline-block px-2 py-1 border border-ink bg-ink text-surface text-xs font-bold uppercase tracking-widest hover:bg-ink/80 transition-colors">
                                            Sah
                                        </span>
                                    @else
                                        <span class="inline-block px-2 py-1 border border-ink border-dashed text-muted text-xs font-bold uppercase tracking-widest hover:text-ink hover:border-solid transition-colors">
                                            Belum Sah
                                        </span>
                                    @endif
                                </button>
                            </td>

                            <td class="p-4 text-right space-x-2 whitespace-nowrap">
                                <a
                                    href="{{ route('admin.users.edit', $user->id) }}"
                                    wire:navigate
                                    class="inline-block text-xs uppercase tracking-widest font-bold px-2 py-1 border border-transparent hover:border-ink hover:bg-ink hover:text-surface transition-colors"
                                >
                                    [✎ Ubah]
                                </a>
                                <button
                                    type="button"
                                    onclick="if(confirm('Hapus arsip pengguna {{ addslashes($user->name) }} dari sistem?\n\nTindakan ini tidak dapat dibatalkan.')) { Livewire.dispatch('delete-user', { userId: {{ $user->id }} }); }"
                                    class="inline-block text-xs uppercase tracking-widest font-bold px-2 py-1 text-red-800 border border-transparent hover:border-red-800 hover:bg-red-800 hover:text-surface transition-colors"
                                >
                                    [× Hapus]
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center bg-background/50">
                                <p class="font-serif italic text-muted text-lg">
                                    Tidak ditemukan catatan pengguna dalam arsip.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-4 border-t-2 border-ink border-dotted">
            {{ $users->links('components.ui.pagination') }}
        </div>

    </div>

