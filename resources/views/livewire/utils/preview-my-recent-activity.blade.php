<section aria-labelledby="recent-activity-heading">
    <h2 id="recent-activity-heading"
        class="text-sm font-black text-gray-600 dark:text-gray-400 uppercase tracking-widest mb-6 transition-colors duration-300">
        Tu Actividad Reciente
    </h2>
    <div class="flex flex-col gap-4">

        {{-- Actividad 1: Juego Finalizado --}}
        <article
            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-5 flex flex-col sm:flex-row gap-5 items-start sm:items-center transition-colors duration-300 hover:bg-gray-50 dark:hover:bg-gray-800 shadow-xl"
            tabindex="0">
            <div class="w-12 h-12 rounded-2xl bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 flex items-center justify-center shrink-0 border border-green-200 dark:border-green-500/20 text-xl transition-colors duration-300"
                aria-hidden="true">
                <i class="fa-solid fa-check"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm text-gray-600 dark:text-gray-400 transition-colors duration-300">
                    <span class="text-gray-900 dark:text-white font-bold text-base transition-colors duration-300">Elden
                        Ring</span> marcado como Finalizado.
                </p>
                <div class="flex flex-wrap gap-3 mt-2 items-center">
                    <span class="text-xs font-black text-cyan-600 dark:text-cyan-400 transition-colors duration-300"
                        aria-label="Tiempo jugado: 120 horas">
                        <i class="fa-solid fa-clock mr-1" aria-hidden="true"></i> 120 horas
                    </span>
                    <div class="w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-600 transition-colors duration-300"
                        aria-hidden="true"></div>
                    <div class="flex text-xs text-yellow-500" aria-label="Valoración: 5 de 5 estrellas">
                        <i class="fa-solid fa-star" aria-hidden="true"></i><i class="fa-solid fa-star"
                            aria-hidden="true"></i><i class="fa-solid fa-star" aria-hidden="true"></i><i
                            class="fa-solid fa-star" aria-hidden="true"></i><i class="fa-solid fa-star"
                            aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <span
                class="text-xs text-gray-500 font-bold uppercase tracking-wider transition-colors duration-300">Ayer</span>
        </article>

        {{-- Actividad 2: Reseña --}}
        <article
            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-5 flex flex-col sm:flex-row gap-5 items-start sm:items-center transition-colors duration-300 hover:bg-gray-50 dark:hover:bg-gray-800 shadow-xl"
            tabindex="0">
            <div class="w-12 h-12 rounded-2xl bg-cyan-50 dark:bg-cyan-500/10 text-cyan-600 dark:text-cyan-400 flex items-center justify-center shrink-0 border border-cyan-200 dark:border-cyan-500/20 text-xl transition-colors duration-300"
                aria-hidden="true">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="flex-1 w-full">
                <p class="text-sm text-gray-600 dark:text-gray-400 transition-colors duration-300">
                    Has escrito una reseña para <span
                        class="text-gray-900 dark:text-white font-bold text-base transition-colors duration-300">Hollow
                        Knight</span>.
                </p>
                <blockquote
                    class="mt-3 bg-gray-50 dark:bg-gray-950 border border-gray-200 dark:border-gray-800 rounded-xl p-4 text-xs italic text-gray-500 dark:text-gray-400 border-l-2 border-l-cyan-500 transition-colors duration-300">
                    "El mejor metroidvania que he jugado en la última década. El diseño de niveles es magistral."
                </blockquote>
            </div>
            <span
                class="text-xs text-gray-500 font-bold uppercase tracking-wider shrink-0 transition-colors duration-300">Hace
                2 días</span>
        </article>
    </div>
</section>
