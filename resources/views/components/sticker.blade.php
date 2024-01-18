@php
    use App\Enums\Sticker;
@endphp

@props([
    'show' => true,
    'asset' => Sticker::DINO,
])

@php
    $assets = [
        'dino' => asset('images/stickers/dino.png'),
        'otter' => asset('images/stickers/otter.png'),
        'panda' => asset('images/stickers/panda.png'),
        'shark' => asset('images/stickers.shark.png'),
    ]
@endphp

<div x-data="{ show: false }" x-init="$nextTick(() => show = @js($show))">
    <div
        {{ $attributes->merge(['class' => '']) }}
        x-show="show"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="scale-50"
        x-transition:enter-end="scale-100"
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="scale-100"
        x-transition:leave-end="scale-50"
    >
        <img src="{{ $asset->image() }}" alt="Sticker">
    </div>
</div>