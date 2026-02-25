<div class="p-6">
    <div class="max-w-7xl mx-auto">
        <div class="bg-surface rounded-lg shadow-sm border border-muted p-8 text-center">
            <svg class="w-16 h-16 mx-auto text-muted mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
            <h2 class="text-xl font-bold italic mb-2">Validasi Pinjam</h2>
            <p class="text-muted italic">Permintaan pinjaman buku yang perlu diverifikasi akan muncul di sini.</p>

            @can('manage transactions')
                <div class="mt-8 p-4 bg-background rounded border border-dashed border-muted max-w-md mx-auto">
                    <span class="text-sm text-muted italic">Belum ada permintaan pinjaman yang perlu diverifikasi.</span>
                </div>
            @endcan
        </div>
    </div>
</div>