<x-action-section>

    {{-- TEXTOS EXPLICATIVOS --}}
    <x-slot name="title">
        {{ __('Privacidad del Perfil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Gestiona quién puede ver tu biblioteca, estadísticas y actividad reciente.') }}
    </x-slot>

    {{-- CONTENIDO Y TOGGLE --}}
    <x-slot name="content">
        <h3 class="text-lg font-black text-lightbox-text dark:text-white">
            {{ __('Visibilidad de la cuenta') }}
        </h3>

        <div class="mt-3 max-w-xl text-sm text-lightbox-muted dark:text-gray-400">
            <p>
                {{ __('Si activas esta opción, tu perfil será privado. Solo tú y los administradores podréis ver tus juegos completados, abandonados y tus estadísticas. Los demás usuarios solo verán tu nombre y tu avatar base.') }}
            </p>
        </div>

        <div class="mt-5">
            <div x-data="{ isPrivate: @entangle('is_private') }">
                <label for="is_private_toggle" class="flex items-center cursor-pointer w-fit group">
                    <div class="relative">
                        <input type="checkbox" id="is_private_toggle" class="sr-only" wire:model.live="is_private"
                            wire:change="updatePrivacy">
                        <div class="block w-12 h-7 rounded-full transition-colors duration-300"
                            :class="isPrivate ? 'bg-cyan-500' : 'bg-lightbox-border dark:bg-gray-700'"></div>
                        <div class="dot absolute left-1 top-1 bg-white w-5 h-5 rounded-full transition-transform duration-300 shadow-sm"
                            :class="isPrivate ? 'translate-x-5' : 'translate-x-0'"></div>
                    </div>
                    <div class="ml-4 text-xs font-black uppercase tracking-widest transition-colors duration-300"
                        :class="isPrivate ? 'text-cyan-600 dark:text-cyan-400' : 'text-lightbox-muted dark:text-gray-400'">
                        {{ __('Perfil Privado') }}
                    </div>
                </label>
            </div>
        </div>

        <x-action-message class="me-3 mt-4 text-emerald-500 font-bold text-sm" on="saved">
            <i class="fa-solid fa-check mr-1" aria-hidden="true"></i> {{ __('Configuración guardada.') }}
        </x-action-message>
    </x-slot>

</x-action-section>
