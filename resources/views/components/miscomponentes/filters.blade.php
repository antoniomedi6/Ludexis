@props([
    'filter' => null,
    'orderBy' => null,
])
<div class="flex gap-4">
    @if ($filter)
        <button @click="filtersOpen = true"
            class="bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 hover:bg-gray-50 text-gray-900 dark:text-white px-5 py-3 rounded-xl text-xs uppercase tracking-widest font-black flex items-center gap-3 transition-colors shadow-sm">
            <i class="fa-solid fa-filter text-cyan-600 dark:text-cyan-500"></i> Filtros
        </button>
        {{ $filterModal }}
    @endif
    @if ($orderBy)
        <div class="relative group">
            <i class="fa-solid fa-sort absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <select wire:model.live="orderBy"
                class="bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white text-sm rounded-xl pl-10 pr-10 py-3 font-bold appearance-none cursor-pointer w-full transition-colors shadow-sm">
                {{ $options }}
            </select>
            <i
                class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
        </div>
    @endif
</div>
