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
        '5xl' => 'sm:max-w-5xl',
        '6xl' => 'sm:max-w-6xl',
        '7xl' => 'sm:max-w-7xl',
    ][$maxWidth ?? '2xl'];
@endphp

{{-- MODAL: teleport a body para que fixed no quede anclado a ancestros con transform (hover -translate, scale en transiciones). --}}
<div x-data="{ show: @entangle($attributes->wire('model')) }" x-on:close.stop="show = false" id="{{ $id }}">
    <template x-teleport="body">
        <div x-show="show" @keydown.escape.window="show = false"
            class="fixed inset-0 z-[110] flex items-center justify-center p-4 sm:p-6" style="display: none;">

            <div x-show="show" x-transition.opacity
                class="absolute inset-0 cursor-pointer bg-gray-900/40 transition-colors duration-300 dark:bg-black/60 backdrop-blur-md"
                @click="show = false" aria-hidden="true">
            </div>

            <div x-show="show" x-trap.noscroll="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-90 translate-y-4"
                class="relative z-10 max-h-screen w-full overflow-x-hidden overflow-y-auto rounded-[2.5rem] border border-gray-200 bg-white shadow-2xl transition-all dark:border-gray-800 dark:bg-[#151821] sm:mx-auto {{ $maxWidth }}"
                role="dialog" aria-modal="true">

                <button type="button" @click="show = false" aria-label="Cerrar modal"
                    class="absolute right-6 top-6 z-20 flex w-8 h-8 items-center justify-center rounded-full text-gray-400 transition-colors duration-300 hover:bg-gray-200 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:hover:bg-gray-800 dark:hover:text-white">
                    <i class="fa-solid fa-xmark text-lg" aria-hidden="true"></i>
                </button>

                <div class="p-8 md:p-10">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </template>
</div>
