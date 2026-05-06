<div class="w-full relative z-50 flex justify-end md:block" x-data="{ show: false, searchOpen: false }"
    @click.away="show = false; searchOpen = false">

    {{-- BOTON TOGGLE LUPA (SOLO MOVIL) --}}
    <button type="button" @click="searchOpen = !searchOpen"
        class="md:hidden flex items-center justify-center w-10 h-10 rounded-lg text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 hover:bg-lightbox-soft dark:hover:bg-darkbox-card transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500"
        aria-label="Alternar busqueda de usuarios">
        <i class="fa-solid fa-magnifying-glass text-lg" aria-hidden="true"></i>
    </button>

    {{-- CONTENEDOR DESPLEGABLE --}}
    <div :class="searchOpen ? 'absolute top-full right-0 mt-4 w-full max-w-md z-50 block' : 'hidden md:block'"
        class="w-full z-50">

        {{-- BARRA DE BÚSQUEDA --}}
        <div
            class="relative bg-lightbox-card dark:bg-darkbox-card md:bg-transparent rounded-full shadow-2xl md:shadow-none p-1 md:p-0 border border-lightbox-border dark:border-darkbox-border md:border-transparent">
            <i class="fa-solid fa-magnifying-glass absolute left-5 md:left-4 top-1/2 -translate-y-1/2 text-lightbox-muted dark:text-gray-400 transition-colors duration-300"
                aria-hidden="true"></i>

            <label for="search-users" class="sr-only">Buscar usuarios por nombre</label>
            <input id="search-users" type="search" wire:model.live.debounce.300ms="search" @focus="show = true"
                @keydown.escape.window="show = false; searchOpen = false" placeholder="Buscar usuarios…"
                autocomplete="off" aria-autocomplete="list" aria-controls="search-users-results"
                :aria-expanded="show.toString()" x-ref="searchInput"
                x-effect="if(searchOpen) $nextTick(() => $refs.searchInput.focus())"
                class="w-full bg-lightbox-main dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border text-lightbox-text dark:text-white placeholder-gray-500 dark:placeholder-gray-400 rounded-full pl-12 pr-12 py-2.5 text-sm font-bold hover:bg-lightbox-soft dark:hover:bg-darkbox-card hover:border-cyan-400 dark:hover:border-cyan-600 focus:outline-none focus:border-cyan-500 dark:focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500 transition-colors duration-300 shadow-inner" />

            <div wire:loading wire:target="search" class="absolute right-5 md:right-4 top-1/2 -translate-y-1/2"
                aria-live="polite">
                <span class="sr-only">Buscando…</span>
                <x-icons.animate-spin class="size-5" />
            </div>
        </div>

        {{-- RESULTADOS DE BÚSQUEDA --}}
        @if (count($users) > 0)
            <div x-show="show" x-transition.opacity.duration.200ms style="display: none;" id="search-users-results"
                role="listbox" aria-label="Resultados de busqueda de usuarios"
                class="absolute left-0 right-0 top-full mt-2 bg-lightbox-card dark:bg-gray-800 border border-lightbox-border dark:border-gray-700 rounded-xl shadow-2xl overflow-hidden flex flex-col max-h-96 overflow-y-auto custom-scrollbar">

                @foreach ($users as $item)
                    <div role="option" wire:key="search-user-row-{{ $item->id }}"
                        class="flex items-center justify-between gap-2 p-3 border-b border-lightbox-border/60 dark:border-gray-700/50 last:border-0 hover:bg-lightbox-soft dark:hover:bg-gray-700 focus-within:bg-lightbox-soft dark:focus-within:bg-gray-700 transition-colors group">
                        <a href="{{ route('profile', $item->id) }}" wire:navigate
                            @click="show = false; searchOpen = false"
                            class="flex min-w-0 flex-1 items-center gap-3 text-left focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 rounded-lg -m-1 p-1">
                            <img src="{{ $item->profile_photo_url }}" alt="Avatar de {{ $item->name }}"
                                class="h-10 w-10 shrink-0 rounded-full object-cover border border-gray-200 dark:border-gray-600"
                                loading="lazy">
                            <h4 class="min-w-0 flex-1 truncate text-sm font-black text-lightbox-text dark:text-white">
                                {{ $item->name }}
                            </h4>
                        </a>
                        <div class="shrink-0" @click.stop>
                            @auth
                                @if (Auth::id() !== $item->id)
                                    @livewire('utils.follow-button', ['user' => $item, 'compact' => true], key('search-follow-' . $item->id))
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ESTADO VACIO --}}
        @elseif (strlen($search) >= 2)
            <div x-show="show" x-transition.opacity.duration.200ms style="display: none;" role="status"
                class="absolute left-0 right-0 top-full mt-2 bg-lightbox-card dark:bg-gray-800 border border-lightbox-border dark:border-gray-700 rounded-xl shadow-2xl overflow-hidden p-6 text-center">
                <i class="fa-solid fa-ghost text-3xl text-gray-600 mb-3 block" aria-hidden="true"></i>
                <span class="text-sm font-bold text-gray-500 dark:text-gray-400">
                    No se encontraron usuarios para <span class="text-cyan-500">"{{ $search }}"</span>
                </span>
            </div>
        @endif
    </div>
</div>
