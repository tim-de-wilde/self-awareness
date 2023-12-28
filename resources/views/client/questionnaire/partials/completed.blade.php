<div class="flex flex-col h-full py-6 px-4">
    <div class="flex flex-1 flex-col text-center ">
        <div class="mx-auto">
            <x-sticker class="w-48 h-48"/>
        </div>
        <p class="text-xl pt-8">
            Super! Je hebt je vragenlijst voor vandaag ingevuld.
            Kom morgen terug om hem opnieuw in te vullen.
        </p>
    </div>

    <a href="{{ route('client.dashboard') }}" class="p-2 w-full text-white rounded-lg bg-sky-400 hover:bg-sky-300 text-lg inline-flex justify-center w-[200px]">
        Terug naar het overzicht
    </a>
</div>