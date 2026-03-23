@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'w-full bg-gray-50 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white rounded-xl px-4 py-3 text-sm font-bold focus:ring-1 focus:ring-cyan-500 focus:outline-none transition-all shadow-inner custom-scrollbar resize-none',
]) !!}></textarea>
