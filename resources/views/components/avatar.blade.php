@props([
    'user',
    'size' => 12
])

<span class="inline-flex h-{{ $size }} w-{{ $size }} items-center justify-center rounded-full bg-gray-500">
    <span class="text-xl font-medium leading-none text-white uppercase">
        {{ $user->name[0] }}
    </span>
</span>