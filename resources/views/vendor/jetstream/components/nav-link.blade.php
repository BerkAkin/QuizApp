@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-green-400 no-underline hover:border-green-700 text-md leading-5 hover:text-green-700 text-green-400 text-gray-900 focus:outline-none focus:border-green-700 font-bold'
            : 'inline-flex items-center px-1 pt-1  text-sm font-medium leading-5 no-underline text-gray-500 hover:text-red-700 hover:border-red-500 font-bold';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
