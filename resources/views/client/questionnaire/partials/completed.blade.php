<div class="flex flex-col h-full py-6">
    <div class="flex flex-1 flex-col justify-center text-center">
        <x-sticker/>
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