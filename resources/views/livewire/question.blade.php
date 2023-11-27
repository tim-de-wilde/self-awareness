<div class="relative h-full">
    <div class="px-2 py-4 flex flex-col h-full">
        <div class="text-center flex-1 flex flex-col justify-center">
            <h1 class="text-2xl font-semibold">{{ $title }}</h1>
            <p class="mt-2">{{ $description }}</p>
        </div>
        <div class="flex justify-center pt-4">
            <img
              src="{{ $imgLoc }}"
              class="w-80 object-contain"
              alt="">
        </div>
        <div>
            <input
              wire:model="currentValue"
              type="range"
              min="1"
              max="100"
              value="50"
              class="w-full">
        </div>
    </div>

    {{-- Buttons for previous and next question --}}
    <div class="absolute top-1/2 right-0">
        <button wire:click="next" type="button">
            <x-heroicon-o-chevron-right class="w-10 h-10"/>
        </button>
    </div>

    <div class="absolute top-1/2 left-0">
        <button wire:click="back" type="button">
            <x-heroicon-o-chevron-left class="w-10 h-10"/>
        </button>
    </div>
</div>
