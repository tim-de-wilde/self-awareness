<div>
    <!--psy client editpage-->
    <script>
        // JavaScript function to submit the delete form
        function submitDeleteForm() {
            document.getElementById('deleteForm').submit();
        }
    </script>

    <form wire:submit.prevent="save" class="py-12 space-y-4 px-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4 px-5">
            <div class="flex">
                <div class="items-center flex justify-center py-2 rounded-full mx-auto my-5 w-10/12 bg-[#B9DDD8] ">
                    <span class="font-bold text-1xl ">{{ ($client === null) ? 'VOEG EEN KLANT TOE' : 'Client Editen' }} </span>

                </div>
                <div class="items-center flex justify-center py-2 rounded-full mx-auto my-5 w-1/12 bg-[#B9DDD8]  hover:bg-red-400  active:bg-red-600">
                    <button id="arrowButton" class="focus:outline-none py-1"
                            onclick="submitDeleteForm()">
                        <x-heroicon-s-trash class="h-5 text-gray-800" />
                    </button>

                    @if($client !== null)
                        <form id="deleteForm" action="{{ route('psychologist.client.delete', ['client' => $client->id]) }}" method="post" style="display: none;">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>

            {{-- Avatar and contact information. --}}
            <div class="flex space-x-4 ">
                <div class="flex-1 space-y-2">
                    <div>
                        <x-text-container>
                            <input wire:model="data.name" placeholder="{{__('First name')}}" type="text" name="name" class="form-input bg-white rounded-full mt-1 block w-full h-12 px-3 border-none focus:border-none focus:ring-0"/>
                            <x-input-error :messages="$errors->get('data.name')" class="mt-2"/>
                        </x-text-container>
                    </div>

                    <div>
                        <x-text-container>
                            <input wire:model="data.last_name" placeholder="{{__('Last name')}}" type="text" name="last_name" class="form-input rounded-md  mt-1 block w-full border-none focus:border-none focus:ring-0"/>
                            <x-input-error :messages="$errors->get('data.last_name')" class="mt-2"/>
                        </x-text-container>
                    </div>

                    <div>
                        <x-text-container>
                            <input wire:model="data.email" placeholder="{{__('Email')}}" type="email" name="email" class="form-input rounded-md  mt-1 block w-full border-none focus:border-none focus:ring-0"/>
                            <x-input-error :messages="$errors->get('data.email')" class="mt-2"/>
                        </x-text-container>
                    </div>
                </div>
            </div>

            {{-- Gender, age and phone number. --}}
            <div class="flex space-x-4">
                <x-text-container>
                    <select wire:model="data.gender" name="gender" class="form-select rounded-full  mt-1 block w-full border-none focus:border-none focus:ring-0">
                        @foreach(App\Enums\Gender::cases() as $gender)
                            <option value="{{ $gender->value }}">
                                {{ $gender->label() }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('data.gender')" class="mt-2 "/>
                </x-text-container>

                <x-text-container>
                    <input wire:model="data.birth_date" type="date" name="birth_date" class="form-input rounded-md mt-1 block w-y border-none focus:border-none focus:ring-0"/>
                    <x-input-error :messages="$errors->get('data.birth_date')" class="mt-2"/>
                </x-text-container>

                <x-text-container>
                    <input wire:model="data.phone" type="text" name="phone" placeholder="{{ __('Phone') }}" class="form-input rounded-md  mt-1 block w-full border-none focus:border-none focus:ring-0"/>
                    <x-input-error :messages="$errors->get('data.phone')" class="mt-2"/>
                </x-text-container>
            </div>

           {{-- Beschrijving --}}
            <div class="flex space-x-4">
                <div class="flex-1 space-y-2">
                    <div>
                        <x-textarea
                            wire:model="data.description"
                            placeholder="{{ __('Description') }}"
                            id="description"
                            name="description"
                            class="mt-1"></x-textarea>
                        <x-input-error :messages="$errors->get('data.description')" class="mt-2"/>
                    </div>
                </div>
            </div>

            <div>
                <x-input-label :value="__('Questionnaires')"/>
                <x-autocomplete
                    wire:model.live="selectedQuestionnaireIds"
                    :items="$questionnaireOptions"/>
                <x-input-error :messages="$errors->get('selectedQuestionnaireIds')"/>
            </div>

            <div class="flex justify-end w-full">
                <x-primary-button>
                    {{ ($client === null) ? 'Add' : 'Save' }}
                </x-primary-button>
            </div>
        </div>
    </form>
</div>