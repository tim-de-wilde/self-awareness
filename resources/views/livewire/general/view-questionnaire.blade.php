<div class="relative h-full">
    @if($isFinished)
        <div class="flex flex-col h-full py-6">
            <div class="flex flex-1 flex-col justify-center text-center">
                <img src="{{ asset('images/stickers/fox.png') }}" alt="Sticker">
                <p class="text-lg font-semibold">
                    {{ __('You\'ve completed this questionnaire for today. Come back tomorrow for a new one!') }}
                </p>
            </div>

            <div class="flex justify-center">
                <a href="{{ route('client.dashboard') }}" class="p-2 rounded-lg bg-sky-400 text-lg inline-flex justify-center w-[200px]">
                    {{ __('Back to questions') }}
                </a>
            </div>
        </div>
    @else
        <div class="h-full">
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
                            x-ref="slider"
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
    @endif
</div>