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
        @if($icon === 'dashboard')
            <x-heroicon-o-squares-2x2 class="w-5 h-5 opacity-70 group-hover:opacity-100 transition-opacity" />
        @elseif($icon === 'book')
            <x-heroicon-o-book-open class="w-5 h-5 opacity-70 group-hover:opacity-100 transition-opacity" />
        @elseif($icon === 'users')
            <x-heroicon-o-users class="w-5 h-5 opacity-70 group-hover:opacity-100 transition-opacity" />
        @elseif($icon === 'clipboard')
            <x-heroicon-o-clipboard-document-list class="w-5 h-5 opacity-70 group-hover:opacity-100 transition-opacity" />
        @elseif($icon === 'clock')
            <x-heroicon-o-clock class="w-5 h-5 opacity-70 group-hover:opacity-100 transition-opacity" />
        @elseif($icon === 'bookmark')
            <x-heroicon-o-bookmark class="w-5 h-5 opacity-70 group-hover:opacity-100 transition-opacity" />
        @endif
    </span>

    <span class="text-sm font-medium tracking-wide italic">{{ $label }}</span>
</a>