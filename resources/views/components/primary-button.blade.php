<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex text-white rounded-full items-center px-4 py-2 font-semibold bg-[#8bbdb6] hover:bg-teal-700 uppercase tracking-widest transition ease-in-out duration-150' ]) }}>
    {{ $slot }}
</button>
