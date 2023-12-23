<div class="h-full py-8 bg-[#E4EFEF]" x-data="{ show: @entangle('showModal').live }">
    <div class="max-w-4xl mx-auto p-4 h-full flex flex-col">
        <div class="flex-1 space-y-4 overflow-y-auto">
            <div class="rounded-full text-sm font-semibold bg-sky-200 text-center px-4 py-1">
                {{ $questionnaire?->name ?? __('New Questionnaire') }}
            </div>

            <div class="space-y-4">
                <div class="border-b border-gray-300 pb-1">
                    <h2>{{ __('Information') }}</h2>
                </div>

                <div>
                    <x-input-label for="name" :value="__('Name')"/>
                    <x-text-input wire:model="stagedQuestionnaireData.name" id="name" class="mt-1"/>
                    <x-input-error :messages="$errors->get('stagedQuestionnaireData.name')" />
                </div>

                <div>
                    <x-input-label :value="__('Users')" />
                    <x-autocomplete
                        wire:model.live="selectedTreatmentPlanIds"
                        queryMethod="getTreatmentPlans"/>
                    <x-input-error :messages="$errors->get('selectedUserIds')"/>
                </div>

                <div>
                    <x-input-label for="description" :value="__('Description')"/>
                    <x-textarea wire:model="stagedQuestionnaireData.description" id="description" class="mt-1"/>
                    <x-input-error :messages="$errors->get('stagedQuestionnaireData.description')"/>
                </div>
            </div>

            <div class="space-y-4">
                <div class="border-b border-gray-300 pb-1 flex justify-between space-x-4">
                    <h2>{{ __('Questions') }}</h2>

                    <button wire:click="openModal(true)">
                        {{ __('+ Add new question') }}
                    </button>
                </div>

                @if(count($stagedQuestions))
                    <div class="relative">
                        <ul wire:sortable="updateQuestionOrder" class="divide-y divide-gray-300 rounded-full">
                            @foreach($stagedQuestions as $question)
                                <li
                                        wire:click="editQuestion('{{ $question['id'] }}')"
                                        wire:sortable.item="{{ $question['id']  }}"
                                        class="p-2 flex items-center space-x-4 hover:bg-gray-50 cursor-pointer transition ease-in-out duration-150"
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
                @else
                    <x-empty-state wire:click="openModal" icon="heroicon-o-question-mark-circle">
                        {{ __('Click here to add questions') }}
                    </x-empty-state>
                @endif
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <x-secondary-button wire:click="back">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button wire:click="save">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </div>

    <x-alpine-modal>
        <div>
            <div class="border-b border-gray-300 px-4 py-2">
                <h2>{{ __('Question') }}</h2>
            </div>

            <div class="p-4 space-y-4">
                <div>
                    <x-input-label :value="__('Title')" for="title"/>
                    <x-text-input wire:model="stagedQuestion.title" name="title" id="title" class="mt-1 w-full"/>
                    <x-input-error :messages="$errors->get('stagedQuestion.title')" class="mt-1" />
                </div>

                <div>
                    <x-input-label :value="__('Description')" for="description"/>
                    <x-textarea wire:model="stagedQuestion.description" name="description" class="mt-1"/>
                    <x-input-error :messages="$errors->get('stagedQuestion.description')" class="mt-1"/>
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
