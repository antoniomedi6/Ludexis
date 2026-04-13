<x-miscomponentes.page-layout :fullWidth="false">

    {{-- BOTONES SUPERIORES --}}
    <x-slot:aside>
        <button type="button"
            class="px-6 py-2.5 bg-cyan-600 hover:bg-cyan-500 text-white rounded-xl font-black text-xs uppercase tracking-widest transition-all shadow-md focus:outline-none focus:ring-2 focus:ring-cyan-500 active:scale-95">
            <i class="fa-solid fa-user-plus mr-2" aria-hidden="true"></i> Seguir
        </button>
        <button type="button"
            class="p-2.5 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500 text-gray-600 dark:text-gray-400"
            aria-label="Opciones del perfil">
            <i class="fa-solid fa-ellipsis" aria-hidden="true"></i>
        </button>
    </x-slot:aside>

    <x-slot>
        <div class="flex flex-col gap-8">

            {{-- PLAYER CARD --}}
            <header
                class="w-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-[2rem] shadow-sm overflow-hidden relative">

                {{-- Efecto de resplandor --}}
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-cyan-500/10 blur-[60px] pointer-events-none"
                    aria-hidden="true"></div>

                <div
                    class="relative z-10 p-6 sm:p-10 flex flex-col sm:flex-row items-center sm:items-center gap-6 sm:gap-8">

                    {{-- Avatar --}}
                    <div class="relative shrink-0 group">
                        <div class="absolute -inset-1.5 bg-gradient-to-tr from-cyan-500 to-blue-600 rounded-full opacity-30 group-hover:opacity-60 blur-md transition duration-500"
                            aria-hidden="true"></div>
                        <div class="relative">
                            <img src="https://ui-avatars.com/api/?name={{ $user->name }}&color=FFFFFF&background=374151&size=200"
                                alt="Avatar de {{ $user->name }}"
                                class="w-32 h-32 sm:w-36 sm:h-36 rounded-full border-4 border-white dark:border-gray-900 object-cover shadow-xl bg-gray-100 dark:bg-gray-800">

                            {{-- Badge Rol --}}
                            <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 px-3 py-1 bg-yellow-500 text-black text-[10px] font-black uppercase tracking-widest rounded-full border-2 border-white dark:border-gray-900 shadow-md whitespace-nowrap"
                                title="Rol Oficial">
                                <i class="fa-solid fa-crown mr-1" aria-hidden="true"></i> {{ $user->role }}
                            </div>
                        </div>
                    </div>

                    {{-- Info del Jugador --}}
                    <div class="flex-1 w-full text-center sm:text-left flex flex-col justify-center gap-5">

                        <div>
                            <div
                                class="flex flex-col sm:flex-row sm:items-center justify-center sm:justify-start gap-3 mb-2">
                                <h1
                                    class="text-3xl sm:text-4xl font-black text-gray-900 dark:text-white tracking-tight leading-none">
                                    {{ $user->name }}
                                </h1>
                                @if ($user->is_private)
                                    <span
                                        class="w-fit mx-auto sm:mx-0 px-2.5 py-1 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700 rounded-lg text-[10px] font-black uppercase tracking-widest flex items-center gap-1.5"
                                        title="Perfil Privado">
                                        <i class="fa-solid fa-lock" aria-hidden="true"></i> Privado
                                    </span>
                                @else
                                    <span
                                        class="w-fit mx-auto sm:mx-0 px-2.5 py-1 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700 rounded-lg text-[10px] font-black uppercase tracking-widest flex items-center gap-1.5"
                                        title="Perfil Público">
                                        <i class="fa-solid fa-earth" aria-hidden="true"></i> Público
                                    </span>
                                @endif
                            </div>

                            <p class="text-xs font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400">
                                <i class="fa-solid fa-calendar-day mr-1" aria-hidden="true"></i>
                                {{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('M Y') }}
                            </p>
                        </div>

                        @if (!Auth::user()->role === 'admin' || Auth::user()->role === 'journalist')
                            {{-- Barra XP --}}
                            <div
                                class="w-full max-w-md mx-auto sm:mx-0 bg-gray-50 dark:bg-gray-950 border border-gray-200 dark:border-gray-800 p-3.5 rounded-2xl">
                                <div class="flex justify-between items-end mb-2 px-1">
                                    <span
                                        class="text-[10px] font-black uppercase tracking-widest text-gray-500">Progreso
                                        XP</span>
                                    <span
                                        class="text-[10px] font-black text-cyan-600 dark:text-cyan-400 tabular-nums">{{ $user->xp }}
                                        / 1,000</span>
                                </div>
                                <div class="h-2 w-full bg-gray-200 dark:bg-gray-800 rounded-full overflow-hidden"
                                    role="progressbar" aria-valuenow="{{ $user->xp }}" aria-valuemin="0"
                                    aria-valuemax="1000">
                                    <div class="h-full bg-cyan-500 rounded-full transition-all duration-500"
                                        style="width: {{ ($user->xp / 1000) * 100 }}%"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if (Auth::user()->is_private || Auth::user()->role === 'admin' || Auth::user()->id === $user->id)
                        @if (isset($game))
                            <div class="flex-col">
                                <h2 class="text-xl font-bold">Mi Top 3 de Juegos</h2>
                                <div class="flex gap-5">
                                    <div>
                                        2
                                    </div>
                                    <div>
                                        1
                                    </div>
                                    <div>
                                        3
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </header>

            {{-- GRID PRINCIPAL --}}
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
                @if (!$user->is_private)
                    {{-- ASIDE: Estadísticas --}}
                    <aside class="xl:col-span-4 flex flex-col gap-8">

                        <div
                            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-[2rem] p-6 sm:p-8 shadow-sm">
                            <h2
                                class="text-xs font-black uppercase tracking-widest text-gray-500 mb-6 flex items-center gap-2">
                                <i class="fa-solid fa-chart-pie text-cyan-500" aria-hidden="true"></i> Estadísticas
                                Usuario
                            </h2>

                            <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-gray-100 dark:border-gray-800">
                                <div
                                    class="bg-gray-50 dark:bg-gray-950 p-4 rounded-2xl border border-gray-100 dark:border-gray-800/50 text-center">
                                    <span
                                        class="block text-2xl sm:text-3xl font-black text-gray-900 dark:text-white tabular-nums">{{ $totalHours }}</span>
                                    <span
                                        class="text-[10px] font-bold uppercase text-gray-500 tracking-widest">Horas</span>
                                </div>
                                <div
                                    class="bg-gray-50 dark:bg-gray-950 p-4 rounded-2xl border border-gray-100 dark:border-gray-800/50 text-center">
                                    <span
                                        class="block text-2xl sm:text-3xl font-black text-gray-900 dark:text-white tabular-nums">{{ number_format($averageRating, 1) }}</span>
                                    <span class="text-[10px] font-bold uppercase text-gray-500 tracking-widest">Nota
                                        Media</span>
                                </div>
                            </div>

                            <div class="space-y-4 px-2">
                                <div class="flex justify-between items-center text-sm font-bold">
                                    <div class="flex items-center gap-2 text-emerald-600 dark:text-emerald-400">
                                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i> Completados
                                    </div>
                                    <span
                                        class="text-gray-900 dark:text-white tabular-nums">{{ $completedCount }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm font-bold">
                                    <div class="flex items-center gap-2 text-blue-600 dark:text-blue-400">
                                        <i class="fa-solid fa-gamepad" aria-hidden="true"></i> Jugando
                                    </div>
                                    <span class="text-gray-900 dark:text-white tabular-nums">{{ $playingCount }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm font-bold">
                                    <div class="flex items-center gap-2 text-purple-600 dark:text-purple-400">
                                        <i class="fa-solid fa-bookmark" aria-hidden="true"></i> Pendientes
                                    </div>
                                    <span class="text-gray-900 dark:text-white tabular-nums">{{ $pendingCount }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm font-bold">
                                    <div class="flex items-center gap-2 text-red-600 dark:text-red-400">
                                        <i class="fa-solid fa-skull" aria-hidden="true"></i> Abandonados
                                    </div>
                                    <span
                                        class="text-gray-900 dark:text-white tabular-nums">{{ $abandonedCount }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Colecciones --}}
                        <div
                            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-[2rem] p-6 sm:p-8 shadow-sm">
                            <h2
                                class="text-xs font-black uppercase tracking-widest text-gray-500 mb-6 flex items-center gap-2">
                                <i class="fa-solid fa-layer-group text-cyan-500" aria-hidden="true"></i> Colecciones
                            </h2>
                            <nav class="space-y-3" aria-label="Listas de juegos del usuario">
                                <a href="#"
                                    class="flex justify-between items-center p-4 bg-gray-50 dark:bg-gray-950 border border-gray-200 dark:border-gray-800/50 rounded-2xl hover:border-cyan-500/50 transition-colors group focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                    <span
                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">Mis
                                        Favoritos Absolutos</span>
                                    <span class="text-xs font-black text-gray-400 tabular-nums">10</span>
                                </a>
                                <a href="#"
                                    class="flex justify-between items-center p-4 bg-gray-50 dark:bg-gray-950 border border-gray-200 dark:border-gray-800/50 rounded-2xl hover:border-cyan-500/50 transition-colors group focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                    <span
                                        class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">Decepción
                                        Total</span>
                                    <span class="text-xs font-black text-gray-400 tabular-nums">4</span>
                                </a>
                            </nav>
                        </div>
                    </aside>

                    {{-- FEED PRINCIPAL --}}
                    <div x-data="{ activeTab: 'activity' }" class="xl:col-span-8 flex flex-col gap-8">

                        {{-- Pestañas --}}
                        <div class="flex gap-2 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-1.5 shrink-0 w-fit shadow-sm"
                            role="tablist">
                            <button type="button" @click="activeTab = 'activity'"
                                :class="activeTab === 'activity' ?
                                    'bg-gray-100 dark:bg-gray-800 text-cyan-600 dark:text-cyan-400' :
                                    'text-gray-500 hover:text-gray-900 dark:hover:text-white'"
                                class="px-5 py-2.5 rounded-lg font-black text-xs uppercase tracking-widest transition-all focus:outline-none"
                                role="tab">
                                Actividad
                            </button>
                            <button type="button" @click="activeTab = 'library'"
                                :class="activeTab === 'library' ?
                                    'bg-gray-100 dark:bg-gray-800 text-cyan-600 dark:text-cyan-400' :
                                    'text-gray-500 hover:text-gray-900 dark:hover:text-white'"
                                class="px-5 py-2.5 rounded-lg font-black text-xs uppercase tracking-widest transition-all focus:outline-none"
                                role="tab">
                                Biblioteca
                            </button>
                            <button type="button" @click="activeTab = 'screenshots'"
                                :class="activeTab === 'screenshots' ?
                                    'bg-gray-100 dark:bg-gray-800 text-cyan-600 dark:text-cyan-400' :
                                    'text-gray-500 hover:text-gray-900 dark:hover:text-white'"
                                class="px-5 py-2.5 rounded-lg font-black text-xs uppercase tracking-widest transition-all focus:outline-none"
                                role="tab">
                                Capturas
                            </button>
                        </div>

                        {{-- CONTENIDO DE LAS PESTAÑAS --}}
                        <div x-show="activeTab === 'activity'" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-4">
                            <div class="flex flex-col gap-6" role="feed" aria-label="Feed de actividad">

                                {{-- Tarjeta de Reseña --}}
                                <article
                                    class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-[2rem] p-6 sm:p-8 shadow-sm hover:shadow-md transition-shadow">

                                    <div class="flex items-center gap-2 mb-6">
                                        <span
                                            class="text-[10px] bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50 px-2 py-0.5 rounded-md font-black uppercase tracking-widest">
                                            Juego Completado
                                        </span>
                                        <time
                                            class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Hace
                                            2
                                            días</time>
                                    </div>

                                    <div class="flex flex-col sm:flex-row gap-6">
                                        <a href="#"
                                            class="shrink-0 group focus:outline-none focus:ring-4 focus:ring-cyan-500 rounded-xl h-fit">
                                            <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/co4ksi.jpg"
                                                class="w-full sm:w-28 h-48 sm:h-36 object-cover rounded-xl shadow-md group-hover:scale-[1.02] transition-transform duration-300"
                                                alt="Portada de Elden Ring">
                                        </a>

                                        <div class="flex-1 flex flex-col justify-between space-y-3">
                                            <div>
                                                <div class="flex justify-between items-start gap-4 mb-2">
                                                    <h3
                                                        class="text-xl font-black text-gray-900 dark:text-white leading-tight">
                                                        <a href="#"
                                                            class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors focus:outline-none focus:underline">Elden
                                                            Ring: Shadow of the Erdtree</a>
                                                    </h3>
                                                    <div class="shrink-0 bg-yellow-50 dark:bg-yellow-900/20 px-2.5 py-1 rounded-lg border border-yellow-200 dark:border-yellow-800/50 flex items-center gap-1.5"
                                                        aria-label="Valoración: 9.5">
                                                        <span
                                                            class="font-black text-yellow-700 dark:text-yellow-500 text-sm tabular-nums">9.5</span>
                                                        <i class="fa-solid fa-star text-yellow-500 text-[10px]"
                                                            aria-hidden="true"></i>
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <span
                                                        class="text-[10px] font-bold text-gray-500 bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 px-2 py-1 rounded-md uppercase tracking-wider">
                                                        <i class="fa-solid fa-clock mr-1" aria-hidden="true"></i> 45h
                                                        para
                                                        terminar
                                                    </span>
                                                </div>

                                                <p
                                                    class="text-sm text-gray-600 dark:text-gray-400 italic line-clamp-3">
                                                    "Una expansión que se siente como un juego completo. La dirección
                                                    artística
                                                    supera todo lo visto y el diseño de niveles es magistral."
                                                </p>
                                            </div>

                                            <div class="pt-3 border-t border-gray-50 dark:border-gray-800/50 mt-2">
                                                <button type="button"
                                                    class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-950 text-xs font-black text-gray-500 hover:text-red-500 hover:border-red-200 dark:hover:border-red-900/50 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 group mt-2">
                                                    <i class="fa-regular fa-heart group-hover:scale-110 transition-transform"
                                                        aria-hidden="true"></i> <span class="tabular-nums">124</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                                {{-- Tarjeta de Abandonado --}}
                                <article
                                    class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-[2rem] p-6 sm:p-8 shadow-sm hover:shadow-md transition-shadow">

                                    <div class="flex items-center gap-2 mb-6">
                                        <span
                                            class="text-[10px] bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800/50 px-2 py-0.5 rounded-md font-black uppercase tracking-widest">
                                            Abandonado
                                        </span>
                                        <time
                                            class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Hace
                                            1
                                            semana</time>
                                    </div>

                                    <div class="flex flex-col sm:flex-row gap-6">
                                        <a href="#"
                                            class="shrink-0 group focus:outline-none focus:ring-4 focus:ring-cyan-500 rounded-xl h-fit">
                                            <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/co5vbg.jpg"
                                                class="w-full sm:w-28 h-48 sm:h-36 object-cover rounded-xl shadow-md group-hover:scale-[1.02] transition-transform duration-300 grayscale opacity-80"
                                                alt="Portada de Redfall">
                                        </a>

                                        <div class="flex-1 flex flex-col justify-center space-y-3">
                                            <div>
                                                <h3
                                                    class="text-xl font-black text-gray-900 dark:text-white leading-tight mb-4">
                                                    <a href="#"
                                                        class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors focus:outline-none focus:underline">Redfall</a>
                                                </h3>

                                                <div
                                                    class="bg-red-50 dark:bg-red-500/10 border-l-4 border-red-500 p-4 rounded-r-lg">
                                                    <span
                                                        class="block text-[10px] font-black uppercase tracking-widest text-red-600 dark:text-red-400 mb-2">Motivo
                                                        del abandono</span>
                                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                        "Demasiados
                                                        bugs y el rendimiento en PC es injugable. Quizás en un año..."
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                        {{-- Pestaña Biblioteca --}}
                        <div x-show="activeTab === 'library'" x-cloak>
                            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach ($user->games as $game)
                                    <x-miscomponentes.game-card :game="$game" :status="$game->pivot->status" :rating="$game->pivot->rating"
                                        :hours="$game->pivot->hours_finish + $game->pivot->hours_completed" />
                                @endforeach
                            </div>
                        </div>
                        <div x-show="activeTab === 'screenshots'">
                            CAPTURAS
                        </div>
                    </div>
                @else
                @endif
            </div>
        </div>
    </x-slot>
</x-miscomponentes.page-layout>
