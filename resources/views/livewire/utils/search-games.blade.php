<div class="flex-1 max-w-2xl relative hidden md:block z-50" x-data="{ show: false }" @click.away="show = false">

    {{-- BARRA DE BÚSQUEDA --}}
    <div class="relative">
        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 transition-colors duration-300"
            aria-hidden="true"></i>

        <label for="search-games" class="sr-only">Buscar juegos, sagas o estudios</label>
        <input id="search-games" type="search" wire:model.live.debounce.300ms="search" @focus="show = true"
            @keydown.escape.window="show = false" placeholder="Buscar juegos, sagas, estudios..." autocomplete="off"
            aria-autocomplete="list" aria-controls="search-results" :aria-expanded="show.toString()"
            class="w-full bg-gray-100 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 rounded-full pl-12 pr-12 py-2.5 text-sm focus:outline-none focus:border-cyan-500 dark:focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500 transition-colors duration-300 shadow-inner">

        <div wire:loading wire:target="search" class="absolute right-4 top-1/2 -translate-y-1/2" aria-live="polite">
            <span class="sr-only">Buscando...</span>
            <svg class="animate-spin h-5 w-5 text-cyan-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" aria-hidden="true">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
        </div>
    </div>

    {{-- RESULTADOS DE BÚSQUEDA --}}
    @if (count($games) > 0)
        <div x-show="show" x-transition.opacity.duration.200ms style="display: none;" id="search-results"
            role="listbox"
            class="absolute left-0 right-0 top-full mt-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-2xl overflow-hidden flex flex-col max-h-96 overflow-y-auto custom-scrollbar">

            @foreach ($games as $item)
                <button type="button" wire:click="addToDb('{{ $item->slug }}')" role="option"
                    class="w-full text-left flex cursor-pointer items-center gap-4 p-3 hover:bg-gray-50 dark:hover:bg-gray-700 focus:bg-gray-50 dark:focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 transition-colors border-b border-gray-100 dark:border-gray-700/50 last:border-0 group">

                    <div class="w-10 h-14 shrink-0 bg-gray-900 rounded overflow-hidden shadow border border-gray-700">
                        <img src="{{ $item->cover_url }}" alt="Portada de {{ $item->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            loading="lazy">
                    </div>

                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-black text-gray-900 dark:text-white truncate">{{ $item->title }}</h4>
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-widest">
                            {{ $item->first_release_date?->format('Y') ?? 'TBA' }}
                        </span>
                    </div>

                    <div class="flex flex-col items-center justify-center bg-cyan-900/20 border border-cyan-500/20 rounded px-2.5 py-1.5 shrink-0"
                        aria-label="Nota: {{ $item->rating ?? 'Sin calificar' }}">
                        <span class="text-xs font-black text-cyan-400"
                            aria-hidden="true">{{ $item->rating ?? '-' }}</span>
                    </div>
                </button>
            @endforeach

            <div
                class="p-3 bg-gray-50 dark:bg-gray-900 border-t border-gray-100 dark:border-gray-700 text-center shrink-0">
                <a href="/allGames?search={{ urlencode($search) }}" wire:navigate
                    class="text-xs font-black text-cyan-500 hover:text-cyan-400 focus:outline-none focus:underline transition-colors uppercase tracking-widest block w-full py-1">
                    Ver todos los resultados para "{{ $search }}"
                </a>
            </div>
        </div>

        {{-- ESTADO VACÍO --}}
    @elseif(strlen($search) >= 2)
        <div x-show="show" x-transition.opacity.duration.200ms style="display: none;" role="status"
            class="absolute left-0 right-0 top-full mt-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-2xl overflow-hidden p-6 text-center">
            <i class="fa-solid fa-ghost text-3xl text-gray-600 mb-3 block" aria-hidden="true"></i>
            <span class="text-sm font-bold text-gray-500 dark:text-gray-400">
                No se encontraron resultados para <span class="text-cyan-500">"{{ $search }}"</span>
            </span>
        </div>
    @endif
</div>
