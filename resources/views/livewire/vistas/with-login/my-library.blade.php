<div
    class="bg-gray-50 dark:bg-[#0f1117] text-gray-900 dark:text-gray-100 font-sans min-h-screen flex selection:bg-cyan-500 selection:text-white transition-colors duration-300 ">
    <div class="flex-1 flex flex-col h-full w-full">
        <x-miscomponentes.search-header />

        <div class="flex-1 overflow-y-auto px-4 md:px-8 py-8 relative hide-scrollbar w-full">
            <div class="max-w-[1400px] mx-auto flex flex-col gap-8">
                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
                    <div>
                        <x-miscomponentes.title title1="Mi" title2="Biblioteca" />
                        <p class="text-gray-600 dark:text-gray-400 font-medium text-lg transition-colors duration-300">
                            Tienes un total de
                            <span
                                class="text-gray-900 dark:text-white font-bold transition-colors duration-300">{{ count($userGames) }}
                                juegos</span>
                            en tu registro.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <div
                            class="flex items-center gap-2 bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-2xl p-1.5 shadow-sm transition-colors duration-300 overflow-x-auto w-full sm:w-auto hide-scrollbar">
                            <button
                                class="px-5 py-2 rounded-xl bg-gray-100 dark:bg-[#1a1d27] text-cyan-600 dark:text-cyan-400 font-bold text-xs uppercase tracking-widest shadow-sm transition-colors duration-300 whitespace-nowrap">
                                Todos
                            </button>
                            <button
                                class="px-5 py-2 rounded-xl text-gray-500 hover:text-gray-900 dark:hover:text-white font-bold text-xs uppercase tracking-widest transition-colors duration-300 whitespace-nowrap">
                                Jugando
                            </button>
                            <button
                                class="px-5 py-2 rounded-xl text-gray-500 hover:text-gray-900 dark:hover:text-white font-bold text-xs uppercase tracking-widest transition-colors duration-300 whitespace-nowrap">
                                Completados
                            </button>
                            <button
                                class="px-5 py-2 rounded-xl text-gray-500 hover:text-gray-900 dark:hover:text-white font-bold text-xs uppercase tracking-widest transition-colors duration-300 whitespace-nowrap">
                                Pendientes
                            </button>
                        </div>

                        <div class="relative w-full sm:w-auto group shrink-0">
                            <i
                                class="fa-solid fa-sort absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-sm transition-colors duration-300"></i>
                            <select
                                class="bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white text-sm rounded-2xl pl-10 pr-10 py-2.5 font-bold focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 appearance-none cursor-pointer w-full transition-colors duration-300 shadow-sm">
                                <option value="updated">Última actualización</option>
                                <option value="rating">Mi Puntuación</option>
                                <option value="time">Horas jugadas</option>
                            </select>
                            <i
                                class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-xs pointer-events-none transition-colors duration-300"></i>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6 mt-4">
                    @foreach ($userGames as $item)
                        @php
                            $status = $item->pivot->status ?? 'pending';
                            $rating = $item->pivot->rating ?? 0;
                            $hours = $item->pivot->hours_finish ?? 0;

                            $isAbandoned = $status === 'abandoned';
                            $isPending = $status === 'pending';
                        @endphp

                        <a href="{{ route('games.show', $item->slug) }}"
                            class="group bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl dark:shadow-none hover:border-cyan-300 dark:hover:border-cyan-500/50 transition-all duration-500 flex flex-col {{ $isAbandoned || $isPending ? 'opacity-80 hover:opacity-100' : '' }}">

                            <div class="relative aspect-[4/3] w-full overflow-hidden">
                                <img src="{{ $item->cover_url }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700 {{ $isAbandoned ? 'filter grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100' : '' }}" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-gray-900/90 to-transparent opacity-80">
                                </div>

                                <div class="absolute top-4 left-4">
                                    @if ($status === 'finish')
                                        <span
                                            class="bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 border border-green-200 dark:border-green-800/50 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                            <i class="fa-solid fa-flag-checkered"></i> Finalizado
                                        </span>
                                    @elseif ($status === 'completed')
                                        <span
                                            class="bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 border border-purple-200 dark:border-purple-800/50 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                            <x-icons.completed class="size-6" /> 100% Completado
                                        </span>
                                    @elseif ($status === 'playing')
                                        <span
                                            class="bg-cyan-50 dark:bg-cyan-900/30 text-cyan-600 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                            <x-icons.playing class="size-6" /> Jugando
                                        </span>
                                    @elseif ($status === 'abandoned')
                                        <span
                                            class="bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800/50 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                            <x-icons.abandoned class="size-6" /> Abandonado
                                        </span>
                                    @elseif ($status === 'pending')
                                        <span
                                            class="bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800/50 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                            <x-icons.pending class="size-6" /> Pendiente
                                        </span>
                                    @elseif ($status === 'paused')
                                        <span
                                            class="bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800/50 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                            <x-icons.paused class="size-6" /> En Pausa
                                        </span>
                                    @elseif ($status === 'multiplayer')
                                        <span
                                            class="bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800/50 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                            <x-icons.multiplayer class="size-6" /> Multiplayer
                                        </span>
                                    @endif
                                </div>

                                <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end">
                                    <div class="flex items-center gap-1">
                                        @if ($rating > 0)
                                            <div
                                                class="flex text-cyan-500 dark:text-cyan-400 text-sm drop-shadow-md {{ $isPending || $isAbandoned ? 'opacity-50' : '' }}">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($rating >= $i)
                                                        <i class="fa-solid fa-star"></i>
                                                    @elseif ($rating >= $i - 0.5)
                                                        <i class="fa-solid fa-star-half-stroke"></i>
                                                    @else
                                                        <i class="fa-regular fa-star opacity-30"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        @else
                                            <span
                                                class="text-[10px] font-bold text-white/70 uppercase tracking-wider drop-shadow-md">
                                                Sin valorar
                                            </span>
                                        @endif
                                    </div>
                                    <span
                                        class="bg-white/90 dark:bg-[#1a1d27]/90 backdrop-blur-md text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider shadow-sm transition-colors duration-300">
                                        PC
                                    </span>
                                </div>
                            </div>

                            <div class="p-6 flex-1 flex flex-col justify-center">
                                <h3
                                    class="text-xl font-black text-gray-900 dark:text-white leading-tight mb-2 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300 line-clamp-2">
                                    {{ $item->title }}
                                </h3>
                                <p
                                    class="text-xs font-bold uppercase tracking-wider flex items-center gap-1.5 transition-colors duration-300
                                    {{ $status === 'finish' || $status === 'completed' ? 'text-green-600 dark:text-green-500' : '' }}
                                    {{ $status === 'playing' ? 'text-cyan-600 dark:text-cyan-500' : '' }}
                                    {{ $status === 'abandoned' ? 'text-red-600 dark:text-red-500' : '' }}
                                    {{ $status === 'pending' || $status === 'paused' ? 'text-yellow-600 dark:text-yellow-500' : '' }}
                                    {{ $status === 'multiplayer' ? 'text-blue-600 dark:text-blue-500' : '' }}">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $hours }} hrs jugadas
                                </p>
                            </div>
                        </a>
                </div>
                @endforeach
            </div>

            @if (count($userGames) < 0)
                <div class="flex flex-col items-center justify-center py-20 px-6 text-center">
                    <div
                        class="w-24 h-24 bg-gray-100 dark:bg-[#1a1d27] rounded-full flex items-center justify-center mb-6 border border-gray-200 dark:border-gray-800">
                        <i class="fa-solid fa-gamepad text-4xl text-gray-400 dark:text-gray-600"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-2">Tu biblioteca está vacía</h3>
                    <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto">Explora el catálogo y añade juegos
                        a tu registro para empezar a llevar el control de tus partidas.</p>
                </div>
            @endif
        </div>
    </div>
</div>
</div>
