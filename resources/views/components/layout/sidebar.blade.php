<aside class="fixed left-0 top-0 h-screen w-64 bg-surface text-ink shadow-sm z-50 border-r">
    <div class="p-6 border-b flex flex-col items-center">
        <div class="w-16 h-16 bg-background rounded-full flex items-center justify-center mb-3">
            <svg class="w-10 h-10 text-ink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                </path>
            </svg>
        </div>
        <h2 class="font-bold italic text-xl tracking-wide">Pustaka <span class="text-muted">Arsip</span></h2>
    </div>

    <nav class="mt-8 px-4 space-y-4">
        <div class="text-[10px] uppercase tracking-[0.3em] text-muted mb-2 px-4 italic">Menu Utama</div>

        <x-layout.sidebar-item icon="dashboard" label="Meja Kerja" href="{{ route('dashboard') }}"
            :active="request()->routeIs('dashboard')" />
        <x-layout.sidebar-item icon="book" label="Buku" href="{{ route('admin.books.index') }}"
            :active="request()->routeIs('admin.books.index')" />

        @role('admin')
        <div class="pt-6 text-[10px] uppercase tracking-[0.3em] text-muted mb-2 px-4 italic">Administrasi</div>
        <x-layout.sidebar-item icon="users" label="Data Anggota" href="/users" />
        <x-layout.sidebar-item icon="clipboard" label="Verifikasi Pinjam" href="/verify" />
        @endrole

        @can('view own transactions')
            <div class="pt-6 text-[10px] uppercase tracking-[0.3em] text-muted mb-2 px-4 italic">Aktivitas</div>
            <x-layout.sidebar-item icon="clock" label="Pinjaman Saya" href="/my-loans" />
            <x-layout.sidebar-item icon="bookmark" label="Koleksi" href="/favorites" />
        @endcan
    </nav>

    <div class="absolute bottom-0 w-full p-6 border-t bg-surface">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="flex items-center text-sm text-muted hover:text-ink transition group w-full">
                <span class="p-2 bg-background rounded mr-3 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
                Logout
            </button>
        </form>
    </div>
</aside>