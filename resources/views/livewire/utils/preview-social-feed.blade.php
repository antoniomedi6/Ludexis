<div class="xl:col-span-4 flex flex-col h-full gap-8">
    <section
        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-8 flex flex-col shadow-xl transition-colors duration-300"
        aria-labelledby="social-feed-heading">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-8">
            <h2 id="social-feed-heading"
                class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest transition-colors duration-300">
                Feed Social
            </h2>
        </div>

        {{-- FEED --}}
        <div class="flex flex-col gap-8" role="feed">
            @forelse ($activities as $activity)

                @if ($activity->type === 'review')
                    {{-- ACTIVIDAD: RESEÑA --}}
                    <article class="flex gap-4 group" aria-labelledby="feed-user-{{ $loop->index }}">
                        <img src="{{ $activity->game->cover_url }}" alt="Portada de {{ $activity->game->title }}"
                            class="w-10 h-10 rounded-xl object-cover border border-gray-200 dark:border-gray-700 shrink-0 transition-colors duration-300"
                            loading="lazy" />
                        <div class="flex-1">
                            <p
                                class="text-sm text-gray-600 dark:text-gray-400 leading-snug transition-colors duration-300">
                                <a id="feed-user-{{ $loop->index }}" href="{{ route('profile', $activity->user) }}"
                                    class="text-gray-900 dark:text-white font-bold transition-colors hover:text-cyan-500">{{ $activity->user->name }}</a>
                                ha puntuado
                                <a href="{{ route('games.show', $activity->game->slug) }}"
                                    class="text-gray-900 dark:text-white font-bold transition-colors duration-300 hover:text-cyan-500">{{ $activity->game->title }}</a>
                            </p>

                            <x-miscomponentes.star-rating :value10="$activity->rating" class="text-cyan-500 mt-1.5 mb-2" />

                            @if ($activity->review)
                                <blockquote
                                    class="text-xs text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-950 p-3 rounded-lg border border-gray-200 dark:border-gray-800 transition-colors duration-300 line-clamp-2">
                                    {{ $activity->review }}
                                </blockquote>
                            @endif
                            <time datetime="{{ $activity->date }}"
                                class="text-xs text-gray-500 font-bold uppercase tracking-wider block mt-3">
                                {{ \Carbon\Carbon::parse($activity->date)->diffForHumans() }}
                            </time>
                        </div>
                    </article>
                @elseif ($activity->type === 'wishlist')
                    {{-- ACTIVIDAD: LISTA DE DESEOS --}}
                    <article class="flex gap-4 group" aria-labelledby="feed-user-{{ $loop->index }}">
                        <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800/30 flex items-center justify-center shrink-0 transition-colors duration-300"
                            aria-hidden="true">
                            <i
                                class="fa-solid fa-ghost text-purple-600 dark:text-purple-500 text-sm transition-colors duration-300"></i>
                        </div>
                        <div class="flex-1 flex flex-col justify-center">
                            <p
                                class="text-sm text-gray-600 dark:text-gray-400 leading-snug transition-colors duration-300">
                                <a id="feed-user-{{ $loop->index }}" href="{{ route('profile', $activity->user) }}"
                                    class="text-gray-900 dark:text-white font-bold transition-colors hover:text-purple-600 dark:hover:text-purple-400">
                                    {{ $activity->user->name }}
                                </a>
                                añadió <a href="{{ route('games.show', $activity->game->slug) }}"
                                    class="text-gray-900 dark:text-white font-bold transition-colors duration-300 hover:text-purple-600 dark:hover:text-purple-400">
                                    {{ $activity->game->title }}
                                </a>
                                a sus pendientes
                            </p>
                            <time datetime="{{ $activity->date }}"
                                class="text-xs text-gray-500 font-bold uppercase tracking-wider block mt-2">
                                {{ \Carbon\Carbon::parse($activity->date)->diffForHumans() }}
                            </time>
                        </div>
                    </article>
                @elseif ($activity->type === 'capture')
                    {{-- ACTIVIDAD: CAPTURA --}}
                    <article class="flex gap-4 group" aria-labelledby="feed-user-{{ $loop->index }}">
                        <img src="{{ $activity->game->cover_url }}" alt="Portada de {{ $activity->game->title }}"
                            class="w-10 h-10 rounded-xl object-cover border border-gray-200 dark:border-gray-700 shrink-0 transition-colors duration-300"
                            loading="lazy" />
                        <div class="flex-1">
                            <p
                                class="text-sm text-gray-600 dark:text-gray-400 leading-snug transition-colors duration-300">
                                <a id="feed-user-{{ $loop->index }}" href="{{ route('profile', $activity->user) }}"
                                    class="text-gray-900 dark:text-white font-bold transition-colors hover:text-cyan-500">
                                    {{ $activity->user->name }}
                                </a>
                                subió una captura de <a href="{{ route('games.show', $activity->game->slug) }}"
                                    class="text-gray-900 dark:text-white font-bold transition-colors hover:text-cyan-500">
                                    {{ $activity->game->title }}
                                </a>.
                            </p>

                            <button type="button" x-data
                                @click="$dispatch('open-image-detail', { imageId: {{ $activity->id }} })"
                                @keydown.enter="$dispatch('open-image-detail', { imageId: {{ $activity->id }} })"
                                class="mt-3 relative rounded-xl overflow-hidden border border-gray-200 dark:border-gray-800 aspect-video cursor-pointer transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 group"
                                aria-label="Ver captura en grande">
                                <img src="{{ Storage::url($activity->image_path) }}"
                                    alt="Captura de pantalla de {{ $activity->game->title }} subida por {{ $activity->user->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                    loading="lazy" />
                            </button>

                            <time datetime="{{ $activity->date }}"
                                class="text-xs text-gray-500 font-bold uppercase tracking-wider block mt-3">
                                {{ \Carbon\Carbon::parse($activity->date)->diffForHumans() }}
                            </time>
                        </div>
                    </article>
                @endif

            @empty
                {{-- SIN RESULTADOS --}}
                <output class="flex flex-col items-center justify-center py-6 text-center" aria-live="polite">
                    <i class="fa-solid fa-wind text-gray-300 dark:text-gray-700 text-3xl mb-2" aria-hidden="true"></i>
                    @if (!$hasFollowings)
                        <p class="text-sm text-gray-500 font-bold">Sigue a usuarios para ver su actividad.</p>
                    @else
                        <p class="text-sm text-gray-500 font-bold">Aún no hay actividad social.</p>
                    @endif
                </output>
            @endforelse
        </div>

        {{-- ENLACE A FEED SOCIAL COMPLETO --}}
        <a href="{{ route('social') }}"
            class="w-full mt-6 py-3 border text-center border-gray-200 dark:border-gray-800 rounded-xl text-xs font-black uppercase tracking-widest text-cyan-600 dark:text-cyan-500 bg-gray-50 hover:bg-gray-100 dark:bg-transparent dark:hover:bg-gray-800 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500">
            Ver toda la actividad
        </a>
    </section>
</div>
