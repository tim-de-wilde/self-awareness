<x-app-layout role="client" back="{{ route('client.dashboard') }}">
    @livewire('general.view-questionnaire', ['questionnaire' => $questionnaire, 'treatmentPlan' => $treatmentPlan])
</x-app-layout>

