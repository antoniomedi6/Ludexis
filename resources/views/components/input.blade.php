@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'bg-[#0f1117] border border-gray-800 text-white placeholder-gray-500 rounded-xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors shadow-inner w-full disabled:opacity-50 disabled:cursor-not-allowed',
]) !!}>
