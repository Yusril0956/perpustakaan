@props(['disabled' => false, 'label' => '', 'type' => 'text'])

<div>
    @if($label)
        <label class="block text-[12px] font-mono uppercase font-black tracking-widest text-ink mb-2">
            {{ $label }}
        </label>
    @endif
    <input {{ $disabled ? 'disabled' : '' }} type="{{ $type }}" {!! $attributes->merge(['class' => 'w-full bg-transparent border-0 border-b-2 border-ink/30 focus:border-ink focus:outline-none focus:ring-0 px-0 py-2 font-serif text-xl italic text-ink placeholder:text-ink/20 transition-all']) !!}>

    @error($attributes->wire('model')->value())
        <span class="text-[10px] font-mono uppercase font-bold text-red-700 mt-1 block">{{ $message }}</span>
    @enderror
</div>