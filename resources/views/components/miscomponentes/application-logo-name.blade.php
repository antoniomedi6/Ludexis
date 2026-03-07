@props(['class' => 'h-12 w-auto'])
<div class="flex items-center gap-2">
    <img src="{{ asset('logo.png') }}" {{ $attributes->merge(['class' => $class]) }} alt="Logo">
    <span class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">
        LU<span class="text-cyan-500 dark:text-cyan-400">DEXIS</span>
    </span>
</div>
