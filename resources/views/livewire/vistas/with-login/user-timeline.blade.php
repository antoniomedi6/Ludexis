<x-miscomponentes.page-layout fullWidth="false">
    <div
        class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[800px] bg-cyan-200/40 dark:bg-cyan-900/20 rounded-full blur-[150px] pointer-events-none z-0">
    </div>

    <div class="relative z-10 w-full max-w-6xl mx-auto mt-8">
        <div class="mb-24 flex flex-col items-center justify-center">
            <span
                class="text-xs font-black text-cyan-600 dark:text-cyan-500 uppercase tracking-widest mb-3 block text-center">
                Recorrido de Actividad
            </span>
            <h2
                class="text-5xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-b from-gray-900 to-gray-500 dark:from-white dark:to-gray-400 tracking-tighter mb-8 text-center uppercase">
                Tu Cronología
            </h2>

            <div
                class="bg-gray-100 dark:bg-[#151821] p-1.5 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm inline-flex relative z-20">
                <button wire:click="setFilter('current_year')"
                    class="relative px-8 py-2.5 rounded-xl text-sm font-bold uppercase tracking-widest transition-all duration-300 {{ $filterOption === 'current_year' ? 'text-cyan-600 dark:text-cyan-400 bg-white dark:bg-[#1a1d27] shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                    Resumen Anual
                </button>

                <button wire:click="setFilter('last_month')"
                    class="relative px-8 py-2.5 rounded-xl text-sm font-bold uppercase tracking-widest transition-all duration-300 {{ $filterOption === 'last_month' ? 'text-cyan-600 dark:text-cyan-400 bg-white dark:bg-[#1a1d27] shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                    Vista Mensual
                </button>
            </div>
        </div>

        <div class="relative space-y-32 pb-32">
            <div
                class="absolute left-7 md:left-1/2 top-0 h-full w-2 bg-gray-200 dark:bg-gray-800 -translate-x-1/2 pointer-events-none rounded-full z-0">
            </div>

            @php $globalIndex = 0; @endphp

            @foreach ($monthsSummary as $monthKey => $monthData)
                @php $globalIndex++; @endphp

                <div
                    class="relative flex items-center w-full group {{ $globalIndex % 2 == 0 ? 'md:justify-end' : '' }}">
                    <div
                        class="absolute left-7 md:left-1/2 -translate-x-1/2 w-14 h-14 rounded-full bg-gray-50 dark:bg-[#0f1117] border-8 border-white dark:border-[#151821] shadow-inner flex items-center justify-center z-10 group-hover:scale-110 transition-transform duration-300">
                        <div class="w-4 h-4 rounded-full bg-amber-500 shadow-lg shadow-amber-500/50"></div>
                    </div>

                    <div
                        class="w-full md:w-1/2 pl-24 {{ $globalIndex % 2 == 0 ? 'md:pl-16' : 'md:pl-0 md:pr-16 md:text-right' }}">
                        <div
                            class="w-full bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-[2rem] p-8 md:p-10 shadow-xl dark:shadow-2xl hover:border-amber-400 dark:hover:border-amber-800 transition-all duration-300 hover:-translate-y-1">
                            <div class="space-y-8">
                                <div class="flex-1 space-y-2">
                                    <span
                                        class="text-3xl font-black text-gray-900 dark:text-white tracking-tight uppercase">
                                        {{ $monthData['month_name'] }}
                                    </span>
                                    <p
                                        class="text-gray-500 dark:text-gray-400 font-bold uppercase tracking-widest text-xs">
                                        Hito de Exploración
                                    </p>
                                    <h4 class="text-2xl font-black text-gray-900 dark:text-white leading-tight pt-1">
                                        Probaste {{ $monthData['unique_games_count'] }}
                                        {{ Str::plural('nuevo título', $monthData['unique_games_count']) }}
                                    </h4>
                                </div>

                                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 pt-2">
                                    @foreach ($monthData['covers'] as $cover)
                                        <div
                                            class="relative group/cover aspect-[3/4] overflow-hidden rounded-2xl md:rounded-3xl border border-gray-200 dark:border-gray-800 shadow-lg">
                                            <img src="{{ $cover }}"
                                                class="w-full h-full object-cover transition-transform duration-500 group-hover/cover:scale-105" />
                                        </div>
                                    @endforeach
                                </div>

                                <div
                                    class="flex items-center gap-3 text-sm text-amber-600 dark:text-amber-500 font-bold pt-6 border-t border-gray-200 dark:border-gray-800 {{ $globalIndex % 2 == 0 ? 'justify-start' : 'md:justify-end' }}">
                                    <i class="fa-solid fa-layer-group"></i>
                                    <span>Destacado: {{ $monthData['top_game']?->title ?? 'Ninguno' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($monthData['activities'] as $item)
                    @php $globalIndex++; @endphp
                    <div
                        class="relative flex items-center w-full group {{ $globalIndex % 2 == 0 ? 'md:justify-end' : '' }}">
                        <div
                            class="absolute left-7 md:left-1/2 -translate-x-1/2 w-14 h-14 rounded-full bg-gray-50 dark:bg-[#0f1117] border-8 border-white dark:border-[#151821] shadow-inner flex items-center justify-center z-10 group-hover:scale-110 transition-transform duration-300">
                            <div class="w-4 h-4 rounded-full bg-cyan-500 shadow-lg shadow-cyan-500/50"></div>
                        </div>

                        <div
                            class="w-full md:w-1/2 pl-24 {{ $globalIndex % 2 == 0 ? 'md:pl-16' : 'md:pl-0 md:pr-16 md:text-right' }}">
                            <div
                                class="w-full bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-[2rem] p-8 md:p-10 shadow-xl dark:shadow-2xl hover:border-cyan-400 dark:hover:border-cyan-800 transition-all duration-300 hover:-translate-y-1">
                                <div
                                    class="flex flex-col {{ $globalIndex % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' }} items-center gap-8">
                                    <img src="{{ $item->game->cover_url }}"
                                        class="w-32 md:w-40 aspect-[3/4] rounded-2xl md:rounded-3xl object-cover shadow-lg shrink-0 transition-transform duration-500 hover:scale-105" />
                                    <div class="flex-1 space-y-3 w-full">
                                        <span class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">
                                            {{ $item->created_at->format('d') }}
                                        </span>
                                        <p
                                            class="text-gray-500 dark:text-gray-400 font-bold uppercase tracking-widest text-xs">
                                            {{ $item->created_at->translatedFormat('l') }}
                                        </p>
                                        <h4
                                            class="text-2xl font-black text-gray-900 dark:text-white leading-tight uppercase">
                                            {{ $item->game->title }}
                                        </h4>
                                        <div
                                            class="flex items-center gap-3 text-sm text-cyan-600 dark:text-cyan-400 font-bold pt-2 {{ $globalIndex % 2 == 0 ? 'justify-start' : 'md:justify-end' }}">
                                            <i class="fa-solid fa-clock"></i>
                                            <span>{{ $item->hours_played }}
                                                {{ Str::plural('hora', $item->hours_played) }} registradas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</x-miscomponentes.page-layout>
