<div>
    {{-- AUTHENTICATED_VIEW --}}
    @auth
        <button type="button" wire:click.prevent.stop="openReport" aria-pressed="{{ $isReported ? 'true' : 'false' }}"
            aria-label="{{ $isReported ? 'Ya has reportado este contenido' : 'Reportar contenido' }}"
            @disabled($isReported)
            class="group relative flex items-center gap-2 px-4 py-2 rounded-2xl border transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500 shadow-sm
        {{ $isReported
            ? 'bg-gradient-to-br from-red-900/30 to-gray-900 border-red-500/40 shadow-sm cursor-not-allowed'
            : 'bg-white dark:bg-darkbox-card border-gray-200 dark:border-gray-800 hover:border-red-500/40 hover:bg-red-50 dark:hover:bg-red-900/20' }}">

            <div class="relative flex items-center justify-center">
                <div class="absolute inset-0 bg-red-400 blur-md transition-opacity duration-300 {{ $isReported ? 'opacity-30' : 'opacity-0' }}"
                    aria-hidden="true"></div>

                <i class="transition-all duration-300 group-active:scale-75 relative z-10 text-base
                {{ $isReported
                    ? 'fa-solid fa-flag text-red-400 drop-shadow-sm'
                    : 'fa-regular fa-flag text-gray-400 dark:text-gray-500 group-hover:text-red-500' }}"
                    aria-hidden="true"></i>
            </div>

            <span
                class="text-xs font-black tracking-widest uppercase transition-colors duration-300 relative z-10
            {{ $isReported ? 'text-red-400' : 'text-gray-600 dark:text-gray-400 group-hover:text-red-600 dark:group-hover:text-red-400' }}">
                {{ $isReported ? 'Reportado' : 'Reportar' }}
            </span>
        </button>

        {{-- MODAL --}}
        <div x-data="{ show: @entangle('openModal') }" x-show="show" x-cloak
            x-on:keydown.escape.window="$wire.closeReport()" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6"
            role="dialog" aria-modal="true" aria-label="Reportar contenido">

            <div x-show="show" x-transition.opacity class="absolute inset-0 bg-black/60 backdrop-blur-sm"
                @click="$wire.closeReport()" aria-hidden="true"></div>

            <div x-show="show" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="relative w-full max-w-lg max-h-screen overflow-y-auto bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-2xl shadow-xl p-4 sm:p-6"
                @click.stop>

                {{-- CABECERA --}}
                <div class="flex items-start justify-between gap-4 mb-4">
                    <div>
                        <h3 class="text-lg font-black text-gray-900 dark:text-white">Reportar contenido</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Elige un motivo para reportar este contenido a los moderadores.
                        </p>
                    </div>
                    <button type="button" wire:click="closeReport"
                        class="p-2 rounded-xl border border-gray-200 dark:border-darkbox-border bg-white dark:bg-darkbox-card hover:bg-gray-50 dark:hover:bg-darkbox-main transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500"
                        aria-label="Cerrar modal">
                        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                    </button>
                </div>

                {{-- FORMULARIO --}}
                <div class="space-y-3">
                    <div>
                        <label for="report_reason_{{ $this->getId() }}"
                            class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2">
                            Motivo
                        </label>
                        <select id="report_reason_{{ $this->getId() }}" wire:model.live="reportReason"
                            class="w-full rounded-xl bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border text-sm font-bold text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                            <option value="">Selecciona un motivo</option>
                            <option value="Spam o publicidad">Spam o publicidad</option>
                            <option value="Suplantación de identidad">Suplantación de identidad</option>
                            <option value="Lenguaje ofensivo">Lenguaje ofensivo</option>
                            <option value="Contenido inapropiado">Contenido inapropiado</option>
                            <option value="Spoilers no marcados">Spoilers no marcados</option>
                            <option value="Otro">Otro</option>
                        </select>
                        @error('reportReason')
                            <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-2 pt-4">
                        <button type="button" wire:click="closeReport"
                            class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-darkbox-border bg-white dark:bg-darkbox-card text-sm font-black text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-darkbox-main transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500">
                            Cancelar
                        </button>
                        <button type="button" wire:click="submitReport"
                            class="px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white text-sm font-black transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
                            Enviar reporte
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- VISTA SIN LOGIN --}}
        <a href="{{ route('login') }}"
            class="group relative flex items-center gap-2 px-4 py-2 rounded-2xl border transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500 shadow-sm bg-white dark:bg-darkbox-card border-gray-200 dark:border-gray-800 hover:border-red-500/40"
            aria-label="Inicia sesión para reportar">

            <div class="relative flex items-center justify-center">
                <i class="fa-regular fa-flag text-gray-400 dark:text-gray-500 group-hover:text-red-500 transition-all duration-300 relative z-10 text-base"
                    aria-hidden="true"></i>
            </div>

            <span
                class="text-xs font-black tracking-widest uppercase transition-colors duration-300 relative z-10 text-gray-600 dark:text-gray-400">
                Reportar
            </span>
        </a>
    @endauth
</div>
