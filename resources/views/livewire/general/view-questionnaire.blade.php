<div x-ref="container" class="relative h-full" x-data="viewQuestionnaireApp()" x-init="onInit()">
    <div
        class="h-full block overflow-hidden transition-all duration-300"
        x-bind:style="{ transform: `translateX(-${transform()}px)`, width: `${containerWidth()}px` }">
        <template x-for="(item, index) in items">
            <div class="w-screen inline-block h-full p-4">
                <div class="flex flex-col w-full h-full text-center">
                    <h2 x-text="item.title" class="text-2xl font-semibold py-4"></h2>
                    <p x-text="item.description" class="text-lg"></p>
                    <div class="flex-1">
                        <img
                            x-bind:src="assetSource(item, index)"
                            alt="Emoticon">
                    </div>
                    <div>
                        <input
                            x-model.debounce="answers[index]"
                            min="1"
                            max="100"
                            type="range"
                            class="w-full h-8">
                    </div>
                </div>
            </div>
        </template>
    </div>

    {{-- Buttons for previous and next question --}}
    <div class="absolute top-1/2 right-0">
        <button x-on:click="next()" type="button">
            <x-heroicon-o-chevron-right class="w-10 h-10"/>
        </button>
    </div>

    <div class="absolute top-1/2 left-0">
        <button x-on:click="previous()" type="button">
            <x-heroicon-o-chevron-left class="w-10 h-10"/>
        </button>
    </div>
</div>

@once
    @push('scripts')
        <script type="text/javascript">
            window.viewQuestionnaireApp = () => {
                return {
                    index: 0,
                    items: @js($questions),
                    answers: [],
                    transformContainer: 0,

                    onInit() {
                        this.answers = this.items.map(() => 50)
                    },

                    next() {
                        if (this.index < this.items.length - 1) {
                            this.index += 1
                        }
                    },

                    previous() {
                        if (this.index > 0) {
                            this.index -= 1
                        }
                    },

                    transform() {
                        return this.$refs.container.offsetWidth * this.index
                    },

                    containerWidth() {
                        return this.$refs.container.offsetWidth * this.items.length + 10
                    },

                    assetSource(item, index) {
                        const answer = this.answers[index]
                        const assets = item.assets

                        for (let i = 0; i < assets.length; i += 1) {
                            const part = (100 / assets.length) * i+1

                            if (answer < part) {
                                return item.assets[i].location
                            }
                        }
                    },
                }
            }
        </script>
    @endpush
@endonce