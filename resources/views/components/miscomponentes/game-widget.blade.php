@props(['game'])

<div class="bg-gray-50 dark:bg-gray-900/40 border border-gray-200 dark:border-gray-800 rounded-3xl p-5 shadow-sm">
    <div class="flex items-start gap-4 sm:flex-col sm:gap-5">
        <img src="{{ $game->cover_url }}" alt="Portada de {{ $game->title }}"
            class="w-24 sm:w-full shrink-0 aspect-[3/4] object-cover rounded-2xl shadow-md border border-gray-200 dark:border-gray-700" />

        <div class="flex-1 min-w-0 flex flex-col gap-3 sm:gap-4">
            <h3 class="text-lg sm:text-xl font-black text-gray-900 dark:text-white leading-tight text-left sm:text-center">
                {{ $game->title }}
            </h3>

            <a href="{{ route('games.show', $game->slug) }}" wire:navigate
                class="w-full bg-gray-900 hover:bg-gray-800 dark:bg-white dark:hover:bg-gray-200 text-white dark:text-gray-900 font-black px-6 py-3 rounded-xl transition-all uppercase tracking-widest text-xs flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-gray-500 shadow-sm">
                <i class="fa-solid fa-gamepad mr-2" aria-hidden="true"></i> Ver Ficha
            </a>
        </div>
    </div>
</div>
