<div>
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.books.index') }}" wire:navigate class="text-muted hover:underline italic">
                ← Kembali ke Rak
            </a>
            <h2 class="text-3xl font-bold text-ink italic">Pendaftaran Buku Baru</h2>
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
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-muted font-bold mb-2">Jumlah Stok
                            Fisik</label>
                        <input type="number" wire:model="form.total_stock" class="form-input text-lg font-mono">
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-widest text-muted font-bold mb-2">Ilustrasi
                            Sampul</label>
                        <div class="mt-2 flex items-center gap-4">
                            @if ($form->cover_image)
                                <img src="{{ $form->cover_image->temporaryUrl() }}" class="w-20 h-28 object-cover border">
                            @else
                                <div
                                    class="w-20 h-28 border-dashed border p-2 text-[10px] italic text-muted flex items-center justify-center text-center">
                                    Belum ada gambar
                                </div>
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
                </div>
            </div>

            <div class="mt-10 flex justify-end">
                <x-ui.button type="submit" variant="primary" class="w-full md:w-auto">
                    Simpan ke Inventaris
                </x-ui.button>
            </div>
        </form>
    </div>
</div>

<div class="col-span-1">
    <label class="text-sm text-muted">Cover Preview</label>
    <div class="mt-2">
        <img src="{{ $book?->cover_url ?? asset('images/book-placeholder.svg') }}" alt="cover preview"
            class="w-36 h-48 object-cover rounded border">
    </div>
</div>