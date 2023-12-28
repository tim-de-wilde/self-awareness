<x-app-layout role="client">
    <div class="h-full bg-[#E4EFEF] overflow-auto">
        <div class="h-full py-2 max-w-4xl mx-auto px-4">
            <x-client-dropdown :client="$currentUser"/>

            @forelse($dataGroup as $group)
                <x-questionnaire-overview-card
                    :color="$group['color']"
                    :questionnaire="$group['questionnaire']"
                    :link="route('questionnaire.index', ['questionnaire' => $group['questionnaire']->id, 'treatmentPlan' => $treatmentPlan])"
                >
                    <x-sticker
                        :asset="$group['sticker']"
                        :show="$group['questionnaire']->isCompletedForUser($currentUser, $treatmentPlan)"
                        class="w-24 h-24"/>
                </x-questionnaire-overview-card>
            @empty
                <span class="italic">
                    Er zijn momenteel geen vragenlijsten beschikbaar.
                </span>
            @endforelse
        </div>
    </div>
</x-app-layout>