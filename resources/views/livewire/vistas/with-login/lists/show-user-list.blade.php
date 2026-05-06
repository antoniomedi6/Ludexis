<x-miscomponentes.page-layout title1="Lista -" :title2="$list->name" :full-width="false">

    <x-slot name="subtitle">
        <span class="text-gray-500 dark:text-gray-400 font-bold uppercase tracking-widest text-[10px]">
            Actualizada {{ $list->updated_at->diffForHumans() }}
        </span>
    </x-slot>

    <x-slot name="aside">
        <div class="flex items-center gap-3 w-full justify-end">
            <a href="{{ back()->getTargetUrl() }}" wire:navigate
                class="bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white font-black px-4 py-3 rounded-xl transition-all duration-300 hover:border-cyan-500 flex items-center justify-center gap-2 text-sm shadow-sm">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>
            @if (Auth::id() === $list->user_id)
                <button wire:click="openModal"
                    class="bg-cyan-600 hover:bg-cyan-500 text-white font-black px-6 py-3 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(6,182,212,0.2)] dark:shadow-[0_5px_15px_rgba(6,182,212,0.3)] uppercase tracking-wider text-sm flex items-center justify-center gap-2 hover:-translate-y-1">
                    <i class="fa-solid fa-pen"></i> Editar
                </button>

                <button wire:click="$set('confirmingListDeletion', true)"
                    class="bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white font-black w-12 h-12 rounded-xl transition-all duration-300 flex items-center justify-center text-sm border border-transparent hover:border-red-600">
                    <i class="fa-solid fa-trash"></i>
                </button>
            @endif
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
                    class="text-xl md:text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight leading-none mb-2">
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

    <div class="relative z-10 w-full overflow-hidden min-h-[400px]">
        @if ($list->games_count > 0)

            <div class="grid grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-2 md:gap-6 w-full">
                @foreach ($list->games as $item)
                    @php
                        // Obteniendo el registro del usuario para este juego si lo hay
                        $userRegister = $userRegisters->firstWhere('game_id', $item->id);

                        $status = $userRegister->status ?? 'pending';
                        $rating = $userRegister->rating ?? 0;
                        $hours = $userRegister->hours_finish ?? 0;

                        $isAbandoned = $status === 'abandoned';
                        $isPending = $status === 'pending';
                    @endphp

                    <div class="relative group">

                        {{-- CARD ENLACE --}}
                        <a href="{{ route('games.show', $item->slug) }}"
                            class="group bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl dark:shadow-none hover:border-cyan-300 dark:hover:border-cyan-500/50 transition-all duration-500 flex flex-col {{ $isAbandoned || $isPending ? 'opacity-80 hover:opacity-100' : '' }}">

                            {{-- IMAGEN Y OVERLAYS --}}
                            <div
                                class="relative aspect-[4/3] w-full overflow-hidden shrink-0 border-b border-gray-200 dark:border-gray-800">
                                <img src="{{ $item->cover_url }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 {{ $isAbandoned ? 'filter grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100' : '' }}"
                                    loading="lazy" />

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-gray-900/90 to-transparent opacity-80">
                                </div>

                                {{-- BADGES ESTADO --}}
                                <div class="absolute top-2 left-2 md:top-4 md:left-4 z-10">
                                    @if ($status === 'finish')
                                        <span
                                            class="bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 border border-green-200 dark:border-green-800/50 px-2 md:px-3 py-1 md:py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                            <i class="fa-solid fa-flag-checkered"></i> <span
                                                class="hidden md:inline">Finalizado</span>
                                        </span>
                                    @elseif ($status === 'completed')
                                        <span
                                            class="bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 border border-purple-200 dark:border-purple-800/50 px-2 md:px-3 py-1 md:py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                            <x-icons.completed class="size-4 md:size-6" /> <span
                                                class="hidden md:inline">100%</span>
                                        </span>
                                    @elseif ($status === 'playing')
                                        <span
                                            class="bg-cyan-50 dark:bg-cyan-900/30 text-cyan-600 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50 px-2 md:px-3 py-1 md:py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                            <x-icons.playing class="size-4 md:size-6" /> <span
                                                class="hidden md:inline">Jugando</span>
                                        </span>
                                    @elseif ($status === 'abandoned')
                                        <span
                                            class="bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800/50 px-2 md:px-3 py-1 md:py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                            <x-icons.abandoned class="size-4 md:size-6" /> <span
                                                class="hidden md:inline">Abandonado</span>
                                        </span>
                                    @elseif ($status === 'pending')
                                        <span
                                            class="bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800/50 px-2 md:px-3 py-1 md:py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                            <x-icons.pending class="size-4 md:size-6" /> <span
                                                class="hidden md:inline">Pendiente</span>
                                        </span>
                                    @elseif ($status === 'paused')
                                        <span
                                            class="bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800/50 px-2 md:px-3 py-1 md:py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                            <x-icons.paused class="size-4 md:size-6" /> <span
                                                class="hidden md:inline">En Pausa</span>
                                        </span>
                                    @elseif ($status === 'multiplayer')
                                        <span
                                            class="bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800/50 px-2 md:px-3 py-1 md:py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                                            <x-icons.multiplayer class="size-4 md:size-6" /> <span
                                                class="hidden md:inline">Multiplayer</span>
                                        </span>
                                    @endif
                                </div>

                                {{-- VALORACION Y PLATAFORMA --}}
                                <div
                                    class="absolute bottom-2 left-2 right-2 md:bottom-4 md:left-4 md:right-4 flex justify-between items-end z-10">
                                    <x-miscomponentes.star-rating :value10="$rating"
                                        class="text-cyan-500 dark:text-cyan-400 drop-shadow-md" />
                                    {{--          
                                    <span
                                        class="bg-white/90 dark:bg-[#1a1d27]/90 backdrop-blur-md text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider shadow-sm transition-colors duration-300">
                                        PC
                                    </span>
                                    --}}
                                </div>
                            </div>

                            {{-- INFO JUEGO --}}
                            <div class="p-2 md:p-6 flex-1 flex flex-col justify-center text-center sm:text-left">
                                <h3
                                    class="text-xs md:text-xl font-black text-gray-900 dark:text-white leading-tight mb-1 md:mb-2 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300 line-clamp-2">
                                    {{ $item->title }}
                                </h3>
                                <p
                                    class="text-[10px] md:text-xs font-bold uppercase tracking-wider flex items-center justify-center sm:justify-start gap-1 md:gap-1.5 transition-colors duration-300
                                    {{ $status === 'finish' || $status === 'completed' ? 'text-green-600 dark:text-green-500' : '' }}
                                    {{ $status === 'playing' ? 'text-cyan-600 dark:text-cyan-500' : '' }}
                                    {{ $status === 'abandoned' ? 'text-red-600 dark:text-red-500' : '' }}
                                    {{ $status === 'pending' || $status === 'paused' ? 'text-yellow-600 dark:text-yellow-500' : '' }}
                                    {{ $status === 'multiplayer' ? 'text-blue-600 dark:text-blue-500' : '' }}">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $hours }} h<span class="hidden md:inline">rs jugadas</span>
                                </p>
                            </div>
                        </a>
                        @if (Auth::id() === $list->user_id)
                            {{-- BOTON BORRAR --}}
                            <button wire:click.prevent="deleteGameFromList({{ $item->id }})"
                                class="absolute top-4 right-4 w-8 h-8 rounded-full bg-red-500/90 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 hover:scale-110 hover:bg-red-600 z-30 shadow-lg translate-y-2 group-hover:translate-y-0 backdrop-blur-sm">
                                <x-icons.exit />
                            </button>
                        @endif
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

    <x-modal wire:model="showUpdateModal" maxWidth="md">

        <div class="text-center mb-8">
            <div
                class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-cyan-100 dark:bg-cyan-900/30 mb-5 shadow-inner">
                <i class="fa-solid fa-folder-plus text-3xl text-cyan-600 dark:text-cyan-400"></i>
            </div>
            <h3 class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight leading-none mb-2">
                Editar Colección
            </h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium px-4">
                Cambiar nombre de la colección.
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
                    <input type="text" id="cname" wire:model="uform.name" required
                        class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-800 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-cyan-500/50 focus:border-cyan-500 transition-all duration-300 shadow-sm"
                        placeholder="Ej: Joyas Ocultas, Backlog 2026..." autocomplete="off">
                </div>
                @error('uform.name')
                    <span class="text-red-500 dark:text-red-400 text-xs font-bold pl-1">{{ $message }}</span>
                @enderror
            </div>

            <div
                class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3 pt-6 border-t border-gray-100 dark:border-gray-800/80">
                <button type="button" wire:click="cancel"
                    class="w-full sm:w-auto px-6 py-3.5 rounded-xl text-sm font-bold text-gray-500 dark:text-gray-400 hover:bg-lightbox-soft dark:hover:bg-darkbox-main hover:text-gray-900 dark:hover:text-white transition-all duration-300 uppercase tracking-wider">
                    Cancelar
                </button>
                <button type="submit"
                    class="w-full sm:w-auto bg-cyan-600 hover:bg-cyan-500 text-white font-black px-8 py-3.5 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(6,182,212,0.2)] dark:shadow-[0_5px_15px_rgba(6,182,212,0.3)] uppercase tracking-wider text-sm hover:-translate-y-1">
                    Editar Lista
                </button>
            </div>
        </form>

    </x-modal>

    <x-confirmation-modal wire:model="confirmingListDeletion" maxWidth="md">
        <x-slot name="title">
            Eliminar Colección
        </x-slot>

        <x-slot name="content">
            ¿Estás seguro de que deseas eliminar la colección <strong>{{ $list->name }}</strong>?
            Esta acción borrará la lista permanentemente, pero los juegos en su interior seguirán en tu registro
            principal. Esta acción no se puede deshacer.
        </x-slot>

        <x-slot name="footer">
            <button type="button" wire:click="$set('confirmingListDeletion', false)"
                class="w-full sm:w-auto px-6 py-3.5 rounded-xl text-sm font-bold text-gray-500 dark:text-gray-400 hover:bg-lightbox-soft dark:hover:bg-darkbox-main hover:text-gray-900 dark:hover:text-white transition-all duration-300 uppercase tracking-wider">
                Cancelar
            </button>
            <button type="button" wire:click="deleteList"
                class="w-full sm:w-auto bg-red-600 hover:bg-red-500 text-white font-black px-8 py-3.5 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(220,38,38,0.2)] uppercase tracking-wider text-sm hover:-translate-y-1">
                Eliminar
            </button>
        </x-slot>
    </x-confirmation-modal>

</x-miscomponentes.page-layout>
