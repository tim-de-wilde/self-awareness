@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 bg-white"']) }}>
    {{ $value ?? $slot }}
</label>
