<div x-data="{
    isModalOpen: false,
    isProcessing: false,
    modalTitle: '',
    modalMessage: '',
    modalButtonText: '',
    modalButtonColor: '#991b1b',
    modalUserId: null,
    modalAction: '', 
    
    openDeleteModal(userId, userName) {
        this.modalUserId = userId;
        this.modalAction = 'delete';
        this.modalTitle = 'Hapus Pengguna';
        this.modalMessage = `Hapus arsip pengguna <strong>${userName}</strong> dari sistem?<br><br>Tindakan ini tidak dapat dibatalkan.`;
        this.modalButtonText = '[×] Hapus';
        this.modalButtonColor = '#991b1b';
        this.isModalOpen = true;
    },
    
    openVerifyModal(userId, userName, isVerified) {
        this.modalUserId = userId;
        this.modalAction = 'verify';
        const actionText = isVerified ? 'Membatalkan pengesahan' : 'Mengesahkan';
        this.modalTitle = isVerified ? 'Batal Sahkan Pengguna' : 'Sahkan Pengguna';
        this.modalMessage = `${actionText} akun <strong>${userName}</strong>?<br><br>Status pengguna akan diperbarui di sistem.`;
        this.modalButtonText = isVerified ? '[⊘] Batal Sah' : '[✓] Sahkan';
        this.modalButtonColor = isVerified ? '#b45309' : '#15803d'; 
        this.isModalOpen = true;
    },
    
    async handleModalConfirm() {
        this.isProcessing = true; 
        
        if (this.modalAction === 'delete') {
            await this.$wire.delete(this.modalUserId);
        } else if (this.modalAction === 'verify') {
            await this.$wire.toggleVerify(this.modalUserId);
        }
        
        this.isModalOpen = false; 
        this.isProcessing = false; 
    }
}" @keydown.escape="isModalOpen = false">
    
    <div class="space-y-8 text-ink">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b-2 border-ink pb-4 gap-4">
            <div>
                <h2 class="text-3xl font-bold italic font-serif">Manajemen Pengguna</h2>
                <p class="text-xs uppercase tracking-widest text-muted mt-1">Daftar Keanggotaan & Pegawai</p>
            </div>
            <x-ui.button iconLeft="heroicon-o-plus" href="{{ route('admin.users.create') }}" wire:navigate size="sm">
                Tambah
            </x-ui.button>
        </div>

        <div class="max-w-2xl mx-auto mb-12">
            <div class="relative flex shadow-[8px_8px_0px_rgba(44,36,32,1)] focus-within:shadow-[4px_4px_0px_rgba(44,36,32,1)] focus-within:translate-y-1 focus-within:translate-x-1 transition-all">
                <div class="relative flex-1">
                    <input type="text" wire:model.live.debounce.300ms="search" name="search"
                        placeholder="CARI NAMA ATAU EMAIL..."
                        class="w-full pl-12 pr-4 py-4 bg-[#fcfaf5] border-2 border-ink border-r-0 focus:ring-0 font-mono text-sm placeholder-ink/40 uppercase">
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                        <x-heroicon-o-magnifying-glass class="w-6 h-6 text-ink/60" />
                    </div>
                </div>
                {{-- Tombol Lacak opsional karena Livewire live update, tapi tetap oke untuk visual --}}
                <div class="bg-ink text-[#fcfaf5] px-8 py-4 font-mono font-black uppercase tracking-widest border-2 border-ink flex items-center justify-center select-none">
                    Lacak
                </div>
            </div>
        </div>

        <div class="bg-surface border-2 border-ink overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-background text-xs uppercase tracking-widest border-b-2 border-ink">
                    <tr>
                        <th class="p-0 border-r border-ink w-1/3">
                            <button wire:click="setSortBy('name')" class="w-full flex items-center justify-between p-4 focus:outline-none hover:bg-ink hover:text-surface transition-colors group">
                                <span>Identitas Pengguna</span>
                                <span class="text-[10px] {{ $sortBy === 'name' ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}">
                                    @if($sortBy === 'name' && $sortDir === 'asc') ▲ @elseif($sortBy === 'name' && $sortDir === 'desc') ▼ @else ▲▼ @endif
                                </span>
                            </button>
                        </th>
                        <th class="p-0 border-r border-ink">
                            <button wire:click="setSortBy('email')" class="w-full flex items-center justify-between p-4 focus:outline-none hover:bg-ink hover:text-surface transition-colors group">
                                <span>Kontak (Email)</span>
                                <span class="text-[10px] {{ $sortBy === 'email' ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}">
                                    @if($sortBy === 'email' && $sortDir === 'asc') ▲ @elseif($sortBy === 'email' && $sortDir === 'desc') ▼ @else ▲▼ @endif
                                </span>
                            </button>
                        </th>
                        <th class="p-4 border-r border-ink text-left align-middle select-none">
                            Peran
                        </th>
                        <th class="p-0 border-r border-ink w-24">
                            <button wire:click="setSortBy('verify')" class="w-full flex items-center justify-center gap-2 p-4 focus:outline-none hover:bg-ink hover:text-surface transition-colors group text-center">
                                <span>Status</span>
                                <span class="text-[10px] {{ $sortBy === 'verify' ? 'opacity-100' : 'opacity-30 group-hover:opacity-100' }}">
                                    @if($sortBy === 'verify' && $sortDir === 'asc') ▲ @elseif($sortBy === 'verify' && $sortDir === 'desc') ▼ @else ▲▼ @endif
                                </span>
                            </button>
                        </th>
                        <th class="p-4 text-right select-none">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-ink text-ink relative">
                    
                    {{-- Loading Overlay bawaan Livewire agar terlihat halus saat sorting --}}
                    <div wire:loading.class.remove="hidden" class="hidden absolute inset-0 z-10 bg-surface/50 backdrop-blur-sm transition-all duration-300"></div>

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
                                        <span class="px-2 py-1 border border-ink text-[10px] font-bold uppercase tracking-widest">{{ $role }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="p-4 border-r border-ink text-center">
                                <button type="button" 
                                    @click="openVerifyModal({{ $user->id }}, '{{ addslashes($user->name) }}', {{ $user->verify ? 'true' : 'false' }})"
                                    class="focus:outline-none hover:scale-105 hover:-translate-y-0.5 transition-transform"
                                    title="Klik untuk ubah status verifikasi">
                                    @if($user->verify)
                                        <span class="inline-block px-2 py-1 border border-ink bg-ink text-surface text-xs font-bold uppercase tracking-widest hover:bg-ink/80 transition-colors">
                                            Sah
                                        </span>
                                    @else
                                        <span class="inline-block px-2 py-1 border border-ink border-dashed text-muted text-xs font-bold uppercase tracking-widest hover:text-ink hover:border-solid hover:border-ink transition-colors">
                                            Belum Sah
                                        </span>
                                    @endif
                                </button>
                            </td>
                            <td class="p-4 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.users.edit', $user->id) }}" wire:navigate
                                    class="inline-block text-xs uppercase tracking-widest font-bold px-2 py-1 border border-transparent hover:border-ink hover:bg-ink hover:text-surface transition-colors">
                                    [✎ Ubah]
                                </a>
                                <button type="button" @click="openDeleteModal({{ $user->id }}, '{{ addslashes($user->name) }}')"
                                    class="inline-block text-xs uppercase tracking-widest font-bold px-2 py-1 text-red-800 border border-transparent hover:border-red-800 hover:bg-red-800 hover:text-surface transition-colors">
                                    [× Hapus]
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center border-dashed border-ink/30 bg-background/50">
                                <p class="font-serif italic text-muted text-lg">Tidak ditemukan catatan pengguna dalam arsip.</p>
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

    {{-- Reusable Confirmation Modal --}}
    <div x-cloak x-show="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center">
        <div @click="if(!isProcessing) isModalOpen = false" class="absolute inset-0 bg-black/30"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        </div>

        <div class="relative z-10 bg-white border-2 border-ink max-w-md w-full mx-4" @click.stop
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

            <div class="px-6 py-4 border-b border-ink/20">
                <h3 class="font-serif italic font-bold text-ink text-lg" x-text="modalTitle"></h3>
            </div>
            <div class="px-6 py-6">
                <p class="text-sm text-ink/80 font-serif" x-html="modalMessage"></p>
            </div>
            <div class="px-6 py-4 border-t border-ink/20 flex gap-3 justify-end">
                <button type="button" @click="isModalOpen = false" :disabled="isProcessing"
                    class="px-4 py-2 border border-ink/30 text-ink text-sm font-mono font-bold hover:bg-ink/5 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    Batal
                </button>

                <button type="button" @click="handleModalConfirm()" 
                    :disabled="isProcessing"
                    :style="`background-color: ${modalButtonColor}; border-color: ${modalButtonColor};`"
                    class="px-4 py-2 border-2 text-white text-sm font-mono font-bold transition disabled:opacity-50 disabled:cursor-wait flex items-center">
                    
                    <span x-show="!isProcessing" x-text="modalButtonText"></span>
                    <span x-cloak x-show="isProcessing" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>