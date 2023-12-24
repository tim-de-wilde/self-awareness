@props([
    'show' => true,
    'image' => asset('images/stickers/dino.png'),
])

<div x-data="{ show: false }" x-init="$nextTick(() => show = @js($show))">
    <div
        x-show="show"
        {{ $attributes->merge(['class' => 'w-24 h-24']) }}
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="scale-50"
        x-transition:enter-end="scale-100"
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="scale-100"
        x-transition:leave-end="scale-50">
        <img src="{{ $image }}" alt="Sticker">
    </div>
</div>