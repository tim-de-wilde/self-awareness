<div x-ref="container" class="max-w-2xl mx-auto h-full bg-[#E4EFEF]">
    <div class="relative h-full" x-data="viewQuestionnaireApp()" x-init="onInit()">
        <div x-show="isFinished" x-cloak class="h-full">
            @include('client.questionnaire.partials.completed')
        </div>

        <div x-show="! isFinished" class="h-full w-full pt-6 overflow-hidden">
            <div
                class="h-full block overflow-hidden transition-all duration-300"
                x-bind:style="{ transform: `translateX(-${transform()}px)`, width: `${containerWidth()}px` }">
                <template x-for="(item, index) in items">
                    <div class="w-screen sm:w-[42rem] inline-block h-full p-4">
                        <div class="flex flex-col w-full h-full text-center">
                            <h2 x-text="item.title" class="text-2xl font-semibold py-4"></h2>
                            <p x-text="item.description" class="text-lg"></p>
                            <div class="flex-1">
                                <img
                                    x-bind:src="assetSource(item, index)"
                                    class="sm:w-96 sm:h-96 sm:mx-auto"
                                    alt="Emoticon"
                                >
                            </div>
                            <div class="pb-4">
                                <input
                                    x-model.debounce.20ms="answers[index].value"
                                    min="1"
                                    max="100"
                                    type="range"
                                    class="w-full h-8"
                                >
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Progress bar --}}
            <div x-ref="bar" class="absolute top-0 left-0 p-2 w-screen sm:w-[42rem] bg-gray-50">
                <div
                    x-bind:style="{ width: `${$refs.bar.offsetWidth * progressBarWidth()}px` }"
                    class="bg-teal-400"></div>
            </div>

            {{-- Button -- next question --}}
            <div class="absolute top-1/2 right-0">
                <button x-on:click="next()" type="button">
                    <x-heroicon-o-chevron-right class="w-10 h-10"/>
                </button>
            </div>

            {{-- Button -- previous question --}}
            <div x-show="index > 0" class="absolute top-1/2 left-0">
                <button x-on:click="previous()" type="button">
                    <x-heroicon-o-chevron-left class="w-10 h-10"/>
                </button>
            </div>
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script type="text/javascript">
            window.viewQuestionnaireApp = () => {
                return {
                    index: 0,
                    isFinished: @js($isFinished),
                    items: @js($questions),
                    answers: [],
                    transformContainer: 0,

                    onInit() {
                        this.answers = this.items.map(item => ({
                            question_id: item.id,
                            value: 1,
                        }))
                    },

                    submit() {
                        this.isFinished = true

                        @this.submit(this.answers)
                    },

                    next() {
                        if (this.index < this.items.length - 1) {
                            this.index += 1
                        } else {
                            this.submit()
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

                    progressBarWidth() {
                        const out = (this.index + 1) / this.items.length
                        return Math.round(out)
                    },

                    assetSource(item, index) {
                        const answer = this.answers[index].value
                        const assets = item.assets

                        //todo This is probably very slow; put event handler on slider to do this faster

                        for (let i = 0; i < assets.length; i += 1) {
                            const part = (100 / assets.length) * (i + 1)

                            if (answer <= part) {
                                return item.assets[i].location
                            }
                        }
                    },
                }
            }
        </script>
    @endpush
@endonce