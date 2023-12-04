<!--parent component = index.blade.php-->
<div class="pt-8 bg-[#E4EFEF] h-full" x-data="{ tabs: {clients: 'c', questionnaires: 'q'}, currentTab: 'c', showSearchInput: false }">
    {{-- Floating button new client --}}
    <x-floating-anchor x-show="currentTab === tabs.clients" :href="route('psychologist.client.create')">
        <x-heroicon-o-plus class="w-6 h-6"/>
    </x-floating-anchor>

    {{-- Floating button new questionnaire --}}
    <x-floating-anchor x-show="currentTab === tabs.questionnaires" :href="route('psychologist.questionnaire.create')">
        <x-heroicon-o-plus class="w-6 h-6"/>
    </x-floating-anchor>
    <div class="max-w-4xl mx-auto pb-4 sm:px-6 lg:px-8 h-full overflow-hidden flex flex-col">
        {{-- Tabs & search button --}}
        <div class="flex px-4 space-x-4 pb-4 items-center">
            <div x-show="! showSearchInput" class="flex bg-white rounded-full p-1" x-bind:class="{'flex-1': ! showSearchInput}">
                <button
                        x-on:click="currentTab = tabs.clients"
                        x-bind:class="{'bg-[#9ed6d0] hover:bg-[#7ec9c0] active:bg-[#3f978d] text-white': currentTab === tabs.clients}"
                        class="flex-1 p-1 text-center rounded-full">
                    {{ __('Clients') }}
                </button>
                <button
                        x-on:click="currentTab = tabs.questionnaires"
                        x-bind:class="{'bg-[#9ed6d0] hover:bg-[#7ec9c0] active:bg-[#3f978d] text-white': currentTab === tabs.questionnaires}"
                        class="flex-1 p-1 text-center rounded-full">
                    {{ __('Questionnaires') }}
                </button>
            </div>
            <div class="flex space-x-4" x-bind:class="{ 'flex-1': showSearchInput }">
                <div x-show="showSearchInput" class="flex-1 !rounded-full ">
                    <x-text-input class="w-full  !rounded-full " wire:model.live="search"/>
                </div>
                <button x-on:click="showSearchInput = ! showSearchInput" class="w-10 h-10 rounded-full bg-[#9ed6d0] hover:bg-[#7ec9c0] active:bg-[#3f978d] flex justify-center items-center">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5 text-white"/>
                </button>
            </div>
        </div>

        <div class="bg-white shadow-sm sm:rounded-xl flex-1 mx-5 overflow-auto">
            {{-- Client tab --}}
            <div x-show="currentTab === tabs.clients" class="overflow-auto">
                <div class="divide-y divide-gray-200 overflow-auto">
                    @foreach($clients as $client)
                        <a href="{{ route('psychologist.client.show', ['client' => $client->id]) }}" class="p-4 flex hover:bg-gray-100">
                            <x-avatar :user="$client" size="12"/>
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
               <div class=" w-full cursor-pointer mx-auto px-5 ">
                <!--Card-1-->
                   <div class=" p-1 mt-5  mx-auto bg-[#FAE7CD] shadow-lg  overflow-hidden rounded-md relative">
                       <div class="p-4">
                           <!-- Titel -->
                           <h2 class="text-2xl font-extrabold mb-3">Stemming</h2>
                           <!-- Beschreibung -->
                           <p class=" font-thin  text-gray-700  mb-4 "> Deze vragen helpen u bij uw stemming. </p>
                           <!-- Button -->
                           <button class="bg-[#E1A24C] hover:bg-[#62b1a6] text-white font-bold py-2 px-4 rounded mt-4"> Naar vragen </button>
                       </div>
                   </div>
                   <!--Card-2-->
                   <div class=" p-1 my-5 mx-auto bg-[#FCDDCC] shadow-lg  overflow-hidden rounded-md relative">
                       <div class="p-4">
                           <!-- Titel -->
                           <h2 class="text-2xl font-extrabold mb-3">Gevoel</h2>
                           <!-- Beschreibung -->
                           <p class=" font-thin  text-gray-700  mb-4 "> Deze vragen helpen u bij uw gevoelens. </p>
                           <!-- Button -->
                           <button class="bg-[#FFA26F] hover:bg-[#62b1a6] text-white font-bold py-2 px-4 rounded mt-4"> Naar vragen </button>
                       </div>
                   </div>
                   <!--Card-3-->
                   <div class=" p-1 my-5 mx-auto bg-[#E5EBC0] shadow-lg  overflow-hidden rounded-md relative">
                       <div class="p-4">
                           <!-- Titel -->
                           <h2 class="text-2xl font-extrabold mb-3">Gepersonaliseerd</h2>
                           <!-- Beschreibung -->
                           <p class=" font-thin  text-gray-700  mb-4 "> Dit zijn gepersonaliseerde vragen. </p>
                           <!-- Button -->
                           <button class="bg-[#C1CE73] hover:bg-[#62b1a6] text-white font-bold py-2 px-4 rounded mt-4"> Naar vragen </button>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>