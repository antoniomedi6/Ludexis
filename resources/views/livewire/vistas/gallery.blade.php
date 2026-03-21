<div class="relative w-full">
    <x-miscomponentes.page-layout :title1="isset($game) ? 'Galería de' : 'Galería de la'" :title2="isset($game) ? $game->title : 'Comunidad'" :subtitle="isset($game) ? 'Explora las capturas de este juego.' : 'Todas las capturas de la comunidad'" :full-width="!isset($game)">

        <x-slot:aside>
            <div class="flex items-center gap-4">
                @auth
                    <button @click="$wire.set('showingModal', true)"
                        class="bg-cyan-600 hover:bg-cyan-500 text-white px-5 py-3 rounded-xl text-xs uppercase tracking-widest font-black flex items-center gap-3 transition-all shadow-lg shadow-cyan-900/20 active:scale-95">
                        <i class="fa-solid fa-cloud-arrow-up"></i> Subir Imagen
                    </button>
                @endauth

                <div class="relative" x-data="{ filtersOpen: false }">
                    <button @click="filtersOpen = !filtersOpen"
                        class="bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 hover:bg-gray-50 text-gray-900 dark:text-white px-5 py-3 rounded-xl text-xs uppercase tracking-widest font-black flex items-center gap-3 transition-colors shadow-sm">
                        <i class="fa-solid fa-filter text-cyan-600 dark:text-cyan-500"></i> Filtros
                    </button>

                    <div x-show="filtersOpen" @click.away="filtersOpen = false" x-transition.opacity
                        class="absolute right-0 top-full mt-3 w-80 bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-2xl shadow-2xl z-[100] p-6 flex flex-col gap-6"
                        x-cloak>

                        <div
                            class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 pb-4">
                            <h2 class="font-black text-gray-900 dark:text-white text-lg tracking-tight">Filtros</h2>
                            <button wire:click="clearFilters" @click="filtersOpen = false"
                                class="text-[10px] font-black text-cyan-600 uppercase tracking-widest">Limpiar</button>
                        </div>

                        <div x-data="{ searchGame: '' }">
                            <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Juegos</h3>
                            <input type="text" x-model="searchGame" placeholder="Buscar..."
                                class="w-full bg-gray-50 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 rounded-lg px-3 py-2 text-xs font-bold text-white mb-3 focus:ring-cyan-500">
                            <div class="space-y-2 max-h-40 overflow-y-auto custom-scrollbar">
                                @foreach ($allGames as $g)
                                    <label
                                        x-show="(searchGame.trim() !== '' && '{{ strtolower(str_replace('\'', '\\\'', $g->title)) }}'.includes(searchGame.trim().toLowerCase())) || $wire.gamesFilter.includes({{ $g->id }})"
                                        class="flex items-center gap-2.5 cursor-pointer group">
                                        <input type="checkbox" wire:model.live="gamesFilter" value="{{ $g->id }}"
                                            class="w-4 h-4 rounded border-gray-700 bg-[#0f1117] text-cyan-600 focus:ring-cyan-500">
                                        <span
                                            class="text-xs font-bold text-gray-400 group-hover:text-white">{{ $g->title }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="space-y-4">
                            <select wire:model.live="spoilerFilter"
                                class="w-full bg-gray-50 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 rounded-lg px-3 py-2 text-xs font-bold text-white">
                                <option value="all">Todos los Spoilers</option>
                                <option value="hide">Ocultar Spoilers</option>
                                <option value="only">Solo Spoilers</option>
                            </select>
                            <select wire:model.live="dateFilter"
                                class="w-full bg-gray-50 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 rounded-lg px-3 py-2 text-xs font-bold text-white">
                                <option value="all">Cualquier fecha</option>
                                <option value="24h">Últimas 24h</option>
                                <option value="week">Esta semana</option>
                            </select>
                        </div>
                    </div>
                </div>

                <select wire:model.live="orderBy"
                    class="bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 text-white text-xs rounded-xl px-4 py-3 font-black uppercase tracking-widest focus:ring-cyan-500">
                    <option value="created_at">Más recientes</option>
                    <option value="likes">Más valoradas</option>
                </select>
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
                                            @endif

                                            <div class="flex-1 flex flex-col gap-2">
                                                <div class="flex items-start justify-between gap-3">
                                                    <span
                                                        class="text-sm font-black text-gray-900 dark:text-white line-clamp-2 leading-tight hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">
                                                        {{ $item->game->title ?? 'Juego Desconocido' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div
                                        class="flex items-center gap-3 pt-4 mt-auto border-t border-gray-100 dark:border-gray-800/80">
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
                        class="flex flex-col items-center justify-center py-32 border-2 border-dashed border-gray-800 rounded-[2rem]">
                        <i class="fa-solid fa-image text-4xl text-gray-600 mb-4"></i>
                        <h3 class="text-xl font-black text-white">No hay capturas</h3>
                    </div>
                @endif
            </div>

            @if (isset($game))
                <div class="xl:col-span-4 2xl:col-span-3">
                    <div
                        class="bg-[#151821]/80 backdrop-blur-2xl border border-gray-800 rounded-[2.5rem] p-6 sticky top-8">
                        <img src="{{ $game->cover_url }}"
                            class="w-full aspect-[3/4] object-cover rounded-2xl mb-6 shadow-lg border border-gray-700" />
                        <h2 class="text-2xl font-black text-white leading-tight mb-2">{{ $game->title }}</h2>
                        <a href="{{ route('games.show', $game->slug) }}"
                            class="w-full mt-6 bg-gray-800 hover:bg-gray-700 text-white font-black px-6 py-3.5 rounded-xl transition-all uppercase tracking-widest text-xs flex items-center justify-center">Ver
                            Ficha</a>
                    </div>
                </div>
            @endif
        </div>

    </x-miscomponentes.page-layout>

    <x-modal wire:model="showingModal" maxWidth="3xl">
        <div class="mb-10">
            <h2
                class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter uppercase flex items-center gap-4">
                <i class="fa-solid fa-cloud-arrow-up text-cyan-600"></i> Subir Captura
            </h2>
        </div>

        <form wire:submit="save" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div class="relative group aspect-video">
                        <input type="file" wire:model="cimage.image_path"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div
                            class="border-2 border-dashed border-gray-800 rounded-3xl p-6 flex flex-col items-center justify-center h-full {{ $cimage->image_path ? 'bg-[#0f1117]' : 'bg-[#1a1d27]' }}">
                            @if ($cimage->image_path)
                                <img src="{{ $cimage->image_path->temporaryUrl() }}"
                                    class="w-full h-full object-cover rounded-2xl">
                            @else
                                <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-600 mb-2"></i>
                                <p class="text-xs font-black text-white uppercase">Seleccionar Imagen</p>
                            @endif
                        </div>
                    </div>
                    <x-input-error for="cimage.image_path" class="mt-2" />
                </div>

                <label
                    class="flex items-center justify-between p-4 bg-[#0f1117] border border-gray-800 rounded-2xl cursor-pointer">
                    <span class="text-xs font-black text-white uppercase tracking-widest">¿Contiene Spoilers?</span>
                    <input type="checkbox" wire:model="cimage.is_spoiler"
                        class="w-5 h-5 rounded border-gray-700 bg-gray-800 text-cyan-600">
                </label>
            </div>

            <div class="flex flex-col justify-between h-full">
                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Juego</label>
                    <select wire:model="cimage.game_id"
                        class="w-full bg-[#0f1117] border border-gray-800 text-white rounded-xl p-4 text-sm font-bold focus:ring-cyan-500">
                        <option value="">Selecciona...</option>
                        @foreach ($allGames as $game)
                            <option value="{{ $game->id }}">{{ $game->title }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="cimage.game_id" class="mt-2" />
                </div>

                <div class="flex gap-4 mt-8">
                    <button type="button" @click="$wire.set('showingModal', false)"
                        class="flex-1 bg-gray-800 text-white font-black py-4 rounded-xl uppercase text-xs tracking-widest">Cancelar</button>
                    <button type="submit"
                        class="flex-1 bg-cyan-600 text-white font-black py-4 rounded-xl uppercase text-xs tracking-widest shadow-lg shadow-cyan-900/20">Publicar</button>
                </div>
            </div>
        </form>
    </x-modal>

    <x-miscomponentes.loading-spinner variant="modal" wire:target="save, gamesFilter, spoilerFilter, dateFilter">
        Actualizando...
    </x-miscomponentes.loading-spinner>
</div>
