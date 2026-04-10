<x-miscomponentes.page-layout title1="Lista -" :title2="$list->name" :full-width="false">

    <x-slot name="subtitle">
        <span class="text-gray-500 dark:text-gray-400 font-bold uppercase tracking-widest text-[10px]">
            Actualizada {{ $list->updated_at->diffForHumans() }}
        </span>
    </x-slot>

    <x-slot name="aside">
        <div class="flex items-center gap-3 w-full justify-end">
            <a href="{{ route('userLists') }}" wire:navigate
                class="bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white font-black px-4 py-3 rounded-xl transition-all duration-300 hover:border-cyan-500 flex items-center justify-center gap-2 text-sm shadow-sm">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>

            <button
                class="bg-cyan-600 hover:bg-cyan-500 text-white font-black px-6 py-3 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(6,182,212,0.2)] dark:shadow-[0_5px_15px_rgba(6,182,212,0.3)] uppercase tracking-wider text-sm flex items-center justify-center gap-2 hover:-translate-y-1">
                <i class="fa-solid fa-pen"></i> Editar
            </button>

            <button
                class="bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white font-black w-12 h-12 rounded-xl transition-all duration-300 flex items-center justify-center text-sm border border-transparent hover:border-red-600">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
    </x-slot>

    <div
        class="absolute top-0 right-0 w-full max-w-3xl h-[600px] bg-cyan-200/20 dark:bg-cyan-900/10 rounded-full blur-[120px] pointer-events-none z-0">
    </div>

    <div
        class="relative z-10 w-full mb-12 flex flex-col md:flex-row items-center justify-between bg-white dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 rounded-[2rem] p-8 shadow-lg gap-6">
        <div class="flex items-center gap-6">
            <div
                class="w-20 h-20 rounded-2xl bg-cyan-100 dark:bg-cyan-900/30 flex items-center justify-center shrink-0 border border-cyan-200 dark:border-cyan-800">
                <i class="fa-solid fa-layer-group text-3xl text-cyan-600 dark:text-cyan-400"></i>
            </div>
            <div>
                <h2
                    class="text-3xl md:text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight leading-none mb-2">
                    {{ $list->name }}
                </h2>
                <div class="flex items-center gap-4">
                    <span
                        class="text-xs font-black text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-[#1a1d27] px-3 py-1.5 rounded-lg border border-gray-200 dark:border-gray-800">
                        {{ $list->games_count }} Juegos
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10 w-full relative overflow-hidden min-h-[400px]">
        @if ($list->games_count > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-6 md:gap-8">
                @foreach ($list->games as $item)
                    <div
                        class="relative group aspect-[3/4] rounded-[2rem] overflow-hidden bg-gray-100 dark:bg-[#151821] border border-gray-200 dark:border-gray-800 cursor-pointer shadow-sm hover:shadow-xl transition-all duration-500">

                        <img src="{{ $item->cover_url }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                            loading="lazy" />

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-gray-900/95 via-gray-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>

                        <button
                            class="absolute top-4 right-4 w-8 h-8 rounded-full bg-red-500/90 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 hover:scale-110 hover:bg-red-600 z-20 shadow-lg translate-y-2 group-hover:translate-y-0 backdrop-blur-sm">
                            <i class="fa-solid fa-xmark"></i>
                        </button>

                        <div
                            class="absolute inset-0 flex flex-col justify-end p-5 md:p-6 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-4 group-hover:translate-y-0 z-10">
                            <h3 class="font-black text-white text-lg md:text-xl leading-tight mb-2 drop-shadow-md">
                                {{ $item->title }}
                            </h3>

                            @if ($item->rating)
                                <span
                                    class="bg-gray-900/90 text-cyan-400 font-black text-sm px-3 py-1.5 rounded-lg border border-gray-700 inline-flex items-center gap-1 shadow-lg w-max backdrop-blur-sm">
                                    {{ round($item->rating) }} <i class="fa-solid fa-star text-[10px]"></i>
                                </span>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div
                class="flex flex-col items-center justify-center py-24 px-6 border-2 border-dashed border-gray-300 dark:border-gray-800 rounded-[2rem] bg-white/50 dark:bg-[#151821]/50 transition-colors">
                <div
                    class="mb-6 bg-gray-100 dark:bg-gray-800/50 w-24 h-24 flex items-center justify-center rounded-full border border-gray-200 transition-colors shadow-sm">
                    <i class="fa-solid fa-ghost text-4xl text-gray-400 transition-colors"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-3">Lista Vacía</h3>
                <p class="text-gray-600 dark:text-gray-500 text-sm font-medium text-center max-w-md mb-8">
                    Aún no has añadido ningún juego a esta colección.
                </p>
                <a href="{{ route('allGames') }}" wire:navigate
                    class="bg-cyan-600 hover:bg-cyan-500 text-white font-black px-6 py-3 rounded-xl text-xs uppercase tracking-widest transition-all shadow-[0_5px_15px_rgba(6,182,212,0.2)] hover:-translate-y-1 flex items-center gap-2">
                    <i class="fa-solid fa-compass"></i> Explorar Catálogo
                </a>
            </div>
        @endif
    </div>

</x-miscomponentes.page-layout>
