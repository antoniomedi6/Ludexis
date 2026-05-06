<x-form-section submit="updatePassword">
    <x-slot name="title">
        <span class="text-gray-900 dark:text-white font-black">{{ __('Actualizar Contraseña') }}</span>
    </x-slot>

    <x-slot name="description">
        <span
            class="text-gray-600 dark:text-gray-400 text-sm">{{ __('Asegúrate de que tu cuenta use una contraseña larga y aleatoria para mantenerse segura.') }}</span>
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <label for="current_password"
                class="block text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1">{{ __('Contraseña Actual') }}</label>
            <div class="relative">
                <i class="fa-solid fa-unlock absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"
                    aria-hidden="true"></i>
                <x-input id="current_password" type="password"
                    class="mt-1 block w-full bg-lightbox-main dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border text-lightbox-text dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-400 dark:placeholder-gray-600"
                    wire:model="state.current_password" autocomplete="current-password"
                    placeholder="{{ __('Tu contraseña actual') }}" />
            </div>
            <x-input-error for="current_password" class="mt-2 text-red-500 text-xs font-bold" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <label for="password"
                class="block text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1">{{ __('Nueva Contraseña') }}</label>
            <div class="relative">
                <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"
                    aria-hidden="true"></i>
                <x-input id="password" type="password"
                    class="mt-1 block w-full bg-lightbox-main dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border text-lightbox-text dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-400 dark:placeholder-gray-600"
                    wire:model="state.password" autocomplete="new-password"
                    placeholder="{{ __('Introduce una contraseña segura') }}" />
            </div>
            <x-input-error for="password" class="mt-2 text-red-500 text-xs font-bold" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <label for="password_confirmation"
                class="block text-xs font-black text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-1">{{ __('Confirmar Contraseña') }}</label>
            <div class="relative">
                <i class="fa-solid fa-check-double absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"
                    aria-hidden="true"></i>
                <x-input id="password_confirmation" type="password"
                    class="mt-1 block w-full bg-lightbox-main dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border text-lightbox-text dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-cyan-500 focus:ring-cyan-500 transition placeholder-gray-400 dark:placeholder-gray-600"
                    wire:model="state.password_confirmation" autocomplete="new-password"
                    placeholder="{{ __('Repite la nueva contraseña') }}" />
            </div>
            <x-input-error for="password_confirmation" class="mt-2 text-red-500 text-xs font-bold" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-4 text-emerald-500 font-bold text-sm" on="saved">
            <div class="flex items-center">
                <i class="fa-solid fa-check mr-1" aria-hidden="true"></i> {{ __('Guardado.') }}
            </div>
        </x-action-message>

        <button type="submit" wire:loading.attr="disabled"
            class="inline-flex items-center justify-center px-6 py-3 bg-cyan-600 hover:bg-cyan-500 text-white rounded-xl font-black text-xs uppercase tracking-widest transition-all duration-300 shadow-[0_0_15px_rgba(8,145,178,0.2)] hover:shadow-[0_0_25px_rgba(8,145,178,0.4)] focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-lightbox-soft dark:focus:ring-offset-darkbox-main disabled:opacity-50">
            <i class="fa-solid fa-floppy-disk mr-2" aria-hidden="true"></i> {{ __('Guardar') }}
        </button>
    </x-slot>
</x-form-section>
