<div class="p-6">
    <div class="max-w-7xl mx-auto">
        <div class="bg-surface rounded-lg shadow-sm border border-muted p-8 text-center">
            <svg class="w-16 h-16 mx-auto text-muted mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z">
                </path>
            </svg>
            <h2 class="text-xl font-bold italic mb-2">Buku Disimpan</h2>
            <p class="text-muted italic">Koleksi buku favorit Anda akan muncul di sini.</p>

            @can('borrow books')
                <div class="mt-8 p-4 bg-background rounded border border-dashed border-muted max-w-md mx-auto">
                    <span class="text-sm text-muted italic">Belum ada buku yang disimpan.</span>
                </div>
            @endcan
        </div>
    </div>
</div>
