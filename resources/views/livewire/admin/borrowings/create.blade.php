<div class="w-full max-w-4xl mx-auto py-12 px-4">
    <div class="mb-8">
        <a href="{{ route('admin.borrowings.index') }}" wire:navigate
            class="text-xs font-mono uppercase tracking-widest text-ink font-bold flex items-center gap-2 group">
            <span class="group-hover:-translate-x-1 transition-transform">←</span> Kembali ke Peminjaman
        </a>
    </div>

    <div class="relative bg-white p-2 border-2 border-ink/20 shadow-2xl">
        <div class="border-[3px] border-ink p-10 md:p-14 relative bg-[#fdfbf7]">

            {{-- Header --}}
            <div class="text-center mb-16 border-b-2 border-ink/10 pb-10">
                <h2 class="text-4xl font-serif italic text-ink font-black mb-3">Peminjaman Buku Baru</h2>
                <span
                    class="text-[11px] font-mono uppercase tracking-[0.4em] text-ink font-bold py-1 px-4 bg-ink/5 border border-ink/10">
                    Formulir Pinjam Antar Rak
                </span>
            </div>

            <form wire:submit="save" class="space-y-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-12">

                    {{-- Kolom Kiri --}}
                    <div class="space-y-10">
                        <div>
                            <label
                                class="block text-[12px] font-mono uppercase font-black tracking-widest text-ink mb-2">
                                01. Pilih Anggota
                            </label>
                            <select wire:model="user_id"
                                class="w-full bg-transparent border-0 border-b-2 border-ink/30 focus:border-ink focus:outline-none focus:ring-0 px-0 py-2 font-serif text-xl italic text-ink cursor-pointer">
                                <option value="">Pilih Anggota...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span
                                    class="text-[10px] font-mono uppercase font-bold text-red-700 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label
                                class="block text-[12px] font-mono uppercase font-black tracking-widest text-ink mb-2">
                                03. Tanggal Peminjaman
                            </label>
                            <input type="date" wire:model="borrowed_at"
                                class="w-full bg-transparent border-0 border-b-2 border-ink/30 focus:border-ink focus:outline-none focus:ring-0 px-0 py-2 font-serif text-xl italic text-ink">
                            @error('borrowed_at')
                                <span
                                    class="text-[10px] font-mono uppercase font-bold text-red-700 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="space-y-10">
                        <div>
                            <label
                                class="block text-[12px] font-mono uppercase font-black tracking-widest text-ink mb-2">
                                02. Pilih Buku
                            </label>
                            <select wire:model="book_id"
                                class="w-full bg-transparent border-0 border-b-2 border-ink/30 focus:border-ink focus:outline-none focus:ring-0 px-0 py-2 font-serif text-xl italic text-ink cursor-pointer">
                                <option value="">Pilih Buku...</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }} ({{ $book->author }})</option>
                                @endforeach
                            </select>
                            @error('book_id')
                                <span
                                    class="text-[10px] font-mono uppercase font-bold text-red-700 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label
                                class="block text-[12px] font-mono uppercase font-black tracking-widest text-ink mb-2">
                                04. Tanggal Jatuh Tempo
                            </label>
                            <input type="date" wire:model="due_at"
                                class="w-full bg-transparent border-0 border-b-2 border-ink/30 focus:border-ink focus:outline-none focus:ring-0 px-0 py-2 font-serif text-xl italic text-ink">
                            @error('due_at')
                                <span
                                    class="text-[10px] font-mono uppercase font-bold text-red-700 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                {{-- Action Area --}}
                <div
                    class="flex flex-col md:flex-row items-center justify-between pt-10 border-t-2 border-ink/10 gap-8">
                    <div class="max-w-xs">
                        <p class="text-[11px] font-mono uppercase font-bold text-ink leading-relaxed">
                            Pastikan anggota dan buku yang dipilih sudah benar.
                        </p>
                    </div>
                    <x-ui.button type="submit">
                        [✓] Simpan Peminjaman
                    </x-ui.button>
                </div>
            </form>
        </div>
    </div>
</div>