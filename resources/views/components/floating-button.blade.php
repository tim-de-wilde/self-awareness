<div class="fixed right-0 bottom-0 m-8">
    <button {{ $attributes->merge(['class' => 'rounded-full w-12 h-12 bg-gray-400 hover:bg-gray-400 shadow-lg text-white flex justify-center items-center']) }}>
        {{ $slot }}
    </button>
</div>