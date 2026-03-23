<form wire:submit.prevent="save" x-data="{ status: $wire.entangle('form.status') }">

    <div
        class="sticky top-28 bg-white/95 dark:bg-[#151821]/95 backdrop-blur-2xl border border-gray-200 dark:border-gray-800 rounded-[2.5rem] p-8 shadow-xl dark:shadow-[0_20px_60px_rgba(0,0,0,0.5)] transition-colors duration-300 flex flex-col gap-8">

        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-[0_5px_15px_rgba(6,182,212,0.4)]">
                <img class="size-9" src="{{ Storage::url('logo-tracker.png') }}" />
            </div>
            <div>
                <p
                    class="text-[10px] text-cyan-600 dark:text-cyan-500 font-black uppercase tracking-widest transition-colors duration-300">
                    Ludexis Tracker
                </p>
                <h3 class="text-xl font-black text-gray-900 dark:text-white transition-colors duration-300">
                    Tu Registro
                </h3>
            </div>
        </div>

        {{-- VALORACIÓN --}}
        <div class="bg-gray-50 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 rounded-[2rem] p-6 transition-colors duration-300 flex flex-col items-center shadow-inner dark:shadow-none relative"
            x-data="{ hoverRating: 0, rating: $wire.entangle('form.rating'), saved: false }">

            <span
                class="text-[10px] font-black uppercase tracking-widest text-gray-500 dark:text-gray-500 mb-4">Valoración</span>

            {{-- ICONO GUARDADO VALORACIÓN --}}
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

            <div class="flex gap-2 mb-3 transition-all duration-300"
                :class="{ 'opacity-40 grayscale pointer-events-none': !status }">
                <template x-for="i in 5">
                    <div class="relative w-8 h-8 cursor-pointer">

                        <x-icons.star
                            class="text-gray-200 dark:text-gray-800 absolute inset-0 w-8 h-8 transition-colors duration-300" />

                        <div class="absolute inset-0 overflow-hidden pointer-events-none transition-all duration-150"
                            :style="`width: ${hoverRating ? (hoverRating >= i ? '100%' : (hoverRating == i - 0.5 ? '50%' : '0%')) : (rating >= i ? '100%' : (rating == i - 0.5 ? '50%' : '0%'))}`">
                            <x-icons.star
                                class="text-cyan-500 dark:text-cyan-400 w-8 h-8 drop-shadow-[0_0_8px_rgba(6,182,212,0.5)]" />
                        </div>

                        <div class="absolute left-0 top-0 w-1/2 h-full z-10" @mouseenter="hoverRating = i - 0.5"
                            @mouseleave="hoverRating = 0"
                            @click="rating = i - 0.5; $wire.save().then(() => { saved = true; setTimeout(() => saved = false, 1500) })">
                        </div>
                        <div class="absolute right-0 top-0 w-1/2 h-full z-10" @mouseenter="hoverRating = i"
                            @mouseleave="hoverRating = 0"
                            @click="rating = i; $wire.save().then(() => { saved = true; setTimeout(() => saved = false, 1500) })">
                        </div>

                    </div>
                </template>
            </div>

            <div class="h-6 flex items-center justify-center">
                <span
                    class="text-xs font-black text-cyan-600 dark:text-cyan-400 bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-700 px-3 py-1 rounded-lg shadow-sm"
                    x-show="rating > 0 && status" x-text="Number(rating).toFixed(1) + ' / 5.0'"></span>

                <span class="text-xs font-bold text-gray-400 dark:text-gray-600"
                    x-show="(!rating || rating === 0) && status">Sin valorar</span>

                <span class="text-[10px] font-black uppercase tracking-widest text-red-500 flex items-center gap-1.5"
                    x-show="!status" x-cloak>
                    <i class="fa-solid fa-lock text-sm"></i> Requiere un estado
                </span>

                <x-input-error for="form.rating" />
            </div>
        </div>

        {{-- ESTADOS --}}
        <div>
            <div class="flex justify-between items-center mb-3">
                <span
                    class="text-[10px] text-gray-500 dark:text-gray-500 font-black uppercase tracking-widest">Estado</span>
            </div>
            <div class="grid grid-cols-2 gap-2.5">
                @php
                    $statuses = [
                        ['val' => 'pending', 'label' => 'Pendiente', 'icon' => 'icons.pending'],
                        ['val' => 'playing', 'label' => 'Jugando', 'icon' => 'icons.playing'],
                        ['val' => 'finish', 'label' => 'Finalizado', 'icon' => 'fa-flag-checkered', 'type' => 'font'],
                        ['val' => 'completed', 'label' => '100%', 'icon' => 'icons.completed'],
                        ['val' => 'paused', 'label' => 'En Pausa', 'icon' => 'icons.paused'],
                        ['val' => 'abandoned', 'label' => 'Abandonado', 'icon' => 'icons.abandoned'],
                    ];
                @endphp

                @foreach ($statuses as $status)
                    <label class="cursor-pointer relative group" x-data="{ saved: false }">
                        <input type="radio" name="status" class="peer hidden" value="{{ $status['val'] }}"
                            wire:model="form.status"
                            @change="$wire.save().then(() => { saved = true; setTimeout(() => saved = false, 1500) })" />

                        {{-- ICONO GUARDADO INDIVIDUAL --}}
                        <template x-if="saved">
                            <div x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-50"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-50" class="absolute -top-1 -right-1 z-20">
                                <div
                                    class="bg-white dark:bg-gray-900 rounded-full shadow-lg border border-gray-100 dark:border-gray-700 p-0.5">
                                    <x-icons.saved-animated class="size-5" />
                                </div>
                            </div>
                        </template>

                        <div
                            class="flex flex-col items-center justify-center gap-1.5 p-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-[#0f1117] text-gray-500 dark:text-gray-400 peer-checked:bg-gray-200 dark:peer-checked:bg-gray-800 peer-checked:border-gray-400 dark:peer-checked:border-gray-600 peer-checked:text-gray-900 dark:peer-checked:text-white transition-all duration-300">
                            @if (isset($status['type']) && $status['type'] == 'font')
                                <i class="fa-solid {{ $status['icon'] }} text-sm"></i>
                            @else
                                <x-dynamic-component :component="$status['icon']" class="size-6" />
                            @endif
                            <span class="text-[10px] font-black uppercase tracking-wider">{{ $status['label'] }}</span>
                        </div>
                    </label>
                @endforeach

                <label class="cursor-pointer relative group col-span-2" x-data="{ saved: false }">
                    <input type="radio" name="status" class="peer hidden" value="multiplayer"
                        wire:model="form.status"
                        @change="$wire.save().then(() => { saved = true; setTimeout(() => saved = false, 1500) })" />

                    {{-- ICONO GUARDADO MULTIPLAYER --}}
                    <template x-if="saved">
                        <div x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-50"
                            class="absolute -top-1 -right-1 z-20">
                            <div
                                class="bg-white dark:bg-gray-900 rounded-full shadow-lg border border-gray-100 dark:border-gray-700 p-0.5">
                                <x-icons.saved-animated class="size-5" />
                            </div>
                        </div>
                    </template>

                    <div
                        class="flex items-center justify-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-[#0f1117] text-gray-500 dark:text-gray-400 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/30 peer-checked:border-blue-400 dark:peer-checked:border-blue-500 peer-checked:text-blue-700 dark:peer-checked:text-blue-400 transition-all duration-300">
                        <x-icons.multiplayer class="size-6" />
                        <span class="text-[10px] font-black uppercase tracking-wider">Multiplayer Frecuente</span>
                    </div>
                </label>
            </div>
            <x-input-error for="form.status" />
        </div>

        {{-- HORAS FINISH --}}
        <div x-show="status === 'finish' || status === 'completed'" x-transition x-data="{ saved: false }">
            <label class="flex justify-between items-center mb-3">
                <span class="text-[10px] text-gray-500 font-black uppercase tracking-widest">Horas Objetivo
                    Principal</span>
            </label>
            <div class="relative">
                <i class="fa-regular fa-clock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="number" min="0" wire:model="form.hours_finish"
                    @change="$wire.save().then(() => { saved = true; setTimeout(() => saved = false, 1500) })"
                    class="w-full bg-gray-50 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm font-bold focus:ring-cyan-500 transition-all shadow-inner" />

                {{-- ICONO GUARDADO HORAS FINISH --}}
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

        {{-- HORAS COMPLETED --}}
        <div x-show="status === 'completed'" x-transition x-data="{ saved: false }">
            <label class="flex justify-between items-center mb-3">
                <span class="text-[10px] text-gray-500 font-black uppercase tracking-widest">Horas Completado
                    100%</span>
            </label>
            <div class="relative">
                <i class="fa-regular fa-clock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="number" min="0" wire:model="form.hours_completed"
                    @change="$wire.save().then(() => { saved = true; setTimeout(() => saved = false, 1500) })"
                    class="w-full bg-gray-50 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm font-bold focus:ring-cyan-500 transition-all shadow-inner" />

                {{-- ICONO GUARDADO HORAS COMPLETED --}}
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
        <x-button type="button" @click="$dispatch('evtOpenReviewModal', { gameId: {{ $this->form->game_id }} })">
            <x-icons.review class="size-6 mr-2" />
            {{ $this->form->review ? 'Editar Reseña' : 'Escribir Reseña' }}
        </x-button>
    </div>
</form>
