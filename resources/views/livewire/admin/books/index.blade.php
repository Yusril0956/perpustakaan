<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold italic text-ink">Manajemen Koleksi Buku</h2>
        <x-ui.button iconLeft="heroicon-o-plus" href="{{ route('admin.books.create') }}" wire:navigate size="sm">
            Tambah
        </x-ui.button>
    </div>

    <div class="paper-card p-4">
        <input wire:model.live.debounce.300ms="search" type="text"
            placeholder="Cari buku berdasarkan judul atau penulis..." class="form-input text-lg italic">
    </div>

    <div class="bg-surface border-2 border-ink overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-background text-xs uppercase tracking-widest border-b-2 border-ink">
                <tr>
                    <th class="p-4 border-r border-ink">Sampul</th>
                    <th class="p-4 border-r border-ink">Informasi Buku</th>
                    <th class="p-4 border-r border-ink">Kategori</th>
                    <th class="p-4 border-r border-ink">Stok (Tersedia/Total)</th>
                    <th class="p-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-ink text-ink">
                @forelse($books as $book)
                    <tr class="hover:bg-background transition-colors group">
                        <td class="p-4 border-r border-ink align-middle">
                            <div class="h-full flex items-center justify-center">
                                <img src="{{ $book->cover_url }}" alt="{{ $book->title }}"
                                    class="h-full max-h-24 w-auto object-contain" loading="lazy">
                            </div>
                        </td>
                        <td class="p-4 border-r border-ink">
                            <div class="font-bold text-ink italic">{{ $book->title }}</div>
                            <div class="text-xs text-muted">{{ $book->author }}</div>
                        </td>
                        <td class="p-4 border-r border-ink text-sm">{{ $book->category->name }}</td>
                        <td class="p-4 border-r border-ink font-mono text-sm">
                            <span class="text-green-700">{{ $book->available_stock }}</span> / {{ $book->total_stock }}
                        </td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('admin.books.edit', $book) }}" wire:navigate
                                class="text-sm italic text-muted hover:text-ink">Edit</a>
                            <button
                                onclick="if(confirm('Hapus koleksi {{ addslashes($book->title) }} dari pustaka?\n\nTindakan ini tidak dapat dibatalkan.')) { Livewire.dispatch('delete-book', { id: {{ $book->id }} }); }"
                                class="text-sm italic text-red-800 hover:text-red-600">Hapus</button>
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