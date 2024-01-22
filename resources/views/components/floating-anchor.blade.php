<div class="fixed right-0 bottom-0 m-8">
    <a {{ $attributes->merge(['class' => 'rounded-full w-12 h-12 bg-[#9ed6d0] hover:bg-[#7ec9c0] shadow-lg text-white flex justify-center items-center']) }}>
        {{ $slot }}
    </a>
</div>