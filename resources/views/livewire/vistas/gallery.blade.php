<div class="relative w-full">
    <x-miscomponentes.page-layout :title1="isset($game) ? 'Galería de' : 'Galería de la'" :title2="isset($game) ? $game->title : 'Comunidad'" :subtitle="isset($game) ? 'Explora las capturas de este juego.' : 'Todas las capturas de la comunidad'" :full-width="!isset($game)">

        {{-- BARRA SUPERIOR: CONTROLES Y FILTROS --}}
        <x-slot:aside>
            <div class="flex items-center gap-4">
                @auth
                    <button type="button" @click="$wire.set('showingModal', true)"
                        class="bg-cyan-700 hover:bg-cyan-600 dark:bg-cyan-600 dark:hover:bg-cyan-500 text-white px-5 py-3 rounded-xl text-sm uppercase tracking-widest font-black flex items-center gap-3 transition-all shadow-lg shadow-cyan-900/20 active:scale-95 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        <i class="fa-solid fa-cloud-arrow-up" aria-hidden="true"></i> Subir Imagen
                    </button>
                @endauth

                {{-- Filtros Desplegables --}}
                <div class="relative" x-data="{ filtersOpen: false }">
                    <button type="button" @click="filtersOpen = !filtersOpen" aria-haspopup="true"
                        :aria-expanded="filtersOpen.toString()"
                        class="bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-800 hover:bg-gray-50 text-gray-900 dark:text-white px-5 py-3 rounded-xl text-sm tracking-widest font-black flex items-center gap-3 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        <i class="fa-solid fa-filter text-cyan-700 dark:text-cyan-500" aria-hidden="true"></i> Filtros
                    </button>

                    <div x-show="filtersOpen" @click.away="filtersOpen = false" x-transition.opacity
                        @keydown.escape.window="filtersOpen = false"
                        class="absolute right-0 top-full mt-3 w-80 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-800 rounded-2xl shadow-2xl z-[100] p-6 flex flex-col gap-6"
                        role="dialog" aria-label="Panel de filtros" x-cloak>

                        <div
                            class="flex items-center justify-between border-b border-gray-300 dark:border-gray-800 pb-4">
                            <h2 class="font-black text-gray-900 dark:text-white text-lg tracking-tight">Filtros</h2>
                            <button type="button" wire:click="clearFilters" @click="filtersOpen = false"
                                class="text-sm font-black text-cyan-700 dark:text-cyan-500 uppercase tracking-widest hover:underline focus:outline-none">Limpiar</button>
                        </div>

                        {{-- Filtro de Juegos --}}
                        <div x-data="{ searchGame: '' }">
                            <h3 class="text-sm font-black uppercase tracking-widest text-gray-700 dark:text-gray-400 mb-3"
                                id="filter-games-heading">Juegos</h3>
                            <label for="search-games-filter" class="sr-only">Buscar juego en filtros</label>
                            <input id="search-games-filter" type="search" x-model="searchGame" placeholder="Buscar..."
                                class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 text-sm font-bold text-gray-900 dark:text-white mb-3 focus:ring-2 focus:ring-cyan-500 focus:outline-none placeholder-gray-500 shadow-inner">

                            <div class="space-y-2 max-h-40 overflow-y-auto custom-scrollbar" role="group"
                                aria-labelledby="filter-games-heading">
                                @foreach ($allGames as $g)
                                    <label
                                        x-show="(searchGame.trim() !== '' && '{{ strtolower(str_replace('\'', '\\\'', $g->title)) }}'.includes(searchGame.trim().toLowerCase())) || $wire.gamesFilter.includes({{ $g->id }})"
                                        class="flex items-center gap-2.5 cursor-pointer group">
                                        <input type="checkbox" wire:model.live="gamesFilter" value="{{ $g->id }}"
                                            class="w-4 h-4 rounded border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-800 text-cyan-700 dark:text-cyan-500 focus:ring-cyan-500">
                                        <span
                                            class="text-sm font-bold text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition-colors">{{ $g->title }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="space-y-4">
                            {{-- Filtro Spoilers --}}
                            <div>
                                <label for="filter-spoilers" class="sr-only">Filtrar por spoilers</label>
                                <select id="filter-spoilers" wire:model.live="spoilerFilter"
                                    class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 text-sm font-bold text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 focus:outline-none">
                                    <option value="all">Todos los Spoilers</option>
                                    <option value="hide">Ocultar Spoilers</option>
                                    <option value="only">Solo Spoilers</option>
                                </select>
                            </div>

                            {{-- Filtro Fechas --}}
                            <div>
                                <label for="filter-dates" class="sr-only">Filtrar por fecha</label>
                                <select id="filter-dates" wire:model.live="dateFilter"
                                    class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 text-sm font-bold text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 focus:outline-none">
                                    <option value="all">Cualquier fecha</option>
                                    <option value="24h">Últimas 24h</option>
                                    <option value="week">Esta semana</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Ordenación Global --}}
                <div class="relative">
                    <label for="order-gallery" class="sr-only">Ordenar galería</label>
                    <select id="order-gallery" wire:model.live="orderBy"
                        class="bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-800 text-gray-900 dark:text-white text-sm rounded-xl px-4 py-3 font-black tracking-widest focus:ring-2 focus:ring-cyan-500 focus:outline-none shadow-sm cursor-pointer">
                        <option value="created_at">Más recientes</option>
                        <option value="likes">Más valoradas</option>
                    </select>
                </div>
            </div>
        </x-slot:aside>

        {{-- CONTENIDO DE LA GALERÍA --}}
        <div class="{{ isset($game) ? 'grid grid-cols-1 xl:grid-cols-12 gap-8 w-full' : 'w-full' }}">

            {{-- GRID DE IMÁGENES --}}
            <div class="{{ isset($game) ? 'xl:col-span-8 2xl:col-span-9' : '' }}">
                @if (count($images) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 {{ isset($game) ? 'xl:grid-cols-3 2xl:grid-cols-4' : 'xl:grid-cols-4 2xl:grid-cols-5' }} gap-6 w-full"
                        role="list">

                        @foreach ($images as $item)
                            <div x-data="{ loaded: false, revealed: false }" wire:key="gal-img-{{ $item->id }}"
                                @click="$dispatch('open-image-detail', { imageId: {{ $item->id }} })"
                                @if ($item->is_spoiler) @click="revealed = true" @endif
                                @if ($item->is_spoiler) @keydown.enter="revealed = true" @endif role="button"
                                tabindex="0" aria-label="Captura de pantalla compartida por {{ $item->user->name }}"
                                class="relative group rounded-3xl overflow-hidden bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-1 flex flex-col h-full cursor-pointer focus:outline-none focus:ring-4 focus:ring-cyan-500">

                                <div
                                    class="relative w-full overflow-hidden bg-gray-100 dark:bg-gray-950 aspect-video shrink-0">
                                    <div x-show="!loaded"
                                        class="absolute inset-0 animate-pulse flex items-center justify-center z-10"
                                        aria-hidden="true">
                                        <i class="fa-solid fa-image text-gray-400 dark:text-gray-800 text-4xl"></i>
                                    </div>

                                    {{-- Capa Spoiler --}}
                                    @if ($item->is_spoiler)
                                        <div x-show="loaded && !revealed" x-cloak
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                            class="absolute inset-0 z-20 bg-gray-950/95 backdrop-blur-2xl flex flex-col items-center justify-center p-6 text-center transition-colors duration-300 group-hover:bg-gray-900/90">
                                            <i class="fa-solid fa-eye-slash text-cyan-500 text-4xl mb-4"
                                                aria-hidden="true"></i>
                                            <h4 class="font-black text-white uppercase tracking-tighter text-xl">
                                                Contenido Spoiler</h4>
                                            <p
                                                class="text-sm text-gray-200 font-bold mt-2 uppercase tracking-widest bg-gray-800/80 px-4 py-1.5 rounded-full">
                                                Haz clic para revelar
                                            </p>
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
                                <div class="p-5 flex flex-col justify-between flex-1 bg-white dark:bg-gray-900">
                                    @if (!isset($game))
                                        <div class="flex items-start gap-4">
                                            @if ($item->game && $item->game->cover_url)
                                                <a href="{{ route('games.show', $item->game->slug) }}">
                                                    <img src="{{ $item->game->cover_url }}"
                                                        alt="Portada de {{ $item->game->title }}"
                                                        class="w-12 h-16 rounded-lg object-cover shrink-0 border border-gray-200 dark:border-gray-800 shadow-sm"
                                                        loading="lazy">
                                                </a>
                                            @endif

                                            <div class="flex-1 flex flex-col gap-2">
                                                <div class="flex items-start justify-between gap-3">
                                                    <a href="{{ route('games.show', $item->game->slug) }}">
                                                        <span
                                                            class="text-sm font-black text-gray-900 dark:text-white line-clamp-2 leading-tight hover:text-cyan-700 dark:hover:text-cyan-400 transition-colors">
                                                            {{ $item->game->title ?? 'Juego Desconocido' }}
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div
                                        class="flex justify-between items-center gap-3 pt-4 mt-auto border-t border-gray-200 dark:border-gray-800/80">
                                        <span
                                            class="font-bold text-sm text-gray-700 dark:text-gray-400 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 transition-colors">
                                            {{ $item->user->name }}
                                        </span>
                                        {{-- BOTÓN DE LIKE --}}
                                        @livewire('utils.like-button', ['model' => $item], key('like-review-' . $item->id))
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- Observer para Scroll Infinito --}}
                    <div x-intersect="$wire.loadMore()" class="h-10 w-full mt-4" aria-hidden="true"></div>
                @else
                    {{-- ESTADO VACÍO --}}
                    <div class="flex flex-col items-center justify-center py-32 border-2 border-dashed border-gray-400 dark:border-gray-700 rounded-3xl bg-white/50 dark:bg-gray-900/50"
                        role="status">
                        <i class="fa-solid fa-image text-4xl text-gray-500 dark:text-gray-600 mb-4"
                            aria-hidden="true"></i>
                        <h3 class="text-xl font-black text-gray-900 dark:text-white">No hay capturas</h3>
                    </div>
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

    {{-- MODAL DE SUBIDA --}}
    <x-modal wire:model="showingModal" maxWidth="3xl">
        <div class="mb-10">
            <h2 id="modal-upload-title"
                class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter uppercase flex items-center gap-4">
                <i class="fa-solid fa-cloud-arrow-up text-cyan-700 dark:text-cyan-500" aria-hidden="true"></i> Subir
                Captura
            </h2>
        </div>

        <form wire:submit="save" class="grid grid-cols-1 md:grid-cols-2 gap-8" aria-labelledby="modal-upload-title">
            <div class="space-y-6">

                {{-- Zona de Drop / Input File --}}
                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <div class="relative group aspect-video">
                        <label for="image_upload" class="sr-only">Seleccionar imagen para subir</label>
                        <input id="image_upload" type="file" wire:model="cimage.image_path"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" aria-required="true">

                        <div
                            class="border-2 border-dashed border-gray-400 dark:border-gray-700 rounded-3xl p-6 flex flex-col items-center justify-center h-full {{ $cimage->image_path ? 'bg-gray-100 dark:bg-gray-900' : 'bg-gray-50 dark:bg-gray-950' }}">
                            @if ($cimage->image_path)
                                <img src="{{ $cimage->image_path->temporaryUrl() }}"
                                    alt="Previsualización de la imagen a subir"
                                    class="w-full h-full object-cover rounded-2xl shadow-sm">
                            @else
                                <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-600 dark:text-gray-500 mb-2"
                                    aria-hidden="true"></i>
                                <p class="text-sm font-black text-gray-700 dark:text-gray-400 uppercase">Seleccionar
                                    Imagen</p>
                            @endif
                        </div>
                    </div>
                    <x-input-error for="cimage.image_path"
                        class="mt-2 text-red-600 dark:text-red-500 text-sm font-bold" />
                </div>

                {{-- Toggle Spoiler --}}
                <label for="is-spoiler-toggle"
                    class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-800 rounded-2xl cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <span
                        class="text-sm font-black text-gray-800 dark:text-gray-300 uppercase tracking-widest">¿Contiene
                        Spoilers?</span>
                    <input id="is-spoiler-toggle" type="checkbox" wire:model="cimage.is_spoiler"
                        class="w-5 h-5 rounded border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-800 text-cyan-700 dark:text-cyan-500 focus:ring-cyan-500 transition-colors">
                </label>
            </div>

            <div class="flex flex-col justify-between h-full">
                {{-- Selector de Juego --}}
                <div>
                    <label for="game-select"
                        class="block text-sm font-black uppercase tracking-widest text-gray-700 dark:text-gray-400 mb-3">Juego
                        relacionado</label>
                    <select id="game-select" wire:model="cimage.game_id" aria-required="true"
                        class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-800 text-gray-900 dark:text-white rounded-xl p-4 text-sm font-bold focus:ring-2 focus:ring-cyan-500 focus:outline-none shadow-inner">
                        <option value="">Selecciona un juego...</option>
                        @foreach ($allGames as $game)
                            <option value="{{ $game->id }}">{{ $game->title }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="cimage.game_id"
                        class="mt-2 text-red-600 dark:text-red-500 text-sm font-bold" />
                </div>

                {{-- Botones de Acción --}}
                <div class="flex gap-4 mt-8">
                    <button type="button" @click="$wire.set('showingModal', false)"
                        class="flex-1 bg-gray-200 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-300 font-black py-4 rounded-xl uppercase text-sm tracking-widest transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="flex-1 bg-cyan-700 hover:bg-cyan-600 dark:bg-cyan-600 dark:hover:bg-cyan-500 text-white font-black py-4 rounded-xl uppercase text-sm tracking-widest shadow-lg shadow-cyan-900/20 transition-all active:scale-95 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        Publicar
                    </button>
                </div>
            </div>
        </form>
    </x-modal>

    <x-miscomponentes.loading-spinner variant="modal" wire:target="save, gamesFilter, spoilerFilter, dateFilter">
        Actualizando galería...
    </x-miscomponentes.loading-spinner>
</div>
