@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 bg-blue-600 text-white rounded-lg transition-all duration-200 shadow-md'
            : 'flex items-center px-4 py-3 text-gray-400 hover:bg-white/10 hover:text-white rounded-lg transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>