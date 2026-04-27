<div>
    {{-- CONTENEDOR PRINCIPAL --}}
    <div x-data="{ show: @entangle('showModal') }" x-show="show" style="display: none;" @keydown.escape.window="$wire.closeModal()"
        class="fixed inset-0 z-[100] overflow-y-auto" aria-modal="true" role="dialog">

        {{-- Overlay --}}
        <div x-show="show" x-transition.opacity class="fixed inset-0 bg-gray-950/90 backdrop-blur-sm cursor-pointer"
            @click="$wire.closeModal()"></div>

        <div class="flex min-h-full items-center justify-center p-4 sm:p-6 lg:p-12">

            {{-- Caja de la Modal --}}
            <div x-show="show" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                class="relative w-full max-w-7xl mx-auto bg-gray-100 dark:bg-[#151821] rounded-2xl md:rounded-[2rem] shadow-2xl overflow-hidden z-10 flex flex-col md:flex-row max-h-none md:max-h-[90vh]"
                @click.stop>

                {{-- Botón Cerrar (Móvil) --}}
                <button @click="$wire.closeModal()"
                    class="md:hidden absolute top-4 right-4 z-50 text-white bg-black/50 w-8 h-8 flex items-center justify-center rounded-full backdrop-blur-md">
                    <i class="fa-solid fa-xmark"></i>
                </button>

                @if ($image)
                    {{-- COLUMNA IZQUIERDA (IMAGEN) --}}
                    <div
                        class="w-full md:w-2/3 lg:w-[70%] bg-black flex items-center justify-center relative h-[45vh] md:h-auto md:min-h-[80vh] shrink-0">
                        <img src="{{ Storage::url($image->image_path) }}"
                            alt="Captura subida por {{ $image->user->name }}"
                            class="w-full h-full object-contain max-h-[80vh]" />
                    </div>

                    {{-- COLUMNA DERECHA (INFORMACIÓN) --}}
                    <div
                        class="w-full md:w-1/3 lg:w-[30%] flex flex-col flex-1 min-h-0 bg-white dark:bg-[#151821] border-l border-gray-200 dark:border-gray-800">

                        {{-- HEADER --}}
                        <div
                            class="p-4 pr-12 md:pr-6 md:p-6 border-b border-gray-100 dark:border-gray-800 shrink-0 bg-gray-50/50 dark:bg-[#11131a]">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-center gap-3 min-w-0">
                                    <a href="{{ route('profile', $image->user) }}" class="shrink-0">
                                        <img src="{{ $image->user->profile_photo_url }}" alt="{{ $image->user->name }}"
                                            class="w-10 h-10 rounded-full border border-gray-300 dark:border-gray-700 shadow-sm transition-transform hover:scale-105">
                                    </a>
                                    <div class="flex flex-col justify-center min-w-0">
                                        <div class="flex items-center gap-3 min-w-0">
                                            <a href="{{ route('profile', $image->user) }}"
                                                class="font-black text-sm text-gray-900 dark:text-white leading-tight hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">
                                                {{ $image->user->name }}
                                            </a>
                                        </div>
                                        <time
                                            class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-0.5">
                                            {{ $image->created_at->diffForHumans() }}
                                        </time>
                                    </div>
                                </div>

                                {{-- Botón Cerrar (Escritorio) --}}
                                <button @click="$wire.closeModal()"
                                    class="hidden md:flex w-8 h-8 items-center justify-center rounded-full text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500 shrink-0">
                                    <i class="fa-solid fa-xmark text-lg"></i>
                                </button>
                            </div>

                            {{-- BODY (SCROLLABLE) --}}
                            <div
                                class="p-4 md:p-6 flex-1 overflow-y-auto custom-scrollbar flex flex-col gap-6 md:gap-8 pb-8 md:pb-6">

                                {{-- ACCIONES --}}
                                <div class="flex flex-wrap items-center gap-2">
                                    @if (Auth::id() === $image->user_id)
                                        @livewire('utils.image-owner-actions', ['image' => $image], key('image-owner-actions-detail-' . $image->id))
                                    @endif

                                    <div class="scale-90 origin-left">
                                        @livewire('utils.like-button', ['model' => $image], key('like-detail-' . $image->id))
                                    </div>

                                    <div class="scale-90 origin-left">
                                        @livewire('utils.report-button', ['model' => $image], key('report-detail-' . $image->id))
                                    </div>
                                </div>

                                {{-- INFO DEL JUEGO --}}
                                @if ($image->game)
                                    <div>
                                        <div
                                            class="flex items-center gap-2 mb-4 border-b border-gray-100 dark:border-gray-800 pb-2">
                                            <i class="fa-solid fa-gamepad text-cyan-600 dark:text-cyan-500 text-sm"
                                                aria-hidden="true"></i>
                                            <h4
                                                class="text-xs font-black uppercase tracking-widest text-gray-900 dark:text-gray-300">
                                                Juego Capturado
                                            </h4>
                                        </div>

                                        <div
                                            class="w-full max-w-[260px] mx-auto md:max-w-none transform scale-95 md:scale-100 origin-top">
                                            <x-miscomponentes.game-widget :game="$image->game" />
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="flex flex-col items-center justify-center h-full opacity-50 py-10 md:py-0">
                                        <i class="fa-solid fa-ghost text-4xl mb-3"></i>
                                        <p class="text-xs font-bold uppercase tracking-widest">Juego desconocido</p>
                                    </div>
                                @endif
                            </div>

                        </div>
                    @else
                        {{-- ESTADO DE CARGA --}}
                        <div class="w-full h-[50vh] flex items-center justify-center">
                            <i class="fa-solid fa-circle-notch fa-spin text-3xl text-cyan-500"></i>
                        </div>
                @endif
            </div>
        </div>
    </div>
</div>
