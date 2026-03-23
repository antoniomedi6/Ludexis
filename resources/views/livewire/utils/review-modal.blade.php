<x-dialog-modal wire:model.live="modalOpen">
    <x-slot:title>
        Reseña
    </x-slot:title>

    <x-slot:content>
        @if ($game)
            <div class="flex flex-col md:flex-row gap-6">
                <div class="w-full md:w-1/3 shrink-0">
                    <img src="{{ $game->cover_url }}" class="w-full rounded-xl shadow-md object-cover"
                        alt="{{ $game->title }}" />
                    <p class="mt-3 text-center font-black text-gray-900 dark:text-white">{{ $game->title }}</p>
                </div>

                <div class="w-full md:w-2/3">
                    <x-miscomponentes.textarea class="h-full" wire:model="cform.review"
                        placeholder="¿Qué te ha parecido el juego?"></x-miscomponentes.textarea>
                </div>
                <x-input-error for="cform.review" />
            </div>
        @endif
    </x-slot:content>

    <x-slot:footer>
        <x-danger-button wire:click="$set('modalOpen', false)">
            <x-icons.exit class="mr-1 size-4" /> Cancelar
        </x-danger-button>

        <x-button class="ml-1" wire:click="save">
            <x-icons.publish class="mr-1 size-4" /> Publicar Reseña
        </x-button>
    </x-slot:footer>
</x-dialog-modal>
