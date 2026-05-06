<div class="relative w-full">
    <x-miscomponentes.page-layout :title1="isset($game) ? 'Galería de' : 'Galería de la'" :title2="isset($game) ? $game->title : 'Comunidad'" :subtitle="isset($game) ? 'Explora las capturas de este juego.' : 'Todas las capturas de la comunidad'" {{-- :full-width="!isset($game)" --}}>

        {{-- BARRA SUPERIOR: CONTROLES Y FILTROS --}}
        <x-slot:aside>
            <div class="flex flex-col md:flex-row md:justify-end items-start md:items-center gap-4 w-full">

                {{-- Filtros Modal --}}
                <div class="relative w-full sm:w-auto shrink-0" x-data="{ filtersOpen: false }">
                    <button type="button" @click="filtersOpen = !filtersOpen" aria-haspopup="true"
                        :aria-expanded="filtersOpen.toString()"
                        class="w-full sm:w-auto bg-lightbox-card dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border hover:bg-lightbox-soft dark:hover:bg-darkbox-card hover:border-cyan-300 dark:hover:border-cyan-600 text-lightbox-text dark:text-white px-5 py-2.5 rounded-2xl text-sm font-bold flex items-center justify-center gap-3 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        <i class="fa-solid fa-filter text-cyan-600 dark:text-cyan-500" aria-hidden="true"></i> Filtros
                    </button>

                    <div x-show="filtersOpen" @click.away="filtersOpen = false" x-transition.opacity
                        @keydown.escape.window="filtersOpen = false"
                        class="absolute left-0 sm:left-auto sm:right-0 top-full mt-3 w-full sm:w-80 bg-lightbox-card dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border rounded-2xl shadow-2xl z-[100] p-6 flex flex-col gap-6"
                        role="dialog" aria-label="Panel de filtros" x-cloak>

                        <div
                            class="flex items-center justify-between border-b border-lightbox-border dark:border-darkbox-border pb-4">
                            <h2 class="font-black text-lightbox-text dark:text-white text-lg tracking-tight">Filtros</h2>
                            <button type="button" wire:click="clearFilters" @click="filtersOpen = false"
                                class="text-xs font-bold text-cyan-600 dark:text-cyan-500 hover:underline focus:outline-none">Limpiar</button>
                        </div>

                        {{-- Filtro de Juegos --}}
                        @unless (isset($this->game))
                            <div x-data="{ searchGame: '' }">
                                <h3 class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3"
                                    id="filter-games-heading">Juegos</h3>
                                <label for="search-games-filter" class="sr-only">Buscar juego en filtros</label>
                                <input id="search-games-filter" type="search" x-model="searchGame" placeholder="Buscar..."
                                    class="w-full bg-lightbox-main dark:bg-gray-800 border border-lightbox-border dark:border-gray-700 rounded-xl px-3 py-2.5 text-sm font-bold text-lightbox-text dark:text-white mb-3 hover:bg-lightbox-soft dark:hover:bg-gray-700 hover:border-cyan-300 transition-colors focus:ring-2 focus:ring-cyan-500 focus:outline-none placeholder-gray-400 shadow-inner">

                                <div class="space-y-2 max-h-40 overflow-y-auto custom-scrollbar" role="group"
                                    aria-labelledby="filter-games-heading">
                                    @foreach ($allGames as $g)
                                        <label
                                            x-show="(searchGame.trim() !== '' && '{{ strtolower(str_replace('\'', '\\\'', $g->title)) }}'.includes(searchGame.trim().toLowerCase())) || $wire.gamesFilter.includes({{ $g->id }})"
                                            class="flex items-center gap-2.5 cursor-pointer group">
                                            <input type="checkbox" wire:model.live="gamesFilter" value="{{ $g->id }}"
                                                class="w-4 h-4 rounded border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-cyan-600 focus:ring-cyan-500">
                                            <span
                                                class="text-sm font-bold text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition-colors">{{ $g->title }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="space-y-4 border-t border-lightbox-border dark:border-darkbox-border pt-4"></div>
                        @endunless

                        {{-- Filtro Spoilers --}}
                        <div>
                            <label for="filter-spoilers" class="sr-only">Filtrar por spoilers</label>
                            <select id="filter-spoilers" wire:model.live="spoilerFilter"
                                class="w-full bg-lightbox-main dark:bg-gray-800 border border-lightbox-border dark:border-gray-700 rounded-xl px-3 py-2.5 text-sm font-bold text-lightbox-text dark:text-white hover:bg-lightbox-soft dark:hover:bg-gray-700 transition-colors focus:ring-2 focus:ring-cyan-500 focus:outline-none">
                                <option value="all">Todos los Spoilers</option>
                                <option value="hide">Ocultar Spoilers</option>
                                <option value="only">Solo Spoilers</option>
                            </select>
                        </div>

                        {{-- Filtro Fechas --}}
                        <div>
                            <label for="filter-dates" class="sr-only">Filtrar por fecha</label>
                            <select id="filter-dates" wire:model.live="dateFilter"
                                class="w-full bg-lightbox-main dark:bg-gray-800 border border-lightbox-border dark:border-gray-700 rounded-xl px-3 py-2.5 text-sm font-bold text-lightbox-text dark:text-white hover:bg-lightbox-soft dark:hover:bg-gray-700 transition-colors focus:ring-2 focus:ring-cyan-500 focus:outline-none">
                                <option value="all">Cualquier fecha</option>
                                <option value="24h">Últimas 24h</option>
                                <option value="week">Esta semana</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Ordenación y Botón de Acción --}}
                <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
                    {{-- Ordenación Global --}}
                    <div class="relative group w-full sm:w-56 shrink-0">
                        <label for="order-gallery" class="sr-only">Ordenar galería</label>
                        <i class="fa-solid fa-sort absolute left-4 top-1/2 -translate-y-1/2 text-lightbox-muted dark:text-gray-400 text-sm transition-colors duration-300"
                            aria-hidden="true"></i>

                        <select id="order-gallery" wire:model.live="orderBy"
                            class="bg-lightbox-card dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border hover:bg-lightbox-soft dark:hover:bg-darkbox-card text-lightbox-text dark:text-white text-sm rounded-2xl pl-10 pr-10 py-2.5 font-bold appearance-none cursor-pointer w-full transition-colors duration-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                            <option value="created_at">Más recientes</option>
                            <option value="likes">Más valoradas</option>
                        </select>

                        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-lightbox-muted dark:text-gray-400 text-xs pointer-events-none transition-colors duration-300 group-hover:text-cyan-600 dark:group-hover:text-cyan-500"
                            aria-hidden="true"></i>
                    </div>

                </div>

            </div>
        </x-slot:aside>

        {{-- CONTENIDO DE LA GALERÍA --}}
        <div class="{{ isset($game) ? 'grid grid-cols-1 xl:grid-cols-12 gap-8 w-full' : 'w-full' }}">

            {{-- GRID DE IMÁGENES --}}
            <div class="{{ isset($game) ? 'xl:col-span-8 2xl:col-span-9' : '' }}">
                @if (count($images) > 0)
                    <div class="grid grid-cols-2 lg:grid-cols-3 {{ isset($game) ? 'xl:grid-cols-3 2xl:grid-cols-4' : 'xl:grid-cols-4 2xl:grid-cols-5' }} gap-4 sm:gap-6 w-full items-stretch"
                        role="list">

                        @foreach ($images as $item)
                            <div x-data="{ loaded: false, revealed: false }" wire:key="gal-img-{{ $item->id }}"
                                @click="$dispatch('open-image-detail', { imageId: {{ $item->id }} })"
                                @if ($item->is_spoiler) @click="revealed = true" @endif
                                @if ($item->is_spoiler) @keydown.enter="revealed = true" @endif role="button"
                                tabindex="0" aria-label="Captura de pantalla compartida por {{ $item->user->name }}"
                                class="relative group rounded-3xl overflow-hidden bg-lightbox-card dark:bg-gray-900 border border-lightbox-border dark:border-gray-800 shadow-sm hover:shadow-xl hover:bg-lightbox-soft dark:hover:bg-gray-900 transition-all duration-500 hover:-translate-y-1 flex flex-col h-full cursor-pointer focus:outline-none focus:ring-4 focus:ring-cyan-500">

                                @if (Auth::id() === $item->user_id)
                                    <div class="absolute top-3 right-3 z-30">
                                        <livewire:utils.image-owner-actions :image="$item" :key="'image-owner-actions-gallery-' . $item->id" />
                                    </div>
                                @endif

                                <div
                                    class="relative w-full overflow-hidden bg-gray-100 dark:bg-gray-950 aspect-video shrink-0">
                                    <div x-show="!loaded"
                                        class="absolute inset-0 animate-pulse flex items-center justify-center z-10"
                                        aria-hidden="true">
                                        <i
                                            class="fa-solid fa-image text-gray-400 dark:text-gray-800 text-2xl sm:text-4xl"></i>
                                    </div>

                                    {{-- Capa Spoiler --}}
                                    @if ($item->is_spoiler)
                                        <div x-show="loaded && !revealed" x-cloak
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                            class="absolute inset-0 z-20 bg-black flex flex-col items-center justify-center p-4 sm:p-6 text-center transition-colors duration-300 group-hover:bg-black">
                                            <i class="fa-solid fa-eye-slash text-cyan-500 text-2xl sm:text-4xl mb-2 sm:mb-4"
                                                aria-hidden="true"></i>
                                            <h4
                                                class="font-black text-white uppercase tracking-tighter text-sm sm:text-xl">
                                                Spoiler</h4>
                                        </div>
                                    @endif

                                    {{-- Imagen Final --}}
                                    <img src="{{ Storage::url($item->image_path) }}" x-init="if ($el.complete) loaded = true"
                                        @load="loaded = true" loading="lazy" decoding="async"
                                        alt="{{ $item->is_spoiler ? 'Imagen oculta por spoiler' : 'Captura de pantalla del juego' }}"
                                        class="w-full h-full object-cover block transition-transform duration-700"
                                        :class="(!'{{ $item->is_spoiler }}' || revealed) ? 'group-hover:scale-105' : ''" />
                                </div>

                                {{-- Meta Info de la Tarjeta --}}
                                <div
                                    class="p-3 sm:p-5 flex flex-col justify-between flex-1 bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800">
                                    @if (!isset($game))
                                        <div class="flex items-start gap-3 sm:gap-4 mb-3 sm:mb-0">
                                            @if ($item->game && $item->game->cover_url)
                                                <a href="{{ route('games.show', $item->game->slug) }}"
                                                    class="shrink-0 hidden sm:block">
                                                    <img src="{{ $item->game->cover_url }}"
                                                        alt="Portada de {{ $item->game->title }}"
                                                        class="w-10 sm:w-12 aspect-[3/4] rounded-lg object-cover border border-gray-200 dark:border-gray-800 shadow-sm"
                                                        loading="lazy">
                                                </a>
                                            @endif

                                            <div class="flex-1 flex flex-col gap-1 sm:gap-2">
                                                <div class="flex items-start justify-between gap-2 sm:gap-3">
                                                    <a href="{{ route('games.show', $item->game->slug) }}">
                                                        <span
                                                            class="text-xs sm:text-sm font-black text-gray-900 dark:text-white line-clamp-2 leading-tight hover:text-cyan-700 dark:hover:text-cyan-400 transition-colors break-words">
                                                            {{ $item->game->title ?? 'Juego Desconocido' }}
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div
                                        class="flex justify-between items-center gap-2 sm:gap-3 pt-3 sm:pt-4 mt-auto border-t border-gray-50 dark:border-gray-800/50">
                                        <a href="{{ route('profile', $item->user->id) }}"
                                            class="font-bold text-[10px] sm:text-sm text-gray-700 dark:text-gray-400 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 transition-colors truncate max-w-[100px] sm:max-w-none">
                                            {{ $item->user->name }}
                                        </a>
                                        {{-- BOTÓN DE LIKE --}}
                                        <div class="scale-90 sm:scale-100 origin-right">
                                            @livewire('utils.like-button', ['model' => $item], key('like-review-' . $item->id))
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- Observer para Scroll Infinito --}}
                    <div x-intersect="$wire.loadMore()" class="h-10 w-full mt-4" aria-hidden="true"></div>
                @else
                    {{-- ESTADO VACÍO --}}
                    <x-miscomponentes.empty-state title="No hay capturas"
                        content="Aún no se han subido imágenes. ¡Anímate a ser el primero en compartir tus mejores momentos!"
                        icon="fa-solid fa-image" />
                @endif
            </div>

            {{-- PANEL LATERAL: INFORMACIÓN DEL JUEGO --}}
            @if (isset($game))
                <aside class="xl:col-span-4 2xl:col-span-3 sticky top-8">
                    <x-miscomponentes.game-widget :game="$game" />
                </aside>
            @endif
        </div>
        {{-- SPINNER DE CARGA --}}
        <x-miscomponentes.loading-spinner variant="simple" wire:target="loadMore" />

    </x-miscomponentes.page-layout>


    <x-miscomponentes.loading-spinner variant="modal"
        wire:target="save, gamesFilter, spoilerFilter, dateFilter, orderBy">
        Actualizando galería...
    </x-miscomponentes.loading-spinner>
</div>
