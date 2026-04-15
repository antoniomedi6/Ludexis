@props(['game'])

<div class="bg-gray-50 dark:bg-gray-900/40 border border-gray-200 dark:border-gray-800 rounded-3xl p-5 shadow-sm">
    <img src="{{ $game->cover_url }}" alt="Portada de {{ $game->title }}"
        class="w-full aspect-[3/4] object-cover rounded-2xl mb-5 shadow-md border border-gray-200 dark:border-gray-700" />

    <h3 class="text-xl font-black text-gray-900 dark:text-white leading-tight mb-4 text-center">
        {{ $game->title }}
    </h3>

    <a href="{{ route('games.show', $game->slug) }}" wire:navigate
        class="w-full bg-gray-900 hover:bg-gray-800 dark:bg-white dark:hover:bg-gray-200 text-white dark:text-gray-900 font-black px-6 py-3 rounded-xl transition-all uppercase tracking-widest text-xs flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-gray-500 shadow-sm">
        <i class="fa-solid fa-gamepad mr-2"></i> Ver Ficha
    </a>
</div>
