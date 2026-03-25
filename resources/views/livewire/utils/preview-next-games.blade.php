<section>
    <div class="flex items-center justify-between mb-6">
        <h2
            class="text-sm font-black text-gray-600 dark:text-gray-400 uppercase tracking-widest flex items-center gap-3 transition-colors duration-300">
            <i class="fa-solid fa-calendar-days text-cyan-600 dark:text-cyan-500"></i> Próximos
            Lanzamientos
        </h2>
        {{-- 
        <a href="#"
            class="text-[10px] font-bold text-cyan-600 dark:text-cyan-400 uppercase tracking-widest hover:text-cyan-700 dark:hover:text-cyan-300 transition-colors duration-300">Ver
            Calendario
        </a>
         --}}
    </div>
    <div class="flex gap-4 overflow-x-auto hide-scrollbar pb-4 snap-x">
        @foreach ($nextGames as $game)
            <a href="{{ route('games.show', $game->slug) }}">
                <div
                    class="min-w-[140px] snap-start bg-white dark:bg-[#151821] rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 group cursor-pointer shadow-xl transition-colors duration-300">
                    <div class="relative aspect-[3/4] overflow-hidden">
                        <img src="{{ $game->cover_url }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 to-transparent opacity-80">
                        </div>
                        <div class="absolute inset-x-0 bottom-0 p-4 flex flex-col items-center justify-end text-center">
                            <h3 class="text-sm font-black text-white leading-tight mb-2 drop-shadow-md line-clamp-2">
                                {{ $game->title }}</h3>
                            <span
                                class="bg-white/90 dark:bg-[#1a1d27]/90 backdrop-blur-md text-cyan-700 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-900/50 px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider w-full transition-colors duration-300">{{ $game->first_release_date ? \Carbon\Carbon::parse($game->first_release_date)->translatedFormat('d M Y') : 'Sin fecha de lanzamiento' }}</span>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>
