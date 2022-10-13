@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'p-3 border border-gray-300 rounded-md placeholder:font-sans placeholder:font-light']) !!}>
