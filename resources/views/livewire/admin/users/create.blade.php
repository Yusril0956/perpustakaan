<div class="w-full max-w-4xl mx-auto py-12 px-4">
    {{-- Navigasi --}}
    <div class="mb-8">
        <a href="{{ route('admin.users.index') }}" wire:navigate
            class="text-xs font-mono uppercase tracking-widest text-ink font-bold flex items-center gap-2 group">
            <span class="group-hover:-translate-x-1 transition-transform">←</span> Kembali ke Daftar Personalia
        </a>
    </div>

    <div class="relative bg-white p-2 border-2 border-ink/20 shadow-2xl">
        <div class="border-[3px] border-ink p-10 md:p-14 relative bg-[#fdfbf7]">

            {{-- Header Form --}}
            <div class="text-center mb-16 border-b-2 border-ink/10 pb-10">
                <h2 class="text-4xl font-serif italic text-ink font-black mb-3">Registrasi Pengguna Baru</h2>
                <span
                    class="text-[11px] font-mono uppercase tracking-[0.4em] text-ink font-bold py-1 px-4 bg-ink/5 border border-ink/10">
                    Otoritas & Identitas Keanggotaan
                </span>
            </div>

            <form wire:submit="save" class="space-y-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-12">

                    <div class="space-y-10">
                        <x-forms.input label="01. Nama Lengkap Sesuai Identitas" wire:model="form.name"
                            placeholder="Masukkan nama..." />

                        <x-forms.input label="02. Alamat Surat Elektronik (Email)" wire:model="form.email" type="email"
                            placeholder="example@mail.com" />

                        <x-forms.input label="03. Password (abaikan jika tidak diubah)" wire:model="form.password"
                            type="password" placeholder="••••••••" />
                    </div>

                    {{-- Sisi Kanan: Detail & Otoritas --}}
                    <div class="space-y-10">
                        <div>
                            <label
                                class="block text-[12px] font-mono uppercase font-black tracking-widest text-ink mb-2">04.
                                Peran / Otoritas Sistem</label>
                            <select wire:model="form.role"
                                class="w-full bg-transparent border-0 border-b-2 border-ink/30 focus:border-ink focus:outline focus:ring-0 px-0 py-2 font-serif text-xl italic text-ink cursor-pointer">
                                <option value="">Tentukan Peran...</option>
                                <option value="admin">Administrator</option>
                                <option value="staff">Petugas Pustaka</option>
                                <option value="anggota">Anggota Terdaftar</option>
                            </select>
                            @error('form.role') <span
                                class="text-[10px] font-mono uppercase font-bold text-red-700 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <x-forms.input label="05. Nomor Telepon Aktif" wire:model="form.phone"
                            placeholder="08xxxxxxxxxx" />

                        {{-- Textarea Alamat --}}
                        <div>
                            <label
                                class="block text-[12px] font-mono uppercase font-black tracking-widest text-ink mb-2">06.
                                Domisili / Alamat Lengkap</label>
                            <textarea wire:model="form.address" rows="2"
                                class="w-full bg-transparent border-0 border-b-2 border-ink/30 focus:border-ink focus:ring-0 px-0 py-2 font-serif text-xl italic text-ink placeholder:text-ink/10"
                                placeholder="Tuliskan alamat..."></textarea>
                            @error('form.address') <span
                                class="text-[10px] font-mono uppercase font-bold text-red-700 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Bagian Bawah Form --}}
                <div
                    class="flex flex-col md:flex-row items-center justify-between pt-10 border-t-2 border-ink/10 gap-8">
                    <div class="max-w-xs text-left">
                        <p class="text-[11px] font-mono uppercase font-bold text-ink leading-relaxed">
                            Peringatan: Pastikan peran yang diberikan sesuai dengan tanggung jawab pengguna.
                        </p>
                    </div>

                    <x-ui.button variant="outline">
                        Daftarkan Pengguna &rarr;
                    </x-ui.button>
                </div>
            </form>

            <div
                class="absolute bottom-4 right-8 text-[40px] font-serif italic text-ink/[0.03] pointer-events-none select-none">
                Authorized Personnel Only
            </div>
        </div>
    </div>
</div>