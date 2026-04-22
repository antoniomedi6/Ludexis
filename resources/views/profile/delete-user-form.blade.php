<x-action-section>
    <x-slot name="title">
        <span class="text-gray-900 dark:text-white font-black">{{ __('Borrar Cuenta') }}</span>
    </x-slot>

    <x-slot name="description">
        <span class="text-gray-600 dark:text-gray-400 text-sm">{{ __('Elimina tu cuenta de forma permanente.') }}</span>
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('Una vez que se elimine tu cuenta, todos sus recursos y datos se borrarán permanentemente. Antes de eliminar tu cuenta, descarga cualquier dato o información que desees conservar.') }}
        </div>

        <div class="mt-5">
            <button wire:click="confirmUserDeletion" wire:loading.attr="disabled"
                class="inline-flex items-center justify-center px-6 py-3 bg-red-600 hover:bg-red-500 text-white rounded-xl font-black text-xs uppercase tracking-widest transition-all duration-300 shadow-[0_0_15px_rgba(220,38,38,0.2)] hover:shadow-[0_0_25px_rgba(220,38,38,0.4)] focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-darkbox-card disabled:opacity-50">
                <i class="fa-solid fa-trash-can mr-2" aria-hidden="true"></i> {{ __('Borrar Cuenta') }}
            </button>
        </div>

        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                <span class="text-gray-900 dark:text-white font-black text-xl">{{ __('Borrar Cuenta') }}</span>
            </x-slot>

            <x-slot name="content">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    {{ __('¿Estás seguro de que quieres eliminar tu cuenta? Una vez eliminada, todos sus recursos y datos se borrarán permanentemente. Por favor, introduce tu contraseña para confirmar.') }}
                </p>

                <div class="mt-4" x-data="{}"
                    x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"
                            aria-hidden="true"></i>
                        <x-input type="password"
                            class="mt-1 block w-full sm:w-3/4 bg-gray-50 dark:bg-darkbox-main border-gray-200 dark:border-darkbox-border text-gray-900 dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm focus:border-red-500 focus:ring-red-500 transition placeholder-gray-400 dark:placeholder-gray-600"
                            autocomplete="current-password" placeholder="{{ __('Tu contraseña') }}" x-ref="password"
                            wire:model="password" wire:keydown.enter="deleteUser" />
                    </div>
                    <x-input-error for="password" class="mt-2 text-red-500 text-xs font-bold" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled"
                    class="px-6 py-3 bg-white dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border text-gray-700 dark:text-gray-300 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 disabled:opacity-50">
                    {{ __('Cancelar') }}
                </button>

                <button wire:click="deleteUser" wire:loading.attr="disabled"
                    class="ms-3 inline-flex items-center justify-center px-6 py-3 bg-red-600 hover:bg-red-500 text-white rounded-xl font-black text-xs uppercase tracking-widest transition-all duration-300 shadow-[0_0_15px_rgba(220,38,38,0.2)] hover:shadow-[0_0_25px_rgba(220,38,38,0.4)] focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-darkbox-card disabled:opacity-50">
                    {{ __('Borrar Cuenta') }}
                </button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
