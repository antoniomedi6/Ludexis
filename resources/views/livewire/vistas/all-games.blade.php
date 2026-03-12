<div class="bg-[#0f1117] flex-1 flex flex-col min-h-screen" x-data="{ mobileFiltersOpen: false }">
    {{-- Aquí está la clave: quitamos overflow-hidden y añadimos items-start --}}
    <div class="flex-1 flex flex-col lg:flex-row items-start relative">

        <aside
            :class="mobileFiltersOpen ? 'fixed inset-0 z-50 w-full h-full' :
                'hidden lg:block lg:sticky lg:top-0 lg:w-72 lg:h-screen lg:shrink-0'"
            class="bg-[#151821] border-r border-gray-800 overflow-y-auto transition-all duration-300 custom-scrollbar">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6 border-b border-gray-800 pb-4">
                    <h2 class="font-black text-white text-lg tracking-tight">
                        Filtros
                    </h2>
                    <div class="flex items-center gap-4">
                        <button wire:click="clearFilters"
                            class="text-[10px] font-bold text-cyan-500 uppercase hover:text-cyan-400 transition focus:outline-none focus:ring-2 focus:ring-cyan-500 rounded px-1">
                            Limpiar
                        </button>
                        <button @click="mobileFiltersOpen = false"
                            class="lg:hidden text-gray-400 hover:text-white transition">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-8" x-data="{ search: '' }">
                    <h3 class="text-xs font-black uppercase tracking-widest text-gray-500 mb-3">
                        Plataforma
                    </h3>

                    <div class="relative mb-3">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-gray-500 text-xs"></i>
                        <input type="text" x-model="search" placeholder="Buscar plataforma..."
                            class="w-full bg-[#0f1117] border border-gray-700 text-white rounded-lg pl-8 pr-3 py-2 text-xs font-bold focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition placeholder-gray-600" />
                    </div>

                    <div class="space-y-2 max-h-40 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach ($allPlatforms as $platform)
                            <label
                                x-show="search === '' || '{{ strtolower($platform->name) }}'.includes(search.toLowerCase())"
                                class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" value="{{ $platform->id }}" wire:model.live="platformsFilter"
                                    class="w-4 h-4 rounded border-gray-700 bg-[#0f1117] text-cyan-500 focus:ring-cyan-500/50 focus:ring-offset-[#151821]" />
                                <span class="text-sm font-bold text-gray-300 group-hover:text-white transition">
                                    {{ $platform->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-xs font-black uppercase tracking-widest text-gray-500 mb-3">
                        Nota LUDEXIS Mínima
                    </h3>
                    <div class="px-2" x-data="{ nota: $wire.minRatingFilter }">
                        <input type="range" min="0" max="100"
                            wire:model.live.debounce.300ms="minRatingFilter" x-on:input="nota = $event.target.value"
                            class="w-full h-1 bg-gray-800 rounded-lg appearance-none cursor-pointer accent-cyan-500" />
                        <div class="flex justify-between mt-2 text-[10px] font-bold text-gray-500">
                            <span>0</span>
                            <span class="text-cyan-400">> <span x-text="nota"></span></span>
                            <span>100</span>
                        </div>
                    </div>
                </div>

                <div class="mb-8" x-data="{ expanded: false }">
                    <h3 class="text-xs font-black uppercase tracking-widest text-gray-500 mb-3">
                        Géneros
                    </h3>

                    <div class="flex flex-wrap gap-2">
                        @foreach ($topGenres as $genre)
                            <label class="cursor-pointer">
                                <input type="checkbox" value="{{ $genre->id }}" wire:model.live="genresFilter"
                                    class="hidden peer" />
                                <div
                                    class="bg-[#1a1d27] text-gray-400 border border-gray-800 hover:border-gray-600 px-3 py-1.5 rounded-lg text-xs font-bold transition peer-checked:bg-cyan-600 peer-checked:text-white peer-checked:border-cyan-400">
                                    {{ $genre->name }}
                                </div>
                            </label>
                        @endforeach

                        <div x-show="expanded" style="display: none;" class="flex flex-wrap gap-2 mt-1">
                            @foreach ($otherGenres as $genre)
                                <label class="cursor-pointer">
                                    <input type="checkbox" value="{{ $genre->id }}" wire:model.live="genresFilter"
                                        class="hidden peer" />
                                    <div
                                        class="bg-[#1a1d27] text-gray-400 border border-gray-800 hover:border-gray-600 px-3 py-1.5 rounded-lg text-xs font-bold transition peer-checked:bg-cyan-600 peer-checked:text-white peer-checked:border-cyan-400">
                                        {{ $genre->name }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <button @click="expanded = !expanded"
                        class="mt-3 text-[10px] font-black uppercase tracking-wider text-gray-500 hover:text-cyan-400 transition flex items-center gap-1 focus:outline-none focus:ring-2 focus:ring-cyan-500 rounded px-1 py-0.5">
                        <span x-text="expanded ? 'Mostrar menos' : 'Mostrar todos'"></span>
                        <i class="fa-solid fa-chevron-down transition-transform duration-300"
                            :class="expanded ? 'rotate-180' : ''"></i>
                    </button>
                </div>

                <div class="lg:hidden mt-8 border-t border-gray-800 pt-6">
                    <button @click="mobileFiltersOpen = false"
                        class="w-full bg-cyan-600 hover:bg-cyan-500 text-white font-black py-3 rounded-xl transition shadow-lg">
                        Aplicar Filtros
                    </button>
                </div>
            </div>
        </aside>

        <div class="flex-1 p-6 md:p-8 bg-[#0f1117]">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div class="flex items-center gap-4">
                    <button @click="mobileFiltersOpen = true"
                        class="lg:hidden bg-[#1a1d27] border border-gray-800 hover:bg-gray-800 text-white px-4 py-2 rounded-xl text-sm font-bold flex items-center gap-2 transition shadow-lg">
                        <i class="fa-solid fa-filter text-cyan-500"></i> Filtros
                    </button>
                    <p class="text-sm text-gray-400 font-medium mt-1">
                        Mostrando {{ count($allGames) }} títulos sincronizados con IGDB
                    </p>
                </div>
                <select wire:model.live="orderBy"
                    class="bg-[#1a1d27] border border-gray-800 text-white text-sm rounded-xl px-7 py-2.5 font-bold focus:outline-none focus:border-cyan-500/50 appearance-none cursor-pointer w-full sm:w-auto">
                    <option value="rating">Ordenar por: Puntuación</option>
                    <option value="first_release_date">Ordenar por: Más recientes</option>
                </select>
            </div>

            <div class="relative min-h-[400px]">
                <x-miscomponentes.loading-spinner />
                @if (count($allGames))
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-6">
                        @foreach ($allGames as $item)
                            <a href="{{ route('games.show', $item->slug) }}"
                                class="relative group aspect-[3/4] rounded-2xl overflow-hidden bg-[#1a1d27] border border-gray-800 cursor-pointer shadow-lg">
                                <img src="{{ $item->cover_url }}"
                                    class="w-full h-full object-cover transition duration-700 group-hover:scale-105 group-hover:opacity-20" />
                                <div
                                    class="absolute inset-0 flex flex-col justify-between p-5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="flex justify-between items-start">
                                        @if ($item->first_release_date && $item->first_release_date->isFuture())
                                            <div>
                                                <span
                                                    class="bg-[#0f1117]/90 text-gray-300 border border-gray-700 text-[10px] font-black uppercase px-2 py-1 rounded">
                                                    {{ $item->first_release_date->year }}
                                                </span>
                                                <span
                                                    class="bg-[#0f1117]/90 text-gray-300 border border-gray-700 text-[10px] font-black uppercase px-2 py-1 rounded">
                                                    Próximamente
                                                </span>
                                            </div>
                                        @elseif($item->first_release_date)
                                            <span
                                                class="bg-[#0f1117]/90 text-gray-300 border border-gray-700 text-[10px] font-black uppercase px-2 py-1 rounded">
                                                {{ $item->first_release_date->year }}
                                            </span>
                                        @endif
                                        <span
                                            class="bg-[#0f1117]/90 backdrop-blur text-cyan-400 font-black text-xl px-3 py-1 rounded-lg border border-gray-700">
                                            @if ($item->rating)
                                                {{ $item->rating }}
                                            @else
                                                {{ $item->weighted_score }}
                                            @endif
                                        </span>
                                    </div>

                                    <div>
                                        <h3 class="font-black text-white text-base leading-tight mb-1">
                                            {{ $item->title }}
                                        </h3>
                                        @php
                                            $developer = $item->companies->first(function ($company) {
                                                return (bool) $company->pivot->is_developer;
                                            });
                                        @endphp

                                        @if ($developer)
                                            <p
                                                class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-3 truncate">
                                                {{ $developer->name }}
                                            </p>
                                        @endif

                                        <div class="flex flex-wrap gap-1.5 mb-4">
                                            @foreach ($item->genres as $genre)
                                                <span
                                                    class="text-[9px] bg-gray-800 text-gray-300 px-2 py-1 rounded font-bold uppercase tracking-wider">{{ $genre->name }}</span>
                                            @endforeach
                                        </div>
                                        @auth
                                            <button
                                                class="w-full bg-cyan-600 hover:bg-cyan-500 text-white text-xs font-black py-2 rounded-lg transition shadow-lg flex items-center justify-center gap-2">
                                                <i class="fa-solid fa-plus"></i> Añadir
                                            </button>
                                        @endauth
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div
                        class="col-span-full flex flex-col items-center justify-center py-20 px-6 border-2 border-dashed border-gray-800 rounded-3xl bg-[#151821]/50">
                        <div
                            class="mb-4 bg-gray-800/50 w-20 h-20 flex items-center justify-center rounded-full border border-gray-700">
                            <i class="fa-solid fa-magnifying-glass text-3xl text-gray-600"></i>
                        </div>
                        <h3 class="text-xl font-black text-white mb-2">No se han encontrado resultados</h3>
                        <p class="text-gray-500 text-sm font-medium text-center max-w-xs">
                            Intenta cambiar los filtros o limpiar la búsqueda para encontrar lo que buscas.
                        </p>
                        <button wire:click="clearFilters"
                            class="mt-6 text-cyan-500 hover:text-cyan-400 font-black text-xs uppercase tracking-widest transition">
                            Limpiar todos los filtros
                        </button>
                    </div>
                @endif
                <x-miscomponentes.back-to-top />
            </div>
        </div>
    </div>
    <x-miscomponentes.footer />
</div>
