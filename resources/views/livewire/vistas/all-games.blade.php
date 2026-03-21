<div x-data="{ filtersOpen: false }" class="w-full">

    <template x-teleport="body">
        <div>
            <div x-show="filtersOpen" x-transition.opacity @click="filtersOpen = false"
                class="fixed inset-0 z-[100] bg-gray-900/60 dark:bg-black/80 backdrop-blur-sm" x-cloak>
            </div>

            <aside x-cloak wire:ignore :class="filtersOpen ? 'translate-x-0' : 'translate-x-full'"
                class="fixed inset-y-0 right-0 z-[110] w-full sm:w-80 bg-white dark:bg-[#151821] border-l border-gray-200 dark:border-gray-800 overflow-y-auto transition-transform duration-300 shadow-2xl flex flex-col translate-x-full custom-scrollbar">
                <div class="p-6 md:p-8 flex-1">
                    <div
                        class="flex items-center justify-between mb-8 border-b border-gray-200 dark:border-gray-800 pb-4">
                        <h2 class="font-black text-gray-900 dark:text-white text-xl tracking-tight">Filtros</h2>
                        <div class="flex items-center gap-4">
                            <button wire:click="clearFilters" @click="filtersOpen = false"
                                class="text-[10px] font-black text-cyan-600 dark:text-cyan-500 uppercase hover:text-cyan-700 dark:hover:text-cyan-400 transition-colors">Limpiar</button>
                            <button @click="filtersOpen = false"
                                class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 dark:bg-[#1a1d27] text-gray-500 hover:text-gray-900 dark:hover:text-white transition-colors">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-10">
                        <div x-data="{ searchPlat: '' }">
                            <h3
                                class="text-xs font-black uppercase tracking-widest text-gray-900 dark:text-gray-400 mb-4">
                                Plataforma</h3>
                            <div class="relative mb-4">
                                <i
                                    class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-xs"></i>
                                <input type="text" x-model="searchPlat" placeholder="Buscar plataforma..."
                                    class="w-full bg-gray-100 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white rounded-xl pl-10 pr-4 py-3 text-xs font-bold focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors placeholder-gray-500 shadow-inner" />
                            </div>
                            <div class="space-y-3 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                                @foreach ($allPlatforms as $platform)
                                    <label
                                        x-show="searchPlat === '' || '{{ strtolower($platform->name) }}'.includes(searchPlat.toLowerCase())"
                                        class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" value="{{ $platform->id }}"
                                            wire:model.live="platformsFilter"
                                            class="w-4 h-4 rounded border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0f1117] text-cyan-600 focus:ring-cyan-500 transition-colors cursor-pointer" />
                                        <span
                                            class="text-sm font-bold text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:hover:text-white transition-colors">
                                            {{ $platform->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div x-data="{ nota: @entangle('minRatingFilter') }">
                            <h3
                                class="text-xs font-black uppercase tracking-widest text-gray-900 dark:text-gray-400 mb-4">
                                Nota LUDEXIS Mínima</h3>
                            <div class="px-2">
                                <input type="range" min="0" max="100"
                                    wire:model.live.debounce.300ms="minRatingFilter"
                                    class="w-full h-1.5 bg-gray-200 dark:bg-gray-800 rounded-lg appearance-none cursor-pointer accent-cyan-600 transition-colors" />
                                <div
                                    class="flex justify-between mt-3 text-[10px] font-black text-gray-500 uppercase tracking-widest">
                                    <span>0</span>
                                    <span class="text-cyan-600">> <span x-text="nota"></span></span>
                                    <span>100</span>
                                </div>
                            </div>
                        </div>

                        <div x-data="{ expanded: false }">
                            <h3
                                class="text-xs font-black uppercase tracking-widest text-gray-900 dark:text-gray-400 mb-4">
                                Géneros</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($topGenres as $genre)
                                    <label class="cursor-pointer group">
                                        <input type="checkbox" value="{{ $genre->id }}"
                                            wire:model.live="genresFilter" class="hidden peer" />
                                        <div
                                            class="bg-gray-100 dark:bg-[#1a1d27] text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-gray-600 px-4 py-2 rounded-xl text-xs font-bold transition-all peer-checked:bg-cyan-600 peer-checked:text-white peer-checked:border-cyan-500 shadow-sm">
                                            {{ $genre->name }}
                                        </div>
                                    </label>
                                @endforeach
                                <div x-show="expanded" x-collapse class="flex flex-wrap gap-2 mt-1 w-full">
                                    @foreach ($otherGenres as $genre)
                                        <label class="cursor-pointer group">
                                            <input type="checkbox" value="{{ $genre->id }}"
                                                wire:model.live="genresFilter" class="hidden peer" />
                                            <div
                                                class="bg-gray-100 dark:bg-[#1a1d27] text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-gray-600 px-4 py-2 rounded-xl text-xs font-bold transition-all peer-checked:bg-cyan-600 peer-checked:text-white peer-checked:border-cyan-500 shadow-sm">
                                                {{ $genre->name }}
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <button @click="expanded = !expanded"
                                class="mt-4 text-[10px] font-black uppercase tracking-widest text-gray-500 hover:text-cyan-600 transition-colors flex items-center gap-2 focus:outline-none">
                                <span x-text="expanded ? 'Mostrar menos' : 'Mostrar todos'"></span>
                                <i class="fa-solid fa-chevron-down transition-transform"
                                    :class="expanded ? 'rotate-180' : ''"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </template>

    <x-miscomponentes.page-layout title1="Explorar" title2="Catálogo" :subtitle="'Mostrando ' . count($games) . ' títulos'" :full-width="false">
        <x-slot:aside>
            <button @click="filtersOpen = true"
                class="bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 hover:bg-gray-50 text-gray-900 dark:text-white px-5 py-3 rounded-xl text-xs uppercase tracking-widest font-black flex items-center gap-3 transition-colors shadow-sm">
                <i class="fa-solid fa-filter text-cyan-600 dark:text-cyan-500"></i> Filtros
            </button>
            <div class="relative group">
                <i class="fa-solid fa-sort absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <select wire:model.live="orderBy"
                    class="bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white text-sm rounded-xl pl-10 pr-10 py-3 font-bold appearance-none cursor-pointer w-full transition-colors shadow-sm focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500">
                    <option value="first_release_date">Más recientes</option>
                    <option value="rating">Puntuación Ludexis</option>
                </select>
                <i
                    class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
            </div>
        </x-slot:aside>

        <div class="relative min-h-[500px]" x-data="{
            dispatched: false,
            observe() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !this.dispatched) {
                            this.dispatched = true;
                            $wire.loadMore().then(() => { this.dispatched = false; });
                        }
                    })
                }, { threshold: 0.1 });
                observer.observe(this.$refs.infiniteMarker);
            }
        }" x-init="observe()">

            @if (count($games))
                <div
                    class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-6 md:gap-8">
                    @foreach ($games as $item)
                        <div wire:click="addToDb('{{ $item->slug }}')"
                            class="relative group aspect-[3/4] rounded-[2rem] overflow-hidden bg-gray-100 dark:bg-[#151821] border border-gray-200 dark:border-gray-800 cursor-pointer shadow-sm hover:shadow-xl transition-all duration-500">
                            <img src="{{ $item->cover_url }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                loading="lazy" />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-gray-900/95 via-gray-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>

                            <div
                                class="absolute inset-0 flex flex-col justify-between p-5 md:p-6 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-4 group-hover:translate-y-0">
                                <div class="flex justify-between items-start">
                                    @if ($item->first_release_date && $item->first_release_date->isFuture())
                                        <span
                                            class="bg-gray-900/90 text-cyan-400 border border-gray-700 px-3 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest shadow-lg">
                                            Próximamente ({{ $item->first_release_date->year }})
                                        </span>
                                    @elseif($item->first_release_date)
                                        <span
                                            class="bg-gray-900/90 text-white border border-gray-700 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest">
                                            {{ $item->first_release_date->year }}
                                        </span>
                                    @endif

                                    @if ($item->rating)
                                        <span
                                            class="bg-gray-900/90 text-cyan-400 font-black text-sm px-3 py-1.5 rounded-lg border border-gray-700 flex items-center gap-1 shadow-lg">
                                            {{ round($item->rating) }} <i class="fa-solid fa-star text-[10px]"></i>
                                        </span>
                                    @endif
                                </div>

                                <div>
                                    <h3
                                        class="font-black text-white text-lg md:text-xl leading-tight mb-2 drop-shadow-md">
                                        {{ $item->title }}
                                    </h3>
                                    <div class="flex flex-wrap gap-2 mb-6">
                                        @foreach ($item->genres->take(2) as $genre)
                                            <span
                                                class="text-[9px] bg-gray-800/80 text-gray-300 border border-gray-600 px-2 py-1 rounded-md font-bold uppercase tracking-wider">{{ $genre->name }}</span>
                                        @endforeach
                                    </div>
                                    @auth
                                        <button
                                            class="w-full bg-cyan-600 hover:bg-cyan-500 text-white text-xs font-black uppercase tracking-widest py-3 rounded-xl transition-colors shadow-lg flex items-center justify-center gap-2">
                                            <i class="fa-solid fa-plus text-sm"></i> Añadir
                                        </button>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div x-ref="infiniteMarker" class="h-10 w-full mt-4"></div>
            @else
                <div
                    class="flex flex-col items-center justify-center py-32 px-6 border-2 border-dashed border-gray-300 dark:border-gray-800 rounded-[2rem] bg-white/50 dark:bg-[#151821]/50 transition-colors">
                    <div
                        class="mb-6 bg-gray-100 dark:bg-gray-800/50 w-24 h-24 flex items-center justify-center rounded-full border border-gray-200 transition-colors shadow-sm">
                        <i class="fa-solid fa-magnifying-glass text-4xl text-gray-400 transition-colors"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-3">No hay resultados</h3>
                    <p class="text-gray-600 dark:text-gray-500 text-sm font-medium text-center max-w-md">Intenta
                        limpiar los filtros para encontrar el juego que buscas.</p>
                    <button wire:click="clearFilters"
                        class="mt-8 bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-700 text-cyan-600 font-black px-6 py-3 rounded-xl text-xs uppercase tracking-widest transition-all shadow-sm hover:shadow-md hover:-translate-y-1 flex items-center gap-2">
                        <i class="fa-solid fa-rotate-right"></i> Limpiar Filtros
                    </button>
                </div>
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
