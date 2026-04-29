<section class="w-full" aria-labelledby="random-game-title" x-data="{ showModal: @entangle('showModal').live, source: @entangle('selectedSource').live, listId: @entangle('selectedListId').live, minRating: @entangle('minRating').live }">

    <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
        <button aria-label="Seleccionar un juego aleatorio" @click="showModal = true"
            class="bg-gradient-to-br from-cyan-50 dark:from-cyan-900/30 to-white dark:to-gray-900 border border-cyan-200 dark:border-cyan-800/50 rounded-3xl p-6 flex flex-col justify-center items-center text-center transition-colors duration-300 hover:from-cyan-100 dark:hover:from-cyan-800/40 shadow-xl dark:shadow-[0_0_20px_rgba(6,182,212,0.1)] focus:outline-none focus:ring-2 focus:ring-cyan-500 group">
            <i class="fa-solid fa-dice text-3xl text-cyan-600 dark:text-cyan-500 mb-2 group-hover:rotate-12 transition-transform duration-300"
                aria-hidden="true"></i>
            <span
                class="text-xs font-black uppercase tracking-widest text-cyan-700 dark:text-cyan-400 transition-colors duration-300">Juego
                Aleatorio</span>
        </button>
    </div>

    {{-- MODAL --}}
    <x-modal wire:model="showModal" maxWidth="4xl">
        <div class="space-y-8">
            {{-- HEADER --}}
            <header class="text-center">
                <div class="mb-5 inline-flex h-16 w-16 items-center justify-center rounded-full bg-cyan-50 text-brand shadow-inner dark:bg-darkbox-main"
                    aria-hidden="true">
                    <i class="fa-solid fa-dice-d20 text-3xl"></i>
                </div>
                <h3 class="text-3xl font-black uppercase leading-none tracking-tight text-gray-900 dark:text-white">
                    Ruleta de juegos
                </h3>
                <p class="mx-auto mt-3 max-w-2xl text-sm font-medium leading-6 text-gray-500 dark:text-gray-400">
                    Define el origen, controla el ranking mínimo y genera una recomendación rápida.
                </p>
            </header>

            <div class="grid gap-6 lg:grid-cols-5">
                {{-- CONTROLES --}}
                <form wire:submit.prevent="pickGame" class="space-y-6 lg:col-span-2"
                    aria-label="Filtros del selector aleatorio">
                    <fieldset class="flex flex-col gap-2">
                        <legend
                            class="text-xs font-black uppercase tracking-widest mb-4 text-gray-500 dark:text-gray-400">
                            Origen
                        </legend>

                        <label class="cursor-pointer relative group">
                            <input type="radio" value="general" x-model="source"
                                @change="if (source !== 'list') listId = null" class="peer hidden">

                            <div
                                class="flex items-center gap-3 rounded-2xl border border-gray-200 bg-gray-50 p-3 text-gray-400 transition-all duration-300 peer-checked:border-cyan-500 peer-checked:bg-cyan-50 peer-checked:text-cyan-700 hover:border-cyan-300 dark:border-gray-800 dark:bg-darkbox-main dark:text-gray-500 dark:peer-checked:border-cyan-600 dark:peer-checked:bg-cyan-900/20 dark:peer-checked:text-cyan-400 dark:hover:border-cyan-700">
                                <span
                                    class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-white text-current shadow-sm transition-colors duration-300 dark:bg-darkbox-card"
                                    aria-hidden="true">
                                    <i class="fa-solid fa-globe"></i>
                                </span>
                                <span class="min-w-0">
                                    <span class="block text-sm font-black text-gray-900 dark:text-white">
                                        Catálogo completo
                                    </span>
                                    <span class="block text-xs font-bold text-gray-500 dark:text-gray-400">
                                        Sin filtrar por tu biblioteca
                                    </span>
                                </span>
                            </div>
                        </label>

                        <label class="cursor-pointer relative group">
                            <input type="radio" value="library" x-model="source"
                                @change="if (source !== 'list') listId = null" class="peer hidden">

                            <div
                                class="flex items-center gap-3 rounded-2xl border border-gray-200 bg-gray-50 p-3 text-gray-400 transition-all duration-300 peer-checked:border-cyan-500 peer-checked:bg-cyan-50 peer-checked:text-cyan-700 hover:border-cyan-300 dark:border-gray-800 dark:bg-darkbox-main dark:text-gray-500 dark:peer-checked:border-cyan-600 dark:peer-checked:bg-cyan-900/20 dark:peer-checked:text-cyan-400 dark:hover:border-cyan-700">
                                <span
                                    class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-white text-current shadow-sm transition-colors duration-300 dark:bg-darkbox-card"
                                    aria-hidden="true">
                                    <i class="fa-solid fa-book"></i>
                                </span>
                                <span class="min-w-0">
                                    <span class="block text-sm font-black text-gray-900 dark:text-white">
                                        Mi biblioteca
                                    </span>
                                    <span class="block text-xs font-bold text-gray-500 dark:text-gray-400">
                                        Solo tus juegos registrados
                                    </span>
                                </span>
                            </div>
                        </label>

                        <label class="cursor-pointer relative group">
                            <input type="radio" value="list" x-model="source" class="peer hidden">

                            <div
                                class="flex items-center gap-3 rounded-2xl border border-gray-200 bg-gray-50 p-3 text-gray-400 transition-all duration-300 peer-checked:border-cyan-500 peer-checked:bg-cyan-50 peer-checked:text-cyan-700 hover:border-cyan-300 dark:border-gray-800 dark:bg-darkbox-main dark:text-gray-500 dark:peer-checked:border-cyan-600 dark:peer-checked:bg-cyan-900/20 dark:peer-checked:text-cyan-400 dark:hover:border-cyan-700">
                                <span
                                    class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-white text-current shadow-sm transition-colors duration-300 dark:bg-darkbox-card"
                                    aria-hidden="true">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <span class="min-w-0">
                                    <span class="block text-sm font-black text-gray-900 dark:text-white">
                                        Una lista
                                    </span>
                                    <span class="block text-xs font-bold text-gray-500 dark:text-gray-400">
                                        Elige una colección concreta
                                    </span>
                                </span>
                            </div>
                        </label>
                    </fieldset>

                    <div class="space-y-2" x-show="source === 'list'" x-transition x-cloak>
                        <label for="random-list"
                            class="block text-xs font-black uppercase tracking-widest text-gray-500 dark:text-gray-400">
                            Lista
                        </label>
                        <select id="random-list" x-model="listId"
                            class="w-full cursor-pointer rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-bold text-gray-900 shadow-sm transition-colors focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:border-darkbox-border dark:bg-darkbox-main dark:text-white">
                            <option :value="null">Selecciona una lista</option>
                            @foreach ($userLists as $list)
                                <option :value="{{ $list->id }}">
                                    {{ $list->name }} · {{ $list->games_count }} juegos
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between gap-4">
                            <label for="random-rating"
                                class="text-xs font-black uppercase tracking-widest text-gray-500 dark:text-gray-400">
                                Ranking mínimo
                            </label>
                            <output for="random-rating"
                                class="rounded-full bg-cyan-50 px-3 py-1 text-sm font-black text-brand dark:bg-darkbox-main"
                                x-text="minRating + '/100'">
                                {{ $minRating }}/100
                            </output>
                        </div>
                        <input id="random-rating" type="range" min="0" max="100" step="5"
                            x-model="minRating"
                            class="h-2 w-full cursor-pointer appearance-none rounded-lg bg-gray-200 accent-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:bg-darkbox-border">
                        <div class="flex justify-between text-xs font-black uppercase tracking-widest text-gray-400"
                            aria-hidden="true">
                            <span>0</span>
                            <span>100</span>
                        </div>
                    </div>

                    <button type="submit" wire:loading.attr="disabled" wire:target="pickGame"
                        class="flex w-full items-center justify-center gap-3 rounded-xl bg-cyan-700 py-3.5 text-xs font-black uppercase tracking-widest text-white shadow-lg transition-all active:scale-95 hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-cyan-600 dark:hover:bg-cyan-500"
                        :disabled="source === 'list' && !listId">
                        <span wire:loading.remove wire:target="pickGame"
                            class="inline-flex items-center justify-center gap-2">
                            <i class="fa-solid fa-shuffle" aria-hidden="true"></i>
                            Dame un juego
                        </span>
                        <span wire:loading wire:target="pickGame" class="inline-flex items-center justify-center gap-2">
                            <x-icons.animate-spin class="size-4" />
                            Buscando...
                        </span>
                    </button>
                </form>

                {{-- RESULTADO --}}
                <section class="lg:col-span-3" aria-live="polite">
                    @if ($randomGame)
                        <article
                            class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm transition-colors duration-300 dark:border-darkbox-border dark:bg-darkbox-card">
                            <div class="grid gap-0 md:grid-cols-5">
                                <div
                                    class="relative min-h-72 overflow-hidden bg-gray-100 dark:bg-darkbox-main md:col-span-2">
                                    <img src="{{ $randomGame->cover_url }}" alt="Portada de {{ $randomGame->title }}"
                                        class="h-full w-full object-cover" loading="lazy">
                                    <div class="absolute left-4 top-4 rounded-lg bg-gray-900/90 px-2.5 py-1.5 text-xs font-black text-cyan-400 shadow-lg"
                                        aria-label="Nota Ludexis {{ round($randomGame->rating) }} sobre 100">
                                        {{ round($randomGame->rating) }}
                                        <i class="fa-solid fa-star text-[10px]" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <div class="flex flex-col justify-center p-5 md:col-span-3 md:p-6">
                                    <span class="mb-2 text-[10px] font-black uppercase tracking-widest text-brand">
                                        Recomendado
                                    </span>
                                    <h4
                                        class="text-xl font-black leading-tight text-gray-900 dark:text-white sm:text-2xl">
                                        {{ $randomGame->title }}
                                    </h4>

                                    <dl class="mt-4 flex flex-wrap gap-2">
                                        <div class="rounded-xl bg-gray-50 px-3 py-2 dark:bg-darkbox-main">
                                            <dt class="text-[10px] font-black uppercase tracking-widest text-gray-400">
                                                Ranking</dt>
                                            <dd class="mt-0.5 text-sm font-black text-gray-900 dark:text-white">
                                                {{ round($randomGame->rating) }}/100
                                            </dd>
                                        </div>
                                        <div class="rounded-xl bg-gray-50 px-3 py-2 dark:bg-darkbox-main">
                                            <dt class="text-[10px] font-black uppercase tracking-widest text-gray-400">
                                                Duración</dt>
                                            <dd class="mt-0.5 text-sm font-black text-gray-900 dark:text-white">
                                                {{ $randomGame->avg_time ? $randomGame->avg_time . ' h' : 'N/D' }}
                                            </dd>
                                        </div>
                                    </dl>

                                    <div class="mt-5 flex gap-2 w-full">
                                        <button type="button" wire:click="pickGame"
                                            class="flex-1 bg-gray-200 dark:bg-darkbox-main hover:bg-gray-300 dark:hover:bg-darkbox-card text-gray-800 dark:text-gray-300 font-black py-3 rounded-xl uppercase text-xs tracking-widest transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 whitespace-nowrap flex items-center justify-center gap-2">
                                            <i class="fa-solid fa-rotate" aria-hidden="true"></i>
                                            Repetir
                                        </button>
                                        <a href="{{ route('games.show', $randomGame->slug) }}" wire:navigate
                                            class="flex-1 bg-cyan-700 hover:bg-cyan-600 dark:bg-cyan-600 dark:hover:bg-cyan-500 text-white font-black py-3 rounded-xl uppercase text-xs tracking-widest shadow-lg transition-all active:scale-95 focus:outline-none focus:ring-2 focus:ring-cyan-500 whitespace-nowrap flex items-center justify-center gap-2">
                                            Ficha
                                            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @else
                        <div
                            class="flex min-h-96 flex-col items-center justify-center rounded-3xl border-2 border-dashed border-gray-200 bg-gray-50 p-8 text-center transition-colors duration-300 dark:border-darkbox-border dark:bg-darkbox-main">
                            <div class="mb-5 flex h-20 w-20 items-center justify-center rounded-full bg-white text-brand shadow-sm dark:bg-darkbox-card"
                                aria-hidden="true">
                                <i class="fa-solid fa-gamepad text-3xl"></i>
                            </div>
                            <h4 class="text-2xl font-black text-gray-900 dark:text-white">
                                Todavía no hay tirada
                            </h4>
                            <p class="mt-3 max-w-md text-sm font-medium leading-6 text-gray-500 dark:text-gray-400">
                                Ajusta el origen y el ranking mínimo. El resultado aparecerá aquí con su portada,
                                nota y acceso directo a la ficha.
                            </p>
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </x-modal>
</section>
