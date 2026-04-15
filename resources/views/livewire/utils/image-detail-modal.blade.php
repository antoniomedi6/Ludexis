<div>
    {{-- CONTENEDOR PRINCIPAL --}}
    <div x-data="{ show: @entangle('showModal') }" x-show="show" style="display: none;" @keydown.escape.window="$wire.closeModal()"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 lg:p-12" aria-modal="true" role="dialog">

        <div x-show="show" x-transition.opacity class="absolute inset-0 bg-gray-950/90 backdrop-blur-sm cursor-pointer"
            @click="$wire.closeModal()"></div>

        <div x-show="show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            class="relative w-full max-w-7xl mx-auto bg-gray-100 dark:bg-[#151821] rounded-2xl md:rounded-[2rem] shadow-2xl overflow-hidden z-10 flex flex-col md:flex-row max-h-full"
            @click.stop>

            <button @click="$wire.closeModal()"
                class="md:hidden absolute top-4 right-4 z-50 text-white bg-black/50 p-2 rounded-full backdrop-blur-md">
                <i class="fa-solid fa-xmark"></i>
            </button>

            @if ($image)
                {{-- COLUMNA IZQUIERDA --}}
                <div
                    class="w-full md:w-2/3 lg:w-[70%] bg-black flex items-center justify-center relative min-h-[40vh] md:min-h-[80vh]">
                    <img src="{{ Storage::url($image->image_path) }}" alt="Captura subida por {{ $image->user->name }}"
                        class="w-full h-full object-contain max-h-[80vh]" />
                </div>

                {{-- COLUMNA DERECHA --}}
                <div
                    class="w-full md:w-1/3 lg:w-[30%] flex flex-col h-full bg-white dark:bg-[#151821] border-l border-gray-200 dark:border-gray-800">

                    {{-- HEADER --}}
                    <div
                        class="p-5 md:p-6 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between shrink-0 bg-gray-50/50 dark:bg-[#11131a]">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('profile', $image->user) }}" class="shrink-0">
                                <img src="{{ $image->user->profile_photo_url }}" alt="{{ $image->user->name }}"
                                    class="w-10 h-10 rounded-full border border-gray-300 dark:border-gray-700 shadow-sm transition-transform hover:scale-105">
                            </a>
                            <div class="flex flex-col">
                                <a href="{{ route('profile', $image->user) }}"
                                    class="font-black text-sm text-gray-900 dark:text-white leading-tight hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">
                                    {{ $image->user->name }}
                                </a>
                                <time class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-0.5">
                                    {{ $image->created_at->diffForHumans() }}
                                </time>
                            </div>
                        </div>
                        <button @click="$wire.closeModal()"
                            class="w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>

                    {{-- BODY --}}
                    <div class="p-6 flex-1 overflow-y-auto custom-scrollbar flex flex-col gap-8">
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

                                <div class="w-full">
                                    <x-miscomponentes.game-widget :game="$image->game" />
                                </div>
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center h-full opacity-50">
                                <i class="fa-solid fa-ghost text-4xl mb-3"></i>
                                <p class="text-xs font-bold uppercase tracking-widest">Juego desconocido</p>
                            </div>
                        @endif
                    </div>

                    {{-- FOOTER --}}
                    <div
                        class="p-5 md:p-6 border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-[#11131a] shrink-0">
                        <div class="w-full flex justify-center">
                            @livewire('utils.like-button', ['model' => $image], key('like-detail-' . $image->id))
                        </div>
                    </div>

                </div>
            @else
                <div class="w-full h-[50vh] flex items-center justify-center">
                    <i class="fa-solid fa-circle-notch fa-spin text-3xl text-cyan-500"></i>
                </div>
            @endif
        </div>
    </div>
</div>
