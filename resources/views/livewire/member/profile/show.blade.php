<div x-data="{
    preview: null,
    uploading: false,
    progress: 0,
    toast: false,

    showToast() {
        this.toast = true
        setTimeout(() => this.toast = false, 2500)
    },
}" x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false"
    x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress"
    x-on:photo-saved.window="showToast()" x-on:photo-removed.window="showToast()" class="space-y-10 text-ink">

    <div class="border-b-2 border-ink pb-4">
        <h2 class="text-3xl font-bold italic font-serif">Profil Peminjam</h2>
        <p class="text-xs uppercase tracking-widest text-muted mt-1">Kartu Informasi & Riwayat</p>
    </div>

    @if(session('success'))
        <div x-show="toast" x-transition.opacity.duration.300ms
            class="fixed bottom-6 right-6 bg-ink text-white px-5 py-3 text-xs uppercase tracking-widest shadow-lg">

            ✔ Berhasil diperbarui
        </div>
    @endif

    <div class="paper-card p-6 md:p-8 border border-ink shadow-sm bg-surface">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="flex flex-col items-center flex-shrink-0 space-y-3">

                <div class="relative group">

                    <img x-transition.opacity.duration.500ms :src="preview ?? '{{ $user->profile_photo_url }}'"
                        class="w-32 h-40 object-cover border-2 border-ink transition" loading="lazy" alt="{{ $user->name }}">

                    <!-- Upload Hover -->
                    <label class="absolute inset-0 cursor-pointer">
                        <input type="file" wire:model="photo" class="hidden" accept="image/*"
                            @change="preview = URL.createObjectURL($event.target.files[0])">

                        <div class="absolute inset-0 bg-ink/80 flex flex-col items-center justify-center
                opacity-0 group-hover:opacity-100 transition">

                            <x-heroicon-o-arrow-up-tray class="w-6 h-6 text-white mb-1" />

                            <span class="text-[10px] text-white uppercase tracking-widest font-bold">
                                Ganti
                            </span>
                        </div>
                    </label>

                    <!-- Upload Progress -->
                    <div x-show="uploading"
                        class="absolute inset-0 bg-ink/90 flex flex-col items-center justify-center text-white text-xs font-bold">

                        <span x-text="progress + '%'"></span>

                        <div class="w-16 h-1 bg-white/30 mt-2">
                            <div class="h-full bg-white transition-all" :style="'width:'+progress+'%'"></div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-2">

                    <!-- SAVE -->
                    <button wire:click="savePhoto" :disabled="uploading || !preview"
                        class="text-xs border border-ink px-3 py-1 transition"
                        :class="uploading || !preview ? 'opacity-40 cursor-not-allowed' : 'hover:bg-ink hover:text-white'">
                        Simpan
                    </button>

                    <!-- DELETE -->
                    @if($user->profile_photo_path)
                        <button type="button"
                            onclick="if(confirm('Hapus foto profil Anda?\n\nTindakan ini tidak dapat dibatalkan.')) { Livewire.dispatch('remove-profile-photo'); }"
                            class="text-xs border border-ink px-3 py-1 hover:bg-ink hover:text-white transition">
                            Hapus
                        </button>
                    @endif
                </div>

                <div class="mt-2 flex flex-wrap justify-center gap-2">
                    @foreach($user->getRoleNames() as $role)
                        <span class="px-2 py-1 border border-ink text-xs font-bold uppercase tracking-widest">
                            {{ $role }}
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="flex-1 border-t md:border-t-0 md:border-l border-ink/30 pt-6 md:pt-0 md:pl-8 space-y-6">
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
                        <p class="font-serif text-lg">{{ $user->address ?: '—' }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-widest text-muted mb-1">Terdaftar Sejak</p>
                        <p class="font-mono text-sm">{{ $user->created_at->format('d/m/Y') }}</p>
                    </div>
                    @if ($user->verify)
                        <div>
                            <p class="text-xs uppercase tracking-widest text-muted mb-1">Status</p>
                            <p class="font-mono text-sm">Terverifikasi</p>
                        </div>
                    @else
                        <div>
                            <p class="text-xs uppercase tracking-widest text-muted mb-1">Status</p>
                            <p class="font-mono text-sm">Belum Terverifikasi</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>