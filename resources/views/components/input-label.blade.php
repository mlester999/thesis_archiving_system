@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-xs md:text-sm lg:text-md text-black mt-2']) }}>
    {{ $value ?? $slot }}
</label>
