@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'p-2 border border-gray-300 rounded-md placeholder:font-sans placeholder:font-light focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none  text-xs md:text-sm xl:text-base']) !!}>
