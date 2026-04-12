<section aria-labelledby="tendencias-heading">
    <div class="flex justify-between items-end mb-6">
        <h2 id="tendencias-heading"
            class="text-2xl font-black flex items-center gap-2 text-gray-900 dark:text-white transition-colors duration-300">
            <i class="fa-solid fa-fire text-orange-500" aria-hidden="true"></i> Tendencias de la Semana
        </h2>
        <a href="{{ route('allGames') }}"
            class="text-sm text-cyan-600 dark:text-cyan-400 font-bold hover:text-cyan-800 dark:hover:text-cyan-300 transition-colors duration-300 focus:outline-none focus:underline">
            Ver catálogo completo
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-4 justify-items-center"
        role="list">

        @foreach ($popularGames as $item)
            <div role="listitem">
                <a href="{{ route('games.show', $item->slug) }}"
                    class="block w-[203px] relative aspect-[4/5] rounded-xl overflow-hidden group border border-gray-200 dark:border-gray-800 hover:border-cyan-500 dark:hover:border-cyan-500 transition shadow-md dark:shadow-lg focus:outline-none focus:ring-4 focus:ring-cyan-500">
                    <img src="{{ $item->cover_url }}" alt="Portada del juego {{ $item->title }}" loading="lazy"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />

                    <div class="absolute top-2 right-2">
                        <span
                            class="bg-gray-900/90 backdrop-blur text-cyan-400 font-black text-sm px-2 py-0.5 rounded-lg border border-gray-700 shadow-lg drop-shadow-md"
                            aria-label="Valoración: {{ $item->rating }}">
                            {{ $item->rating }}
                        </span>
                    </div>

                    <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/40 to-transparent flex flex-col justify-end p-3 pointer-events-none"
                        aria-hidden="true">
                        <h3 class="font-bold text-xs leading-tight text-white drop-shadow-md line-clamp-2">
                            {{ $item->title }}
                        </h3>
                    </div>
                </a>
            </div>
        @endforeach

        <div role="listitem">
            <a href="{{ route('allGames') }}"
                class="w-[203px] relative aspect-[3/4] rounded-xl overflow-hidden group border border-gray-200 dark:border-gray-800 flex flex-col items-center justify-center bg-gray-50 dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 transition shadow-md dark:shadow-lg focus:outline-none focus:ring-4 focus:ring-cyan-500">
                <i class="fa-solid fa-arrow-right text-2xl text-gray-400 dark:text-gray-500 mb-2 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300"
                    aria-hidden="true"></i>
                <span
                    class="font-bold text-xs text-gray-500 dark:text-gray-400 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300">
                    Ver más
                </span>
            </a>
        </div>
    </div>
</section>
