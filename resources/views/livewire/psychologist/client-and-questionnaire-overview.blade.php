<div class="pt-8" x-data="{ tabs: {clients: 'c', questionnaires: 'q'}, currentTab: 'c', showSearchInput: false }">
    {{-- Floating button new client --}}
    <x-floating-anchor x-show="currentTab === tabs.clients" :href="route('psychologist.client.create')">
        <x-heroicon-o-plus class="w-6 h-6"/>
    </x-floating-anchor>

    {{-- Floating button new questionnaire --}}
    <x-floating-anchor x-show="currentTab === tabs.questionnaires" :href="route('psychologist.questionnaire.create')">
        <x-heroicon-o-plus class="w-6 h-6"/>
    </x-floating-anchor>


    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        {{-- Tabs & search button --}}
        <div class="flex pb-8 px-4 space-x-4 items-center">
            <div x-show="! showSearchInput" class="flex bg-white rounded-full p-1" x-bind:class="{'flex-1': ! showSearchInput}">
                <button
                        x-on:click="currentTab = tabs.clients"
                        x-bind:class="{'bg-gray-400 text-white': currentTab === tabs.clients}"
                        class="flex-1 p-1 text-center rounded-full">
                    {{ __('Clients') }}
                </button>
                <button
                        x-on:click="currentTab = tabs.questionnaires"
                        x-bind:class="{'bg-gray-400 text-white': currentTab === tabs.questionnaires}"
                        class="flex-1 p-1 text-center rounded-full">
                    {{ __('Questionnaires') }}
                </button>
            </div>
            <div class="flex space-x-4" x-bind:class="{ 'flex-1': showSearchInput }">
                <div x-show="showSearchInput" class="flex-1">
                    <x-text-input class="w-full" wire:model.live="search"/>
                </div>
                <button x-on:click="showSearchInput = ! showSearchInput" class="w-10 h-10 rounded-full bg-gray-400 flex justify-center items-center">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5 text-white"/>
                </button>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            {{-- Client tab --}}
            <div x-show="currentTab === tabs.clients">
                <div class="divide-y divide-gray-200">
                    @foreach($clients as $client)
                        <a href="{{ route('psychologist.client.show', ['client' => $client->id]) }}" class="p-4 flex hover:bg-gray-100">
                            <x-avatar size="12" :user="$client"/>
                            <div class="flex flex-1 flex-col text-center">
                                <p class="font-semibold text-lg">{{ $client->name }}</p>
                                <p class="text-xs text-gray-400">{{ $client->email }}</p>
                            </div>
                            <button>
                                <x-heroicon-o-chevron-right class="w-5 h-5"/>
                            </button>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Questionnaire tab --}}
            <div x-show="currentTab === tabs.questionnaires">
                <div class="space-y-4">
                    <div class="bg-orange-300 rounded-lg space-y-4">
                        <h3>Stemming</h3>
                        <p>
{{--                            @livewire('Questionnaire.QuestionnaireList')--}}
                            Dit is een beschrijving van een questionnaire.
                        </p>
                        <button>
                            Naar vragen
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>