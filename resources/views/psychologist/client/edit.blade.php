<x-app-layout role="psychologist" back="{{ route('psychologist.client.show', ['client' => $client->id]) }}">
    @livewire('psychologist.client.create-or-edit', ['client' => $client])
</x-app-layout>