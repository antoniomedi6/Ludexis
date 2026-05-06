<x-miscomponentes.page-layout title1="Resumen" title2="General">
    <x-slot name="subtitle">
        Bienvenido de nuevo, {{ Auth()->user()->name }}. Tienes
        {{ $userGames->where('pivot.status', 'playing')->count() }} juegos activos.
    </x-slot>
    <x-slot>
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 w-full">

            {{-- COLUMNA PRINCIPAL IZQUIERDA --}}
            <div class="xl:col-span-8 flex flex-col gap-10">

                {{-- TARJETAS DE ESTADISTICAS --}}
                <section class="grid grid-cols-2 md:grid-cols-4 gap-4" aria-label="Estadísticas generales">
                    <a href="{{ route('library') }}"
                        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 flex flex-col justify-center items-center text-center transition-colors duration-300 hover:bg-gray-50 dark:hover:bg-gray-800 shadow-xl relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-cyan-500 group">
                        <i class="fa-solid fa-cubes absolute -bottom-4 -right-4 text-6xl text-gray-100 dark:text-gray-800/30 transition-colors duration-300 group-hover:scale-110"
                            aria-hidden="true"></i>
                        <span
                            class="text-4xl font-black text-gray-900 dark:text-white mb-1 relative z-10 transition-colors duration-300">{{ count($userGames) }}</span>
                        <span
                            class="text-xs font-black uppercase tracking-widest text-gray-500 relative z-10 transition-colors duration-300">En
                            Biblioteca</span>
                    </a>

                    <a href="{{ route('library') }}"
                        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 flex flex-col justify-center items-center text-center transition-colors duration-300 hover:bg-gray-50 dark:hover:bg-gray-800 shadow-xl relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-cyan-500 group">
                        <i class="fa-solid fa-trophy absolute -bottom-4 -right-4 text-6xl text-green-50 dark:text-green-900/20 transition-colors duration-300 group-hover:scale-110"
                            aria-hidden="true"></i>
                        <span
                            class="text-4xl font-black text-green-600 dark:text-green-400 mb-1 relative z-10 transition-colors duration-300">{{ $completedGamesCount }}</span>
                        <span
                            class="text-xs font-black uppercase tracking-widest text-gray-500 relative z-10 transition-colors duration-300">Completados
                            al 100%</span>
                    </a>

                    <a href="{{ route('library') }}"
                        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 flex flex-col justify-center items-center text-center transition-colors duration-300 hover:bg-gray-50 dark:hover:bg-gray-800 shadow-xl relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-cyan-500 group">
                        <i class="fa-regular fa-clock absolute -bottom-4 -right-4 text-6xl text-gray-100 dark:text-gray-800/30 transition-colors duration-300 group-hover:scale-110"
                            aria-hidden="true"></i>
                        <span
                            class="text-4xl font-black text-gray-900 dark:text-white mb-1 relative z-10 transition-colors duration-300">
                            @php
                                $formattedHours =
                                    $totalHours >= 1000 ? number_format($totalHours / 1000, 1) . 'k' : $totalHours;
                            @endphp
                            {{ $formattedHours }}<span class="text-lg text-gray-500" aria-label="horas">h</span>
                        </span>
                        <span
                            class="text-xs font-black uppercase tracking-widest text-gray-500 relative z-10 transition-colors duration-300">Tiempo
                            Total</span>
                    </a>


                    @livewire('utils.random-game-picker-modal')
                </section>

                {{-- JUEGOS ACTIVOS --}}
                @php
                    $activeGames = $userGames->where('pivot.status', 'playing')->take(2);
                @endphp

                @if ($activeGames->isNotEmpty())
                    <section aria-labelledby="active-games-heading">
                        <h2 id="active-games-heading"
                            class="text-sm font-black text-gray-600 dark:text-gray-400 uppercase tracking-widest mb-6 flex items-center gap-3 transition-colors duration-300">
                            <div class="w-2 h-2 rounded-full bg-cyan-500 shadow-[0_0_10px_#06b6d4] animate-pulse"
                                aria-hidden="true">
                            </div>
                            Activos en este momento
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($activeGames as $game)
                                <a href="{{ route('games.show', $game->slug) }}"
                                    class="block rounded-3xl focus:outline-none focus:ring-4 focus:ring-cyan-500 group">
                                    <article
                                        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl shadow-xl flex flex-col overflow-hidden transition-colors duration-300 cursor-pointer h-full">

                                        <div class="relative h-40 w-full overflow-hidden shrink-0">
                                            <img src="{{ $game->cover_url }}" alt="Portada de {{ $game->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                                loading="lazy" />
                                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent opacity-80"
                                                aria-hidden="true"></div>
                                            {{-- PLATAFORMA --}}
                                            {{--
                                            <div class="absolute bottom-4 left-4 flex gap-2">
                                                <span
                                                    class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-md text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider shadow-sm transition-colors duration-300">
                                                    <i class="fa-brands fa-windows mr-1" aria-hidden="true"></i> PC
                                                </span>
                                            </div>
                                             --}}
                                        </div>

                                        <div class="p-6 flex-1 flex flex-col justify-center">
                                            <h3
                                                class="text-xl font-black text-gray-900 dark:text-white leading-tight group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300">
                                                {{ $game->title }}
                                            </h3>
                                        </div>

                                    </article>
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- PROXIMOS JUEGOS Y METRICAS --}}
                @livewire('utils.preview-next-games')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <section aria-labelledby="genre-collection-heading">
                        <h2 id="genre-collection-heading"
                            class="text-sm font-black text-gray-600 dark:text-gray-400 uppercase tracking-widest mb-6 flex items-center gap-3 transition-colors duration-300">
                            <i class="fa-solid fa-chart-simple text-cyan-600 dark:text-cyan-500" aria-hidden="true"></i>
                            Tu Colección por Género
                        </h2>

                        <div
                            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 shadow-xl flex flex-col gap-4 transition-colors duration-300 min-h-[180px]">
                            @if (empty($genreStats))
                                <div class="flex-1 flex items-center justify-center text-xs font-bold text-gray-400 uppercase tracking-widest"
                                    role="status">
                                    No hay datos suficientes
                                </div>
                            @else
                                @php
                                    $genreBarColors = ['bg-cyan-500', 'bg-purple-500', 'bg-teal-500', 'bg-yellow-500'];
                                @endphp
                                <div class="flex flex-col gap-4">
                                    @foreach ($genreStats as $stat)
                                        <div>
                                            <div class="flex justify-between text-xs font-bold text-gray-500 dark:text-gray-400 mb-1.5 uppercase tracking-wider transition-colors duration-300"
                                                aria-hidden="true">
                                                <span>{{ $stat['name'] }}</span>
                                                <span
                                                    class="text-gray-900 dark:text-white transition-colors duration-300">{{ $stat['percentage'] }}%</span>
                                            </div>
                                            <div class="w-full bg-gray-100 dark:bg-gray-950 rounded-full h-2 border border-gray-200 dark:border-gray-800 transition-colors duration-300"
                                                role="progressbar" aria-label="Porcentaje de {{ $stat['name'] }}"
                                                aria-valuenow="{{ $stat['percentage'] }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                                <div
                                                    @class([
                                                        'h-2 rounded-full transition-all duration-1000',
                                                        'bg-cyan-500' => (($loop->index ?? 0) % count($genreBarColors)) === 0,
                                                        'bg-purple-500' => (($loop->index ?? 0) % count($genreBarColors)) === 1,
                                                        'bg-teal-500' => (($loop->index ?? 0) % count($genreBarColors)) === 2,
                                                        'bg-yellow-500' => (($loop->index ?? 0) % count($genreBarColors)) === 3,
                                                    ])
                                                    style="width: {{ $stat['percentage'] }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </section>
                </div>

                @livewire('utils.preview-my-recent-activity')
            </div>

            {{-- COLUMNA LATERAL DERECHA --}}
            @livewire('utils.preview-social-feed')
        </div>
    </x-slot>
</x-miscomponentes.page-layout>
