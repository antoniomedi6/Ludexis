<x-miscomponentes.page-layout title1="Resumen" title2="General" :subtitle="'Bienvenido de nuevo, Antonio. Tienes ' .
    $userGames->where('status', 'playing')->count() .
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

                <section>
                    <h2
                        class="text-sm font-black text-gray-600 dark:text-gray-400 uppercase tracking-widest mb-6 flex items-center gap-3 transition-colors duration-300">
                        <div class="w-2 h-2 rounded-full bg-cyan-500 shadow-[0_0_10px_#06b6d4] animate-pulse"></div>
                        Activos en este momento
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div
                            class="bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-3xl shadow-xl flex flex-col overflow-hidden transition-colors duration-300 group cursor-pointer">
                            <div class="relative h-40 w-full overflow-hidden">
                                <img src="https://images.igdb.com/igdb/image/upload/t_1080p/sc8c26.jpg"
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
                                        The Witcher 3: Wild Hunt</h3>
                                    <p
                                        class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider flex items-center gap-1.5 transition-colors duration-300">
                                        <i class="fa-regular fa-clock text-cyan-600 dark:text-cyan-500"></i> 45 hrs
                                        jugadas
                                    </p>
                                </div>
                                <div class="mt-4">
                                    <div
                                        class="flex justify-between text-[10px] font-bold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-widest transition-colors duration-300">
                                        <span>Progreso</span>
                                        <span class="text-gray-900 dark:text-white">65%</span>
                                    </div>
                                    <div
                                        class="w-full bg-gray-100 dark:bg-[#0f1117] rounded-full h-1.5 border border-gray-200 dark:border-gray-800 transition-colors duration-300">
                                        <div class="bg-cyan-500 h-1.5 rounded-full shadow-sm dark:shadow-[0_0_10px_rgba(6,182,212,0.5)]"
                                            style="width: 65%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-3xl shadow-xl flex flex-col overflow-hidden transition-colors duration-300 group cursor-pointer">
                            <div class="relative h-40 w-full overflow-hidden">
                                <img src="https://images.igdb.com/igdb/image/upload/t_1080p/sc6qon.jpg"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent opacity-80">
                                </div>
                                <div class="absolute bottom-4 left-4 flex gap-2">
                                    <span
                                        class="bg-white/90 dark:bg-[#1a1d27]/90 backdrop-blur-md text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider shadow-sm transition-colors duration-300">
                                        <i class="fa-brands fa-playstation mr-1"></i> PS5
                                    </span>
                                </div>
                            </div>
                            <div class="p-6 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3
                                        class="text-xl font-black text-gray-900 dark:text-white leading-tight mb-2 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300">
                                        Cyberpunk 2077</h3>
                                    <p
                                        class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider flex items-center gap-1.5 transition-colors duration-300">
                                        <i class="fa-regular fa-clock text-cyan-600 dark:text-cyan-500"></i> 12 hrs
                                        jugadas
                                    </p>
                                </div>
                                <div class="mt-4">
                                    <div
                                        class="flex justify-between text-[10px] font-bold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-widest transition-colors duration-300">
                                        <span>Progreso</span>
                                        <span class="text-gray-900 dark:text-white">25%</span>
                                    </div>
                                    <div
                                        class="w-full bg-gray-100 dark:bg-[#0f1117] rounded-full h-1.5 border border-gray-200 dark:border-gray-800 transition-colors duration-300">
                                        <div class="bg-cyan-500 h-1.5 rounded-full shadow-sm dark:shadow-[0_0_10px_rgba(6,182,212,0.5)]"
                                            style="width: 25%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="flex items-center justify-between mb-6">
                        <h2
                            class="text-sm font-black text-gray-600 dark:text-gray-400 uppercase tracking-widest flex items-center gap-3 transition-colors duration-300">
                            <i class="fa-solid fa-calendar-days text-cyan-600 dark:text-cyan-500"></i> Próximos
                            Lanzamientos
                        </h2>
                        <a href="#"
                            class="text-[10px] font-bold text-cyan-600 dark:text-cyan-400 uppercase tracking-widest hover:text-cyan-700 dark:hover:text-cyan-300 transition-colors duration-300">Ver
                            Calendario</a>
                    </div>
                    <div class="flex gap-4 overflow-x-auto hide-scrollbar pb-4 snap-x">
                        <div
                            class="min-w-[140px] snap-start bg-white dark:bg-[#151821] rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 group cursor-pointer shadow-xl transition-colors duration-300">
                            <div class="relative aspect-[3/4] overflow-hidden">
                                <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/co93v7.jpg"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-gray-900/90 to-transparent opacity-80">
                                </div>
                                <div
                                    class="absolute inset-x-0 bottom-0 p-4 flex flex-col items-center justify-end text-center">
                                    <h3
                                        class="text-sm font-black text-white leading-tight mb-2 drop-shadow-md line-clamp-2">
                                        Monster Hunter Wilds</h3>
                                    <span
                                        class="bg-white/90 dark:bg-[#1a1d27]/90 backdrop-blur-md text-cyan-700 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-900/50 px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider w-full transition-colors duration-300">28
                                        Feb 2025</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="min-w-[140px] snap-start bg-white dark:bg-[#151821] rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 group cursor-pointer shadow-xl transition-colors duration-300">
                            <div class="relative aspect-[3/4] overflow-hidden">
                                <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/co670h.jpg"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-gray-900/90 to-transparent opacity-80">
                                </div>
                                <div
                                    class="absolute inset-x-0 bottom-0 p-4 flex flex-col items-center justify-end text-center">
                                    <h3
                                        class="text-sm font-black text-white leading-tight mb-2 drop-shadow-md line-clamp-2">
                                        Grand Theft Auto VI</h3>
                                    <span
                                        class="bg-white/90 dark:bg-[#1a1d27]/90 backdrop-blur-md text-cyan-700 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-900/50 px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider w-full transition-colors duration-300">2025</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="min-w-[140px] snap-start bg-white dark:bg-[#151821] rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 group cursor-pointer shadow-xl transition-colors duration-300">
                            <div class="relative aspect-[3/4] overflow-hidden">
                                <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/co889o.jpg"
                                    class="w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-500" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-gray-900/90 to-transparent opacity-80">
                                </div>
                                <div
                                    class="absolute inset-x-0 bottom-0 p-4 flex flex-col items-center justify-end text-center">
                                    <h3
                                        class="text-sm font-black text-white leading-tight mb-2 drop-shadow-md line-clamp-2">
                                        Hollow Knight: Silksong</h3>
                                    <span
                                        class="bg-gray-100/90 dark:bg-gray-800/90 backdrop-blur-md text-gray-600 dark:text-gray-400 border border-gray-300 dark:border-gray-700 px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider w-full transition-colors duration-300">TBA</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="min-w-[140px] snap-start flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-300 dark:border-gray-800 hover:border-cyan-500 hover:bg-cyan-50 dark:hover:border-cyan-500/50 dark:hover:bg-cyan-500/5 transition-colors cursor-pointer text-gray-500 dark:text-gray-500 hover:text-cyan-600 dark:hover:text-cyan-400 aspect-[3/4] bg-white dark:bg-[#151821]/50 shadow-sm">
                            <i class="fa-solid fa-plus text-2xl mb-2"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest text-center px-4">Añadir a
                                Deseados</span>
                        </div>
                    </div>
                </section>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <section>
                        <h2
                            class="text-sm font-black text-gray-600 dark:text-gray-400 uppercase tracking-widest mb-6 flex items-center gap-3 transition-colors duration-300">
                            <i class="fa-solid fa-chart-simple text-cyan-600 dark:text-cyan-500"></i> Tu Colección por
                            Género
                        </h2>
                        <div
                            class="bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-3xl p-6 shadow-xl flex flex-col gap-4 transition-colors duration-300">
                            <div>
                                <div
                                    class="flex justify-between text-xs font-bold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider transition-colors duration-300">
                                    <span>Action RPG</span>
                                    <span
                                        class="text-gray-900 dark:text-white transition-colors duration-300">45%</span>
                                </div>
                                <div
                                    class="w-full bg-gray-100 dark:bg-[#0f1117] rounded-full h-2 border border-gray-200 dark:border-gray-800 transition-colors duration-300">
                                    <div class="bg-cyan-500 h-2 rounded-full" style="width: 45%"></div>
                                </div>
                            </div>
                            <div>
                                <div
                                    class="flex justify-between text-xs font-bold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider transition-colors duration-300">
                                    <span>Shooter</span>
                                    <span
                                        class="text-gray-900 dark:text-white transition-colors duration-300">25%</span>
                                </div>
                                <div
                                    class="w-full bg-gray-100 dark:bg-[#0f1117] rounded-full h-2 border border-gray-200 dark:border-gray-800 transition-colors duration-300">
                                    <div class="bg-purple-500 h-2 rounded-full" style="width: 25%"></div>
                                </div>
                            </div>
                            <div>
                                <div
                                    class="flex justify-between text-xs font-bold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider transition-colors duration-300">
                                    <span>Aventura</span>
                                    <span
                                        class="text-gray-900 dark:text-white transition-colors duration-300">15%</span>
                                </div>
                                <div
                                    class="w-full bg-gray-100 dark:bg-[#0f1117] rounded-full h-2 border border-gray-200 dark:border-gray-800 transition-colors duration-300">
                                    <div class="bg-teal-500 h-2 rounded-full" style="width: 15%"></div>
                                </div>
                            </div>
                            <div>
                                <div
                                    class="flex justify-between text-xs font-bold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider transition-colors duration-300">
                                    <span>Deportes</span>
                                    <span
                                        class="text-gray-900 dark:text-white transition-colors duration-300">10%</span>
                                </div>
                                <div
                                    class="w-full bg-gray-100 dark:bg-[#0f1117] rounded-full h-2 border border-gray-200 dark:border-gray-800 transition-colors duration-300">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 10%"></div>
                                </div>
                            </div>
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

            {{-- Columna Derecha (Feed y Amigos) --}}
            <div class="xl:col-span-4 flex flex-col h-full gap-8">
                <div
                    class="bg-white dark:bg-[#151821]/80 backdrop-blur-2xl border border-gray-200 dark:border-gray-800 rounded-[2.5rem] p-8 flex flex-col shadow-xl dark:shadow-2xl transition-colors duration-300">
                    <div class="flex items-center justify-between mb-8">
                        <h2
                            class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest transition-colors duration-300">
                            Feed Social
                        </h2>
                        <button
                            class="w-8 h-8 rounded-full bg-gray-100 dark:bg-[#1a1d27] flex items-center justify-center hover:bg-gray-200 dark:hover:bg-gray-800 transition-colors text-gray-500 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 border border-gray-200 dark:border-gray-800">
                            <i class="fa-solid fa-user-plus text-xs"></i>
                        </button>
                    </div>

                    <div class="flex flex-col gap-8">
                        <div class="flex gap-4 group">
                            <img src="https://images.igdb.com/igdb/image/upload/t_thumb/co1r7f.jpg"
                                class="w-10 h-10 rounded-xl object-cover border border-gray-200 dark:border-gray-700 shrink-0 transition-colors duration-300" />
                            <div class="flex-1">
                                <p
                                    class="text-sm text-gray-600 dark:text-gray-400 leading-snug transition-colors duration-300">
                                    <span
                                        class="text-gray-900 dark:text-white font-bold group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors cursor-pointer">Alex99</span>
                                    ha puntuado <span
                                        class="text-gray-900 dark:text-white font-bold cursor-pointer hover:underline transition-colors duration-300">Red
                                        Dead Redemption 2</span>
                                </p>
                                <div class="flex text-[10px] text-yellow-500 mt-1 mb-2">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                        class="fa-solid fa-star-half-stroke"></i>
                                </div>
                                <p
                                    class="text-xs text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-[#0f1117] p-3 rounded-lg border border-gray-200 dark:border-gray-800 transition-colors duration-300">
                                    Una historia increíble, el mundo abierto se siente vivo. Imprescindible.
                                </p>
                                <span
                                    class="text-[10px] text-gray-500 dark:text-gray-500 font-bold uppercase tracking-wider block mt-3 transition-colors duration-300">Hace
                                    2 horas</span>
                            </div>
                        </div>

                        <div class="flex gap-4 group">
                            <div
                                class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800/30 flex items-center justify-center shrink-0 transition-colors duration-300">
                                <i
                                    class="fa-solid fa-ghost text-purple-600 dark:text-purple-500 text-sm transition-colors duration-300"></i>
                            </div>
                            <div class="flex-1 flex flex-col justify-center">
                                <p
                                    class="text-sm text-gray-600 dark:text-gray-400 leading-snug transition-colors duration-300">
                                    <span
                                        class="text-gray-900 dark:text-white font-bold group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors cursor-pointer">PhantomGhost</span>
                                    añadió <span
                                        class="text-gray-900 dark:text-white font-bold cursor-pointer hover:underline transition-colors duration-300">Alan
                                        Wake 2</span> a sus deseados
                                </p>
                                <span
                                    class="text-[10px] text-gray-500 dark:text-gray-500 font-bold uppercase tracking-wider block mt-2 transition-colors duration-300">Hace
                                    5 horas</span>
                            </div>
                        </div>

                        <div class="flex gap-4 group">
                            <img src="https://images.igdb.com/igdb/image/upload/t_thumb/co2lbd.jpg"
                                class="w-10 h-10 rounded-xl object-cover border border-gray-200 dark:border-gray-700 shrink-0 transition-colors duration-300" />
                            <div class="flex-1">
                                <p
                                    class="text-sm text-gray-600 dark:text-gray-400 leading-snug transition-colors duration-300">
                                    <span
                                        class="text-gray-900 dark:text-white font-bold group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors cursor-pointer">Sara_Gamer</span>
                                    subió una captura.
                                </p>
                                <div
                                    class="mt-3 relative rounded-xl overflow-hidden border border-gray-200 dark:border-gray-800 aspect-video cursor-pointer transition-colors duration-300">
                                    <img src="https://images.igdb.com/igdb/image/upload/t_1080p/sc8c26.jpg"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
                                </div>
                                <div class="flex items-center gap-4 mt-3">
                                    <button
                                        class="text-xs font-bold text-gray-500 hover:text-red-500 dark:hover:text-red-400 transition-colors flex items-center gap-1.5">
                                        <i class="fa-regular fa-heart"></i> 14 likes
                                    </button>
                                    <button
                                        class="text-xs font-bold text-gray-500 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors flex items-center gap-1.5">
                                        <i class="fa-regular fa-comment"></i> 3
                                    </button>
                                </div>
                                <span
                                    class="text-[10px] text-gray-500 dark:text-gray-500 font-bold uppercase tracking-wider block mt-3 transition-colors duration-300">Ayer
                                    a las 20:15</span>
                            </div>
                        </div>
                    </div>

                    <button
                        class="w-full mt-6 py-3 border border-gray-200 dark:border-gray-800 rounded-xl text-xs font-black uppercase tracking-widest text-cyan-600 dark:text-cyan-500 bg-gray-50 hover:bg-gray-100 dark:bg-transparent dark:hover:bg-[#1a1d27] transition-colors duration-300">
                        Ver toda la actividad
                    </button>
                </div>

                <div
                    class="bg-white dark:bg-[#151821]/80 backdrop-blur-2xl border border-gray-200 dark:border-gray-800 rounded-[2.5rem] p-8 flex flex-col shadow-xl dark:shadow-2xl sticky top-4 transition-colors duration-300">
                    <h2
                        class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-6 transition-colors duration-300">
                        Amigos en línea (2)
                    </h2>

                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-3 cursor-pointer group">
                            <div class="relative">
                                <div
                                    class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-pink-500 dark:from-purple-500 dark:to-pink-500 flex items-center justify-center text-white font-black text-sm border-2 border-white dark:border-[#151821] transition-colors duration-300">
                                    M</div>
                                <div
                                    class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white dark:border-[#151821] rounded-full transition-colors duration-300">
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4
                                    class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300">
                                    Marc_23</h4>
                                <p
                                    class="text-[10px] font-bold text-cyan-600 dark:text-cyan-500 uppercase tracking-wider truncate transition-colors duration-300">
                                    Jugando a Hades</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 cursor-pointer group">
                            <div class="relative">
                                <div
                                    class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-cyan-500 dark:from-blue-500 dark:to-cyan-500 flex items-center justify-center text-white font-black text-sm border-2 border-white dark:border-[#151821] transition-colors duration-300">
                                    A</div>
                                <div
                                    class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white dark:border-[#151821] rounded-full transition-colors duration-300">
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4
                                    class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300">
                                    Alex99</h4>
                                <p
                                    class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider truncate transition-colors duration-300">
                                    En los menús</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 opacity-60 dark:opacity-50 cursor-pointer group">
                            <div class="relative">
                                <img src="https://images.igdb.com/igdb/image/upload/t_thumb/co2lbd.jpg"
                                    class="w-10 h-10 rounded-full object-cover border-2 border-white dark:border-[#151821] transition-colors duration-300" />
                                <div
                                    class="absolute bottom-0 right-0 w-3 h-3 bg-gray-400 dark:bg-gray-500 border-2 border-white dark:border-[#151821] rounded-full transition-colors duration-300">
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4
                                    class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors duration-300">
                                    Sara_Gamer</h4>
                                <p
                                    class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider truncate transition-colors duration-300">
                                    Desconectada</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-miscomponentes.page-layout>
