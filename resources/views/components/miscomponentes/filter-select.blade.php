@props([
    'accent' => 'cyan',
])

@php
    $focusRing =
        $accent === 'indigo'
            ? 'focus:ring-indigo-500 focus:border-indigo-500'
            : 'focus:ring-cyan-500 focus:border-cyan-500';
    $chevronHover = $accent === 'indigo' ? 'group-hover:text-indigo-500' : 'group-hover:text-cyan-500';
@endphp

<div class="relative group">
    <select
        {{ $attributes->class(
            'appearance-none text-xs font-bold bg-lightbox-card dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border rounded-xl pl-4 pr-9 py-2 text-gray-700 dark:text-gray-300 focus:ring-2 shadow-sm transition-colors duration-300 outline-none cursor-pointer w-full ' .
                $focusRing,
        ) }}>
        {{ $slot }}
    </select>
    <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 {{ $chevronHover }} transition-colors pointer-events-none"
        aria-hidden="true"></i>
</div>
