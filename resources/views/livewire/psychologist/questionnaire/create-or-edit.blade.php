<div class="h-full py-8 bg-[#E4EFEF]" x-data="{ show: @entangle('showModal').live }">
    <x-floating-button
        wire:click="openModal"
        type="button">
        <x-heroicon-o-plus class="w-6 h-6"/>
    </x-floating-button>

    <div class="max-w-4xl mx-auto p-4 space-y-4">
        <div class="rounded-full text-sm font-semibold bg-sky-200 text-center px-4 py-1">
            {{ $questionnaire->name }}
        </div>

        <ul wire:sortable="updateQuestionOrder" class="divide-y divide-gray-300 rounded-full">
            @foreach($stagedQuestions as $question)
                <li
                    wire:click="editQuestion('{{ $question['id'] }}')"
                    wire:sortable.item="{{ $question['id']  }}"
                    class="p-2 flex items-center space-x-4 hover:bg-gray-50 cursor-pointer"
                >
                    <img
                       class="h-10 w-10 object-contain"
                       src="{{ $question['preview_image'] }}"
                       alt="Preview image">
                    <div class="flex-1">
                        <p>{{ $question['order'] }}. {{ $question['title'] }}</p>
                        <p class="text-xs">{{ $question['description'] }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <x-alpine-modal>
        <div>
            <div class="border-b border-gray-300 px-4 py-2">
                <h2>{{ __('Question') }}</h2>
            </div>

            <div class="p-4 space-y-4">
                <div>
                    <x-input-label :value="__('Title')" for="title"/>
                    <x-text-input wire:model="stagedQuestionData.title" name="title" id="title"/>
                    <x-input-error :messages="$errors->get('stagedQuestionData.title')" class="mt-2" />
                </div>

                <div>
                    <x-input-label :value="__('Description')" for="description"/>
                    <x-textarea wire:model="stagedQuestionData.description" name="description"/>
                    <x-input-error :messages="$errors->get('stagedQuestionData.description')"/>
                </div>

                {{-- TODO Files --}}
            </div>

            <div class="flex justify-end space-x-2 p-2">
                <x-secondary-button x-on:click="show = false">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button wire:click="saveQuestion">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </div>
    </x-alpine-modal>
</div>
