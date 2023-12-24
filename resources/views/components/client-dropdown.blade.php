@props(['client'])

<div
    x-data="{ show: false }"
    x-on:click.away="show = false"
    class="bg-white rounded-2xl shadow-sm px-4 py-2">
    {{-- User avatar, name & activate button --}}
    <div
        x-on:click="show = !show"
        class="flex items-center cursor-pointer"
    >
        <x-avatar :user="$client" style="width: 60px; height: 60px"/>
        <div class="flex-1">
            <h2 class="text-2xl font-semibold text-center">
                {{ $client->name . ' ' . $client->last_name }}
            </h2>
        </div>
        <button
            type="button"
            x-bind:class="{ 'rotate-180': show }"
            class="transition-transform duration-200">
            <x-heroicon-o-chevron-down class="w-8 h-8"/>
        </button>
    </div>

    {{-- Extra content; school, e-mail etc. --}}
    <div
        x-show="show"
        x-cloak
        x-transition:enter="transition-transform transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-end="opacity-0 transform -translate-y-3"
    >
        <div class="divide-y divide-gray-300 pt-2">
            <div class="py-4 space-y-1">
                <div class="flex items-center">
                    <x-heroicon-o-at-symbol class="w-5 h-5 mr-1.5"/>
                    {{ __('Email')  }}
                </div>
                <label class="font-semibold">{{ $client->email }}</label>
            </div>

            <div class="py-4 space-y-1">
                <div class="flex items-center">
                    <x-heroicon-o-academic-cap class="w-5 h-5 mr-1.5"/>
                    {{ __('School')  }}
                </div>
                <label class="font-semibold">{{ $client->school()->first()?->school }}</label>
            </div>

            <div class="py-4 space-y-1">
                <span class="flex items-center">
                    <x-heroicon-o-user class="w-5 h-5 mr-1.5"/>
                    {{ __('Parent')  }}
                </span>
                <label class="font-semibold">{{ $client->email }}</label>
            </div>
        </div>
    </div>
</div>