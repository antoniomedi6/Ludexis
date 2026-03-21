@props(['id', 'maxWidth'])

@php
    $id = $id ?? md5($attributes->wire('model'));

    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
        '4xl' => 'sm:max-w-4xl',
    ][$maxWidth ?? '2xl'];
@endphp

<div x-data="{ show: @entangle($attributes->wire('model')) }" x-on:close.stop="show = false" x-on:keydown.escape.window="show = false" x-show="show"
    id="{{ $id }}" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-[150]" style="display: none;">
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-950/80 backdrop-blur-md"></div>
    </div>

    <div x-show="show"
        class="bg-white dark:bg-[#151821] rounded-[2.5rem] overflow-hidden shadow-2xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto border border-gray-200 dark:border-gray-800"
        x-trap.inert.noscroll="show" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95">

        <button x-on:click="show = false"
            class="absolute top-6 right-6 z-10 w-10 h-10 rounded-full bg-gray-100 dark:bg-[#1a1d27] text-gray-500 hover:text-red-500 transition-colors flex items-center justify-center border border-gray-200 dark:border-gray-800">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <div class="p-8 md:p-10">
            {{ $slot }}
        </div>
    </div>
</div>
