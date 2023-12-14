<!--psy client editpage-->

<form wire:submit.prevent="save" class="py-12 space-y-4 px-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4 px-5">
    <div class="items-center flex justify-center py-2 rounded-full mx-auto my-5 bg-[#B9DDD8] ">
            <span class="font-bold text-1xl ">Cliënt editen</span>
          </div>

    <div class="flex space-x-2 invisible">
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
        <div class="flex space-x-4 ">
            <x-avatar :user="$client" size="16"/>

            <div class="flex-1 space-y-2">
                <div>
                    <x-text-container>
                        <input wire:model="data.name" type="text" name="name" class="form-input bg-white rounded-full mt-1 block w-full h-12 px-3 border-none focus:border-none focus:ring-0""/>
                        <x-input-error :messages="$errors->get('data.name')" class="mt-2"/>
                    </x-text-container>
                </div>

                <div>
                    <x-text-container>
                        <input wire:model="data.last_name" type="text" name="last_name" class="form-input rounded-md  mt-1 block w-full border-none focus:border-none focus:ring-0"/>
                        <x-input-error :messages="$errors->get('data.last_name')" class="mt-2"/>
                    </x-text-container>
                </div>
                
                <div>
                    <x-text-container>
                        <input wire:model="data.email" type="email" name="email" class="form-input rounded-md  mt-1 block w-full border-none focus:border-none focus:ring-0"/>
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
                <input wire:model="data.phone" type="text" name="phone" class="form-input rounded-md  mt-1 block w-full border-none focus:border-none focus:ring-0"/>
                <x-input-error :messages="$errors->get('data.phone')" class="mt-2"/>
            </x-text-container>
        </div>

       {{-- Beschrijving --}}
        <div class="flex space-x-4">
            <div class="flex-1 space-y-2">
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Beschrijving</label>
                    <textarea wire:model="data.description" id="description" name="description" rows="3" class=" mt-1 block w-full sm:text-sm rounded-md border-none focus:border-none focus:ring-0"></textarea>
                    <x-input-error :messages="$errors->get('data.description')" class="mt-2"/>
                </div>
            </div>
        </div>

        <!-- ... Weitere Felder wie 'gender', 'birth_date', 'phone', etc. ... -->

        <x-primary-button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
            {{ __('Save') }}
        </x-primary-button>
    </div>
</form>

