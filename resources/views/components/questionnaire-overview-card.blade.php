@props(['questionnaire', 'color', 'link'])

@php($colors = [
    'orange' => ['#FAE7CD', '#E1A24C'],
    'red' => ['#FCDDCC', '#FFA26F'],
    'green' => ['#E5EBC0', '#C1CE73'],
])

<div class="bg-[{{ $colors[$color][0] }}] p-1 mt-5 mx-auto shadow-sm rounded-2xl relative">
    <div class="p-4">
        <h2 class="text-2xl font-extrabold mb-3">{{ $questionnaire->name }}</h2>

        <p class="font-thin  text-gray-700  mb-4 ">
            {{ $questionnaire->description }}
        </p>

        <a href="{{ $link }}" class="bg-[{{ $colors[$color][1] }}] text-white font-bold py-2 px-4 rounded mt-4">
            Naar vragen
        </a>
    </div>

    @if(isset($slot))
        <div class="absolute bottom-0 right-0 p-2">
            {{ $slot }}
        </div>
    @endif
</div>