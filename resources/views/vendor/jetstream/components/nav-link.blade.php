@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-logo-primary text-sm font-medium leading-5 text-logo-primary focus:outline-none focus:border-logo-terciary transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text--logo-terciary hover:text-logo-secondary hover:border-logo-secondary focus:outline-none focus:text-gray-700 focus:border-logo-terciary transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
