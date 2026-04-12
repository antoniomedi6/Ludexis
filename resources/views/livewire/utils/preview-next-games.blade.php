<section aria-labelledby="upcoming-games-heading">
    <div class="flex items-center justify-between mb-6">
        <h2 id="upcoming-games-heading"
            class="text-sm font-black text-gray-600 dark:text-gray-400 uppercase tracking-widest flex items-center gap-3 transition-colors duration-300">
            <i class="fa-solid fa-calendar-days text-cyan-600 dark:text-cyan-500" aria-hidden="true"></i> Próximos
            Lanzamientos
        </h2>
    </div>

    <div class="flex gap-4 overflow-x-auto hide-scrollbar pb-4 snap-x" role="list">
        @foreach ($nextGames as $game)
            <div class="min-w-[140px] snap-start" role="listitem">
                <a href="{{ route('games.show', $game->slug) }}"
                    class="block bg-white dark:bg-gray-900 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 group cursor-pointer shadow-xl transition-colors duration-300 focus:outline-none focus:ring-4 focus:ring-cyan-500">
                    <article class="relative aspect-[3/4] overflow-hidden">
                        <img src="{{ $game->cover_url }}" alt="Portada de {{ $game->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            loading="lazy" />
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 to-transparent opacity-80"
                            aria-hidden="true"></div>
                        <div class="absolute inset-x-0 bottom-0 p-4 flex flex-col items-center justify-end text-center">
                            <h3 class="text-sm font-black text-white leading-tight mb-2 drop-shadow-md line-clamp-2">
                                {{ $game->title }}
                            </h3>
                            <span
                                class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-md text-cyan-700 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-900/50 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider w-full transition-colors duration-300">
                                {{ $game->first_release_date ? \Carbon\Carbon::parse($game->first_release_date)->translatedFormat('d M Y') : 'Sin fecha de lanzamiento' }}
                            </span>
                        </div>
                    </article>
                </a>
            </div>
        @endforeach
    </div>
</section>
