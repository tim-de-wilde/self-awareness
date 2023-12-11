<x-app-layout role="psychologist" back="{{ route('psychologist.manage.index') }}">
    <div class="py-12 space-y-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="flex space-x-2">
                <x-anchor-button :href="route('psychologist.client.edit', ['client' => $client->id])">
                    {{ __('Edit') }}
                </x-anchor-button>

                <form action="{{ route('psychologist.client.delete', ['client' => $client->id]) }}" method="post">
                    @csrf
                    <x-danger-button>
                        Delete
                    </x-danger-button>
                </form>
            </div>

            {{-- Avatar and contact information. --}}
            <div class="flex space-x-4">
                <x-avatar :user="$client" size="16"/>

                <div class="flex-1 space-y-2">
                    <x-text-container>
                        {{ $client->name }}
                    </x-text-container>
                    <x-text-container>
                        {{ $client->last_name }}
                    </x-text-container>
                    <x-text-container>
                        {{ $client->email }}
                    </x-text-container>
                </div>
            </div>

            {{-- Gender, age and phone number. --}}
            <div class="flex space-x-4">
                <x-text-container>
                    {{ $client->gender->label() }}
                </x-text-container>
                <x-text-container>
                    {{ $client->birth_date->format('d-m-Y') }}
                </x-text-container>
                <x-text-container>
                    {{ $client->phone }}
                </x-text-container>
            </div>

            {{-- Graphs. --}}
            <x-text-container class="mb-4">
                Charts komen hier!
            </x-text-container>

            {{-- Description. --}}
            <x-text-container>
                <h3>{{ __('Beschrijving') }}</h3>

                <p>
                    {{ $client->description }}
                </p>
            </x-text-container>
        </div>
    </div>
</x-app-layout>