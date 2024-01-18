@props([
    'queryMethod' => null,
])

<div
    x-data="autocompleteApp({ value: @entangle($attributes->wire('model')) })"
    x-init="onInit()"
>
    <div class="relative mt-2">
        <button
            x-on:click="onButtonClick()"
            type="button"
            class="relative w-full cursor-pointer rounded-full bg-white py-3 pl-4 pr-10 text-left text-gray-900 shadow-sm focus:outline-none focus:ring-1 focus:ring-[#8bbdb6] sm:text-sm sm:leading-6"
            aria-haspopup="listbox"
            aria-expanded="true"
            aria-labelledby="listbox-label"
        >
            <input
                x-show="open"
                x-trap="open"
                x-model.debounce="query"
                x-on:keydown.arrow-up.prevent="onArrowUp()"
                x-on:keydown.arrow-down.prevent="onArrowDown()"
                x-on:keydown.enter.stop.prevent="onOptionSelect()"
                x-on:keydown.escape="onEscape()"
                x-on:keydown.space.prevent="onSpace()"
                placeholder="{{ __('Search for items...')  }}"
                type="text"
                class="border-none h-8 w-full focus:border-0 focus:ring-0"
            >
            <span x-show="! open" x-text="selectedItemsText()" class="block truncate">{{ __('Loading...') }}</span>
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                <x-heroicon-o-chevron-up-down x-show="! loading" class="w-5 h-5 -ml-1 mr-3 text-gray-400"/>
                <x-spinner x-show="loading" class="h-5 w-5 -ml-1 mr-3 text-gray-400"/>
            </span>
        </button>

        <ul
            x-show="open"
            x-ref="listbox"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-on:click.away="open = false"
            x-on:click="onOptionSelect()"
            class="absolute z-10 mt-2 max-h-60 w-full overflow-auto rounded-xl bg-white text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" tabindex="-1" role="listbox"
            aria-labelledby="listbox-label"
        >
            <template x-for="(item, index) in items" x-bind:key="item.id">
                <li
                    x-on:mouseenter="onHighlight(index)"
                    x-bind:id="`listbox-option-${index}`"
                    x-bind:class="{ 'bg-[#8bbdb6] text-white': isHighlighted(index), 'text-gray-900': ! isHighlighted(index) }"
                    class="text-gray-900 relative cursor-default select-none py-2 pl-8 pr-4"
                    role="option"
                >
                    <span
                        x-text="item.name"
                        x-bind:class="{ 'font-semibold': isSelected(item) }"
                        class="block truncate"></span>

                    <span
                        x-show="isSelected(item)"
                        x-bind:class="{ 'text-white': isHighlighted(index), 'text-[#8bbdb6]': ! isHighlighted(index) }"
                        class="absolute inset-y-0 left-0 flex items-center pl-1.5 pointer-events-none"
                    >
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </li>
            </template>
        </ul>
    </div>
</div>

@once
    @push('scripts')
        <script type="text/javascript">
            window.autocompleteApp = (data) => {
                return {
                    ...data,
                    query: '',
                    open: false,
                    highlightedIndex: 0,
                    selectedItems: [],
                    items: [],
                    loading: false,
                    queryMethod: @js($queryMethod),

                    async onInit() {
                        if (this.value) {
                            await this.fetchItems()

                            this.selectedItems = this.value.map(
                                id => this.items.find(
                                    item => String(item.id) === String(id)
                                )
                            )
                        }

                        this.$watch('query', value => {
                            this.fetchItems()
                        })
                    },

                    async fetchItems() {
                        this.loading = true;
                        this.items = await @this[this.queryMethod](this.query);
                        this.loading = false;
                    },

                    selectedItemsText() {
                        if (! this.selectedItems.length) {
                            return '{{ __('No items selected')  }}'
                        }

                        return this.selectedItems
                            .map(item => item.name)
                            .join(', ')
                    },

                    onButtonClick() {
                        this.open = ! this.open
                    },

                    onOptionSelect() {
                        const target = this.items[this.highlightedIndex]
                        const filteredItems = this.selectedItems.filter(
                            item => String(item.id) !== String(target.id)
                        )

                        if (filteredItems.length === this.selectedItems.length) {
                            this.selectedItems.push(target)
                            this.value = [
                                ...this.value,
                                target.id
                            ]
                        } else {
                            this.selectedItems = filteredItems
                            this.value = this.value.filter(
                                id => String(target.id) !== String(id)
                            )
                        }
                    },

                    onArrowDown() {
                        if (this.highlightedIndex < this.items.length - 1) {
                            this.highlightedIndex += 1
                        } else {
                            this.highlightedIndex = 0
                        }
                    },

                    onArrowUp() {
                        if (this.highlightedIndex > 0) {
                            this.highlightedIndex -= 1
                        } else {
                            this.highlightedIndex = this.items.length - 1
                        }
                    },

                    isSelected(item) {
                        return this.value.includes(item.id)
                    },

                    isHighlighted(index) {
                        return this.highlightedIndex === index
                    },

                    onHighlight(index) {
                        this.highlightedIndex = index
                    },

                    onEscape() {
                        this.open = false
                        this.$refs.listbox.blur()
                    },

                    onSpace() {
                        this.query += ' '
                    },
                }
            }
        </script>
    @endpush
@endonce