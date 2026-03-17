<form wire:submit.prevent="save">
    <div
        class="sticky top-28 bg-white/95 dark:bg-[#151821]/95 backdrop-blur-2xl border border-gray-200 dark:border-gray-800 rounded-[2.5rem] p-8 shadow-xl dark:shadow-[0_20px_60px_rgba(0,0,0,0.5)] transition-colors duration-300 flex flex-col gap-8">

        <div class="flex items-center gap-4">
            <div
                class="w-12 h-12 rounded-2xl bg-cyan-600 flex items-center justify-center text-white shadow-[0_5px_15px_rgba(6,182,212,0.4)]">
                <i class="fa-solid fa-gamepad text-xl"></i>
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

        <div class="bg-gray-50 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 rounded-[2rem] p-6 transition-colors duration-300 flex flex-col items-center shadow-inner dark:shadow-none"
            x-data="{ hoverRating: 0, rating: $wire.entangle('form.rating') }">
            <span
                class="text-[10px] font-black uppercase tracking-widest text-gray-500 dark:text-gray-500 mb-4 transition-colors duration-300">Valoración</span>

            <div class="flex gap-2 mb-3">
                <template x-for="i in 5">
                    <div class="relative w-8 h-8 cursor-pointer">
                        <i
                            class="fa-solid fa-star text-gray-200 dark:text-gray-800 absolute inset-0 text-3xl transition-colors duration-300"></i>

                        <div class="absolute inset-0 overflow-hidden pointer-events-none transition-all duration-150"
                            :style="`width: ${hoverRating ? (hoverRating >= i ? '100%' : (hoverRating == i - 0.5 ? '50%' : '0%')) : (rating >= i ? '100%' : (rating == i - 0.5 ? '50%' : '0%'))}`">
                            <i
                                class="fa-solid fa-star text-cyan-500 dark:text-cyan-400 text-3xl drop-shadow-[0_0_8px_rgba(6,182,212,0.5)]"></i>
                        </div>

                        <div class="absolute left-0 top-0 w-1/2 h-full z-10" @mouseenter="hoverRating = i - 0.5"
                            @mouseleave="hoverRating = 0" @click="rating = i - 0.5"></div>

                        <div class="absolute right-0 top-0 w-1/2 h-full z-10" @mouseenter="hoverRating = i"
                            @mouseleave="hoverRating = 0" @click="rating = i"></div>
                    </div>
                </template>
            </div>

            <div class="h-6">
                <span
                    class="text-xs font-black text-cyan-600 dark:text-cyan-400 bg-white dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-700 px-3 py-1 rounded-lg shadow-sm transition-colors duration-300"
                    x-show="rating > 0" x-text="Number(rating).toFixed(1) + ' / 5.0'" style="display: none;"></span>
                <span class="text-xs font-bold text-gray-400 dark:text-gray-600 transition-colors duration-300"
                    x-show="!rating || rating === 0">Sin valorar</span>
                <x-input-error for="form.rating" />
            </div>
        </div>

        <div>
            <div class="flex justify-between items-center mb-3">
                <span
                    class="text-[10px] text-gray-500 dark:text-gray-500 font-black uppercase tracking-widest transition-colors duration-300">Estado</span>
            </div>
            <div class="grid grid-cols-2 gap-2.5">
                <label class="cursor-pointer relative group">
                    <input type="radio" name="status" class="peer hidden" value="pending" wire:model="form.status" />
                    <div
                        class="flex flex-col items-center justify-center gap-1.5 p-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-[#0f1117] text-gray-500 dark:text-gray-400 peer-checked:bg-gray-200 dark:peer-checked:bg-gray-800 peer-checked:border-gray-400 dark:peer-checked:border-gray-600 peer-checked:text-gray-900 dark:peer-checked:text-white transition-all duration-300">
                        <i class="fa-solid fa-clock text-sm group-hover:scale-110 transition-transform"></i>
                        <span class="text-[10px] font-black uppercase tracking-wider">Pendiente</span>
                    </div>
                </label>

                <label class="cursor-pointer relative group">
                    <input type="radio" name="status" class="peer hidden" value="playing" wire:model="form.status" />
                    <div
                        class="flex flex-col items-center justify-center gap-1.5 p-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-[#0f1117] text-gray-500 dark:text-gray-400 peer-checked:bg-cyan-50 dark:peer-checked:bg-cyan-900/30 peer-checked:border-cyan-400 dark:peer-checked:border-cyan-500 peer-checked:text-cyan-700 dark:peer-checked:text-cyan-400 transition-all duration-300 shadow-sm peer-checked:shadow-md">
                        <i class="fa-solid fa-gamepad text-sm group-hover:scale-110 transition-transform"></i>
                        <span class="text-[10px] font-black uppercase tracking-wider">Jugando</span>
                    </div>
                </label>

                <label class="cursor-pointer relative group">
                    <input type="radio" name="status" class="peer hidden" value="finish" wire:model="form.status" />
                    <div
                        class="flex flex-col items-center justify-center gap-1.5 p-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-[#0f1117] text-gray-500 dark:text-gray-400 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/30 peer-checked:border-green-400 dark:peer-checked:border-green-500 peer-checked:text-green-700 dark:peer-checked:text-green-400 transition-all duration-300">
                        <i class="fa-solid fa-flag-checkered text-sm group-hover:scale-110 transition-transform"></i>
                        <span class="text-[10px] font-black uppercase tracking-wider">Finalizado</span>
                    </div>
                </label>

                <label class="cursor-pointer relative group">
                    <input type="radio" name="status" class="peer hidden" value="completed"
                        wire:model="form.status" />
                    <div
                        class="flex flex-col items-center justify-center gap-1.5 p-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-[#0f1117] text-gray-500 dark:text-gray-400 peer-checked:bg-purple-50 dark:peer-checked:bg-purple-900/30 peer-checked:border-purple-400 dark:peer-checked:border-purple-500 peer-checked:text-purple-700 dark:peer-checked:text-purple-400 transition-all duration-300">
                        <i class="fa-solid fa-trophy text-sm group-hover:scale-110 transition-transform"></i>
                        <span class="text-[10px] font-black uppercase tracking-wider">100%</span>
                    </div>
                </label>

                <label class="cursor-pointer relative group">
                    <input type="radio" name="status" class="peer hidden" value="paused" wire:model="form.status" />
                    <div
                        class="flex flex-col items-center justify-center gap-1.5 p-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-[#0f1117] text-gray-500 dark:text-gray-400 peer-checked:bg-yellow-50 dark:peer-checked:bg-yellow-900/30 peer-checked:border-yellow-400 dark:peer-checked:border-yellow-500 peer-checked:text-yellow-700 dark:peer-checked:text-yellow-400 transition-all duration-300">
                        <i class="fa-solid fa-pause text-sm group-hover:scale-110 transition-transform"></i>
                        <span class="text-[10px] font-black uppercase tracking-wider">En Pausa</span>
                    </div>
                </label>

                <label class="cursor-pointer relative group">
                    <input type="radio" name="status" class="peer hidden" value="abandoned"
                        wire:model="form.status" />
                    <div
                        class="flex flex-col items-center justify-center gap-1.5 p-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-[#0f1117] text-gray-500 dark:text-gray-400 peer-checked:bg-red-50 dark:peer-checked:bg-red-900/30 peer-checked:border-red-400 dark:peer-checked:border-red-500 peer-checked:text-red-700 dark:peer-checked:text-red-400 transition-all duration-300">
                        <i class="fa-solid fa-skull text-sm group-hover:scale-110 transition-transform"></i>
                        <span class="text-[10px] font-black uppercase tracking-wider">Abandonado</span>
                    </div>
                </label>

                <label class="cursor-pointer relative group col-span-2">
                    <input type="radio" name="status" class="peer hidden" value="multiplayer"
                        wire:model="form.status" />
                    <div
                        class="flex items-center justify-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-[#0f1117] text-gray-500 dark:text-gray-400 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/30 peer-checked:border-blue-400 dark:peer-checked:border-blue-500 peer-checked:text-blue-700 dark:peer-checked:text-blue-400 transition-all duration-300">
                        <i class="fa-solid fa-users text-sm group-hover:scale-110 transition-transform"></i>
                        <span class="text-[10px] font-black uppercase tracking-wider">Multiplayer Frecuente</span>
                    </div>
                </label>
            </div>
            <x-input-error for="form.status" />
        </div>

        <div>
            <label class="flex justify-between items-center mb-3">
                <span
                    class="text-[10px] text-gray-500 dark:text-gray-500 font-black uppercase tracking-widest transition-colors duration-300">Horas
                    Jugadas</span>
            </label>
            <div class="relative">
                <i
                    class="fa-regular fa-clock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 transition-colors duration-300"></i>
                <input type="number" min="0" wire:model="form.hours_finish" placeholder="Ej: 45"
                    class="w-full bg-gray-50 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white rounded-xl pl-11 pr-4 py-3 text-sm font-bold focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors duration-300 shadow-inner placeholder-gray-400 dark:placeholder-gray-600" />
            </div>
            <x-input-error for="form.hours_finish" />
        </div>

        <div class="flex flex-col gap-3">
            <button type="submit"
                class="w-full bg-gray-900 hover:bg-gray-800 dark:bg-cyan-600 dark:hover:bg-cyan-500 text-white font-black py-4 rounded-xl transition-all duration-300 shadow-[0_10px_20px_rgba(0,0,0,0.1)] dark:shadow-[0_5px_15px_rgba(6,182,212,0.3)] uppercase tracking-widest text-xs flex items-center justify-center gap-3 hover:-translate-y-1">
                <i class="fa-solid fa-floppy-disk text-lg"></i> Guardar Registro
            </button>
        </div>
    </div>
</form>
