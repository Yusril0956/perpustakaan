<div>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold italic text-ink">Manajemen Koleksi Buku</h2>
            <button type="button" onclick="window.location.href='{{ route('admin.books.create') }}'"
                class="btn-primary">
                + Tambah Buku Baru
            </button>
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
                            <td class="p-4">
                                <img src="{{ $book->cover_image }}" class="w-12 h-16 object-cover">
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
                                <button class="text-sm italic text-muted hover:text-ink">Edit</button>
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
            {{ $books->links() }}
        </div>
    </div>
</div>