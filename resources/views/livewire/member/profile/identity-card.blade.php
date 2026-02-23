<div class="flex flex-col gap-6">
    <!-- Kartu Anggota Header -->
    <div class="relative group">
        <div class="absolute -top-4 -left-2 w-12 h-12 rotate-45" style="background: linear-gradient(135deg, rgba(111, 78, 55, 0.15) 0%, rgba(111, 78, 55, 0) 100%); border: 2px solid #6F4E37; border-radius: 2px;" title="Paperclip"></div>

        <!-- Card Container -->
        <div class="paper-card p-6 space-y-4" style="background: linear-gradient(135deg, #FBF8F3 0%, #F9F5F0 100%); border-left: 4px solid #6F4E37;">
            <!-- Photo Frame -->
            <div class="flex justify-center mb-4">
                <div class="relative w-32 h-40 rounded-sm overflow-hidden" style="background: linear-gradient(135deg, #F6F2EA 0%, #FBF8F3 100%); border: 3px solid #8B7D73; box-shadow: inset 0 0 0 2px #D4CCC0, -2px 2px 8px rgba(44, 38, 34, 0.15);">
                    <!-- Vintage Photo Frame Effect -->
                    <div class="absolute inset-0 bg-linear-to-b from-white/5 to-transparent pointer-events-none"></div>

                    <!-- Photo -->
                    @if ($photo)
                        <img src="{{ $photo->temporaryUrl() }}" alt="Photo Preview" class="w-full h-full object-cover" style="filter: sepia(0.15) brightness(1.05);">
                    @else
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover" style="filter: sepia(0.15) brightness(1.05);">
                    @endif

                    <!-- Tape Effect at Top -->
                    <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-20 h-6 rounded-sm" style="background: repeating-linear-gradient(45deg, #F4E4D4 0px, #F4E4D4 1px, #F8EEE8 1px, #F8EEE8 3px); box-shadow: 0 2px 4px rgba(0,0,0,0.1); opacity: 0.7;"></div>
                </div>
            </div>

            <!-- Member Info -->
            <div class="text-center space-y-2">
                <h3 class="text-lg font-semibold text-ink" style="letter-spacing: 0.5px;">{{ auth()->user()->name }}</h3>
                <p class="text-sm text-muted">{{ auth()->user()->email }}</p>
                @if (auth()->user()->phone)
                    <p class="text-sm text-muted">{{ auth()->user()->phone }}</p>
                @endif
            </div>

            <!-- Divider -->
            <div class="border-t border-muted/30 my-4"></div>

            <!-- Member Details -->
            <div class="space-y-3 text-sm">
                <div class="flex items-center gap-3">
                    <x-heroicon-o-user class="w-4 h-4 text-accent" />
                    <span class="text-muted">{{ auth()->user()->id }}</span>
                </div>
                <div class="flex items-center gap-3">
                    <x-heroicon-o-map-pin class="w-4 h-4 text-accent" />
                    <span class="text-muted truncate">{{ auth()->user()->address ?? 'Belum diisi' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Photo Section -->
    <form wire:submit="uploadPhoto" class="space-y-3">
        <div class="relative">
            <input 
                type="file" 
                wire:model="photo" 
                accept="image/*"
                class="form-input"
                placeholder="Pilih foto profil"
            >
            @error('photo')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2">
            @if ($photo || auth()->user()->profile_photo_path)
                <button 
                    type="submit" 
                    class="btn-primary flex-1 flex items-center justify-center gap-2"
                    @if (!$photo && !auth()->user()->profile_photo_path) disabled @endif
                >
                    <x-heroicon-o-arrow-up-tray class="w-4 h-4" />
                    Unggah Foto
                </button>
                @if (auth()->user()->profile_photo_path && !$photo)
                    <button 
                        type="button"
                        wire:click="deletePhoto"
                        wire:confirm="Hapus foto profil?"
                        class="btn-ghost flex-1 flex items-center justify-center gap-2"
                    >
                        <x-heroicon-o-trash class="w-4 h-4" />
                        Hapus
                    </button>
                @endif
            @else
                <button 
                    type="submit" 
                    disabled
                    class="btn-primary flex-1 flex items-center justify-center gap-2 opacity-50 cursor-not-allowed"
                >
                    <x-heroicon-o-arrow-up-tray class="w-4 h-4" />
                    Unggah Foto
                </button>
            @endif
        </div>
    </form>

    <!-- Vintage Stamp -->
    <div class="flex justify-center opacity-60">
        <div class="text-center text-xs text-muted font-mono" style="transform: rotate(-15deg); letter-spacing: 1px;">
            <div style="border: 2px solid currentColor; padding: 2px 6px; display: inline-block;">VERIFIED</div>
            <p class="text-xs mt-1" style="letter-spacing: 2px;">MEMBER</p>
        </div>
    </div>
</div>
