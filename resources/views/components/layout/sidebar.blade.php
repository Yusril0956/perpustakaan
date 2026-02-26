<aside class="fixed left-0 top-0 h-screen w-64 bg-surface text-ink shadow-lg z-50 border-r border-ink/5 flex flex-col overflow-hidden">
    <!-- Header & Profile Card -->
    <div class="flex-shrink-0 p-6 border-b border-ink/10">
        <!-- Logo Section -->
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 bg-gradient-to-br from-coffee to-coffee/80 rounded-lg flex items-center justify-center shadow-md">
                <svg class="w-6 h-6 text-parchment-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
            </div>
            <div>
                <h2 class="font-bold text-sm tracking-wide">Pustaka</h2>
                <p class="text-xs text-muted font-medium">Arsip Digital</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 overflow-y-auto px-3 py-6 space-y-1">
        <!-- Main Menu -->
        <div class="px-3 mb-2">
            <p class="text-xs font-bold uppercase tracking-widest text-muted/60">Menu</p>
        </div>
        <x-layout.sidebar-item icon="home" label="Home" href="{{ route('home') }}"
            :active="request()->routeIs('home')" />
        <x-layout.sidebar-item icon="dashboard" label="Dashboard" href="{{ route('dashboard') }}"
            :active="request()->routeIs('dashboard')" />

        @role('admin')
            <!-- Admin Section -->
            <div class="px-3 mt-6 mb-2">
                <p class="text-xs font-bold uppercase tracking-widest text-muted/60">Katalog</p>
            </div>
            <x-layout.sidebar-item icon="book" label="Kelola Buku" href="{{ route('admin.books.index') }}"
                :active="request()->routeIs('admin.books.index', 'admin.books.create')" />

            <div class="px-3 mt-6 mb-2">
                <p class="text-xs font-bold uppercase tracking-widest text-muted/60">Manajemen</p>
            </div>
            <x-layout.sidebar-item icon="users" label="Data Anggota" href="{{ route('admin.users.index') }}"
                :active="request()->routeIs('admin.users.index')" />
            <x-layout.sidebar-item icon="clipboard" label="Validasi Pinjaman" href="{{ route('admin.loans.validation') }}"
                :active="request()->routeIs('admin.loans.validation')" />
        @else
            <!-- Member Section -->
            <div class="px-3 mt-6 mb-2">
                <p class="text-xs font-bold uppercase tracking-widest text-muted/60">Jelajahi</p>
            </div>
            <x-layout.sidebar-item icon="book" label="Explore" href="{{ route('member.categories.index') }}"
                :active="request()->routeIs('member.categories.index')" />

            <div class="px-3 mt-6 mb-2">
                <p class="text-xs font-bold uppercase tracking-widest text-muted/60">Aktivitas</p>
            </div>
            <x-layout.sidebar-item icon="clock" label="Pinjaman Aktif" href="{{ route('member.loans.index') }}"
                :active="request()->routeIs('member.loans.index')" />
            <x-layout.sidebar-item icon="bookmark" label="Ingin Dibaca" href="{{ route('member.wishlist.index') }}"
                :active="request()->routeIs('member.wishlist.index')" />
        @endrole
    </nav>

    <!-- Footer -->
    <div class="flex-shrink-0 border-t border-ink/10 bg-gradient-to-t from-background/50 to-transparent p-3 space-y-2">
        <a href="{{ route('profile.show') }}" 
            class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-background/60 text-muted hover:text-ink group">
            <svg class="w-4 h-4 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span>Profil Saya</span>
        </a>

        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button 
                class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-red-50 text-muted hover:text-red-600 group">
                <svg class="w-4 h-4 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>