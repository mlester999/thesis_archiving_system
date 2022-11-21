@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'absolute text-xxs sm:text-xs md:text-sm text-red-600 space-y-1 mt-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
