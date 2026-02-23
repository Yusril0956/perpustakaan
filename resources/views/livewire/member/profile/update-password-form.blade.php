<div class="paper-card p-6 space-y-4" style="border-left: 4px solid #6F4E37;">
    <!-- Header -->
    <div class="flex items-center gap-3 mb-4">
        <x-heroicon-o-lock-closed class="w-5 h-5 text-accent" />
        <h3 class="text-lg font-semibold text-ink">Ubah Kata Sandi</h3>
    </div>

    @if ($success)
        <div class="p-3 rounded bg-green-50 border border-green-200 flex items-center gap-2">
            <x-heroicon-o-check-circle class="w-5 h-5 text-green-600" />
            <p class="text-sm text-green-700">Kata sandi berhasil diubah!</p>
        </div>
    @endif

    <form wire:submit="updatePassword" class="space-y-4">
        <!-- Current Password -->
        <div>
            <label for="current_password" class="block text-sm font-medium text-ink mb-1">Kata Sandi Saat Ini</label>
            <input 
                type="password" 
                id="current_password"
                wire:model="current_password"
                @blur="$wire.validate('current_password')"
                class="form-input"
                placeholder="Masukkan kata sandi saat ini"
            >
            @error('current_password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-ink mb-1">Kata Sandi Baru</label>
            <input 
                type="password" 
                id="password"
                wire:model="password"
                @blur="$wire.validate('password')"
                class="form-input"
                placeholder="Minimal 8 karakter"
            >
            @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-ink mb-1">Konfirmasi Kata Sandi</label>
            <input 
                type="password" 
                id="password_confirmation"
                wire:model="password_confirmation"
                @blur="$wire.validate('password_confirmation')"
                class="form-input"
                placeholder="Ulangi kata sandi baru"
            >
            @error('password_confirmation')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="btn-primary w-full flex items-center justify-center gap-2">
                <x-heroicon-o-arrow-path class="w-4 h-4" />
                Perbarui Kata Sandi
            </button>
        </div>
    </form>

    <!-- Security Tips -->
    <div class="mt-4 p-3 rounded-sm" style="background: linear-gradient(135deg, rgba(111, 78, 55, 0.05) 0%, rgba(139, 125, 115, 0.03) 100%);">
        <p class="text-xs font-medium text-muted mb-2 uppercase tracking-wide">💡 Tips Keamanan</p>
        <ul class="text-xs text-muted space-y-1 list-disc list-inside">
            <li>Gunakan kombinasi huruf besar, kecil, angka, dan simbol</li>
            <li>Jangan gunakan nama atau tanggal lahir</li>
            <li>Ubah kata sandi secara berkala untuk keamanan maksimal</li>
        </ul>
    </div>
</div>
