@props([
    'filter' => null,
    'orderBy' => null,
])
<div class="flex gap-4">
    @if ($filter)
        <button @click="filtersOpen = true"
            class="bg-lightbox-card dark:bg-darkbox-card border border-lightbox-border dark:border-darkbox-border hover:bg-lightbox-main text-gray-900 dark:text-white px-5 py-3 rounded-xl text-xs uppercase tracking-widest font-black flex items-center gap-3 transition-colors shadow-sm">
            <i class="fa-solid fa-filter text-cyan-600 dark:text-cyan-500"></i> Filtros
        </button>
        {{ $filterModal }}
    @endif
    @if ($orderBy)
        <div class="relative group">
            <i class="fa-solid fa-sort absolute left-4 top-1/2 -translate-y-1/2 text-lightbox-muted dark:text-gray-400 text-sm"
                aria-hidden="true"></i>
            <select wire:model.live="orderBy"
                class="bg-lightbox-card dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border hover:bg-lightbox-soft dark:hover:bg-darkbox-card text-lightbox-text dark:text-white text-sm rounded-xl pl-10 pr-10 py-3 font-bold appearance-none cursor-pointer w-full transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                {{ $options }}
            </select>
            <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-lightbox-muted dark:text-gray-400 text-xs pointer-events-none group-hover:text-cyan-600 dark:group-hover:text-cyan-500 transition-colors"
                aria-hidden="true"></i>
        </div>
    @endif
</div>
