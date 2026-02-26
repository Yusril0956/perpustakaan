<div>
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.users.index') }}" wire:navigate class="text-muted hover:underline italic">
                ← Kembali
            </a>
            <h2 class="text-3xl font-bold text-ink italic">Edit Pengguna</h2>
        </div>

        <form wire:submit="save" class="paper-card p-10 relative">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-muted font-bold mb-2">Nama
                            Lengkap</label>
                        <input type="text" wire:model="form.name" class="form-input text-lg italic">
                        @error('form.name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-muted font-bold mb-2">Email</label>
                        <input type="email" wire:model="form.email" class="form-input text-lg italic">
                        @error('form.email') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-muted font-bold mb-2">Password <span
                                class="text-xs text-muted">(Kosongkan jika tidak diubah)</span></label>
                        <input type="password" wire:model="form.password" class="form-input text-lg italic">
                        @error('form.password') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-muted font-bold mb-2">Role /
                            Peran</label>
                        <select wire:model="form.role" class="form-input text-lg italic">
                            <option value="">Pilih Role...</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                            <option value="anggota">Anggota</option>
                        </select>
                        @error('form.role') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-muted font-bold mb-2">Nomor
                            Telepon</label>
                        <input type="text" wire:model="form.phone" class="form-input text-lg italic"
                            placeholder="08xxxxxxxxxx">
                        @error('form.phone') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-muted font-bold mb-2">Alamat</label>
                        <textarea wire:model="form.address" rows="2" class="form-input text-lg italic"
                            placeholder="Alamat lengkap..."></textarea>
                        @error('form.address') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="mt-10 flex justify-end">
                <button type="submit"
                    class="px-4 py-2 text-xs uppercase tracking-widest text-coffee border border-sepia-edge/40 hover:bg-coffee hover:text-parchment-light transition-all duration-300 shadow-[3px_3px_0px_#d2b48c] active:shadow-none active:translate-x-[2px] active:translate-y-[2px]">
                    &larr; Perbarui
                </button>
            </div>
        </form>
    </div>
</div>