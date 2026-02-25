@props(['icon', 'label', 'href', 'active' => false])

<a href="{{ $href }}" @class([
    'flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 group text-sm font-medium',
    'bg-coffee/10 text-coffee shadow-sm' => $active,
    'text-muted hover:text-ink hover:bg-background/40' => !$active
])>
    <span @class([
        'flex items-center justify-center transition-all duration-200',
        'text-coffee' => $active,
        'opacity-70 group-hover:opacity-100' => !$active
    ])>
        @if($icon === 'dashboard')
            <x-heroicon-o-squares-2x2 class="w-5 h-5" />
        @elseif($icon === 'book')
            <x-heroicon-o-book-open class="w-5 h-5" />
        @elseif($icon === 'users')
            <x-heroicon-o-users class="w-5 h-5" />
        @elseif($icon === 'clipboard')
            <x-heroicon-o-clipboard-document-list class="w-5 h-5" />
        @elseif($icon === 'clock')
            <x-heroicon-o-clock class="w-5 h-5" />
        @elseif($icon === 'bookmark')
            <x-heroicon-o-bookmark class="w-5 h-5" />
        @endif
    </span>

    <span class="flex-1 truncate">{{ $label }}</span>

    @if($active)
        <div class="w-1.5 h-1.5 rounded-full bg-coffee"></div>
    @endif
</a>