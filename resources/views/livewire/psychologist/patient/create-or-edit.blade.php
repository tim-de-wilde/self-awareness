<form wire:submit.prevent="save">
    <div>
        <x-input-label for="name" :value="__('First name')" />
        <x-text-input wire:model="data.name" type="text" name="name"/>
        <x-input-error :messages="$errors->get('data.name')" class="mt-2"/>
    </div>

    <div>
        <x-input-label for="last_name" :value="__('Last name')" />
        <x-text-input wire:model="data.last_name" type="text" name="last_name"/>
        <x-input-error :messages="$errors->get('data.last_name')" class="mt-2"/>
    </div>

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input wire:model="data.email" type="email" name="email"/>
        <x-input-error :messages="$errors->get('data.email')" class="mt-2"/>
    </div>

    <div>
        <x-input-label for="gender" :value="__('Gender')" />
        <x-select wire:model="data.gender" type="text" name="gender">
            @foreach(App\Enums\Gender::cases() as $gender)
                <option value="{{ $gender->value }}">
                    {{ $gender->label() }}
                </option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('data.gender')" class="mt-2"/>
    </div>

    <div>
        <x-input-label for="birth_date" :value="__('Birth date')" />
        <x-text-input wire:model="data.birth_date" type="date" name="birth_date"/>
        <x-input-error :messages="$errors->get('data.birth_date')" class="mt-2"/>
    </div>

    <div>
        <x-input-label for="phone" :value="__('Phone')"/>
        <x-text-input wire:model="data.phone" name="phone"/>
        <x-input-error :messages="$errors->get('data.phone')" class="mt-2"/>
    </div>

    <x-primary-button>
        {{ __('Save') }}
    </x-primary-button>
</form>
