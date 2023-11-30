@props([
    'user',
    'size'
])

<div {{ $attributes->merge(['class' => "inline-flex items-center justify-center rounded-full bg-gray-500 h-$size w-$size"]) }}>
    <span class="text-xl font-medium leading-none text-white uppercase">
        {{ $user->name[0] }}
    </span>
</div>