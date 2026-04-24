<x-dialog-modal wire:model.live="modalOpen" max-width="6xl">
    <x-slot:title>
        <div class="flex items-center gap-4">
            <span
                class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-cyan-100 dark:bg-cyan-900/30 border border-cyan-200 dark:border-cyan-800/50 shrink-0"
                aria-hidden="true">
                <i class="fa-solid fa-comment-dots text-xl text-cyan-700 dark:text-cyan-400"></i>
            </span>
            <div class="min-w-0">
                <h2 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter uppercase leading-none">
                    Reseña
                </h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium mt-1">
                    Comparte tu experiencia para ayudar a la comunidad.
                </p>
            </div>
        </div>
    </x-slot:title>

    <x-slot:content>
        @if ($game)
            <section class="grid grid-cols-1 md:grid-cols-2 gap-8" aria-label="Formulario de reseña">
                {{-- JUEGO --}}
                <div class="flex flex-col gap-4">
                    <div
                        class="bg-gray-50 dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border rounded-2xl p-4">
                        <div class="flex items-start gap-4">
                            <img src="{{ $game->cover_url }}"
                                class="w-20 sm:w-24 aspect-[3/4] rounded-2xl shadow-md object-cover border border-gray-200 dark:border-darkbox-border shrink-0"
                                alt="Portada de {{ $game->title }}" loading="lazy" />
                            <div class="min-w-0">
                                <p class="text-[10px] font-black uppercase tracking-widest text-gray-500 dark:text-gray-400">
                                    Juego
                                </p>
                                <p class="mt-1 text-lg font-black text-gray-900 dark:text-white leading-tight break-words">
                                    {{ $game->title }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-2xl p-4">
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">
                            Recomendación
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium leading-relaxed">
                            Evita spoilers y céntrate en lo más útil: jugabilidad, historia, rendimiento y puntos fuertes/débiles.
                        </p>
                    </div>
                </div>

                {{-- RESEÑA --}}
                <div class="flex flex-col gap-3">
                    <div
                        class="bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-2xl p-4 sm:p-6">
                        <div class="mb-3">
                            <label for="review_text"
                                class="block text-sm font-black uppercase tracking-widest text-gray-700 dark:text-gray-300">
                                Tu reseña
                            </label>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 font-medium">
                                Entre 5 y 500 caracteres.
                            </p>
                        </div>

                        <x-miscomponentes.textarea id="review_text" class="h-64 md:h-72"
                            wire:model.debounce.400ms="cform.review" placeholder="¿Qué te ha parecido el juego?">
                        </x-miscomponentes.textarea>

                        <div class="mt-3">
                            <x-input-error for="cform.review" />
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </x-slot:content>

    <x-slot:footer>
        <div class="flex flex-col sm:flex-row gap-3 w-full">
            <button type="button" wire:click="$set('modalOpen', false)"
                class="flex-1 bg-gray-200 dark:bg-darkbox-main hover:bg-gray-300 dark:hover:bg-darkbox-card text-gray-800 dark:text-gray-300 font-black py-3.5 rounded-xl uppercase text-xs tracking-widest transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500">
                Cancelar
            </button>
            <button type="button" wire:click="save" wire:loading.attr="disabled"
                class="flex-1 bg-cyan-700 hover:bg-cyan-600 dark:bg-cyan-600 dark:hover:bg-cyan-500 text-white font-black py-3.5 rounded-xl uppercase text-xs tracking-widest shadow-lg transition-all active:scale-95 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                <span wire:loading.remove wire:target="save">Publicar</span>
                <span wire:loading wire:target="save" class="inline-flex items-center justify-center gap-2">
                    <x-icons.animate-spin class="size-4" />
                    Publicando...
                </span>
            </button>
        </div>
    </x-slot:footer>
</x-dialog-modal>
