<div>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold italic text-ink">Manajemen Koleksi Buku</h2>
            <x-ui.button variant="primary" onclick="window.location.href='{{ route('admin.books.create') }}'">
                + Tambah Buku Baru
            </x-ui.button>
        </div>

        <x-ui.card class="p-4 border-dashed border-2">
            <input wire:model.live.debounce.300ms="search" type="text"
                placeholder="Cari buku berdasarkan judul atau penulis..."
                class="w-full bg-transparent border-b border-coffee/30 focus:border-coffee border-t-0 border-x-0 focus:ring-0 text-lg italic">
        </x-ui.card>

        <div class="bg-white/70 shadow-sm border border-sepia-edge/20 overflow-hidden">
            <table class="w-full text-left">
                <thead
                    class="bg-parchment-base/50 text-xs uppercase tracking-widest text-coffee border-b border-sepia-edge/20">
                    <tr>
                        <th class="p-4">Sampul</th>
                        <th class="p-4">Informasi Buku</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Stok (Tersedia/Total)</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sepia-edge/10">
                    @forelse($books as $book)
                        <tr class="hover:bg-parchment-light/30 transition">
                            <td class="p-4">
                                <img src="{{ $book->cover_image }}" class="w-12 h-16 object-cover shadow-sm sepia-[0.2]">
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-ink italic">{{ $book->title }}</div>
                                <div class="text-xs text-coffee">{{ $book->author }}</div>
                            </td>
                            <td class="p-4 text-sm">{{ $book->category->name }}</td>
                            <td class="p-4 font-mono text-sm">
                                <span class="text-green-700">{{ $book->available_stock }}</span> / {{ $book->total_stock }}
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <button class="text-indigo-600 hover:underline italic text-sm">Edit</button>
                                <button wire:click="delete({{ $book->id }})"
                                    wire:confirm="Apakah Anda yakin ingin menghapus buku ini?"
                                    class="text-red-600 hover:underline italic text-sm">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center italic text-coffee">Belum ada koleksi buku yang
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