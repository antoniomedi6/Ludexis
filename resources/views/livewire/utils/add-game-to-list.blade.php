<div class="w-full">
    <button type="button" @click="$wire.set('showModal', true)"
        class="w-full inline-flex items-center justify-center gap-2 bg-cyan-600 hover:bg-cyan-500 text-white font-black px-6 py-3 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(6,182,212,0.2)] uppercase tracking-wider text-sm">
        <i class="fa-solid fa-folder-plus text-lg"></i>
        Añadir a Lista
    </button>

    <template x-teleport="body">
        <x-modal wire:model="showModal" maxWidth="xl">
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-cyan-100 dark:bg-cyan-900/30 mb-5 shadow-inner">
                    <i class="fa-solid fa-folder-plus text-3xl text-cyan-600 dark:text-cyan-400"></i>
                </div>
                <h3
                    class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight leading-none mb-2">
                    Guardar en...
                </h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium px-4">
                    Selecciona las listas para este juego
                </p>
            </div>

            @if ($userLists->count())
                <div class="space-y-3 max-h-[500px] overflow-y-auto pr-2">
                    @foreach ($userLists as $list)
                        <div
                            class="relative bg-white dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden hover:border-cyan-400 dark:hover:border-cyan-700 transition-all duration-300 group shadow-sm">
                            <label class="flex items-center gap-4 p-5 cursor-pointer">
                                {{-- Miniatura estilo CustomLists --}}
                                <div
                                    class="flex-shrink-0 w-14 h-14 rounded-xl bg-gray-100 dark:bg-[#1a1d27] flex items-center justify-center group-hover:scale-105 transition-transform">
                                    @if ($list->games_count > 0)
                                        @php $cover = $list->games->first()?->cover_url; @endphp
                                        @if ($cover)
                                            <img src="{{ $cover }}"
                                                class="w-full h-full object-cover rounded-xl">
                                        @else
                                            <i
                                                class="fa-solid fa-layer-group text-2xl text-gray-400 dark:text-gray-500 group-hover:text-cyan-500 transition-colors"></i>
                                        @endif
                                    @else
                                        <i
                                            class="fa-solid fa-folder-open text-2xl text-gray-400 dark:text-gray-500 group-hover:text-cyan-500 transition-colors"></i>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h4
                                            class="text-base font-black text-gray-900 dark:text-white group-hover:text-cyan-500 transition-colors">
                                            {{ $list->name }}
                                        </h4>
                                        <div
                                            class="w-2 h-2 rounded-full {{ $list->contains_game ? 'bg-cyan-500' : 'bg-gray-300 dark:bg-gray-700' }}">
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 text-xs">
                                        <span class="text-gray-500 dark:text-gray-400 font-medium">
                                            {{ $list->games_count ?? 0 }} juegos
                                        </span>
                                        <span
                                            class="text-gray-400 dark:text-gray-600 text-[10px] font-bold uppercase tracking-wider">
                                            {{ \Carbon\Carbon::parse($list->updated_at)->translatedFormat('d M') }}
                                        </span>
                                    </div>
                                </div>

                                <input type="checkbox" wire:click="toggleGame({{ $list->id }})"
                                    @checked($list->contains_game)
                                    class="w-5 h-5 rounded-lg border-gray-300 dark:border-gray-700 text-cyan-600 focus:ring-cyan-500 bg-white dark:bg-gray-900 transition-all cursor-pointer">
                            </label>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-12 text-center">
                    <div
                        class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-100 dark:bg-gray-800/50 mb-6">
                        <i class="fa-solid fa-folder-open text-3xl text-gray-400 dark:text-gray-500"></i>
                    </div>
                    <p class="text-base font-bold text-gray-700 dark:text-gray-300 mb-2">No tienes listas creadas</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Crea tu primera colección para organizar
                        tus juegos</p>
                    <a href="{{ route('userLists') }}"
                        class="inline-flex items-center gap-2 bg-cyan-600 hover:bg-cyan-500 text-white font-black px-8 py-3.5 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(6,182,212,0.2)] uppercase tracking-wider text-sm">
                        <i class="fa-solid fa-folder-plus"></i>
                        Crear mi primera lista
                    </a>
                </div>
            @endif

            <div class="mt-8 pt-2">
                <button @click="$wire.set('showModal', false)"
                    class="w-full py-4 rounded-2xl bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-black uppercase tracking-widest text-sm hover:opacity-90 transition-opacity shadow-lg dark:shadow-none">
                    Listo
                </button>
            </div>
        </x-modal>
    </template>
</div>
