<x-app-layout role="psychologist">
    <div class="py-12 space-y-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
            {{-- Avatar and contact information. --}}
            <div class="flex space-x-4">
                <x-avatar :user="$patient" size="32"/>

                <div class="flex-1 space-y-2">
                    <x-text-container>
                        {{ $patient->name }}
                    </x-text-container>
                    <x-text-container>
                        {{ $patient->last_name }}
                    </x-text-container>
                    <x-text-container>
                        {{ $patient->email }}
                    </x-text-container>
                </div>
            </div>

            {{-- Gender, age and phone number. --}}
            <div class="flex space-x-4">
                <x-text-container>
                    {{ $patient->gender->label() }}
                </x-text-container>
                <x-text-container>
                    {{ $patient->birth_date->format('d-m-Y') }}
                </x-text-container>
                <x-text-container>
                    {{ $patient->phone }}
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
                    {{ $patient->description }}
                </p>
            </x-text-container>
        </div>
    </div>
</x-app-layout>