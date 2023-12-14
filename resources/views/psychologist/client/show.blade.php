<!--psy client editpage-->

<x-app-layout role="psychologist">
    <div class="py-12 space-y-4 px-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
        <div class="items-center flex justify-center py-2 rounded-full mx-auto my-5 bg-[#B9DDD8]">
            <span class="font-bold text-1xl ">Cliënt informatie</span>
          </div>
            <div class="flex space-x-2">
            
                <x-anchor-button :href="route('psychologist.client.edit', ['client' => $client->id])">
                    {{ __('Edit') }}
                </x-anchor-button>

                <form
                    action="{{ route('psychologist.client.delete', ['client' => $client->id]) }}"
                    method="post">
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
                    <div class="h-14 items-center flex ml-3 ">
                        {{ $client->name }}  
                        </div>
                    </x-text-container>
                    <x-text-container>
                    <div class="h-14 items-center flex ml-3 ">
                        {{ $client->last_name }}
                        </div>
                    </x-text-container>
                    <x-text-container>
                    <div class="h-14 items-center flex ml-3 ">
                        {{ $client->email }}
                        </div>
                    </x-text-container>
                </div>
            </div>

            {{-- Gender, age and phone number. --}}
            <div class="flex space-x-4">
                <x-text-container>
                                    <div class="h-14 items-center flex ml-3 ">

                    {{ $client->gender->label() }}
                    </div>
                </x-text-container>
                <x-text-container>
                                    <div class="h-14 items-center flex ml-3 ">

                    {{ $client->birth_date->format('d-m-Y') }}
                    </div>
                </x-text-container>
                <x-text-container>
                                    <div class="h-14 items-center flex ml-3 ">

                    {{ $client->phone }}
                    </div>
                </x-text-container>
            </div>

 {{-- Description. --}}
            <x-text-container>
                                <div class="h-14 items-center flex ml-3 ">

                <h3>{{ __('Beschrijving') }}</h3>

                <p>
                    {{ $client->description }}
                </p>
                </div>
            </x-text-container>
            {{-- Graphs. --}}
            <x-text-container class="mb-4">
                                <div class="h-14 items-center flex ml-3 ">

                Charts komen hier!
                </div>
            </x-text-container>

           
        </div>
    </div>
</x-app-layout>