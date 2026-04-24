<div class="flex items-center gap-2" x-data @click.stop>

    @auth
        <button type="button" wire:click="edit"
            class="px-3 py-2 rounded-xl bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border hover:bg-gray-50 dark:hover:bg-darkbox-main transition-colors text-gray-600 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-500"
            aria-label="Editar reseña">
            <i class="fa-solid fa-pen text-xs" aria-hidden="true"></i>
        </button>

        <button type="button" wire:click="openDelete"
            class="px-3 py-2 rounded-xl bg-red-500/10 text-red-600 dark:text-red-400 hover:bg-red-600 hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-red-500"
            aria-label="Eliminar reseña">
            <i class="fa-solid fa-trash text-xs" aria-hidden="true"></i>
        </button>
    @endauth

    {{-- MODAL DE CONFIRMACIÓN --}}
    <x-confirmation-modal wire:model="confirmingDelete" maxWidth="md">
        <x-slot name="title">
            Eliminar Reseña
        </x-slot>

        <x-slot name="content">
            ¿Seguro que quieres eliminar tu reseña? Esta acción no se puede deshacer.
        </x-slot>

        <x-slot name="footer">
            <button type="button" wire:click="$set('confirmingDelete', false)"
                class="w-full sm:w-auto px-6 py-3.5 rounded-xl text-sm font-bold text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-darkbox-main hover:text-gray-900 dark:hover:text-white transition-all duration-300 uppercase tracking-wider focus:outline-none focus:ring-2 focus:ring-gray-500">
                Cancelar
            </button>
            <button type="button" wire:click="delete"
                class="w-full sm:w-auto bg-red-600 hover:bg-red-500 text-white font-black px-8 py-3.5 rounded-xl transition-all duration-300 shadow-[0_5px_15px_rgba(220,38,38,0.2)] uppercase tracking-wider text-sm hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-red-500">
                Eliminar
            </button>
        </x-slot>
    </x-confirmation-modal>
</div>
