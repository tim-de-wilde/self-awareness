<x-app-layout role="client">
    <div class="h-full bg-[#E4EFEF] overflow-auto">
        <div class="h-full py-2 max-w-4xl mx-auto px-4">
            <x-client-dropdown :client="$currentUser"/>

            @forelse($questionnaireColorGroup as $group)
                <x-questionnaire-overview-card
                    :color="$group['color']"
                    :questionnaire="$group['questionnaire']"
                >
                    <x-sticker/>
                </x-questionnaire-overview-card>
            @empty
                <span class="italic">
                    Er zijn momenteel geen vragenlijsten beschikbaar.
                </span>
            @endforelse
        </div>
    </div>
</x-app-layout>