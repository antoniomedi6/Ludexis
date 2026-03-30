<section>
    <div class="flex justify-between items-end mb-6">
        <h2
            class="text-2xl font-black flex items-center gap-2 text-gray-900 dark:text-white transition-colors duration-300">
            <i class="fa-solid fa-fire text-orange-500"></i> Tendencias de la Semana
        </h2>
        <a href="{{ route('allGames') }}"
            class="text-sm text-cyan-600 dark:text-cyan-400 font-bold hover:text-cyan-800 dark:hover:text-cyan-300 transition-colors duration-300">
            Ver catálogo completo
        </a>
    </div>

    <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-4 justify-items-center">
        @foreach ($popularGames as $item)
            <a href="{{ route('games.show', $item->slug) }}"
                class="w-[203px] relative aspect-[4/5] rounded-xl overflow-hidden group border border-gray-200 dark:border-gray-800 hover:border-cyan-500 dark:hover:border-cyan-500 transition shadow-md dark:shadow-lg">
                <img src="{{ $item->cover_url }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />

                <div class="absolute top-2 right-2">
                    <span
                        class="bg-[#0f1117]/90 backdrop-blur text-cyan-400 font-black text-sm px-2 py-0.5 rounded-lg border border-gray-700 shadow-lg drop-shadow-md">
                        {{ $item->rating }}
                    </span>
                </div>

                <div
                    class="absolute inset-0 bg-gradient-to-t from-[#0f1117] via-[#0f1117]/40 to-transparent flex flex-col justify-end p-3 pointer-events-none">
                    <h3 class="font-bold text-xs leading-tight text-white drop-shadow-md">
                        {{ $item->title }}
                    </h3>
                </div>
            </a>
        @endforeach

        <a href="{{ route('allGames') }}"
            class="w-[203px] relative aspect-[3/4] rounded-xl overflow-hidden group border border-gray-200 dark:border-gray-800 flex flex-col items-center justify-center bg-gray-50 dark:bg-[#1a1d27] hover:bg-gray-100 dark:hover:bg-[#222634] transition shadow-md dark:shadow-lg">
            <i
                class="fa-solid fa-arrow-right text-2xl text-gray-400 dark:text-gray-500 mb-2 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300"></i>
            <span
                class="font-bold text-xs text-gray-500 dark:text-gray-400 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300">Ver
                más</span>
        </a>
    </div>
</section>
