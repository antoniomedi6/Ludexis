<div class="relative w-full">
    <x-miscomponentes.page-layout :title1="isset($game) ? 'Galería de' : 'Galería de la'" :title2="isset($game) ? $game->title : 'Comunidad'" :subtitle="isset($game) ? 'Explora las capturas de este juego.' : 'Todas las capturas de la comunidad'" :full-width="!isset($game)">

        <x-slot:aside>
            <div class="flex items-center gap-4">

                <div class="relative" x-data="{ filtersOpen: false }">
                    <button @click="filtersOpen = !filtersOpen"
                        class="bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 hover:bg-gray-50 text-gray-900 dark:text-white px-5 py-3 rounded-xl text-xs uppercase tracking-widest font-black flex items-center gap-3 transition-colors shadow-sm">
                        <i class="fa-solid fa-filter text-cyan-600 dark:text-cyan-500"></i> Filtros
                    </button>

                    <div x-show="filtersOpen" @click.away="filtersOpen = false" x-transition.opacity.duration.200ms
                        class="absolute right-0 top-full mt-3 w-80 bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-2xl shadow-2xl z-[100] p-6 flex flex-col gap-6"
                        x-cloak>

                        <div
                            class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 pb-4">
                            <h2 class="font-black text-gray-900 dark:text-white text-lg tracking-tight">Filtros</h2>
                            <button wire:click="clearFilters" @click="filtersOpen = false"
                                class="text-[10px] font-black text-cyan-600 dark:text-cyan-500 uppercase hover:text-cyan-700 dark:hover:text-cyan-400 transition-colors">Limpiar</button>
                        </div>

                        <div class="flex flex-col gap-6">

                            <div x-data="{ searchGame: '' }">
                                <h3
                                    class="text-xs font-black uppercase tracking-widest text-gray-900 dark:text-gray-400 mb-3">
                                    Juegos</h3>
                                <div class="relative mb-3">
                                    <i
                                        class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                                    <input type="text" x-model="searchGame" placeholder="Escribe para buscar..."
                                        class="w-full bg-gray-50 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white rounded-lg pl-9 pr-3 py-2 text-xs font-bold focus:outline-none focus:ring-1 focus:ring-cyan-500">
                                </div>

                                <div x-show="searchGame.trim() === '' && $wire.gamesFilter.length === 0"
                                    class="text-[10px] text-gray-500 font-bold text-center py-4">
                                    Escribe el nombre de un juego para filtrar...
                                </div>

                                <div class="space-y-2 max-h-40 overflow-y-auto custom-scrollbar pr-1">
                                    @foreach ($allGames as $g)
                                        <label
                                            x-show="(searchGame.trim() !== '' && '{{ strtolower(str_replace('\'', '\\\'', $g->title)) }}'.includes(searchGame.trim().toLowerCase())) || $wire.gamesFilter.includes({{ $g->id }}) || $wire.gamesFilter.includes('{{ $g->id }}')"
                                            x-cloak class="flex items-center gap-2.5 cursor-pointer group">
                                            <input type="checkbox" wire:model.live="gamesFilter"
                                                value="{{ $g->id }}"
                                                class="w-4 h-4 rounded border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0f1117] text-cyan-600 focus:ring-cyan-500 transition-colors cursor-pointer">
                                            <span
                                                class="text-xs font-bold text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white transition-colors truncate">
                                                {{ $g->title }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <h3
                                    class="text-xs font-black uppercase tracking-widest text-gray-900 dark:text-gray-400 mb-3">
                                    Spoilers</h3>
                                <div class="relative">
                                    <select wire:model.live="spoilerFilter"
                                        class="w-full bg-gray-50 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-xs font-bold focus:outline-none focus:ring-1 focus:ring-cyan-500 appearance-none cursor-pointer">
                                        <option value="all">Mostrar todos</option>
                                        <option value="hide">Ocultar spoilers</option>
                                        <option value="only">Solo spoilers</option>
                                    </select>
                                    <i
                                        class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                                </div>
                            </div>

                            <div>
                                <h3
                                    class="text-xs font-black uppercase tracking-widest text-gray-900 dark:text-gray-400 mb-3">
                                    Fecha de publicación</h3>
                                <div class="relative">
                                    <select wire:model.live="dateFilter"
                                        class="w-full bg-gray-50 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white rounded-lg px-3 py-2.5 text-xs font-bold focus:outline-none focus:ring-1 focus:ring-cyan-500 appearance-none cursor-pointer">
                                        <option value="all">Cualquier fecha</option>
                                        <option value="24h">Últimas 24 horas</option>
                                        <option value="week">Esta semana</option>
                                        <option value="month">Este mes</option>
                                    </select>
                                    <i
                                        class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <i class="fa-solid fa-sort absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <select wire:model.live="orderBy"
                        class="bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white text-sm rounded-xl pl-10 pr-10 py-3 font-bold appearance-none cursor-pointer w-full transition-colors shadow-sm focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500">
                        <option value="created_at">Más recientes</option>
                        <option value="likes">Más valoradas</option>
                    </select>
                    <i
                        class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                </div>
            </div>
        </x-slot:aside>

        <div class="{{ isset($game) ? 'grid grid-cols-1 xl:grid-cols-12 gap-8 w-full' : 'w-full' }}">
            <div class="{{ isset($game) ? 'xl:col-span-8 2xl:col-span-9' : '' }}">
                @if (count($images) > 0)
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 {{ isset($game) ? 'xl:grid-cols-3 2xl:grid-cols-4' : 'xl:grid-cols-4 2xl:grid-cols-5' }} gap-6 w-full">
                        @foreach ($images as $item)
                            <div x-data="{ loaded: false, revealed: false }" wire:key="gal-img-{{ $item->id }}"
                                @if ($item->is_spoiler) @click="revealed = true" @endif
                                class="relative group rounded-3xl overflow-hidden bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-1 flex flex-col h-full cursor-pointer">

                                <div
                                    class="relative w-full overflow-hidden bg-gray-100 dark:bg-[#151821] aspect-video shrink-0">
                                    <div x-show="!loaded"
                                        class="absolute inset-0 animate-pulse flex items-center justify-center z-10">
                                        <i class="fa-solid fa-image text-gray-300 dark:text-gray-800 text-4xl"></i>
                                    </div>

                                    @if ($item->is_spoiler)
                                        <div x-show="loaded && !revealed" x-cloak
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                            class="absolute inset-0 z-20 bg-gray-950/95 dark:bg-[#0a0c10]/98 backdrop-blur-2xl flex flex-col items-center justify-center p-6 text-center transition-colors duration-300 group-hover:bg-gray-950/90 dark:group-hover:bg-[#0a0c10]/95">
                                            <i class="fa-solid fa-eye-slash text-cyan-500 text-4xl mb-4"></i>
                                            <h4 class="font-black text-white uppercase tracking-tighter text-xl">
                                                Contenido Spoiler</h4>
                                            <p
                                                class="text-xs text-gray-400 font-bold mt-2 uppercase tracking-widest bg-gray-800/50 px-4 py-1.5 rounded-full">
                                                Haz clic para revelar
                                            </p>
                                        </div>
                                    @endif

                                    <img src="{{ Storage::url($item->image_path) }}" x-init="if ($el.complete) loaded = true"
                                        @load="loaded = true" loading="lazy" decoding="async"
                                        class="w-full h-full object-cover block transition-transform duration-700"
                                        :class="(!'{{ $item->is_spoiler }}' || revealed) ? 'group-hover:scale-105' : ''" />

                                    <div x-show="loaded" x-cloak
                                        class="absolute top-4 right-4 z-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button @click.stop=""
                                            class="w-10 h-10 rounded-full bg-white/90 dark:bg-[#0f1117]/80 backdrop-blur text-gray-600 dark:text-gray-300 hover:text-red-500 flex items-center justify-center transition shadow-md active:scale-90">
                                            <i class="fa-solid fa-heart text-base"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="p-5 flex flex-col justify-between flex-1 bg-white dark:bg-[#1a1d27]">
                                    @if (!isset($game))
                                        <div class="flex items-start gap-4">
                                            @if ($item->game && $item->game->cover_url)
                                                <img src="{{ $item->game->cover_url }}"
                                                    class="w-12 h-16 rounded-lg object-cover shrink-0 border border-gray-100 dark:border-gray-800 shadow-sm"
                                                    loading="lazy">
                                            @else
                                                <div
                                                    class="w-12 h-16 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center border border-gray-100 dark:border-gray-800 shrink-0">
                                                    <i
                                                        class="fa-solid fa-box-open text-gray-400 dark:text-gray-600"></i>
                                                </div>
                                            @endif

                                            <div class="flex-1 flex flex-col gap-2">
                                                <div class="flex items-start justify-between gap-3">
                                                    <span
                                                        class="text-sm font-black text-gray-900 dark:text-white line-clamp-2 leading-tight hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">
                                                        {{ $item->game->title ?? 'Juego Desconocido' }}
                                                    </span>

                                                    <div
                                                        class="flex gap-3 text-xs font-bold text-gray-500 dark:text-gray-400 shrink-0 mt-0.5">
                                                        <span
                                                            class="flex items-center gap-1.5 hover:text-red-500 transition-colors">
                                                            <i class="fa-solid fa-heart"></i>
                                                            {{ $item->likes_count ?? 0 }}
                                                        </span>
                                                        <span
                                                            class="flex items-center gap-1.5 hover:text-cyan-500 transition-colors">
                                                            <i class="fa-solid fa-comment"></i>
                                                            {{ $item->comments_count ?? 0 }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div
                                            class="flex justify-end gap-3 text-xs font-bold text-gray-500 dark:text-gray-400 shrink-0 mb-2">
                                            <span
                                                class="flex items-center gap-1.5 hover:text-red-500 transition-colors">
                                                <i class="fa-solid fa-heart"></i> {{ $item->likes_count ?? 0 }}
                                            </span>
                                            <span
                                                class="flex items-center gap-1.5 hover:text-cyan-500 transition-colors">
                                                <i class="fa-solid fa-comment"></i> {{ $item->comments_count ?? 0 }}
                                            </span>
                                        </div>
                                    @endif

                                    <div
                                        class="flex items-center gap-3 pt-4 mt-auto border-t border-gray-100 dark:border-gray-800/80">
                                        @if ($item->user->profile_photo_path)
                                            <img src="{{ Storage::url($item->user->profile_photo_path) }}"
                                                class="w-7 h-7 rounded-full border border-gray-200 dark:border-gray-700 object-cover"
                                                loading="lazy" />
                                        @else
                                            <div
                                                class="w-7 h-7 rounded-full bg-cyan-600 flex items-center justify-center font-black text-xs text-white border border-gray-100 dark:border-gray-700">
                                                {{ strtoupper(substr($item->user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <span
                                            class="font-bold text-sm text-gray-600 dark:text-gray-500 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">
                                            {{ $item->user->name }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div
                        class="flex flex-col items-center justify-center py-32 px-6 border-2 border-dashed border-gray-300 dark:border-gray-800 rounded-[2rem] bg-white/50 dark:bg-[#151821]/50 transition-colors">
                        <div
                            class="mb-6 bg-gray-100 dark:bg-gray-800/50 w-24 h-24 flex items-center justify-center rounded-full border border-gray-200 dark:border-gray-700 transition-colors shadow-sm">
                            <i
                                class="fa-solid fa-image text-4xl text-gray-400 dark:text-gray-500 transition-colors"></i>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-3">No hay capturas</h3>
                        <p class="text-gray-600 dark:text-gray-500 text-sm font-medium text-center max-w-md">No hemos
                            encontrado ninguna captura con estos filtros. ¡Sé el primero en compartir tu experiencia!
                        </p>
                        <button
                            class="mt-8 bg-cyan-600 hover:bg-cyan-500 text-white font-black px-6 py-3 rounded-xl text-xs uppercase tracking-widest transition-all shadow-lg hover:-translate-y-0.5 flex items-center gap-2">
                            <i class="fa-solid fa-cloud-arrow-up text-sm"></i> Subir Captura
                        </button>
                    </div>
                @endif
            </div>

            @if (isset($game))
                <div class="xl:col-span-4 2xl:col-span-3 flex flex-col gap-8">
                    <div
                        class="bg-white dark:bg-[#151821]/80 backdrop-blur-2xl border border-gray-200 dark:border-gray-800 rounded-[2.5rem] p-6 shadow-xl sticky top-8 transition-colors duration-300">
                        <img src="{{ $game->cover_url }}"
                            class="w-full aspect-[3/4] object-cover rounded-2xl shadow-lg mb-6 border border-gray-200 dark:border-gray-700" />

                        <h2 class="text-2xl font-black text-gray-900 dark:text-white leading-tight mb-2">
                            {{ $game->title }}</h2>

                        <div class="flex items-center gap-3 mb-6">
                            @if ($game->rating)
                                <span
                                    class="bg-gray-100 dark:bg-[#1a1d27] text-cyan-600 dark:text-cyan-400 border border-gray-200 dark:border-gray-800 px-3 py-1.5 rounded-lg text-xs font-black flex items-center gap-1 shadow-sm">
                                    {{ round($game->rating) }} <i class="fa-solid fa-star text-[10px]"></i>
                                </span>
                            @endif
                            @if ($game->first_release_date)
                                <span
                                    class="bg-gray-100 dark:bg-[#1a1d27] text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-800 px-3 py-1.5 rounded-lg text-xs font-black uppercase tracking-widest shadow-sm">
                                    {{ $game->first_release_date->year }}
                                </span>
                            @endif
                        </div>

                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach ($game->genres->take(3) as $genre)
                                <span
                                    class="text-[10px] bg-gray-100 dark:bg-gray-800/80 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-600 px-2.5 py-1.5 rounded-lg font-bold uppercase tracking-wider">{{ $genre->name }}</span>
                            @endforeach
                        </div>

                        <button
                            class="w-full bg-cyan-600 hover:bg-cyan-500 text-white font-black px-6 py-3.5 rounded-xl transition-all shadow-lg uppercase tracking-widest text-xs flex items-center justify-center gap-2">
                            <i class="fa-solid fa-plus text-sm"></i> Añadir a mi lista
                        </button>

                        <a href="{{ route('games.show', $game->slug) }}"
                            class="w-full mt-3 bg-gray-50 dark:bg-transparent hover:bg-gray-100 dark:hover:bg-[#1a1d27] text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 font-black px-6 py-3.5 rounded-xl transition-all uppercase tracking-widest text-xs flex items-center justify-center">
                            Ver Ficha Completa
                        </a>
                    </div>
                </div>
            @endif
            <x-miscomponentes.loading-spinner variant="modal"
                wire:target="orderBy, gamesFilter, spoilerFilter, dateFilter, clearFilters">
            </x-miscomponentes.loading-spinner>
        </div>
    </x-miscomponentes.page-layout>
</div>
