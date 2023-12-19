<!--psy client editpage-->

<x-app-layout role="psychologist">
    <script>
        // JavaScript function to handle navigation
        function navigateToEditPage(url) {
            window.location.href = url;
        }
    </script>

    <div class="py-12 space-y-4 px-10 h-full overflow-y-auto">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
        <div class="flex">
        <div class="items-center flex justify-center py-2 rounded-full mx-auto my-5 w-10/12 bg-[#B9DDD8]">
            <span class="font-bold text-1xl ">Cliënt informatie</span>
        </div>
            <div class="items-center flex justify-center py-2 rounded-full mx-auto my-5 w-1/12 bg-[#B9DDD8]  hover:bg-purple-400 active:bg-purple-600 ">
                <button id="arrowButton" class="focus:outline-none py-1" onclick="navigateToEditPage('{{ route('psychologist.client.edit', ['client' => $client->id]) }}')">
                    <x-heroicon-s-pencil class="h-5 text-gray-800" />
                </button>
          </div>
        </div>
            <div class="flex space-x-2">
                <!-- Hidden form for deletion -->
            </div>

            {{-- Avatar and contact information. --}}
            <div class="flex space-x-4">

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

            {{-- Graphs. --}}
            <div class="py-12 space-y-4 mb-5">
                <div class="flex justify-center rounded-xl">
                    <!-- Adjusted image with rounded corners and centered -->
                    <img src="{{asset('images/graphics/Graphic.jpg')}}" class="rounded-xl w-full" alt="Description of the image">
                </div>
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
        </div>
    </div>
    
</x-app-layout>

        