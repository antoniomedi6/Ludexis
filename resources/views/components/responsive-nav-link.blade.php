@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'block w-full ps-4 pe-4 py-3 border-l-4 border-cyan-500 text-start text-sm font-black text-cyan-400 bg-[#1a1d27]/50 transition duration-300 ease-in-out'
            : 'block w-full ps-4 pe-4 py-3 border-l-4 border-transparent text-start text-sm font-bold text-gray-500 hover:text-gray-300 hover:bg-[#1a1d27]/30 hover:border-gray-700 transition duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
