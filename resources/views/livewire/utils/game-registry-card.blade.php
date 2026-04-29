<form wire:submit.prevent="save" x-data="{ status: $wire.entangle('form.status') }">

    <div
        class="sticky top-3 sm:top-10 lg:top-28 bg-white/95 dark:bg-darkbox-card/95 backdrop-blur-2xl border border-gray-200 dark:border-gray-800 rounded-3xl p-3 sm:p-6 lg:p-8 shadow-xl dark:shadow-2xl transition-colors duration-300 flex flex-col gap-3 sm:gap-6 lg:gap-8">

        <div class="flex items-center gap-3 sm:gap-4">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl flex items-center justify-center shadow-lg">
                <img class="size-8 sm:size-9" src="{{ asset('images/logo-tracker.png') }}" alt="Logo Tracker" />
            </div>
            <div>
                <p
                    class="text-[10px] text-cyan-600 dark:text-cyan-500 font-black uppercase tracking-widest transition-colors duration-300">
                    Ludexis Tracker
                </p>
                <h3 class="text-base sm:text-xl font-black text-gray-900 dark:text-white transition-colors duration-300">
                    Tu Registro
                </h3>
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-darkbox-main border border-gray-200 dark:border-gray-800 rounded-3xl p-3 sm:p-6 transition-colors duration-300 flex flex-col items-center shadow-inner dark:shadow-none relative"
            x-data="{ hoverRating: 0, rating: $wire.entangle('form.rating'), saved: false }">

            <span
                class="text-[10px] font-black uppercase tracking-widest text-gray-500 dark:text-gray-500 mb-3">Valoración</span>

            <template x-if="saved">
                <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-50"
                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-50"
                    class="absolute top-4 right-4 z-20">
                    <div
                        class="bg-white dark:bg-gray-900 rounded-full shadow-lg border border-gray-100 dark:border-gray-700 p-0.5">
                        <x-icons.saved-animated class="size-6" />
                    </div>
                </div>
            </template>

            <div class="flex gap-1 sm:gap-2 mb-3 transition-all duration-300"
                :class="{ 'opacity-40 grayscale pointer-events-none': !status }">
                <template x-for="i in 5">
                    <div class="relative w-6 h-6 sm:w-8 sm:h-8 cursor-pointer">

                        <x-icons.star
                            class="text-gray-200 dark:text-gray-800 absolute inset-0 w-6 h-6 sm:w-8 sm:h-8 transition-colors duration-300" />

                        <div class="absolute inset-0 overflow-hidden pointer-events-none transition-all duration-150"
                            :style="`width: ${hoverRating ? (hoverRating >= i * 2 ? '100%' : (hoverRating == i * 2 - 1 ? '50%' : '0%')) : (rating >= i * 2 ? '100%' : (rating == i * 2 - 1 ? '50%' : '0%'))}`">
                            <x-icons.star
                                class="text-cyan-500 dark:text-cyan-400 w-6 h-6 sm:w-8 sm:h-8 drop-shadow-sm" />
                        </div>

                        <div class="absolute left-0 top-0 w-1/2 h-full z-10" @mouseenter="hoverRating = i * 2 - 1"
                            @mouseleave="hoverRating = 0"
                            @click="rating = i * 2 - 1; $wire.save().then(() => { saved = true; setTimeout(() => saved = false, 1500) })">
                        </div>
                        <div class="absolute right-0 top-0 w-1/2 h-full z-10" @mouseenter="hoverRating = i * 2"
                            @mouseleave="hoverRating = 0"
                            @click="rating = i * 2; $wire.save().then(() => { saved = true; setTimeout(() => saved = false, 1500) })">
                        </div>

                    </div>
                </template>
            </div>

            <div class="h-6 flex items-center justify-center">
                <span
                    class="text-xs font-black text-cyan-600 dark:text-cyan-400 bg-white dark:bg-darkbox-card border border-gray-200 dark:border-gray-700 px-2 py-0.5 rounded-lg shadow-sm"
                    x-show="rating > 0 && status" x-text="Number(rating) + ' / 10'"></span>

                <span class="text-xs font-bold text-gray-400 dark:text-gray-600"
                    x-show="(!rating || rating === 0) && status">Sin valorar</span>

                <span class="text-[10px] font-black uppercase tracking-widest text-red-500 flex items-center gap-1.5"
                    x-show="!status" x-cloak>
                    <i class="fa-solid fa-lock text-sm"></i> Requiere un estado
                </span>

                <x-input-error for="form.rating" />
            </div>
        </div>

        <div>
            <div class="flex justify-between items-center mb-3">
                <span
                    class="text-[10px] text-gray-500 dark:text-gray-500 font-black uppercase tracking-widest">Estado</span>
            </div>
            <div class="grid grid-cols-2 gap-2">
                @php
                    $statuses = [
                        ['val' => 'pending', 'label' => 'Pendiente', 'icon' => 'icons.pending'],
                        ['val' => 'playing', 'label' => 'Jugando', 'icon' => 'icons.playing'],
                        ['val' => 'finish', 'label' => 'Finalizado', 'icon' => 'fa-flag-checkered', 'type' => 'font'],
                        ['val' => 'completed', 'label' => '100%', 'icon' => 'icons.completed'],
                        ['val' => 'paused', 'label' => 'En Pausa', 'icon' => 'icons.paused'],
                        ['val' => 'abandoned', 'label' => 'Abandonado', 'icon' => 'icons.abandoned'],
                        /*
                        [
                            'val' => 'multiplayer',
                            'label' => 'Multiplayer Frecuente',
                            'icon' => 'icons.multiplayer',
                            'col_span' => 'col-span-2',
                            'color' =>
                                'peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/30 peer-checked:border-blue-400 dark:peer-checked:border-blue-500 peer-checked:text-blue-700 dark:peer-checked:text-blue-400',
                        ],
                        */
                    ];
                @endphp

                @foreach ($statuses as $st)
                    @php
                        $colorClass =
                            $st['color'] ??
                            'peer-checked:bg-gray-200 dark:peer-checked:bg-gray-800 peer-checked:border-gray-400 dark:peer-checked:border-gray-600 peer-checked:text-gray-900 dark:peer-checked:text-white';
                        $colSpan = $st['col_span'] ?? '';
                    @endphp

                    <label class="cursor-pointer relative group {{ $colSpan }}" x-data="{ saved: false }">
                        <input type="radio" name="status" class="peer hidden" value="{{ $st['val'] }}"
                            wire:model="form.status"
                            @change="$wire.save().then(() => { saved = true; setTimeout(() => saved = false, 1500) })" />

                        <div
                            class="flex {{ isset($st['col_span']) ? 'flex-row' : 'flex-col' }} items-center justify-center gap-2 p-2 sm:p-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-darkbox-main text-gray-500 dark:text-gray-400 transition-all duration-300 {{ $colorClass }}">

                            @if (isset($st['type']) && $st['type'] == 'font')
                                <i class="fa-solid {{ $st['icon'] }} text-sm"></i>
                            @else
                                <x-dynamic-component :component="$st['icon']" class="size-5 sm:size-6" />
                            @endif
                            <span
                                class="text-[10px] font-black uppercase tracking-wider text-center">{{ $st['label'] }}</span>
                        </div>

                        <div x-show="status === '{{ $st['val'] }}'" x-transition
                            class="absolute -top-2 -right-2 z-20 flex items-center justify-center size-6 bg-white dark:bg-darkbox-card rounded-full shadow-lg border border-gray-200 dark:border-gray-700">

                            <button type="button" x-show="!saved"
                                @click.prevent.stop="status = null; $wire.toggleStatus()"
                                class="text-gray-400 hover:text-red-500 transition-colors duration-200 outline-none">
                                <x-icons.exit class="size-4" />
                            </button>

                            <template x-if="saved">
                                <div class="text-cyan-500 flex items-center justify-center">
                                    <x-icons.saved-animated class="size-4" />
                                </div>
                            </template>
                        </div>
                    </label>
                @endforeach
            </div>
            <x-input-error for="form.status" />
        </div>

        <div x-show="status === 'finish' || status === 'completed'" x-transition x-data="{ saved: false }">
            <label class="flex justify-between items-center mb-3">
                <span class="text-[10px] text-gray-500 font-black uppercase tracking-widest">Horas Objetivo
                    Principal</span>
            </label>
            <div class="relative">
                <i class="fa-regular fa-clock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="number" min="0" wire:model="form.hours_finish"
                    @change="$wire.save().then(() => { saved = true; setTimeout(() => saved = false, 1500) })"
                    class="w-full bg-gray-50 dark:bg-darkbox-main border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm font-bold focus:ring-cyan-500 transition-all shadow-inner" />

                <template x-if="saved">
                    <div x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-50"
                        class="absolute -top-2 -right-2 z-20">
                        <div class="bg-white dark:bg-gray-900 rounded-full shadow p-0.5">
                            <x-icons.saved-animated class="size-5" />
                        </div>
                    </div>
                </template>
            </div>
            <x-input-error for="form.hours_finish" />
        </div>

        <div x-show="status === 'completed'" x-transition x-data="{ saved: false }">
            <label class="flex justify-between items-center mb-3">
                <span class="text-[10px] text-gray-500 font-black uppercase tracking-widest">Horas Completado
                    100%</span>
            </label>
            <div class="relative">
                <i class="fa-regular fa-clock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="number" min="0" wire:model="form.hours_completed"
                    @change="$wire.save().then(() => { saved = true; setTimeout(() => saved = false, 1500) })"
                    class="w-full bg-gray-50 dark:bg-darkbox-main border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm font-bold focus:ring-cyan-500 transition-all shadow-inner" />

                <template x-if="saved">
                    <div x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-50"
                        class="absolute -top-2 -right-2 z-20">
                        <div class="bg-white dark:bg-gray-900 rounded-full shadow p-0.5">
                            <x-icons.saved-animated class="size-5" />
                        </div>
                    </div>
                </template>
            </div>
            <x-input-error for="form.hours_completed" />
        </div>

        <div class="flex flex-col gap-2 sm:gap-3">
            @if ($this->form->status)
                <x-button type="button"
                    @click="$dispatch('evtOpenReviewModal', { gameId: {{ $this->form->game_id }} })">
                    <x-icons.review class="size-5 sm:size-6 mr-2" />
                    Escribir Reseña
                </x-button>
            @endif

            @livewire('utils.add-game-to-list-modal', ['gameId' => $this->form->game_id])
        </div>
    </div>
</form>
