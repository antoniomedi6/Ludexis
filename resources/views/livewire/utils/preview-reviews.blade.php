@if (isset($gameId))
    <div class="col-span-full space-y-4 w-full mt-8">
        <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 pb-3">
            <h2
                class="text-xl font-black flex items-center gap-2 text-gray-900 dark:text-white transition-colors duration-300">
                <i class="fa-solid fa-comment-dots text-cyan-500"></i> Opiniones
            </h2>
            @if (!$reviews->isEmpty())
                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                    {{ count($reviews) }} {{ count($reviews) === 1 ? 'Reseña' : 'Reseñas' }}
                </span>
            @endif
        </div>

        @if ($reviews->isEmpty())
            <div
                class="flex flex-col items-center justify-center py-8 px-4 bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-2xl shadow-sm text-center">
                <h3 class="text-sm font-black text-gray-900 dark:text-white mb-1">Aún no hay reseñas</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Sé el primero en compartir tu
                    experiencia.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($reviews as $item)
                    <div
                        class="bg-white dark:bg-[#151821] p-4 md:p-5 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm flex flex-col gap-3 group">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center gap-3">
                                <img src="{{ $item->user->profile_photo_url }}" alt="{{ $item->user->name }}"
                                    class="w-10 h-10 rounded-full object-cover border border-gray-200 dark:border-gray-700" />
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold text-sm text-gray-900 dark:text-white leading-none">
                                            {{ $item->user->name }}
                                        </h4>
                                        <span
                                            class="text-[8px] bg-cyan-50 dark:bg-cyan-900/30 text-cyan-600 dark:text-cyan-400 px-1.5 py-0.5 rounded font-black uppercase tracking-widest border border-cyan-200 dark:border-cyan-800/50">
                                            {{ $item->user->role ?? 'Jugador' }}
                                        </span>
                                    </div>
                                    <span
                                        class="block mt-1 text-[9px] text-gray-400 font-bold uppercase tracking-widest">
                                        {{ $item->updated_at }}
                                    </span>
                                </div>
                            </div>
                            <div
                                class="flex items-center gap-1.5 bg-gray-50 dark:bg-[#0f1117] px-2.5 py-1 rounded-lg border border-gray-200 dark:border-gray-800">
                                <span class="text-sm font-black text-cyan-600 dark:text-cyan-400">
                                    {{ $item->rating }}
                                </span>
                                <i class="fa-solid fa-star text-[10px] text-cyan-500"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed italic">
                            "{{ $item->review }}"
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@else
    <div class="lg:col-span-2 space-y-6">
        <div class="col-span-full space-y-4 w-full mt-8">
            <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 pb-3">
                <h2
                    class="text-2xl font-black flex items-center gap-2 text-gray-900 dark:text-white transition-colors duration-300">
                    <i class="fa-solid fa-star text-indigo-500"></i> Reseñas Destacadas
                </h2>
                @if (!$reviews->isEmpty())
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                        {{ count($reviews) }} {{ count($reviews) === 1 ? 'Reseña' : 'Reseñas' }}
                    </span>
                @endif
            </div>

            @if ($reviews->isEmpty())
                <div
                    class="flex flex-col items-center justify-center py-8 px-4 bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-2xl shadow-sm text-center">
                    <h3 class="text-sm font-black text-gray-900 dark:text-white mb-1">Aún no hay reseñas</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Sé el primero en compartir tu
                        experiencia.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach ($reviews as $item)
                        <div
                            class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-md dark:shadow-lg hover:border-indigo-400 dark:hover:border-indigo-500/50 transition-all duration-300 flex flex-col sm:flex-row gap-6">

                            <div
                                class="w-24 h-32 bg-gray-100 dark:bg-gray-900 rounded-lg shrink-0 border border-gray-200 dark:border-gray-600 overflow-hidden shadow-sm dark:shadow-md hidden sm:block">
                                <a href="{{ route('games.show', $item->game->slug) }}">
                                    <img src="{{ $item->game->cover_url }}"
                                        class="w-full h-full object-cover hover:scale-105 transition duration-500"
                                        alt="Portada de {{ $item->game->title }}" />
                                </a>
                            </div>

                            <div class="flex-1 flex flex-col gap-3">
                                <div class="flex justify-between items-start">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $item->user->profile_photo_url }}" alt="{{ $item->user->name }}"
                                            class="w-10 h-10 rounded-full object-cover border border-gray-200 dark:border-gray-700" />
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <h4
                                                    class="font-bold text-sm text-gray-900 dark:text-white transition-colors duration-300">
                                                    {{ $item->user->name }}
                                                </h4>
                                                <span
                                                    class="text-[9px] bg-indigo-100 text-indigo-700 dark:bg-indigo-600 dark:text-white px-1.5 py-0.5 rounded font-black uppercase shadow-sm transition-colors duration-300">
                                                    {{ $item->user->role ?? 'Jugador' }}
                                                </span>
                                            </div>
                                            <span
                                                class="block mt-1 text-[9px] text-gray-400 font-bold uppercase tracking-widest">
                                                {{ $item->updated_at }}
                                            </span>
                                            <p
                                                class="text-[10px] text-gray-500 dark:text-gray-400 font-bold uppercase mt-0.5 transition-colors duration-300">
                                                Sobre <span
                                                    class="text-indigo-600 dark:text-indigo-300">{{ $item->game->title }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-center gap-1.5 bg-gray-50 dark:bg-[#0f1117] px-2.5 py-1 rounded-lg border border-gray-200 dark:border-gray-800">
                                        <span class="text-sm font-black text-cyan-600 dark:text-cyan-400">
                                            {{ $item->rating }}
                                        </span>
                                        <i class="fa-solid fa-star text-[10px] text-cyan-500"></i>
                                    </div>
                                </div>

                                <p
                                    class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed italic transition-colors duration-300">
                                    "{{ $item->review }}"
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endif
