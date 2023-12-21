@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'focus:ring-0 border-0 focus:border-transparent rounded-full shadow-sm']) !!}>
