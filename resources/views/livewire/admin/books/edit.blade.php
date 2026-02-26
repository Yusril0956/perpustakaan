<div>
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.books.index') }}" wire:navigate class="text-muted hover:underline italic">
                ← Kembali ke Rak
            </a>
            <h2 class="text-3xl font-bold text-ink italic">Edit Informasi Buku</h2>
        </div>

        <form wire:submit="save" class="paper-card p-10 relative">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-muted font-bold mb-2">Judul
                            Buku</label>
                        <input type="text" wire:model="form.title" class="form-input text-lg italic">
                        @error('form.title') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-muted font-bold mb-2">Penulis /
                            Pengarang</label>
                        <input type="text" wire:model="form.author" class="form-input text-lg italic">
                        @error('form.author') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-muted font-bold mb-2">ISBN <span
                                class="text-xs text-muted">(Opsional)</span></label>
                        <input type="text" wire:model="form.isbn" class="form-input text-lg italic">
                        @error('form.isbn') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-muted font-bold mb-2">Kategori
                            Koleksi</label>
                        <select wire:model="form.category_id" class="form-input text-lg italic">
                            <option value="">Pilih Rak...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('form.category_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-muted font-bold mb-2">Jumlah Stok
                            Fisik</label>
                        <input type="number" wire:model="form.total_stock" class="form-input text-lg font-mono">
                        @error('form.total_stock') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-muted font-bold mb-2">Ilustrasi
                            Sampul</label>
                        <div class="mt-2 flex items-center gap-4">
                            @if ($form->cover_image)
                                <img src="{{ $form->cover_image->temporaryUrl() }}" class="w-20 h-28 object-cover border">
                            @else
                                <img src="{{ $form->book->cover_url }}" class="w-20 h-28 object-cover border">
                            @endif
                            <input type="file" wire:model="form.cover_image" class="text-xs text-muted">
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs uppercase tracking-widest text-muted font-bold mb-2">Sinopsis / Catatan
                        Pustakawan</label>
                    <textarea wire:model="form.description" rows="4"
                        class="form-input p-4 italic rounded-sm"></textarea>
                    @error('form.description') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
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