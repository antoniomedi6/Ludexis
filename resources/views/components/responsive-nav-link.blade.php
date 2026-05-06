@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'block w-full ps-4 pe-4 py-3 border-l-4 border-cyan-500 text-start text-sm font-black text-cyan-600 dark:text-cyan-400 bg-cyan-50 dark:bg-darkbox-main/70 transition duration-300 ease-in-out'
            : 'block w-full ps-4 pe-4 py-3 border-l-4 border-transparent text-start text-sm font-bold text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-gray-200 hover:bg-lightbox-soft dark:hover:bg-darkbox-main/50 hover:border-lightbox-border dark:hover:border-gray-600 transition duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
