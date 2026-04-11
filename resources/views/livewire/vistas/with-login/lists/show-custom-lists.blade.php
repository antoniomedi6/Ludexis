<x-miscomponentes.page-layout title1="Mis" title2="Listas" :full-width="false">

    <x-slot name="subtitle">
        <span class="text-gray-500 dark:text-gray-400 font-bold uppercase tracking-widest text-[10px]">
            {{ $userLists->total() }} Colecciones Creadas
        </span>
    </x-slot>

    <x-slot name="aside">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 w-full">
            <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
                <div class="relative w-full sm:w-64">
                    <i
                        class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar colección..."
                        class="w-full bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white text-sm rounded-xl pl-10 pr-4 py-3 font-bold transition-colors shadow-sm focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500">
                </div>

                <div class="relative group w-full sm:w-48">
                    <i class="fa-solid fa-sort absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <select wire:model.live="orderBy"
                        class="bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white text-sm rounded-xl pl-10 pr-10 py-3 font-bold appearance-none cursor-pointer w-full transition-colors shadow-sm focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500">
                        <option value="updated_at">Más recientes</option>
                        <option value="name">Alfabético</option>
                        <option value="games_count">Cantidad</option>
                    </select>
                    <i
                        class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none"></i>
                </div>
            </div>

            <button @click="$wire.set('showCreateModal', true)"
                class="bg-cyan-600 hover:bg-cyan-500 text-white font-black px-6 py-3 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(6,182,212,0.2)] dark:shadow-[0_5px_15px_rgba(6,182,212,0.3)] uppercase tracking-wider text-sm flex items-center justify-center gap-3 hover:-translate-y-1 shrink-0 w-full sm:w-auto">
                <i class="fa-solid fa-folder-plus text-lg"></i>
                Nueva Colección
            </button>
        </div>
    </x-slot>

    {{-- MODAL PARA CREAR LISTA --}}

    <x-modal wire:model="showCreateModal" maxWidth="md">

        <div class="text-center mb-8">
            <div
                class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-cyan-100 dark:bg-cyan-900/30 mb-5 shadow-inner">
                <i class="fa-solid fa-folder-plus text-3xl text-cyan-600 dark:text-cyan-400"></i>
            </div>
            <h3 class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight leading-none mb-2">
                Nueva Colección
            </h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium px-4">
                Dale un nombre a tu lista para empezar a organizar tu biblioteca.
            </p>
        </div>

        <form wire:submit.prevent="save" class="space-y-6">

            <div class="space-y-2">
                <label for="listName"
                    class="block text-xs font-bold text-gray-700 dark:text-gray-400 uppercase tracking-widest pl-1">
                    Nombre de la lista <span class="text-cyan-500">*</span>
                </label>
                <div class="relative group">
                    <div
                        class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors duration-300 group-focus-within:text-cyan-500">
                        <i class="fa-solid fa-pen text-gray-400 group-focus-within:text-cyan-500 transition-colors"></i>
                    </div>
                    <input type="text" id="cname" wire:model="cForm.name" required
                        class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500 transition-all duration-300 shadow-sm"
                        placeholder="Ej: Joyas Ocultas, Backlog 2026..." autocomplete="off">
                </div>
                @error('cForm.name')
                    <span class="text-red-500 dark:text-red-400 text-xs font-bold pl-1">{{ $message }}</span>
                @enderror
            </div>

            <div
                class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3 pt-6 border-t border-gray-100 dark:border-gray-800/80">
                <button type="button" wire:click="cancel"
                    class="w-full sm:w-auto px-6 py-3.5 rounded-xl text-sm font-bold text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-[#1a1d27] hover:text-gray-900 dark:hover:text-white transition-all duration-300 uppercase tracking-wider">
                    Cancelar
                </button>
                <button type="submit"
                    class="w-full sm:w-auto bg-cyan-600 hover:bg-cyan-500 text-white font-black px-8 py-3.5 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(6,182,212,0.2)] dark:shadow-[0_5px_15px_rgba(6,182,212,0.3)] uppercase tracking-wider text-sm hover:-translate-y-1">
                    Crear Lista
                </button>
            </div>
        </form>

    </x-modal>

    <div
        class="absolute top-0 right-0 w-full max-w-3xl h-[600px] bg-cyan-200/20 dark:bg-cyan-900/10 rounded-full blur-[120px] pointer-events-none z-0">
    </div>

    <div class="relative z-10 w-full relative overflow-hidden min-h-[500px]">
        @if ($userLists->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                @foreach ($userLists as $list)
                    <a href="{{ route('userLists.show', $list->id) }}" wire:navigate
                        class="bg-white dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden hover:border-cyan-400 dark:hover:border-cyan-800 transition-all duration-300 group cursor-pointer flex flex-col shadow-sm hover:shadow-xl hover:-translate-y-1 block">

                        <div
                            class="h-40 w-full bg-gray-100 dark:bg-[#1a1d27] relative overflow-hidden flex items-center justify-center p-4">
                            <div
                                class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]">
                            </div>

                            @if ($list->games_count > 0)
                                <div class="relative flex items-center justify-center w-full h-full">
                                    @php
                                        $covers = $list->games->take(3)->pluck('cover_url');
                                    @endphp

                                    @if (isset($covers[1]))
                                        <img src="{{ $covers[1] }}"
                                            class="absolute w-20 aspect-[3/4] rounded-lg object-cover shadow-lg -translate-x-12 opacity-60 rotate-[-10deg] group-hover:-translate-x-14 transition-transform duration-300">
                                    @endif

                                    @if (isset($covers[2]))
                                        <img src="{{ $covers[2] }}"
                                            class="absolute w-20 aspect-[3/4] rounded-lg object-cover shadow-lg translate-x-12 opacity-60 rotate-[10deg] group-hover:translate-x-14 transition-transform duration-300">
                                    @endif

                                    @if (isset($covers[0]))
                                        <img src="{{ $covers[0] }}"
                                            class="relative z-10 w-24 aspect-[3/4] rounded-lg object-cover shadow-xl border border-gray-700 group-hover:scale-105 transition-transform duration-300">
                                    @endif
                                </div>
                            @else
                                <div
                                    class="w-16 h-16 rounded-full bg-gray-200 dark:bg-gray-800 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <i
                                        class="fa-solid fa-ghost text-2xl text-gray-400 dark:text-gray-600 group-hover:text-cyan-500 transition-colors"></i>
                                </div>
                            @endif
                        </div>

                        <div class="p-5 flex-1 flex flex-col border-t border-gray-100 dark:border-gray-800">
                            <h3
                                class="text-xl font-black text-gray-900 dark:text-white uppercase tracking-tight line-clamp-1 group-hover:text-cyan-500 transition-colors mb-1">
                                {{ $list->name }}
                            </h3>

                            <div class="flex items-center justify-between mt-auto pt-4">
                                <div class="flex items-center gap-2">
                                    @if ($list->games_count > 0)
                                        <span
                                            class="text-xs font-black text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 px-2.5 py-1 rounded-md">
                                            {{ $list->games_count }} <i
                                                class="fa-solid fa-gamepad ml-1 text-[10px]"></i>
                                        </span>
                                    @else
                                        <span class="text-xs font-black text-gray-400 dark:text-gray-500 px-1 py-1">
                                            Lista vacía
                                        </span>
                                    @endif
                                </div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400">
                                    {{ \Carbon\Carbon::parse($list->updated_at)->translatedFormat('d M') }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach

                <div @click="$wire.set('showCreateModal', true)"
                    class="border-2 border-dashed border-gray-300 dark:border-gray-800 rounded-2xl p-6 hover:border-cyan-400 dark:hover:border-cyan-800 hover:bg-cyan-50 dark:hover:bg-cyan-900/10 transition-all duration-300 cursor-pointer flex flex-col items-center justify-center min-h-[260px] group shadow-sm">
                    <div
                        class="w-14 h-14 rounded-full bg-gray-100 dark:bg-[#1a1d27] flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-cyan-100 dark:group-hover:bg-cyan-900/30 transition-all duration-300">
                        <i
                            class="fa-solid fa-folder-plus text-xl text-gray-400 dark:text-gray-500 group-hover:text-cyan-500 transition-colors"></i>
                    </div>
                    <h3
                        class="text-lg font-black text-gray-600 dark:text-gray-400 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors uppercase">
                        Nueva Lista
                    </h3>
                </div>

            </div>

            <div class="mt-8">
                {{ $userLists->links() }}
            </div>
        @else
            <div
                class="flex flex-col items-center justify-center py-32 px-6 border-2 border-dashed border-gray-300 dark:border-gray-800 rounded-[2rem] bg-white/50 dark:bg-[#151821]/50 transition-colors">
                <div
                    class="mb-6 bg-gray-100 dark:bg-gray-800/50 w-24 h-24 flex items-center justify-center rounded-full border border-gray-200 transition-colors shadow-sm">
                    <i class="fa-solid fa-magnifying-glass text-4xl text-gray-400 transition-colors"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-3">No hay resultados</h3>
                <p class="text-gray-600 dark:text-gray-500 text-sm font-medium text-center max-w-md">No hemos encontrado
                    ninguna colección que coincida con tu búsqueda.</p>
                <button @click="$wire.set('search', '')"
                    class="mt-8 bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-700 text-cyan-600 font-black px-6 py-3 rounded-xl text-xs uppercase tracking-widest transition-all shadow-sm hover:shadow-md hover:-translate-y-1 flex items-center gap-2">
                    <i class="fa-solid fa-rotate-right"></i> Limpiar Búsqueda
                </button>
            </div>
        @endif

        <x-miscomponentes.loading-spinner variant="modal" wire:target="search, orderBy">
            Actualizando listas...
        </x-miscomponentes.loading-spinner>
    </div>
</x-miscomponentes.page-layout>
