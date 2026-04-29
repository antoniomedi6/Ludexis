@props([
    'gameId',
])

@auth
    <div x-data="{ openRegistry: false }" class="lg:hidden">
        {{-- BOTÓN FLOTANTE --}}
        <button type="button" @click="openRegistry = true"
            class="fixed right-4 bottom-6 z-40 flex items-center justify-center w-14 h-14 rounded-2xl bg-cyan-700 hover:bg-cyan-600 text-white shadow-lg transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500"
            aria-label="Abrir registro de partida">
            <i class="fa-solid fa-clipboard-list text-xl" aria-hidden="true"></i>
        </button>

        {{-- PANEL --}}
        <div x-show="openRegistry" x-cloak class="fixed inset-0 z-50" role="dialog" aria-modal="true"
            aria-label="Registro de partida" @keydown.escape.window="openRegistry = false">
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="openRegistry = false"
                aria-hidden="true"></div>

            <section
                class="absolute inset-0 bg-lightbox-main dark:bg-darkbox-card shadow-2xl p-4 safe-pb flex flex-col"
                @click.stop aria-label="Panel de registro de partida">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <h2 class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest">
                        Registro
                    </h2>
                    <button type="button" @click="openRegistry = false"
                        class="w-10 h-10 flex items-center justify-center rounded-xl border border-lightbox-border dark:border-darkbox-border bg-lightbox-card dark:bg-darkbox-main text-gray-600 dark:text-gray-300 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500"
                        aria-label="Cerrar panel de registro">
                        <i class="fa-solid fa-xmark text-lg" aria-hidden="true"></i>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto">
                    @livewire('utils.game-registry-card', ['gameId' => $gameId], key('game-registry-mobile-' . $gameId))
                </div>
            </section>
        </div>
    </div>
@endauth
