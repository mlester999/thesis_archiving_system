@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-xs md:text-sm lg:text-base text-black']) }}>
    {{ $value ?? $slot }}
</label>
