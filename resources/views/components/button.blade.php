<button {{ $attributes->merge(['type' => 'submit', 'class' => 'group relative px-10 py-4 bg-ink text-[#fcfaf5] font-mono text-sm font-black uppercase tracking-[0.3em] hover:bg-[#1a1a1a] transition-all active:translate-y-1 shadow-[6px_6px_0px_rgba(44,36,32,0.2)] hover:shadow-none']) }}>
    <span class="relative z-10">{{ $slot }}</span>
</button>