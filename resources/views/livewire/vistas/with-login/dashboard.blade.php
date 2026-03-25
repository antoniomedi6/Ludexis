<x-miscomponentes.page-layout title1="Resumen" title2="General" :subtitle="'Bienvenido de nuevo, Antonio. Tienes ' .
    $userGames->where('pivot.status', 'playing')->count() .
    ' juegos activos.'">
    <x-slot>
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 w-full">
            <div class="xl:col-span-8 flex flex-col gap-10">
                <section class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div
                        class="bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-[2rem] p-6 flex flex-col justify-center items-center text-center transition-colors duration-300 hover:bg-gray-50 dark:hover:bg-[#1a1d27] shadow-xl relative overflow-hidden">
                        <i
                            class="fa-solid fa-cubes absolute -bottom-4 -right-4 text-6xl text-gray-100 dark:text-gray-800/30 transition-colors duration-300"></i>
                        <span
                            class="text-4xl font-black text-gray-900 dark:text-white mb-1 relative z-10 transition-colors duration-300">{{ count($userGames) }}</span>
                        <span
                            class="text-[10px] font-black uppercase tracking-widest text-gray-500 dark:text-gray-500 relative z-10 transition-colors duration-300">En
                            Biblioteca</span>
                    </div>
                    <div
                        class="bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-[2rem] p-6 flex flex-col justify-center items-center text-center transition-colors duration-300 hover:bg-gray-50 dark:hover:bg-[#1a1d27] shadow-xl relative overflow-hidden">
                        <i
                            class="fa-solid fa-trophy absolute -bottom-4 -right-4 text-6xl text-green-50 dark:text-green-900/20 transition-colors duration-300"></i>
                        <span
                            class="text-4xl font-black text-green-600 dark:text-green-400 mb-1 relative z-10 transition-colors duration-300">{{ $userGames->where('status', 'completed')->count() }}</span>
                        <span
                            class="text-[10px] font-black uppercase tracking-widest text-gray-500 dark:text-gray-500 relative z-10 transition-colors duration-300">Completados
                            al 100%</span>
                    </div>
                    <div
                        class="bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-[2rem] p-6 flex flex-col justify-center items-center text-center transition-colors duration-300 hover:bg-gray-50 dark:hover:bg-[#1a1d27] shadow-xl relative overflow-hidden">
                        <i
                            class="fa-regular fa-clock absolute -bottom-4 -right-4 text-6xl text-gray-100 dark:text-gray-800/30 transition-colors duration-300"></i>
                        <span
                            class="text-4xl font-black text-gray-900 dark:text-white mb-1 relative z-10 transition-colors duration-300">
                            @php
                                $totalHours = $userGames->sum('pivot.hours');
                                $formattedHours =
                                    $totalHours >= 1000 ? number_format($totalHours / 1000, 1) . 'k' : $totalHours;
                            @endphp
                            {{ $formattedHours }}<span class="text-lg text-gray-500 dark:text-gray-500">h</span>
                        </span>
                        <span
                            class="text-[10px] font-black uppercase tracking-widest text-gray-500 dark:text-gray-500 relative z-10 transition-colors duration-300">Tiempo
                            Total</span>
                    </div>
                    <button
                        class="bg-gradient-to-br from-cyan-50 dark:from-cyan-900/30 to-white dark:to-[#151821] border border-cyan-200 dark:border-cyan-800/50 rounded-[2rem] p-6 flex flex-col justify-center items-center text-center transition-colors duration-300 hover:from-cyan-100 dark:hover:from-cyan-800/40 shadow-xl dark:shadow-[0_0_20px_rgba(6,182,212,0.1)] group">
                        <i
                            class="fa-solid fa-dice text-3xl text-cyan-600 dark:text-cyan-500 mb-2 group-hover:rotate-12 transition-transform duration-300"></i>
                        <span
                            class="text-[10px] font-black uppercase tracking-widest text-cyan-700 dark:text-cyan-400 transition-colors duration-300">Juego
                            Aleatorio</span>
                    </button>
                </section>

                @php
                    $activeGames = $userGames->where('pivot.status', 'playing')->take(2);
                @endphp

                @if ($activeGames->isNotEmpty())
                    <section>
                        <h2
                            class="text-sm font-black text-gray-600 dark:text-gray-400 uppercase tracking-widest mb-6 flex items-center gap-3 transition-colors duration-300">
                            <div class="w-2 h-2 rounded-full bg-cyan-500 shadow-[0_0_10px_#06b6d4] animate-pulse"></div>
                            Activos en este momento
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($activeGames as $game)
                                <a href="{{ route('games.show', $game->slug) }}">
                                    <div
                                        class="bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-3xl shadow-xl flex flex-col overflow-hidden transition-colors duration-300 group cursor-pointer">

                                        <div class="relative h-40 w-full overflow-hidden">
                                            <img src="{{ $game->cover_url }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent opacity-80">
                                            </div>
                                            <div class="absolute bottom-4 left-4 flex gap-2">
                                                <span
                                                    class="bg-white/90 dark:bg-[#1a1d27]/90 backdrop-blur-md text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider shadow-sm transition-colors duration-300">
                                                    <i class="fa-brands fa-windows mr-1"></i> PC
                                                </span>
                                            </div>
                                        </div>

                                        <div class="p-6 flex-1 flex flex-col justify-between">
                                            <div>
                                                <h3
                                                    class="text-xl font-black text-gray-900 dark:text-white leading-tight mb-2 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300">
                                                    {{ $game->title }}
                                                </h3>
                                            </div>
                                        </div>

                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif

                @livewire('utils.preview-next-games')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <section>
                        <h2
                            class="text-sm font-black text-gray-600 dark:text-gray-400 uppercase tracking-widest mb-6 flex items-center gap-3 transition-colors duration-300">
                            <i class="fa-solid fa-chart-simple text-cyan-600 dark:text-cyan-500"></i> Tu Colección por
                            Género
                        </h2>
                        <div
                            class="bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-3xl p-6 shadow-xl flex flex-col gap-4 transition-colors duration-300 min-h-[180px]">

                            @if (empty($genreStats))
                                <div
                                    class="flex-1 flex items-center justify-center text-xs font-bold text-gray-400 uppercase tracking-widest">
                                    No hay datos suficientes
                                </div>
                            @else
                                @foreach ($genreStats as $stat)
                                    <div>
                                        <div
                                            class="flex justify-between text-xs font-bold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider transition-colors duration-300">
                                            <span>{{ $stat['name'] }}</span>
                                            <span
                                                class="text-gray-900 dark:text-white transition-colors duration-300">{{ $stat['percentage'] }}%</span>
                                        </div>
                                        <div
                                            class="w-full bg-gray-100 dark:bg-[#0f1117] rounded-full h-2 border border-gray-200 dark:border-gray-800 transition-colors duration-300">
                                            <div class="{{ $stat['color'] }} h-2 rounded-full transition-all duration-1000"
                                                style="width: {{ $stat['percentage'] }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </section>

                    <section>
                        <h2
                            class="text-sm font-black text-gray-600 dark:text-gray-400 uppercase tracking-widest mb-6 flex items-center gap-3 transition-colors duration-300">
                            <i class="fa-solid fa-medal text-cyan-600 dark:text-cyan-500"></i> Logros Recientes
                        </h2>
                        <div
                            class="bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-3xl p-6 shadow-xl flex flex-wrap gap-4 justify-center items-center h-full min-h-[180px] transition-colors duration-300">
                            <div class="group relative cursor-pointer">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-yellow-400 to-orange-500 dark:from-yellow-500 dark:to-orange-600 rounded-2xl rotate-45 flex items-center justify-center border-2 border-yellow-200 dark:border-yellow-300/30 shadow-[0_0_15px_rgba(234,179,8,0.2)] group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-dragon text-white -rotate-45 text-xl"></i>
                                </div>
                            </div>
                            <div class="group relative cursor-pointer">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-gray-300 to-gray-500 dark:from-gray-400 dark:to-gray-600 rounded-2xl rotate-45 flex items-center justify-center border-2 border-gray-200 dark:border-gray-300/30 shadow-[0_0_15px_rgba(156,163,175,0.2)] group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-skull text-white -rotate-45 text-xl"></i>
                                </div>
                            </div>
                            <div class="group relative cursor-pointer">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-cyan-400 to-blue-500 dark:from-cyan-500 dark:to-blue-600 rounded-2xl rotate-45 flex items-center justify-center border-2 border-cyan-200 dark:border-cyan-300/30 shadow-[0_0_15px_rgba(6,182,212,0.2)] group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-car-burst text-white -rotate-45 text-xl"></i>
                                </div>
                            </div>
                            <div class="group relative cursor-pointer">
                                <div
                                    class="w-14 h-14 bg-gray-50 dark:bg-[#0f1117] rounded-2xl rotate-45 flex items-center justify-center border-2 border-gray-300 dark:border-gray-800 border-dashed hover:border-cyan-500 dark:hover:border-cyan-500/50 transition-colors">
                                    <span
                                        class="text-gray-500 dark:text-gray-600 font-black -rotate-45 text-xs transition-colors duration-300">+12</span>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <section>
                    <h2
                        class="text-sm font-black text-gray-600 dark:text-gray-400 uppercase tracking-widest mb-6 transition-colors duration-300">
                        Tu Actividad Reciente
                    </h2>
                    <div class="flex flex-col gap-4">
                        <div
                            class="bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-3xl p-5 flex flex-col sm:flex-row gap-5 items-start sm:items-center transition-colors duration-300 hover:bg-gray-50 dark:hover:bg-[#1a1d27] shadow-xl">
                            <div
                                class="w-12 h-12 rounded-2xl bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 flex items-center justify-center shrink-0 border border-green-200 dark:border-green-500/20 text-xl transition-colors duration-300">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 dark:text-gray-400 transition-colors duration-300">
                                    <span
                                        class="text-gray-900 dark:text-white font-bold text-base transition-colors duration-300">Elden
                                        Ring</span> marcado como Finalizado.
                                </p>
                                <div class="flex flex-wrap gap-3 mt-2 items-center">
                                    <span
                                        class="text-xs font-black text-cyan-600 dark:text-cyan-400 transition-colors duration-300"><i
                                            class="fa-solid fa-clock mr-1"></i> 120 horas</span>
                                    <div
                                        class="w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-600 transition-colors duration-300">
                                    </div>
                                    <div class="flex text-xs text-yellow-500">
                                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <span
                                class="text-xs text-gray-500 dark:text-gray-500 font-bold uppercase tracking-wider transition-colors duration-300">Ayer</span>
                        </div>

                        <div
                            class="bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-3xl p-5 flex flex-col sm:flex-row gap-5 items-start sm:items-center transition-colors duration-300 hover:bg-gray-50 dark:hover:bg-[#1a1d27] shadow-xl">
                            <div
                                class="w-12 h-12 rounded-2xl bg-cyan-50 dark:bg-cyan-500/10 text-cyan-600 dark:text-cyan-400 flex items-center justify-center shrink-0 border border-cyan-200 dark:border-cyan-500/20 text-xl transition-colors duration-300">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                            <div class="flex-1 w-full">
                                <p class="text-sm text-gray-600 dark:text-gray-400 transition-colors duration-300">
                                    Has escrito una reseña para <span
                                        class="text-gray-900 dark:text-white font-bold text-base transition-colors duration-300">Hollow
                                        Knight</span>.
                                </p>
                                <div
                                    class="mt-3 bg-gray-50 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 rounded-xl p-4 text-xs italic text-gray-500 dark:text-gray-400 border-l-2 border-l-cyan-500 transition-colors duration-300">
                                    "El mejor metroidvania que he jugado en la última década. El diseño de niveles es
                                    magistral."
                                </div>
                            </div>
                            <span
                                class="text-xs text-gray-500 dark:text-gray-500 font-bold uppercase tracking-wider shrink-0 transition-colors duration-300">Hace
                                2 días</span>
                        </div>
                    </div>
                </section>
            </div>
            @livewire('utils.preview-social-feed')
        </div>
    </x-slot>
</x-miscomponentes.page-layout>
