<div class="w-full">
    <x-miscomponentes.page-layout title1="Explorar" title2="Catálogo" :subtitle="'Mostrando ' . count($games) . ' títulos'" :full-width="false">

        {{-- CONTROLES LATERALES Y FILTROS --}}
        <x-slot:aside>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 w-full sm:w-auto">

                <div class="relative w-full sm:w-auto" x-data="{ filtersOpen: false }">
                    <button type="button" @click="filtersOpen = !filtersOpen" aria-haspopup="true"
                        :aria-expanded="filtersOpen.toString()"
                        class="w-full sm:w-auto bg-lightbox-card dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border hover:bg-lightbox-soft dark:hover:bg-darkbox-card hover:border-cyan-300 dark:hover:border-cyan-600 text-lightbox-text dark:text-white px-5 py-3 rounded-xl text-sm font-black flex items-center justify-center gap-3 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        <i class="fa-solid fa-filter text-cyan-600 dark:text-cyan-500" aria-hidden="true"></i> Filtros
                    </button>

                    <div x-show="filtersOpen" @click.away="filtersOpen = false" x-transition.opacity
                        @keydown.escape.window="filtersOpen = false"
                        class="absolute right-0 top-full mt-3 w-full sm:w-96 max-h-[80vh] overflow-y-auto custom-scrollbar bg-lightbox-card dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border rounded-2xl shadow-2xl z-[100] p-6 flex flex-col gap-6"
                        role="dialog" aria-label="Panel de filtros" x-cloak>

                        <div
                            class="flex items-center justify-between border-b border-lightbox-border dark:border-darkbox-border pb-4 shrink-0">
                            <h2 class="font-black text-lightbox-text dark:text-white text-lg tracking-tight">Filtros</h2>
                            <button wire:click="clearFilters" @click="filtersOpen = false"
                                class="text-xs font-black text-cyan-600 uppercase tracking-widest hover:text-cyan-700 dark:hover:text-cyan-400 transition-colors focus:outline-none focus:underline">
                                Limpiar
                            </button>
                        </div>

                        {{-- Filtro: Plataformas --}}
                        <div x-data="{ searchPlat: '' }">
                            <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-3"
                                id="plat-heading">Plataforma</h3>
                            <div class="relative mb-3">
                                <label for="search-platform" class="sr-only">Buscar plataforma</label>
                                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-xs"
                                    aria-hidden="true"></i>
                                <input id="search-platform" type="search" x-model="searchPlat"
                                    placeholder="Buscar plataforma..."
                                    class="w-full bg-lightbox-main dark:bg-gray-800 border border-lightbox-border dark:border-gray-700 rounded-lg pl-9 pr-3 py-2 text-sm font-bold text-lightbox-text dark:text-white hover:bg-lightbox-soft dark:hover:bg-gray-700 hover:border-cyan-300 dark:hover:border-gray-600 focus:ring-2 focus:ring-cyan-500 focus:outline-none transition-colors shadow-inner">
                            </div>

                            <div class="space-y-2 max-h-32 overflow-y-auto custom-scrollbar px-1" role="group"
                                aria-labelledby="plat-heading">
                                @foreach ($allPlatforms as $platform)
                                    <label
                                        x-show="searchPlat === '' || @js(strtolower($platform->name)).includes(searchPlat.toLowerCase())"
                                        class="flex items-center gap-2.5 cursor-pointer group">
                                        <input type="checkbox" value="{{ $platform->id }}"
                                            wire:model.live="platformsFilter"
                                            class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-cyan-600 focus:ring-cyan-500 transition-colors cursor-pointer">
                                        <span
                                            class="text-sm font-bold text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white transition-colors">
                                            {{ $platform->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Filtro: Nota Mínima --}}
                        <div x-data="{ nota: @entangle('minRatingFilter') }">
                            <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-3">
                                <label for="rating-slider">Nota LUDEXIS Mínima</label>
                            </h3>
                            <div class="px-2">
                                <input id="rating-slider" type="range" min="0" max="100"
                                    wire:model.live.debounce.300ms="minRatingFilter"
                                    class="w-full h-1.5 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer accent-cyan-600 transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500" />
                                <div class="flex justify-between mt-3 text-xs font-black text-gray-500 uppercase tracking-widest"
                                    aria-hidden="true">
                                    <span>0</span>
                                    <span class="text-cyan-600">> <span x-text="nota"></span></span>
                                    <span>100</span>
                                </div>
                            </div>
                        </div>

                        {{-- Filtro: Géneros --}}
                        <div x-data="{ expanded: false }">
                            <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-3"
                                id="genre-heading">Géneros</h3>
                            <div class="flex flex-wrap gap-2" role="group" aria-labelledby="genre-heading">
                                @foreach ($topGenres as $genre)
                                    <label class="cursor-pointer group">
                                        <input type="checkbox" value="{{ $genre->id }}"
                                            wire:model.live="genresFilter" class="sr-only peer" />
                                        <div
                                            class="bg-lightbox-soft dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-lightbox-border dark:border-gray-700 hover:bg-lightbox-main dark:hover:bg-gray-700 hover:border-cyan-300 dark:hover:border-gray-600 px-3 py-1.5 rounded-lg text-xs font-bold transition-all peer-checked:bg-cyan-600 peer-checked:text-white peer-checked:border-cyan-500 shadow-sm peer-focus:ring-2 peer-focus:ring-cyan-500">
                                            {{ $genre->name }}
                                        </div>
                                    </label>
                                @endforeach

                                <div x-show="expanded" x-collapse class="flex flex-wrap gap-2 mt-1 w-full">
                                    @foreach ($otherGenres as $genre)
                                        <label class="cursor-pointer group">
                                            <input type="checkbox" value="{{ $genre->id }}"
                                                wire:model.live="genresFilter" class="sr-only peer" />
                                            <div
                                                class="bg-lightbox-soft dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-lightbox-border dark:border-gray-700 hover:bg-lightbox-main dark:hover:bg-gray-700 hover:border-cyan-300 dark:hover:border-gray-600 px-3 py-1.5 rounded-lg text-xs font-bold transition-all peer-checked:bg-cyan-600 peer-checked:text-white peer-checked:border-cyan-500 shadow-sm peer-focus:ring-2 peer-focus:ring-cyan-500">
                                                {{ $genre->name }}
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <button @click="expanded = !expanded" :aria-expanded="expanded.toString()"
                                class="mt-3 text-xs font-black uppercase tracking-widest text-gray-500 hover:text-cyan-600 transition-colors flex items-center gap-2 focus:outline-none focus:underline">
                                <span x-text="expanded ? 'Ocultar géneros' : 'Mostrar todos los géneros'"></span>
                                <i class="fa-solid fa-chevron-down transition-transform"
                                    :class="expanded ? 'rotate-180' : ''" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Ordenación --}}
                <div class="relative group w-full sm:w-56 shrink-0">
                    <label for="order-by" class="sr-only">Ordenar resultados por</label>
                    <i class="fa-solid fa-sort absolute left-4 top-1/2 -translate-y-1/2 text-lightbox-muted dark:text-gray-400 text-sm"
                        aria-hidden="true"></i>
                    <select id="order-by" wire:model.live="orderBy"
                        class="bg-lightbox-card dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border hover:bg-lightbox-soft dark:hover:bg-darkbox-card text-lightbox-text dark:text-white text-sm rounded-xl pl-10 pr-10 py-3 font-bold appearance-none cursor-pointer w-full transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                        <option value="first_release_date">Más recientes</option>
                        <option value="rating">Puntuación Ludexis</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-lightbox-muted dark:text-gray-400 text-xs pointer-events-none group-hover:text-cyan-600 dark:group-hover:text-cyan-500 transition-colors"
                        aria-hidden="true"></i>
                </div>

            </div>
        </x-slot:aside>

        {{-- LISTADO DE JUEGOS --}}
        <div class="relative min-h-[500px]">
            @if (count($games))
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-3 md:gap-8"
                    role="list">
                    @foreach ($games as $item)
                        <button type="button" wire:click="addToDb('{{ $item->slug }}')" role="listitem"
                            class="relative text-left group aspect-[3/4] rounded-3xl overflow-hidden bg-gray-100 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 cursor-pointer shadow-sm hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-cyan-500 transition-all duration-500 w-full block">

                            <img src="{{ $item->cover_url }}" alt="Portada de {{ $item->title }}"
                                class="w-full h-full object-cover transition-transform duration-700 md:group-hover:scale-105"
                                loading="lazy" />

                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/95 via-gray-900/60 to-transparent opacity-100 md:opacity-0 md:group-hover:opacity-100 md:group-focus:opacity-100 transition-opacity duration-300"
                                aria-hidden="true"></div>

                            <div
                                class="absolute inset-0 flex flex-col justify-between p-2.5 sm:p-4 md:p-6 opacity-100 md:opacity-0 md:group-hover:opacity-100 md:group-focus:opacity-100 transition-all duration-300 md:translate-y-4 md:group-hover:translate-y-0 md:group-focus:translate-y-0">

                                <div class="flex justify-between items-start gap-1.5">
                                    @if ($item->first_release_date && $item->first_release_date->isFuture())
                                        <span
                                            class="bg-gray-900/90 text-cyan-400 border border-gray-700 px-2 md:px-3 py-1 md:py-1.5 rounded-lg text-xxs md:text-xs font-black uppercase tracking-widest shadow-lg">
                                            <span class="md:hidden">Próx. {{ $item->first_release_date->year }}</span>
                                            <span class="hidden md:inline">Próximamente
                                                ({{ $item->first_release_date->year }})
                                            </span>
                                        </span>
                                    @elseif($item->first_release_date)
                                        <span
                                            class="bg-gray-900/90 text-white border border-gray-700 px-2 md:px-3 py-1 md:py-1.5 rounded-lg text-xxs md:text-xs font-black uppercase tracking-widest">
                                            {{ $item->first_release_date->year }}
                                        </span>
                                    @endif

                                    @if ($item->rating)
                                        <span
                                            class="bg-gray-900/90 text-cyan-400 font-black text-xxs md:text-sm px-2 md:px-3 py-1 md:py-1.5 rounded-lg border border-gray-700 flex items-center gap-1 shadow-lg"
                                            aria-label="Nota: {{ round($item->rating) }}">
                                            {{ round($item->rating) }} <i class="fa-solid fa-star text-xxs md:text-xs"
                                                aria-hidden="true"></i>
                                        </span>
                                    @endif
                                </div>

                                <div>
                                    <h3
                                        class="font-black text-white text-sm sm:text-base md:text-lg leading-tight mb-5 md:mb-2 drop-shadow-md line-clamp-2 md:line-clamp-none">
                                        {{ $item->title }}
                                    </h3>
                                    <div class="flex flex-wrap gap-1 md:gap-2 mb-1 md:mb-2"
                                        aria-label="Géneros principales">
                                        @foreach ($item->genres->take(2) as $genre)
                                            <span
                                                class="text-xxs md:text-xs bg-gray-800/80 text-gray-300 border border-gray-600 px-1.5 md:px-2 py-0.5 md:py-1 rounded-md font-bold uppercase tracking-wider">{{ $genre->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>

                {{-- Observer para Scroll Infinito --}}
                <div x-intersect="$wire.loadMore()" class="h-10 w-full mt-4" aria-hidden="true"></div>
            @else
                {{-- ESTADO VACÍO --}}
                <x-miscomponentes.empty-state title="No hay resultados"
                    content="Intenta limpiar los filtros para encontrar el juego que buscas."
                    icon="fa-solid fa-magnifying-glass">
                    <x-slot name="actions">
                        <button wire:click="clearFilters" type="button"
                            class="mt-8 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-cyan-600 font-black px-6 py-3 rounded-xl text-xxs md:text-xs uppercase tracking-widest transition-all shadow-sm hover:shadow-md flex items-center gap-2 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                            <i class="fa-solid fa-rotate-right" aria-hidden="true"></i> Limpiar Filtros
                        </button>
                    </x-slot>
                </x-miscomponentes.empty-state>
            @endif

            <x-miscomponentes.loading-spinner variant="modal"
                wire:target="orderBy, platformsFilter, genresFilter, minRatingFilter, clearFilters">
                Actualizando catálogo...
            </x-miscomponentes.loading-spinner>

            <x-miscomponentes.loading-spinner variant="simple" wire:target="loadMore" />

        </div>
        <x-miscomponentes.back-to-top />
    </x-miscomponentes.page-layout>
</div>
