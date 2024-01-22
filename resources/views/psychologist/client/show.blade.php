<!--psy client editpage-->

<x-app-layout role="psychologist" back="{{ route('psychologist.dashboard') }}">
    @livewire('psychologist.client.show', ['client' => $client, 'questionnaireNames' => $questionnaireNames])
</x-app-layout>

        