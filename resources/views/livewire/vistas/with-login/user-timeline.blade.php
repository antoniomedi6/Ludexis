<x-miscomponentes.page-layout :fullWidth="false">

    {{-- LOADING --}}
    <x-miscomponentes.loading-spinner wire:target="setFilter">
        Actualizando cronología
    </x-miscomponentes.loading-spinner>

    {{-- RESPLANDOR DE FONDO --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-screen bg-cyan-200/40 dark:bg-cyan-900/20 rounded-full blur-3xl opacity-70 pointer-events-none z-0"
        aria-hidden="true">
    </div>

    <div class="relative z-10 w-full max-w-6xl mx-auto mt-8">

        {{-- ENCABEZADO Y FILTROS --}}
        <header class="mb-24 flex flex-col items-center justify-center">
            <span
                class="text-xs font-black text-cyan-700 dark:text-cyan-500 uppercase tracking-widest mb-3 block text-center">
                Recorrido de Actividad
            </span>
            <h2
                class="text-5xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-b from-gray-900 to-gray-600 dark:from-white dark:to-gray-400 tracking-tighter mb-8 text-center uppercase">
                Tu Cronología
            </h2>

            <div class="w-full max-w-md bg-lightbox-soft dark:bg-gray-900 p-1.5 rounded-2xl border border-lightbox-border dark:border-gray-800 shadow-sm flex relative z-20"
                role="group" aria-label="Filtros de vista">
                <button type="button" wire:click="setFilter('current_year')"
                    aria-pressed="{{ $filterOption === 'current_year' ? 'true' : 'false' }}"
                    class="relative flex-1 min-w-0 px-3 sm:px-8 py-2.5 rounded-xl text-xs sm:text-sm font-bold uppercase tracking-widest transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 {{ $filterOption === 'current_year' ? 'text-cyan-700 dark:text-cyan-400 bg-lightbox-card dark:bg-gray-800 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-cyan-700 dark:hover:text-white hover:bg-lightbox-card/90 dark:hover:bg-gray-800 hover:shadow-sm' }}">
                    Resumen Anual
                </button>

                <button type="button" wire:click="setFilter('current_month')"
                    aria-pressed="{{ $filterOption === 'current_month' ? 'true' : 'false' }}"
                    class="relative flex-1 min-w-0 px-3 sm:px-8 py-2.5 rounded-xl text-xs sm:text-sm font-bold uppercase tracking-widest transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 {{ $filterOption === 'current_month' ? 'text-cyan-700 dark:text-cyan-400 bg-lightbox-card dark:bg-gray-800 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-cyan-700 dark:hover:text-white hover:bg-lightbox-card/90 dark:hover:bg-gray-800 hover:shadow-sm' }}">
                    Vista Mensual
                </button>
            </div>
        </header>

        {{-- LÍNEA DE TIEMPO Y EVENTOS --}}
        <div class="relative space-y-32 pb-32">
            {{-- Línea central vertical --}}
            <div class="absolute left-7 md:left-1/2 top-0 h-full w-2 bg-gray-200 dark:bg-gray-800 -translate-x-1/2 pointer-events-none rounded-full z-0"
                aria-hidden="true">
            </div>

            @php $globalIndex = 0; @endphp

            @if ($monthsSummary->isEmpty())
                {{-- SIN RESULTADOS --}}
                <div class="relative z-10 flex flex-col items-center justify-center p-12 sm:p-16 text-center bg-white dark:bg-gray-900 border border-dashed border-gray-200 dark:border-gray-800 rounded-3xl shadow-sm max-w-2xl mx-auto"
                    role="status" aria-live="polite">
                    <div
                        class="w-16 h-16 bg-gray-50 dark:bg-gray-950 rounded-2xl flex items-center justify-center mb-5 border border-gray-200 dark:border-gray-800">
                        <i class="fa-solid fa-hourglass-half text-2xl text-cyan-600 dark:text-cyan-500"
                            aria-hidden="true"></i>
                    </div>
                    <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2 uppercase tracking-tight">
                        Sin actividad registrada
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 max-w-md">
                        No hay hitos en el rango seleccionado. Prueba a cambiar el filtro o empieza a registrar
                        partidas para construir tu cronología.
                    </p>
                </div>
            @endif

            @foreach ($monthsSummary as $monthKey => $monthData)
                @php $globalIndex++; @endphp

                {{-- HITO MENSUAL --}}
                <section aria-labelledby="month-heading-{{ $globalIndex }}"
                    class="relative flex items-center w-full group {{ $globalIndex % 2 == 0 ? 'md:justify-end' : '' }}">

                    {{-- Nodo de la línea --}}
                    <div class="absolute left-7 md:left-1/2 -translate-x-1/2 w-14 h-14 rounded-full bg-gray-50 dark:bg-gray-950 border-8 border-white dark:border-gray-900 shadow-inner flex items-center justify-center z-10 group-hover:scale-110 transition-transform duration-300"
                        aria-hidden="true">
                        <div class="w-4 h-4 rounded-full bg-amber-500 shadow-lg shadow-amber-500/50"></div>
                    </div>

                    {{-- Tarjeta del Resumen --}}
                    <div
                        class="w-full md:w-1/2 pl-24 {{ $globalIndex % 2 == 0 ? 'md:pl-16' : 'md:pl-0 md:pr-16 md:text-right' }}">
                        <div
                            class="w-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-8 md:p-10 shadow-xl dark:shadow-2xl hover:border-amber-400 dark:hover:border-amber-800 transition-all duration-300 hover:-translate-y-1">
                            <div class="space-y-8">
                                <div class="flex-1 space-y-2">
                                    <h3 id="month-heading-{{ $globalIndex }}"
                                        class="text-3xl font-black text-gray-900 dark:text-white tracking-tight uppercase">
                                        {{ $monthData['month_name'] }}
                                    </h3>
                                    <p
                                        class="text-gray-600 dark:text-gray-400 font-bold uppercase tracking-widest text-xs">
                                        Hito de Exploración
                                    </p>
                                    <p class="text-2xl font-black text-gray-900 dark:text-white leading-tight pt-1">
                                        Probaste {{ $monthData['unique_games_count'] }}
                                        {{ Str::plural('nuevo título', $monthData['unique_games_count']) }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 pt-2"
                                    aria-label="Juegos probados en {{ $monthData['month_name'] }}">
                                    @foreach ($monthData['covers'] as $cover)
                                        <div
                                            class="relative group/cover aspect-[3/4] overflow-hidden rounded-2xl md:rounded-3xl border border-gray-200 dark:border-gray-800 shadow-lg">
                                            <img src="{{ $cover }}"
                                                alt="Portada de juego jugado en {{ $monthData['month_name'] }}"
                                                loading="lazy"
                                                class="w-full h-full object-cover transition-transform duration-500 group-hover/cover:scale-105" />
                                        </div>
                                    @endforeach
                                </div>

                                <div
                                    class="flex items-center gap-3 text-sm text-amber-600 dark:text-amber-500 font-bold pt-6 border-t border-gray-200 dark:border-gray-800 {{ $globalIndex % 2 == 0 ? 'justify-start' : 'md:justify-end' }}">
                                    <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                                    <span>Destacado: {{ $monthData['top_game']?->title ?? 'Ninguno' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ACTIVIDADES DEL MES --}}
                @foreach ($monthData['activities'] as $item)
                    @php $globalIndex++; @endphp
                    <article aria-labelledby="activity-heading-{{ $globalIndex }}"
                        class="relative flex items-center w-full group {{ $globalIndex % 2 == 0 ? 'md:justify-end' : '' }}">

                        {{-- Nodo de la línea --}}
                        <div class="absolute left-7 md:left-1/2 -translate-x-1/2 w-14 h-14 rounded-full bg-gray-50 dark:bg-gray-950 border-8 border-white dark:border-gray-900 shadow-inner flex items-center justify-center z-10 group-hover:scale-110 transition-transform duration-300"
                            aria-hidden="true">
                            <div class="w-4 h-4 rounded-full bg-cyan-500 shadow-lg shadow-cyan-500/50"></div>
                        </div>

                        {{-- Tarjeta de Actividad --}}
                        <div
                            class="w-full md:w-1/2 pl-24 {{ $globalIndex % 2 == 0 ? 'md:pl-16' : 'md:pl-0 md:pr-16 md:text-right' }}">
                            <div
                                class="w-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-8 md:p-10 shadow-xl dark:shadow-2xl hover:border-cyan-400 dark:hover:border-cyan-800 transition-all duration-300 hover:-translate-y-1">
                                <div
                                    class="flex flex-col {{ $globalIndex % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' }} items-center gap-8">

                                    <img src="{{ $item->game?->cover_url }}"
                                        alt="Portada de {{ $item->game?->title ?? 'juego' }}" loading="lazy"
                                        class="w-32 md:w-40 aspect-[3/4] rounded-2xl md:rounded-3xl object-cover shadow-lg shrink-0 transition-transform duration-500 hover:scale-105" />

                                    <div class="flex-1 space-y-3 w-full">
                                        <time datetime="{{ $item->created_at->format('Y-m-d') }}" class="block">
                                            <span
                                                class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">
                                                {{ $item->created_at->format('d') }}
                                            </span>
                                            <span
                                                class="block text-gray-600 dark:text-gray-400 font-bold uppercase tracking-widest text-xs">
                                                {{ $item->created_at->translatedFormat('l') }}
                                            </span>
                                        </time>

                                        <h4 id="activity-heading-{{ $globalIndex }}"
                                            class="text-2xl font-black text-gray-900 dark:text-white leading-tight uppercase">
                                            {{ $item->game?->title ?? 'Juego desconocido' }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            @endforeach
        </div>
    </div>
</x-miscomponentes.page-layout>
