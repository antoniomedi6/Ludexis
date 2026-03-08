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

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach ($popularGames as $item)
            <a href="#"
                class="relative aspect-[3/4] rounded-xl overflow-hidden group border border-gray-200 dark:border-gray-800 hover:border-cyan-500 dark:hover:border-cyan-500 transition shadow-md dark:shadow-lg">
                <img src="{{ $item->cover_url }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-[#0f1117] via-[#0f1117]/40 to-transparent flex flex-col justify-end p-3">
                    <span
                        class="text-xl font-black text-cyan-400 mb-0.5 drop-shadow-md">{{ $item->weighted_score }}</span>
                    <h3 class="font-bold text-xs leading-tight text-white drop-shadow-md">
                        {{ $item->title }}
                    </h3>
                </div>
            </a>
        @endforeach

        <a href="{{ route('allGames') }}"
            class="relative aspect-[3/4] rounded-xl overflow-hidden group border border-gray-200 dark:border-gray-800 flex flex-col items-center justify-center bg-gray-50 dark:bg-[#1a1d27] hover:bg-gray-100 dark:hover:bg-[#222634] transition shadow-md dark:shadow-lg">
            <i
                class="fa-solid fa-arrow-right text-2xl text-gray-400 dark:text-gray-500 mb-2 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300"></i>
            <span
                class="font-bold text-xs text-gray-500 dark:text-gray-400 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300">Ver
                más</span>
        </a>
    </div>
</section>
