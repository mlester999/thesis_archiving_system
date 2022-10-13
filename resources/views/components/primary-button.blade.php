<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full md:w-auto flex justify-center items-center p-4 space-x-4 font-sans font-bold text-white rounded-md shadow-lg px-9 bg-green-700 shadow-cyan-100 hover:bg-opacity-90 shadow-sm hover:shadow-lg border transition hover:-translate-y-0.5 duration-150']) }}>
    {{ $slot }}
</button>
