@props(['icon', 'label', 'href', 'active' => false])

<a href="{{ $href }}" @class([
    'flex items-center px-4 py-3 rounded-sm transition-all duration-300 group relative overflow-hidden',
    'bg-background text-ink font-semibold' => $active,
    'text-muted hover:text-ink hover:bg-surface' => !$active
])>
    @if($active)
        <div class="absolute left-0 top-0 h-full w-1 bg-ink"></div>
    @endif

    <span class="mr-3">
        <svg class="w-5 h-5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            @if($icon === 'dashboard')
                <path
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
            stroke-width="2"></path> @endif
            @if($icon === 'book')
                <path
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"
            stroke-width="2"></path> @endif
        </svg>
    </span>

    <span class="text-sm font-medium tracking-wide italic">{{ $label }}</span>
</a>