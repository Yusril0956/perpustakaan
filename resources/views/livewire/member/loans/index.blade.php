<div class="p-6">
    <div class="max-w-7xl mx-auto">
        <div class="bg-surface rounded-lg shadow-sm border border-muted p-8 text-center">
            <svg class="w-16 h-16 mx-auto text-muted mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                </path>
            </svg>
            <h2 class="text-xl font-bold italic mb-2">Arsip Pinjaman Saya</h2>
            <p class="text-muted italic">Daftar buku yang sedang Anda pinjam akan muncul di sini.</p>

            @can('view own transactions')
                <div class="mt-8 p-4 bg-background rounded border border-dashed border-muted max-w-md mx-auto">
                    <span class="text-sm text-muted italic">Belum ada transaksi pinjaman aktif.</span>
                </div>
            @endcan
        </div>
    </div>
</div>