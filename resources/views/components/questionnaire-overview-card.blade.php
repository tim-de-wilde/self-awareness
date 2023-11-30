@props(['questionnaire', 'color'])

<div class="p-1 mt-5 mx-auto bg-{{$color}}-400 shadow-lg overflow-hidden rounded-2xl relative">
    <div class="p-4">
        <!-- Titel -->
        <h2 class="text-2xl font-extrabold mb-3">{{ $questionnaire->name }}</h2>
        <!-- Beschreibung -->
        <p class="font-thin  text-gray-700  mb-4 ">
            {{ $questionnaire->description }}
        </p>

        <!-- Button -->
        <a href="{{ route('questionnaire.index', ['questionnaire' => $questionnaire->id]) }}" class="bg-{{ $color }}-500 hover:bg-{{ $color }}-300 text-white font-bold py-2 px-4 rounded mt-4">
            Naar vragen
        </a>
    </div>
</div>