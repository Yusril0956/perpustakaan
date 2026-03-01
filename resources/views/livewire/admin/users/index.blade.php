<div x-data="{
    isModalOpen: false,
    modalTitle: '',
    modalMessage: '',
    modalButtonText: '',
    modalButtonColor: '#991b1b',
    modalUserId: null,
    openDeleteModal(userId, userName) {
        this.modalUserId = userId;
        this.modalTitle = 'Hapus Pengguna';
        this.modalMessage = `Hapus arsip pengguna <strong>${userName}</strong> dari sistem?<br><br>Tindakan ini tidak dapat dibatalkan.`;
        this.modalButtonText = '[×] Hapus';
        this.modalButtonColor = '#991b1b';
        this.isModalOpen = true;
    },
    handleModalConfirm() {
        this.$wire.delete(this.modalUserId);
        this.isModalOpen = false;
    }
}" @keydown.escape="isModalOpen = false">
    <div class="space-y-8 text-ink">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-2 border-ink pb-4 gap-4">
            <div>
                <h2 class="text-3xl font-bold italic font-serif">Manajemen Pengguna</h2>
                <p class="text-xs uppercase tracking-widest text-muted mt-1">Daftar Keanggotaan & Pegawai</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
                class="bg-coffee text-parchment-light px-6 py-2.5 rounded-sm shadow-[4px_4px_0px_#2c2420] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all duration-200 text-xs font-bold uppercase tracking-[0.2em] flex items-center gap-2 border border-[#2c2420]">
                <x-heroicon-o-plus class="w-5 h-5" />Tambah
            </a>
        </div>

        <div class="max-w-2xl mx-auto mb-12">
            <div
                class="relative flex shadow-[8px_8px_0px_rgba(44,36,32,1)] focus-within:shadow-[4px_4px_0px_rgba(44,36,32,1)] focus-within:translate-y-1 focus-within:translate-x-1 transition-all">
                <div class="relative flex-1">
                    <input type="text" wire:model.live.debounce.300ms="search" type="text" name="search"
                        placeholder="CARI NAMA ATAU EMAIL..."
                        class="w-full pl-12 pr-4 py-4 bg-[#fcfaf5] border-2 border-ink border-r-0 focus:ring-0 font-mono text-sm placeholder-ink/40 uppercase">
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                        <x-heroicon-o-magnifying-glass class="w-6 h-6 text-ink/60" />
                    </div>
                </div>
                <button type="submit"
                    class="bg-ink text-[#fcfaf5] px-8 py-4 font-mono font-black uppercase tracking-widest border-2 border-ink hover:bg-ink/90 transition-colors">
                    Lacak
                </button>
            </div>
        </div>
        
        <div class="bg-surface border-2 border-ink overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-background text-xs uppercase tracking-widest border-b-2 border-ink">
                    <tr>
                        <th class="p-4 border-r border-ink">Identitas Pengguna</th>
                        <th class="p-4 border-r border-ink">Kontak (Email)</th>
                        <th class="p-4 border-r border-ink">Peran</th>
                        <th class="p-4 border-r border-ink">Status</th>
                        <th class="p-4 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink text-ink">
                    @forelse($users as $user)
                        <tr class="hover:bg-background transition-colors group">
                            <td class="p-4 border-r border-ink">
                                <div class="font-bold font-serif text-lg italic">{{ $user->name }}</div>
                            </td>
                            <td class="p-4 text-sm font-mono border-r border-ink">
                                {{ $user->email }}
                            </td>
                            <td class="p-4 border-r border-ink">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($user->getRoleNames() as $role)
                                        <span
                                            class="px-2 py-1 border border-ink text-[10px] font-bold uppercase tracking-widest">{{ $role }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="p-4 border-r border-ink">
                                @if($user->email_verified_at)
                                    <span
                                        class="inline-block px-2 py-1 border border-ink bg-ink text-surface text-xs font-bold uppercase tracking-widest">
                                        Sah
                                    </span>
                                @else
                                    <span
                                        class="inline-block px-2 py-1 border border-ink border-dashed text-muted text-xs font-bold uppercase tracking-widest">
                                        Belum Sah
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.users.edit', $user->id) }}" wire:navigate
                                    class="inline-block text-xs uppercase tracking-widest font-bold px-2 py-1 border border-transparent hover:border-ink hover:bg-ink hover:text-surface transition-colors">
                                    [✎ Ubah]
                                </a>
                                <button @click="openDeleteModal({{ $user->id }}, '{{ addslashes($user->name) }}')"
                                    class="inline-block text-xs uppercase tracking-widest font-bold px-2 py-1 text-red-800 border border-transparent hover:border-red-800 hover:bg-red-800 hover:text-surface transition-colors">
                                    [× Hapus]
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center border-dashed border-ink/30 bg-background/50">
                                <p class="font-serif italic text-muted text-lg">Tidak ditemukan catatan pengguna dalam
                                    arsip.</p>
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

    {{-- Modal Konfirmasi --}}
    <x-ui.confirmation-modal />
</div>