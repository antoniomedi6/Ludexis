@if (isset($gameId))
    <div class="col-span-full space-y-4 w-full mt-8" aria-labelledby="opinions-heading">
        <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 pb-3">
            <h2 id="opinions-heading"
                class="text-xl font-black flex items-center gap-2 text-gray-900 dark:text-white transition-colors duration-300">
                <i class="fa-solid fa-comment-dots text-cyan-500" aria-hidden="true"></i> Opiniones
            </h2>
            @if (!$reviews->isEmpty())
                <span class="text-xs font-bold text-gray-500 uppercase tracking-widest" aria-label="Total de opiniones">
                    {{ count($reviews) }} {{ count($reviews) === 1 ? 'Reseña' : 'Reseñas' }}
                </span>
            @endif
        </div>

        @if ($reviews->isEmpty())
            <div class="flex flex-col items-center justify-center py-8 px-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-sm text-center"
                role="status">
                <h3 class="text-sm font-black text-gray-900 dark:text-white mb-1">Aún no hay reseñas</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Sé el primero en compartir tu
                    experiencia.</p>
            </div>
        @else
            <div class="space-y-4" role="feed" aria-label="Lista de opiniones">
                @foreach ($reviews as $item)
                    <article
                        class="bg-white dark:bg-gray-900 p-4 md:p-5 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm flex flex-col gap-3 group">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center gap-3">
                                <img src="{{ $item->user->profile_photo_url }}" alt="Avatar de {{ $item->user->name }}"
                                    loading="lazy"
                                    class="w-10 h-10 rounded-full object-cover border border-gray-200 dark:border-gray-700" />
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold text-sm text-gray-900 dark:text-white leading-none">
                                            {{ $item->user->name }}
                                        </h4>
                                        <span
                                            class="text-xs bg-cyan-50 dark:bg-cyan-900/30 text-cyan-700 dark:text-cyan-400 px-1.5 py-0.5 rounded font-black uppercase tracking-widest border border-cyan-200 dark:border-cyan-800/50 shadow-sm">
                                            {{ $item->user->role ?? 'Jugador' }}
                                        </span>
                                    </div>
                                    <time datetime="{{ $item->updated_at }}"
                                        class="block mt-1 text-xs text-gray-500 font-bold uppercase tracking-widest">
                                        {{ $item->updated_at }}
                                    </time>
                                </div>
                            </div>
                            <div class="flex items-center gap-1.5 bg-gray-50 dark:bg-gray-950 px-2.5 py-1 rounded-lg border border-gray-200 dark:border-gray-800"
                                aria-label="Nota: {{ $item->rating }}">
                                <span class="text-sm font-black text-cyan-700 dark:text-cyan-400" aria-hidden="true">
                                    {{ $item->rating }}
                                </span>
                                <i class="fa-solid fa-star text-xs text-cyan-500" aria-hidden="true"></i>
                            </div>
                        </div>
                        <blockquote class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed italic">
                            "{{ $item->review }}"
                        </blockquote>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
@else
    {{-- MODO RESEÑAS DESTACADAS --}}
    <div class="lg:col-span-2 space-y-6" aria-labelledby="featured-reviews-heading">
        <div class="col-span-full space-y-4 w-full mt-8">
            <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 pb-3">
                <h2 id="featured-reviews-heading"
                    class="text-2xl font-black flex items-center gap-2 text-gray-900 dark:text-white transition-colors duration-300">
                    <i class="fa-solid fa-star text-indigo-500" aria-hidden="true"></i> Reseñas Destacadas
                </h2>
                @if (!$reviews->isEmpty())
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-widest">
                        {{ count($reviews) }} {{ count($reviews) === 1 ? 'Reseña' : 'Reseñas' }}
                    </span>
                @endif
            </div>

            @if ($reviews->isEmpty())
                <div class="flex flex-col items-center justify-center py-8 px-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-sm text-center"
                    role="status">
                    <h3 class="text-sm font-black text-gray-900 dark:text-white mb-1">Aún no hay reseñas</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Sé el primero en compartir tu
                        experiencia.</p>
                </div>
            @else
                <div class="space-y-4" role="feed" aria-label="Lista de reseñas destacadas">
                    @foreach ($reviews as $item)
                        <article
                            class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-md dark:shadow-lg hover:border-indigo-400 dark:hover:border-indigo-500/50 transition-all duration-300 flex flex-col sm:flex-row gap-6">

                            <div
                                class="w-24 h-32 bg-gray-100 dark:bg-gray-900 rounded-lg shrink-0 border border-gray-200 dark:border-gray-600 overflow-hidden shadow-sm dark:shadow-md hidden sm:block">
                                <a href="{{ route('games.show', $item->game->slug) }}" tabindex="-1">
                                    <img src="{{ $item->game->cover_url }}" loading="lazy"
                                        class="w-full h-full object-cover hover:scale-105 transition duration-500"
                                        alt="Portada de {{ $item->game->title }}" />
                                </a>
                            </div>

                            <div class="flex-1 flex flex-col gap-3">
                                <div class="flex justify-between items-start">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $item->user->profile_photo_url }}"
                                            alt="Avatar de {{ $item->user->name }}" loading="lazy"
                                            class="w-10 h-10 rounded-full object-cover border border-gray-200 dark:border-gray-700" />
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <h3
                                                    class="font-bold text-sm text-gray-900 dark:text-white transition-colors duration-300">
                                                    {{ $item->user->name }}
                                                </h3>
                                                <span
                                                    class="text-xs bg-indigo-100 text-indigo-700 dark:bg-indigo-600 dark:text-white px-1.5 py-0.5 rounded font-black uppercase shadow-sm transition-colors duration-300">
                                                    {{ $item->user->role ?? 'Jugador' }}
                                                </span>
                                            </div>
                                            <time datetime="{{ $item->updated_at }}"
                                                class="block mt-1 text-xs text-gray-500 font-bold uppercase tracking-widest">
                                                {{ $item->updated_at }}
                                            </time>
                                            <p
                                                class="text-xs text-gray-600 dark:text-gray-400 font-bold uppercase mt-0.5 transition-colors duration-300">
                                                Sobre <a href="{{ route('games.show', $item->game->slug) }}"
                                                    class="text-indigo-600 dark:text-indigo-300 hover:underline">{{ $item->game->title }}</a>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-1.5 bg-gray-50 dark:bg-gray-950 px-2.5 py-1 rounded-lg border border-gray-200 dark:border-gray-800"
                                        aria-label="Valoración: {{ $item->rating }}">
                                        <span class="text-sm font-black text-cyan-700 dark:text-cyan-400"
                                            aria-hidden="true">
                                            {{ $item->rating }}
                                        </span>
                                        <i class="fa-solid fa-star text-xs text-cyan-500" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <blockquote
                                    class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed italic transition-colors duration-300">
                                    "{{ $item->review }}"
                                </blockquote>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endif
