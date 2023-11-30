@props(['questionnaire'])

@php($color = \Illuminate\Support\Arr::random(['#FAE7CD', '#FCDDCC', '#E5EBC0']))

<div class="p-1 mt-5 mx-auto bg-[#FAE7CD] shadow-lg overflow-hidden rounded-2xl relative">
    <div class="p-4">
        <!-- Titel -->
        <h2 class="text-2xl font-extrabold mb-3">{{ $questionnaire->name }}</h2>
        <!-- Beschreibung -->
        <p class=" font-thin  text-gray-700  mb-4 ">
            {{ $questionnaire->description }}
        </p>
        <!-- Button -->
        <a href="{{ route('questionnaire.index', ['questionnaire' => $questionnaire->id]) }}" class="bg-[#E1A24C] hover:bg-[#62b1a6] text-white font-bold py-2 px-4 rounded mt-4">
            Naar vragen
        </a>
    </div>
</div>