<div class="w-full">
    <x-miscomponentes.page-layout title1="Ludexis" title2="Feed"
        subtitle="Descubre a qué están jugando tus amigos y comparte tus momentos.">

        {{-- FILTROS --}}
        <x-slot:aside>
            <div class="flex gap-2 bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-xl p-1 shrink-0"
                role="group" aria-label="Filtros del feed">

                <button type="button" aria-pressed="true"
                    class="px-5 py-2.5 rounded-lg bg-gray-100 dark:bg-darkbox-main text-brand font-black text-xs uppercase tracking-widest shadow inline-flex items-center gap-2 focus:outline-none focus:ring-2 focus:ring-brand">
                    <i class="fa-solid fa-globe" aria-hidden="true"></i> Global
                </button>

                <button type="button" aria-disabled="true" tabindex="-1"
                    title="Próximamente: necesitas seguir a otros jugadores"
                    class="px-5 py-2.5 rounded-lg text-gray-400 dark:text-gray-600 font-black text-xs uppercase tracking-widest cursor-not-allowed inline-flex items-center gap-2">
                    <i class="fa-solid fa-user-group" aria-hidden="true"></i>
                    Siguiendo
                    <span
                        class="text-xs bg-gray-200 dark:bg-darkbox-border text-gray-500 dark:text-gray-400 px-1.5 py-0.5 rounded font-black uppercase tracking-widest">
                        Pronto
                    </span>
                </button>
            </div>
        </x-slot:aside>

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-10 w-full">

            {{-- COLUMNA PRINCIPAL --}}
            <section class="xl:col-span-8 flex flex-col gap-8" aria-labelledby="feed-heading">
                <h2 id="feed-heading" class="sr-only">Reseñas recientes de la comunidad</h2>

                @if ($userReviews->isEmpty())
                    {{-- SIN RESULTADOS --}}
                    <div class="flex flex-col items-center justify-center py-20 px-6 border-2 border-dashed border-gray-300 dark:border-darkbox-border rounded-3xl bg-white/50 dark:bg-darkbox-card/50 text-center"
                        role="status">
                        <div class="mb-6 bg-gray-100 dark:bg-darkbox-main w-20 h-20 flex items-center justify-center rounded-full border border-gray-200 dark:border-darkbox-border shadow-sm"
                            aria-hidden="true">
                            <i class="fa-solid fa-comment-slash text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-black text-gray-900 dark:text-white mb-2">
                            Aún no hay reseñas
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 font-medium max-w-md">
                            Sé la primera persona en compartir una opinión sobre tus juegos favoritos.
                        </p>
                    </div>
                @else
                    <div class="flex flex-col gap-8" role="feed" aria-label="Feed de reseñas">

                        @foreach ($userReviews as $item)
                            {{-- REVIEW CARD --}}
                            <article aria-labelledby="review-user-{{ $item->id }}"
                                class="bg-white dark:bg-darkbox-card/80 backdrop-blur-xl border border-gray-200 dark:border-darkbox-border rounded-3xl overflow-hidden shadow-xl hover:border-gray-300 dark:hover:border-gray-700 transition-colors">

                                <div class="p-6 flex items-start gap-4">
                                    <a href="{{ route('profile', $item->user->id) }}"
                                        class="shrink-0 focus:outline-none focus:ring-2 focus:ring-brand rounded-full">
                                        <img src="{{ $item->user->profile_photo_url }}"
                                            alt="Avatar de {{ $item->user->name }}" loading="lazy"
                                            class="w-12 h-12 rounded-full object-cover border-2 border-white dark:border-darkbox-border shadow-lg" />
                                    </a>

                                    <div class="flex-1 flex flex-col min-w-0">
                                        <div class="flex items-center justify-between gap-2 mb-1">
                                            <a href="{{ route('profile', $item->user->id) }}"
                                                class="focus:outline-none focus:underline truncate">
                                                <h3 id="review-user-{{ $item->id }}"
                                                    class="text-base font-bold text-gray-900 dark:text-white hover:text-brand transition-colors truncate">
                                                    {{ $item->user->name }}
                                                </h3>
                                            </a>
                                            <time datetime="{{ $item->created_at->toIso8601String() }}"
                                                class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider shrink-0">
                                                {{ $item->created_at->diffForHumans() }}
                                            </time>
                                        </div>

                                        <div class="flex items-center gap-2 mb-4 flex-wrap">
                                            <span
                                                class="text-xs bg-cyan-50 dark:bg-cyan-900/30 text-brand dark:text-cyan-400 border border-cyan-200 dark:border-cyan-500/30 px-2 py-0.5 rounded-md font-bold uppercase tracking-widest">
                                                Reseña
                                            </span>
                                            @if ($item->user->role && $item->user->role !== 'user')
                                                <span
                                                    class="text-xs bg-gray-100 dark:bg-darkbox-main text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-darkbox-border px-2 py-0.5 rounded-md font-bold uppercase tracking-widest">
                                                    {{ $item->user->roleLabel() }}
                                                </span>
                                            @endif
                                        </div>

                                        {{-- GAME CARD --}}
                                        <div
                                            class="bg-gray-50 dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border rounded-3xl p-5 mb-4 flex flex-col sm:flex-row gap-5 group shadow-sm">

                                            <a href="{{ route('games.show', $item->game->slug) }}"
                                                class="shrink-0 focus:outline-none focus:ring-2 focus:ring-brand rounded-xl"
                                                aria-label="Ver ficha de {{ $item->game->title }}">
                                                <img src="{{ $item->game->cover_url }}"
                                                    alt="Portada de {{ $item->game->title }}" loading="lazy"
                                                    class="w-full sm:w-24 h-48 sm:h-36 object-cover rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-300" />
                                            </a>

                                            <div class="flex flex-1 justify-between items-start gap-4 min-w-0">
                                                <div class="flex flex-col min-w-0">
                                                    <a href="{{ route('games.show', $item->game->slug) }}"
                                                        class="focus:outline-none focus:underline">
                                                        <h4
                                                            class="text-xl font-black text-gray-900 dark:text-white leading-tight mb-2 hover:text-brand transition-colors line-clamp-2">
                                                            {{ $item->game->title }}
                                                        </h4>
                                                    </a>
                                                    <p
                                                        class="text-sm text-gray-600 dark:text-gray-400 italic line-clamp-3">
                                                        “{{ $item->review }}”
                                                    </p>
                                                </div>

                                                <div class="flex flex-col items-end gap-3 shrink-0">
                                                    @if ($item->rating > 0)
                                                        @php
                                                            $rating_5 = $item->rating / 2;
                                                        @endphp
                                                        <div class="flex items-center gap-1 text-yellow-500 dark:text-yellow-400 text-xs bg-white dark:bg-darkbox-card px-2.5 py-1.5 rounded-xl border border-gray-200 dark:border-darkbox-border shadow-sm"
                                                            aria-label="Valoración: {{ number_format($rating_5, 1) }} sobre 5 estrellas">
                                                            <span
                                                                class="font-bold text-gray-700 dark:text-gray-300 mr-1">{{ number_format($rating_5, 1) }}</span>
                                                            <x-icons.star class="w-4 h-4 text-brand"
                                                                aria-hidden="true" />
                                                        </div>
                                                    @endif

                                                    {{-- LIKE --}}
                                                    <livewire:utils.like-button :model="$item" :key="'feed-like-' . $item->id" />

                                                    {{-- REPORT --}}
                                                    <livewire:utils.report-button :model="$item" :key="'feed-report-' . $item->id" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{-- CARGAR MÁS --}}
                    @if ($totalCount > $userReviews->count())
                        <div class="flex justify-center mt-2">
                            <button type="button" wire:click="loadMore" wire:loading.attr="disabled"
                                wire:target="loadMore"
                                class="flex items-center justify-center gap-2 px-6 py-3 rounded-xl border border-gray-200 dark:border-darkbox-border bg-white dark:bg-darkbox-card hover:bg-gray-50 dark:hover:bg-darkbox-main text-xs font-black uppercase tracking-widest text-brand transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-brand w-full sm:w-auto">
                                <span wire:loading.remove wire:target="loadMore" class="inline-flex items-center gap-2">
                                    <i class="fa-solid fa-chevron-down" aria-hidden="true"></i> Cargar más reseñas
                                </span>
                                <span wire:loading wire:target="loadMore" class="inline-flex items-center gap-2">
                                    <i class="fa-solid fa-circle-notch fa-spin" aria-hidden="true"></i> Cargando...
                                </span>
                            </button>
                        </div>
                    @endif
                @endif
            </section>

            {{-- TENDENCIAS --}}
            <aside class="xl:col-span-4 flex flex-col gap-8" aria-labelledby="tendencias-heading">
                <div
                    class="bg-white dark:bg-darkbox-card/80 backdrop-blur-2xl border border-gray-200 dark:border-darkbox-border rounded-3xl p-8 shadow-xl dark:shadow-2xl">
                    <h2 id="tendencias-heading"
                        class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-6 flex items-center gap-3">
                        <i class="fa-solid fa-fire text-orange-500" aria-hidden="true"></i> Tendencias
                    </h2>

                    @if ($trending->isEmpty())
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">
                            Aún no hay juegos en tendencia. Cuando la comunidad publique reseñas, aparecerán aquí.
                        </p>
                    @else
                        <ol class="flex flex-col gap-4" aria-label="Top 5 juegos con más reseñas">
                            @foreach ($trending as $trendingGame)
                                <li>
                                    <a href="{{ route('games.show', $trendingGame->slug) }}"
                                        class="flex items-center gap-4 group bg-gray-50 dark:bg-darkbox-main p-3 rounded-2xl border border-gray-200 dark:border-darkbox-border transition-colors hover:border-brand focus:outline-none focus:ring-2 focus:ring-brand">
                                        <span @class([
                                            'text-xl font-black w-6 text-center bg-clip-text text-transparent',
                                            'bg-gradient-to-b from-yellow-400 to-yellow-600' => $loop->iteration === 1,
                                            'bg-gradient-to-b from-gray-300 to-gray-500' => $loop->iteration === 2,
                                            'bg-gradient-to-b from-orange-400 to-orange-700' => $loop->iteration === 3,
                                            'bg-gradient-to-b from-gray-400 to-gray-600' => $loop->iteration > 3,
                                        ])
                                            aria-label="Top {{ $loop->iteration }}">{{ $loop->iteration }}</span>

                                        <img src="{{ $trendingGame->cover_url }}"
                                            alt="Portada de {{ $trendingGame->title }}" loading="lazy"
                                            class="w-10 h-14 object-cover rounded shadow border border-gray-200 dark:border-darkbox-border" />

                                        <div class="flex-1 overflow-hidden">
                                            <h3
                                                class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-brand dark:group-hover:text-cyan-400 transition-colors truncate">
                                                {{ $trendingGame->title }}
                                            </h3>
                                            <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">
                                                {{ $trendingGame->reviews_count }}
                                                {{ $trendingGame->reviews_count === 1 ? 'Reseña' : 'Reseñas' }}
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    @endif
                </div>
            </aside>

        </div>
    </x-miscomponentes.page-layout>
</div>
