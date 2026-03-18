<div class="bg-gray-50 dark:bg-[#0f1117] text-gray-900 dark:text-gray-100 flex-1 flex flex-col min-h-screen transition-colors duration-300"
    x-data="{ filtersOpen: false }">
    <section
        class="h-20 flex items-center justify-between px-8 shrink-0 z-20 bg-white/80 dark:bg-[#0f1117]/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 transition-colors duration-300">
        @livewire('utils.search-games')
    </section>
    <div x-show="filtersOpen" x-transition.opacity @click="filtersOpen = false"
        class="fixed inset-0 z-40 bg-gray-900/20 dark:bg-black/60 backdrop-blur-sm transition-colors duration-300"
        style="display: none;">
    </div>

    <aside :class="filtersOpen ? 'translate-x-0' : 'translate-x-full'"
        class="fixed inset-y-0 right-0 z-[60] w-full sm:w-80 bg-white/95 dark:bg-[#151821]/95 backdrop-blur-2xl border-l border-gray-200 dark:border-gray-800 overflow-y-auto transition-transform duration-300 custom-scrollbar shadow-2xl flex flex-col">

        <div class="p-6 md:p-8 flex-1">
            <div
                class="flex items-center justify-between mb-8 border-b border-gray-200 dark:border-gray-800 pb-4 transition-colors duration-300">
                <h2 class="font-black text-gray-900 dark:text-white text-xl tracking-tight">
                    Filtros
                </h2>
                <div class="flex items-center gap-4">
                    <button wire:click="clearFilters"
                        class="text-[10px] font-black text-cyan-600 dark:text-cyan-500 uppercase hover:text-cyan-700 dark:hover:text-cyan-400 transition-colors duration-300 focus:outline-none rounded">
                        Limpiar
                    </button>
                    <button @click="filtersOpen = false"
                        class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 dark:bg-[#1a1d27] text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>

            <div class="mb-10" x-data="{ search: '' }">
                <h3
                    class="text-xs font-black uppercase tracking-widest text-gray-900 dark:text-gray-400 mb-4 transition-colors duration-300">
                    Plataforma
                </h3>

                <div class="relative mb-4">
                    <i
                        class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-xs transition-colors duration-300"></i>
                    <input type="text" x-model="search" placeholder="Buscar plataforma..."
                        class="w-full bg-gray-100 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white rounded-xl pl-10 pr-4 py-3 text-xs font-bold focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors duration-300 placeholder-gray-500 dark:placeholder-gray-600 shadow-inner" />
                </div>

                <div class="space-y-3 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                    @foreach ($allPlatforms as $platform)
                        <label
                            x-show="search === '' || '{{ strtolower($platform->name) }}'.includes(search.toLowerCase())"
                            class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" value="{{ $platform->id }}" wire:model.live="platformsFilter"
                                class="w-4 h-4 rounded border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0f1117] text-cyan-600 dark:text-cyan-500 focus:ring-cyan-500 transition-colors duration-300 cursor-pointer" />
                            <span
                                class="text-sm font-bold text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white transition-colors duration-300">
                                {{ $platform->name }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-10">
                <h3
                    class="text-xs font-black uppercase tracking-widest text-gray-900 dark:text-gray-400 mb-4 transition-colors duration-300">
                    Nota LUDEXIS Mínima
                </h3>
                <div class="px-2" x-data="{ nota: $wire.minRatingFilter }">
                    <input type="range" min="0" max="100" wire:model.live.debounce.300ms="minRatingFilter"
                        x-on:input="nota = $event.target.value"
                        class="w-full h-1.5 bg-gray-200 dark:bg-gray-800 rounded-lg appearance-none cursor-pointer accent-cyan-600 dark:accent-cyan-500 transition-colors duration-300" />
                    <div
                        class="flex justify-between mt-3 text-[10px] font-black text-gray-500 uppercase tracking-widest transition-colors duration-300">
                        <span>0</span>
                        <span class="text-cyan-600 dark:text-cyan-500">> <span x-text="nota"></span></span>
                        <span>100</span>
                    </div>
                </div>
            </div>

            <div class="mb-8" x-data="{ expanded: false }">
                <h3
                    class="text-xs font-black uppercase tracking-widest text-gray-900 dark:text-gray-400 mb-4 transition-colors duration-300">
                    Géneros
                </h3>

                <div class="flex flex-wrap gap-2">
                    @foreach ($topGenres as $genre)
                        <label class="cursor-pointer group">
                            <input type="checkbox" value="{{ $genre->id }}" wire:model.live="genresFilter"
                                class="hidden peer" />
                            <div
                                class="bg-gray-100 dark:bg-[#1a1d27] text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-gray-600 px-4 py-2 rounded-xl text-xs font-bold transition-all duration-300 peer-checked:bg-cyan-600 dark:peer-checked:bg-cyan-600 peer-checked:text-white peer-checked:border-cyan-500 dark:peer-checked:border-cyan-400 shadow-sm peer-checked:shadow-[0_5px_15px_rgba(6,182,212,0.2)]">
                                {{ $genre->name }}
                            </div>
                        </label>
                    @endforeach

                    <div x-show="expanded" style="display: none;" class="flex flex-wrap gap-2 mt-1 w-full">
                        @foreach ($otherGenres as $genre)
                            <label class="cursor-pointer group">
                                <input type="checkbox" value="{{ $genre->id }}" wire:model.live="genresFilter"
                                    class="hidden peer" />
                                <div
                                    class="bg-gray-100 dark:bg-[#1a1d27] text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-800 hover:border-gray-300 dark:hover:border-gray-600 px-4 py-2 rounded-xl text-xs font-bold transition-all duration-300 peer-checked:bg-cyan-600 dark:peer-checked:bg-cyan-600 peer-checked:text-white peer-checked:border-cyan-500 dark:peer-checked:border-cyan-400 shadow-sm peer-checked:shadow-[0_5px_15px_rgba(6,182,212,0.2)]">
                                    {{ $genre->name }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <button @click="expanded = !expanded"
                    class="mt-4 text-[10px] font-black uppercase tracking-widest text-gray-500 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 flex items-center gap-2 focus:outline-none rounded px-1 py-1">
                    <span x-text="expanded ? 'Mostrar menos' : 'Mostrar todos'"></span>
                    <i class="fa-solid fa-chevron-down transition-transform duration-300"
                        :class="expanded ? 'rotate-180' : ''"></i>
                </button>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col items-start relative w-full max-w-[1600px] mx-auto">
        <div class="flex-1 p-6 md:p-10 lg:p-12 w-full">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-6">
                <div class="flex items-center gap-4">
                    <div class="flex flex-col">
                        <h1
                            class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter hidden sm:block transition-colors duration-300">
                            Explorar <span class="text-cyan-600 dark:text-cyan-500">Catálogo</span>
                        </h1>
                        <p
                            class="text-sm text-gray-500 dark:text-gray-400 font-bold transition-colors duration-300 mt-1">
                            Mostrando <span class="text-gray-900 dark:text-white">{{ count($games) }}</span> títulos
                        </p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <button @click="filtersOpen = true"
                        class="bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-900 dark:text-white px-5 py-3 rounded-xl text-xs uppercase tracking-widest font-black flex items-center gap-3 transition-colors duration-300 shadow-sm">
                        <i class="fa-solid fa-filter text-cyan-600 dark:text-cyan-500"></i> Filtros
                    </button>
                    <div class="relative w-full sm:w-auto group">
                        <i
                            class="fa-solid fa-sort absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-sm transition-colors duration-300"></i>
                        <select wire:model.live="orderBy"
                            class="bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white text-sm rounded-xl pl-10 pr-10 py-3 font-bold focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 appearance-none cursor-pointer w-full transition-colors duration-300 shadow-sm">
                            <option value="first_release_date">Más recientes</option>
                            <option value="rating">Puntuación Ludexis</option>
                        </select>
                        <i
                            class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-xs pointer-events-none transition-colors duration-300"></i>
                    </div>
                </div>
            </div>

            <div class="relative min-h-[500px]">
                @if (count($games))
                    <div
                        class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-6 md:gap-8">
                        @foreach ($games as $item)
                            <div wire:click="addToDb('{{ $item->slug }}')"
                                class="relative group aspect-[3/4] rounded-[2rem] overflow-hidden bg-gray-100 dark:bg-[#151821] border border-gray-200 dark:border-gray-800 cursor-pointer shadow-sm hover:shadow-xl dark:shadow-none hover:border-cyan-300 dark:hover:border-cyan-500/50 transition-all duration-500">
                                <img src="{{ $item->cover_url }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-gray-900/95 via-gray-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>

                                <div
                                    class="absolute inset-0 flex flex-col justify-between p-5 md:p-6 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-4 group-hover:translate-y-0">
                                    <div class="flex justify-between items-start">
                                        @if ($item->first_release_date && $item->first_release_date->isFuture())
                                            <span
                                                class="bg-gray-900/90 backdrop-blur-md text-cyan-400 border border-gray-700 px-3 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest shadow-lg">
                                                Próximamente ({{ $item->first_release_date->year }})
                                            </span>
                                        @elseif($item->first_release_date)
                                            <span
                                                class="bg-gray-900/90 backdrop-blur-md text-white border border-gray-700 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-lg">
                                                {{ $item->first_release_date->year }}
                                            </span>
                                        @endif

                                        @if ($item->rating)
                                            <span
                                                class="bg-gray-900/90 backdrop-blur-md text-cyan-400 font-black text-sm px-3 py-1.5 rounded-lg border border-gray-700 flex items-center gap-1 shadow-lg">
                                                {{ round($item->rating) }} <i
                                                    class="fa-solid fa-star text-[10px]"></i>
                                            </span>
                                        @endif
                                    </div>

                                    <div>
                                        <h3
                                            class="font-black text-white text-lg md:text-xl leading-tight mb-2 drop-shadow-md">
                                            {{ $item->title }}
                                        </h3>

                                        @php
                                            $developer = $item->companies->first(function ($company) {
                                                return $company->pivot ? (bool) $company->pivot->is_developer : true;
                                            });
                                        @endphp

                                        @if ($developer)
                                            <p
                                                class="text-[10px] text-gray-300 font-bold uppercase tracking-wider mb-4 truncate drop-shadow-md">
                                                {{ $developer->name }}
                                            </p>
                                        @endif

                                        <div class="flex flex-wrap gap-2 mb-6">
                                            @foreach ($item->genres->take(3) as $genre)
                                                <span
                                                    class="text-[9px] bg-gray-800/80 text-gray-300 border border-gray-600 px-2 py-1 rounded-md font-bold uppercase tracking-wider backdrop-blur-sm">{{ $genre->name }}</span>
                                            @endforeach
                                        </div>

                                        @auth
                                            <button
                                                class="w-full bg-cyan-600 hover:bg-cyan-500 text-white text-xs font-black uppercase tracking-widest py-3.5 rounded-xl transition-colors duration-300 shadow-[0_5px_15px_rgba(6,182,212,0.3)] flex items-center justify-center gap-2">
                                                <i class="fa-solid fa-plus text-lg"></i> Añadir
                                            </button>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div
                        class="flex flex-col items-center justify-center py-32 px-6 border-2 border-dashed border-gray-300 dark:border-gray-800 rounded-[2rem] bg-white/50 dark:bg-[#151821]/50 transition-colors duration-300">
                        <div
                            class="mb-6 bg-gray-100 dark:bg-gray-800/50 w-24 h-24 flex items-center justify-center rounded-full border border-gray-200 dark:border-gray-700 transition-colors duration-300 shadow-sm">
                            <i
                                class="fa-solid fa-magnifying-glass text-4xl text-gray-400 dark:text-gray-600 transition-colors duration-300"></i>
                        </div>
                        <h3
                            class="text-2xl font-black text-gray-900 dark:text-white mb-3 transition-colors duration-300">
                            No se han encontrado resultados</h3>
                        <p
                            class="text-gray-600 dark:text-gray-500 text-sm font-medium text-center max-w-md transition-colors duration-300">
                            Intenta cambiar los filtros, ajustar la nota mínima o limpiar la búsqueda para encontrar el
                            juego que deseas.
                        </p>
                        <button wire:click="clearFilters"
                            class="mt-8 bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-700 text-cyan-600 dark:text-cyan-500 hover:bg-gray-50 dark:hover:bg-gray-800 font-black px-6 py-3 rounded-xl text-xs uppercase tracking-widest transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1 flex items-center gap-2">
                            <i class="fa-solid fa-rotate-right"></i> Limpiar Filtros
                        </button>
                    </div>
                @endif

                <div x-data="{
                    dispatched: false,
                    checkScroll() {
                        const scrollPosition = window.scrollY;
                        const windowHeight = window.innerHeight;
                        const documentHeight = document.documentElement.scrollHeight;
                        const percentage = (scrollPosition / (documentHeight - windowHeight)) * 100;
                
                        if (percentage >= 90) {
                            if (!this.dispatched) {
                                $wire.loadMore()
                                this.dispatched = true;
                            }
                        } else {
                            this.dispatched = false;
                        }
                    }
                }" @scroll.window.throttle.50ms="checkScroll()">
                </div>

                <x-miscomponentes.loading-spinner variant="modal"
                    wire:target="orderBy, platformsFilter, genresFilter, minRatingFilter, clearFilters">
                    Actualizando catálogo...
                </x-miscomponentes.loading-spinner>

                <x-miscomponentes.loading-spinner variant="simple" wire:target="loadMore" />
            </div>

        </div>
        <x-miscomponentes.back-to-top />
    </div>
</div>
