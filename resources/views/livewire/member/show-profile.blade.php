<div>
    <x-slot:header>
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-ink">Profil Saya</h2>
                <p class="text-muted mt-1">Meja Kerja Klasik - Perpustakaan Digital</p>
            </div>
            <x-heroicon-o-user-circle class="w-8 h-8 text-accent opacity-60" />
        </div>
    </x-slot:header>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Main Grid: 12 Columns -->
            <div class="grid grid-cols-12 gap-6">
                <!-- Left Column: Identity Card (Sticky) -->
                <div class="col-span-12 lg:col-span-4">
                    <div class="sticky top-24">
                        <livewire:member.profile.identity-card />
                    </div>
                </div>

                <!-- Right Column: Personal Shelf + Update Password -->
                <div class="col-span-12 lg:col-span-8 space-y-6">
                    <!-- Personal Shelf -->
                    <livewire:member.profile.personal-shelf />

                    <!-- Update Password Form -->
                    <livewire:member.profile.update-password-form />

                    <!-- Additional Info Section -->
                    <div class="paper-card p-6 space-y-4" style="border-left: 4px solid #6F4E37;">
                        <div class="flex items-center gap-3 mb-4">
                            <x-heroicon-o-information-circle class="w-5 h-5 text-accent" />
                            <h3 class="text-lg font-semibold text-ink">Informasi Akun</h3>
                        </div>

                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <!-- Email -->
                            <div class="p-3 rounded-sm"
                                style="background: linear-gradient(135deg, rgba(111, 78, 55, 0.03) 0%, rgba(139, 125, 115, 0.03) 100%);">
                                <p class="text-muted uppercase tracking-wide mb-1">Email</p>
                                <p class="font-semibold text-ink break-all">{{ auth()->user()->email }}</p>
                            </div>

                            <!-- Member ID -->
                            <div class="p-3 rounded-sm"
                                style="background: linear-gradient(135deg, rgba(111, 78, 55, 0.03) 0%, rgba(139, 125, 115, 0.03) 100%);">
                                <p class="text-muted uppercase tracking-wide mb-1">ID Anggota</p>
                                <p class="font-semibold text-ink">
                                    #{{ str_pad(auth()->user()->id, 6, '0', STR_PAD_LEFT) }}</p>
                            </div>

                            <!-- Phone -->
                            <div class="p-3 rounded-sm"
                                style="background: linear-gradient(135deg, rgba(111, 78, 55, 0.03) 0%, rgba(139, 125, 115, 0.03) 100%);">
                                <p class="text-muted uppercase tracking-wide mb-1">Telepon</p>
                                <p class="font-semibold text-ink">{{ auth()->user()->phone ?? '—' }}</p>
                            </div>

                            <!-- Address -->
                            <div class="p-3 rounded-sm"
                                style="background: linear-gradient(135deg, rgba(111, 78, 55, 0.03) 0%, rgba(139, 125, 115, 0.03) 100%);">
                                <p class="text-muted uppercase tracking-wide mb-1">Alamat</p>
                                <p class="font-semibold text-ink line-clamp-2">{{ auth()->user()->address ?? '—' }}</p>
                            </div>
                        </div>

                        <!-- Edit Info Link -->
                        <div class="pt-2 border-t border-muted/30">
                            <button class="btn-ghost w-full text-center inline-flex items-center justify-center gap-2">
                                <x-heroicon-o-pencil class="w-4 h-4" />
                                Edit Informasi Pribadi
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Vintage Element -->
            <div class="mt-12 text-center">
                <div class="flex items-center justify-center gap-2 text-muted/50">
                    <x-heroicon-o-book-open class="w-4 h-4" />
                    <span class="text-xs font-mono" style="letter-spacing: 1px;">Perpustakaan Digital © 2026</span>
                    <x-heroicon-o-book-open class="w-4 h-4" />
                </div>
            </div>
        </div>
    </div>

    @script
    <script>
        Livewire.on('photo-uploaded', () => {
            // Optional: Show success notification
        });

        Livewire.on('photo-deleted', () => {
            // Optional: Show success notification
        });

        Livewire.on('password-updated', () => {
            // Password form handles its own notification
        });
    </script>
    @endscript
</div>