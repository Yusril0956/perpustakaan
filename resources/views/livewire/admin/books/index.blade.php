<div>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold italic text-ink">Manajemen Koleksi Buku</h2>
            <a href="{{ route('admin.books.create') }}"
                class="bg-coffee text-parchment-light px-6 py-2.5 rounded-sm shadow-[4px_4px_0px_#2c2420] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all duration-200 text-xs font-bold uppercase tracking-[0.2em] flex items-center gap-2">
                <x-heroicon-o-plus class="w-5 h-5" />
                Tambah
            </a>
        </div>

        <div class="paper-card p-4">
            <input wire:model.live.debounce.300ms="search" type="text"
                placeholder="Cari buku berdasarkan judul atau penulis..." class="form-input text-lg italic">
        </div>

        <div class="bg-surface shadow-sm border overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-background text-xs uppercase tracking-widest text-muted border-b">
                    <tr>
                        <th class="p-4">Sampul</th>
                        <th class="p-4">Informasi Buku</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Stok (Tersedia/Total)</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($books as $book)
                        <tr class="hover:bg-surface transition">
                            <td class="py-">
                                <img src="{{ $book->cover_url }}" alt="{{ $book->title }}" class="w-12 h-16 object-cover">
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-ink italic">{{ $book->title }}</div>
                                <div class="text-xs text-muted">{{ $book->author }}</div>
                            </td>
                            <td class="p-4 text-sm">{{ $book->category->name }}</td>
                            <td class="p-4 font-mono text-sm">
                                <span class="text-green-700">{{ $book->available_stock }}</span> / {{ $book->total_stock }}
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('admin.books.edit', $book) }}" wire:navigate
                                    class="text-sm italic text-muted hover:text-ink">Edit</a>
                                <button wire:click="delete({{ $book->id }})"
                                    wire:confirm="Apakah Anda yakin ingin menghapus buku ini?"
                                    class="text-sm italic text-muted hover:text-ink">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center italic text-muted">Belum ada koleksi buku yang
                                terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $books->links('components.ui.pagination') }}
        </div>
    </div>
</div>