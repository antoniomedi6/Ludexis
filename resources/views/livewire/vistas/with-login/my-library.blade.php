<x-miscomponentes.page-layout title1="Mi" title2="Biblioteca" :subtitle="'Tienes un total de ' . count($userGames) . ' juegos en tu registro.'">

    {{-- BARRA SUPERIOR: FILTROS Y ORDEN --}}
    <x-slot:aside>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 w-full">

            {{-- Buscador Principal --}}
            <div class="relative w-full md:w-64 shrink-0">
                <label for="search" class="sr-only">Buscar juego en la biblioteca</label>
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"
                    aria-hidden="true"></i>
                <input id="search" type="search" wire:model.live.debounce.300ms="search" placeholder="Buscar juego..."
                    class="w-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 hover:bg-[#1f2937] text-gray-900 dark:text-white text-sm rounded-xl pl-10 pr-4 py-3 font-bold transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">

                {{-- Modal de Filtros Desplegable --}}
                <div class="relative w-full sm:w-auto" x-data="{ filtersOpen: false }">
                    <button type="button" @click="filtersOpen = !filtersOpen" aria-haspopup="true"
                        :aria-expanded="filtersOpen.toString()"
                        class="w-full sm:w-auto bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 hover:bg-[#1f2937] text-gray-900 dark:text-white px-5 py-3 rounded-xl text-sm font-black flex items-center justify-center gap-3 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        <i class="fa-solid fa-filter text-cyan-700 dark:text-cyan-500" aria-hidden="true"></i> Filtros
                    </button>

                    <div x-show="filtersOpen" @click.away="filtersOpen = false" x-transition.opacity
                        @keydown.escape.window="filtersOpen = false"
                        class="absolute right-0 top-full mt-3 w-full sm:w-80 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-2xl z-[100] p-6 flex flex-col gap-6"
                        role="dialog" aria-label="Panel de filtros" x-cloak style="display: none;">

                        <div
                            class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 pb-4">
                            <h2 class="font-black text-gray-900 dark:text-white text-lg tracking-tight">Filtros</h2>
                            <button type="button" wire:click="$set('filterBy', '')" @click="filtersOpen = false"
                                class="text-sm font-black text-cyan-700 dark:text-cyan-500 uppercase tracking-widest hover:underline focus:outline-none">Limpiar</button>
                        </div>

                        <div class="space-y-4">
                            {{-- Filtro de Estado del Juego --}}
                            <div>
                                <label for="filter-status"
                                    class="block text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-3">
                                    Estado del juego
                                </label>
                                <select id="filter-status" wire:model.live="filterBy"
                                    class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-3 py-3 text-sm font-bold text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 focus:outline-none cursor-pointer">
                                    <option value="">Todos los juegos</option>
                                    <option value="playing">Jugando</option>
                                    <option value="completed">Completados</option>
                                    <option value="pending">Pendientes</option>
                                    <option value="paused">En Pausa</option>
                                    <option value="multiplayer">Multijugador</option>
                                    <option value="abandoned">Abandonados</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Ordenación Global --}}
                <div class="relative w-full sm:w-56 shrink-0">
                    <label for="order-library" class="sr-only">Ordenar biblioteca</label>
                    <i class="fa-solid fa-sort absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm transition-colors duration-300"
                        aria-hidden="true"></i>

                    <select id="order-library" wire:model.live="orderBy"
                        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 hover:bg-[#1f2937] text-gray-900 dark:text-white text-sm rounded-xl pl-10 pr-10 py-3 font-bold appearance-none cursor-pointer w-full transition-colors duration-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                        <option value="updated_at">Última actualización</option>
                        <option value="rating">Mi Puntuación</option>
                        <option value="time">Horas jugadas</option>
                    </select>

                    <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none transition-colors duration-300"
                        aria-hidden="true"></i>
                </div>

            </div>
        </div>
    </x-slot:aside>

    {{-- LISTADO DE JUEGOS --}}
    @if (count($userGames) > 0)
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 md:gap-6 w-full items-stretch"
            role="list">
            @foreach ($userGames as $item)
                @php
                    $status = $item->pivot->status ?? 'pending';
                    $rating = $item->pivot->rating ?? 0;
                    $hours = $item->pivot->hours_finish ?? 0;

                    $isAbandoned = $status === 'abandoned';
                    $isPending = $status === 'pending';
                @endphp

                <div role="listitem">
                    <a href="{{ route('games.show', $item->slug) }}"
                        class="h-full block group bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl dark:shadow-none hover:border-cyan-300 dark:hover:border-cyan-500/50 focus:outline-none focus:ring-4 focus:ring-cyan-500 transition-all duration-500 flex flex-col {{ $isAbandoned || $isPending ? 'opacity-80 hover:opacity-100' : '' }}">

                        {{-- PORTADA Y BADGES --}}
                        <div class="relative aspect-[4/3] w-full overflow-hidden shrink-0">
                            <img src="{{ $item->cover_url }}" alt="Portada de {{ $item->title }}" loading="lazy"
                                class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700 {{ $isAbandoned ? 'filter grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100' : '' }}" />
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 to-transparent opacity-80"
                                aria-hidden="true"></div>

                            {{-- Badges de Estado --}}
                            <div class="absolute top-4 right-3">
                                @if ($status === 'finish')
                                    <span
                                        class="bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 border border-green-200 dark:border-green-800/50 px-2 sm:px-3 py-1.5 rounded-lg text-[10px] sm:text-xs font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                        <i class="fa-solid fa-flag-checkered" aria-hidden="true"></i> <span
                                            class="hidden md:inline">Finalizado</span>
                                    </span>
                                @elseif ($status === 'completed')
                                    <span
                                        class="bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 border border-purple-200 dark:border-purple-800/50 px-2 sm:px-3 py-1.5 rounded-lg text-[10px] sm:text-xs font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                        <x-icons.completed class="size-4 sm:size-6" aria-hidden="true" /> <span
                                            class="hidden md:inline">100%</span>
                                    </span>
                                @elseif ($status === 'playing')
                                    <span
                                        class="bg-cyan-50 dark:bg-cyan-900/30 text-cyan-600 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50 px-2 sm:px-3 py-1.5 rounded-lg text-[10px] sm:text-xs font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                        <x-icons.playing class="size-4 sm:size-6" aria-hidden="true" /> <span
                                            class="hidden md:inline">Jugando</span>
                                    </span>
                                @elseif ($status === 'abandoned')
                                    <span
                                        class="bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800/50 px-2 sm:px-3 py-1.5 rounded-lg text-[10px] sm:text-xs font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                        <x-icons.abandoned class="size-4 sm:size-6" aria-hidden="true" /> <span
                                            class="hidden md:inline">Abandonado</span>
                                    </span>
                                @elseif ($status === 'pending')
                                    <span
                                        class="bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800/50 px-2 sm:px-3 py-1.5 rounded-lg text-[10px] sm:text-xs font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                        <x-icons.pending class="size-4 sm:size-6" aria-hidden="true" /> <span
                                            class="hidden md:inline">Pendiente</span>
                                    </span>
                                @elseif ($status === 'paused')
                                    <span
                                        class="bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800/50 px-2 sm:px-3 py-1.5 rounded-lg text-[10px] sm:text-xs font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                        <x-icons.paused class="size-4 sm:size-6" aria-hidden="true" /> <span
                                            class="hidden md:inline">En Pausa</span>
                                    </span>
                                @elseif ($status === 'multiplayer')
                                    <span
                                        class="bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800/50 px-2 sm:px-3 py-1.5 rounded-lg text-[10px] sm:text-xs font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                        <x-icons.multiplayer class="size-4 sm:size-6" aria-hidden="true" /> <span
                                            class="hidden md:inline">Multijugador</span>
                                    </span>
                                @endif
                            </div>

                            <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end">
                                <x-miscomponentes.star-rating :value10="$rating" size-class="w-3 sm:w-3.5 h-3 sm:h-3.5"
                                    class="text-cyan-500 dark:text-cyan-400 drop-shadow-md" :label=\"'Mi
                                    puntuación: ' . number_format(($rating ?? 0) / 2, 1) . ' sobre 5'\" />
                                <span
                                    class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-md text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-lg text-[10px] sm:text-xs font-bold uppercase tracking-wider shadow-sm transition-colors duration-300">
                                    PC
                                </span>
                            </div>
                        </div>

                        {{-- INFO DEL JUEGO --}}
                        <div
                            class="p-4 sm:p-6 flex-1 flex flex-col justify-center border-t border-gray-50 dark:border-gray-800/50">
                            <h3
                                class="text-base sm:text-xl font-black text-gray-900 dark:text-white leading-tight mb-2 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300 break-words">
                                {{ $item->title }}
                            </h3>
                            <p
                                class="text-[10px] sm:text-xs font-bold uppercase tracking-wider flex items-center gap-1.5 transition-colors duration-300 mt-auto pt-2
                                {{ $status === 'finish' || $status === 'completed' ? 'text-green-600 dark:text-green-500' : '' }}
                                {{ $status === 'playing' ? 'text-cyan-600 dark:text-cyan-500' : '' }}
                                {{ $status === 'abandoned' ? 'text-red-600 dark:text-red-500' : '' }}
                                {{ $status === 'pending' || $status === 'paused' ? 'text-yellow-600 dark:text-yellow-500' : '' }}
                                {{ $status === 'multiplayer' ? 'text-blue-600 dark:text-blue-500' : '' }}">
                                <i class="fa-regular fa-clock" aria-hidden="true"></i>
                                {{ $hours }} hrs jugadas
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{-- ESTADO VACÍO --}}
    @else
        <x-miscomponentes.empty-state :title="$filterBy === '' ? 'Tu biblioteca está vacía' : 'No hay juegos en este estado'" :content="$filterBy === '' ? 'Explora el catálogo y añade juegos a tu registro para empezar a llevar el control de tus partidas.' : 'Intenta seleccionar otro filtro para ver tu colección.'" icon="fa-solid fa-gamepad" />
    @endif

    <x-miscomponentes.loading-spinner variant="modal" wire:target="search, orderBy, filterBy">
        Actualizando juegos...
    </x-miscomponentes.loading-spinner>

</x-miscomponentes.page-layout>
