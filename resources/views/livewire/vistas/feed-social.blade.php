<div class="w-full">
    <x-miscomponentes.page-layout title1="Ludexis" title2="Feed"
        subtitle="Descubre a qué están jugando tus amigos y comparte tus momentos.">

        {{-- ASIDE --}}
        <x-slot:aside>
            <div class="flex w-full flex-col sm:flex-row sm:items-center sm:justify-between gap-4"
                aria-label="Búsqueda y filtros del feed">
                {{-- BÚSQUEDA USUARIOS --}}
                <div class="w-full sm:flex-1 sm:min-w-0 sm:max-w-md order-1">
                    @livewire('utils.search-users')
                </div>

                {{-- TABS --}}
                @auth
                    <nav class="order-2 inline-flex p-1.5 bg-gray-100 dark:bg-darkbox-main/50 border border-gray-200 dark:border-darkbox-border rounded-2xl shadow-inner w-full sm:w-auto sm:shrink-0"
                        aria-label="Filtros del feed" wire:init="setFeedTab('followings')">

                        <div class="flex w-full gap-1" role="tablist" aria-label="Selección de feed">
                            <button type="button" wire:click="setFeedTab('followings')" role="tab"
                                aria-controls="feed-content" id="tab-followings"
                                aria-selected="{{ $feedTab === 'followings' ? 'true' : 'false' }}"
                                @class([
                                    'flex-1 sm:flex-none px-6 py-2.5 rounded-xl font-black text-xs uppercase tracking-widest inline-flex items-center justify-center gap-2 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 dark:focus:ring-offset-darkbox-card',
                                    'bg-white dark:bg-darkbox-card text-brand shadow-sm ring-1 ring-gray-200 dark:ring-darkbox-border' =>
                                        $feedTab === 'followings',
                                    'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-200/50 dark:hover:bg-darkbox-card/50' =>
                                        $feedTab !== 'followings',
                                ]) aria-label="Ver reseñas de usuarios que sigues">
                                <i class="fa-solid fa-user-group" aria-hidden="true"></i>
                                Siguiendo
                            </button>

                            <button type="button" wire:click="setFeedTab('relevant')" role="tab"
                                aria-controls="feed-content" id="tab-relevant"
                                aria-selected="{{ $feedTab === 'relevant' ? 'true' : 'false' }}"
                                @class([
                                    'flex-1 sm:flex-none px-6 py-2.5 rounded-xl font-black text-xs uppercase tracking-widest inline-flex items-center justify-center gap-2 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 dark:focus:ring-offset-darkbox-card',
                                    'bg-white dark:bg-darkbox-card text-brand shadow-sm ring-1 ring-gray-200 dark:ring-darkbox-border' =>
                                        $feedTab === 'relevant',
                                    'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-200/50 dark:hover:bg-darkbox-card/50' =>
                                        $feedTab !== 'relevant',
                                ]) aria-label="Ver reseñas más relevantes">
                                <i class="fa-solid fa-fire" aria-hidden="true"></i>
                                Relevante
                            </button>
                        </div>
                    </nav>
                @endauth

                @guest
                    <nav class="order-2 inline-flex p-1.5 bg-gray-100 dark:bg-darkbox-main/50 border border-gray-200 dark:border-darkbox-border rounded-2xl shadow-inner w-full sm:w-auto sm:shrink-0"
                        aria-label="Filtros del feed">
                        <div class="flex w-full gap-1" role="tablist">
                            <button type="button" wire:click="setFeedTab('relevant')" role="tab"
                                aria-controls="feed-content" id="tab-relevant-guest" aria-selected="true"
                                class="flex-1 sm:flex-none px-6 py-2.5 rounded-xl font-black text-xs uppercase tracking-widest inline-flex items-center justify-center gap-2 transition-all duration-300 bg-white dark:bg-darkbox-card text-brand shadow-sm ring-1 ring-gray-200 dark:ring-darkbox-border focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 dark:focus:ring-offset-darkbox-card"
                                aria-label="Ver reseñas más relevantes">
                                <i class="fa-solid fa-fire" aria-hidden="true"></i>
                                Relevante
                            </button>
                        </div>
                    </nav>
                @endguest
            </div>
        </x-slot:aside>

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 lg:gap-12 w-full mt-6">

            {{-- COLUMNA PRINCIPAL --}}
            <section id="feed-content" class="xl:col-span-8 flex flex-col gap-8" aria-labelledby="feed-heading"
                role="tabpanel" tabindex="-1">
                <h2 id="feed-heading" class="sr-only">Reseñas recientes de la comunidad</h2>

                @if ($userReviews->isEmpty())
                    {{-- SIN RESULTADOS --}}
                    <x-miscomponentes.empty-state title="El feed está muy tranquilo"
                        content="Sé la primera persona en romper el hielo compartiendo tu opinión sobre el último juego que has completado."
                        icon="fa-solid fa-comment-dots" aria-live="polite" />
                @else
                    <div class="flex flex-col gap-6" role="feed" aria-label="Feed de reseñas" aria-busy="false">

                        @foreach ($userReviews as $item)
                            <article aria-labelledby="review-user-{{ $item->id }}"
                                class="bg-white dark:bg-darkbox-card border border-gray-100 dark:border-darkbox-border rounded-[2rem] p-5 sm:p-7 shadow-sm hover:shadow-md transition-shadow duration-300">

                                <div class="flex gap-4 sm:gap-5">
                                    <div class="shrink-0">
                                        <a href="{{ route('profile', $item->user->id) }}"
                                            class="block focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 dark:focus:ring-offset-darkbox-card rounded-full"
                                            aria-label="Visitar perfil de {{ $item->user->name }}">
                                            <img src="{{ $item->user->profile_photo_url }}" alt=""
                                                loading="lazy" aria-hidden="true"
                                                class="w-12 h-12 sm:w-14 sm:h-14 rounded-full object-cover ring-1 ring-gray-200 dark:ring-darkbox-border shadow-sm" />
                                        </a>
                                    </div>

                                    <div class="flex-1 min-w-0 flex flex-col">

                                        <header class="mb-3">
                                            <div class="flex flex-wrap items-center gap-2 mb-2">
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
                                            <div class="flex items-start justify-between gap-2">
                                                <div class="min-w-0 flex-1 flex flex-col gap-1">
                                                    <div
                                                        class="flex flex-wrap items-baseline gap-x-2 gap-y-0.5 min-w-0">
                                                        <a href="{{ route('profile', $item->user->id) }}"
                                                            class="focus:outline-none focus:underline group min-w-0 max-w-full">
                                                            <h3 id="review-user-{{ $item->id }}"
                                                                class="text-base font-black text-gray-900 dark:text-white group-hover:text-brand transition-colors truncate max-w-[150px] sm:max-w-xs">
                                                                {{ $item->user->name }}
                                                            </h3>
                                                        </a>
                                                        <span
                                                            class="shrink-0 text-gray-400 dark:text-gray-500 select-none"
                                                            aria-hidden="true">·</span>
                                                        <div class="flex flex-wrap items-baseline min-w-0">
                                                            <span class="sr-only">Publicado </span>
                                                            <time
                                                                datetime="{{ $item->created_at->toIso8601String() }}"
                                                                class="text-xs text-gray-500 dark:text-gray-400 font-medium hover:underline cursor-help"
                                                                title="{{ $item->created_at->translatedFormat('d M Y, H:i') }}">
                                                                {{ $item->created_at->diffForHumans(null, true, true) }}
                                                            </time>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if ($item->rating > 0)
                                                    @php $rating_5 = $item->rating / 2; @endphp
                                                    <div class="shrink-0 flex pt-0.5"
                                                        aria-label="Valoró con {{ number_format($rating_5, 1) }} sobre 5 estrellas">
                                                        <span
                                                            class="inline-flex items-center gap-1 text-yellow-600 dark:text-yellow-400 bg-yellow-50 dark:bg-yellow-500/10 border border-yellow-200/50 dark:border-yellow-500/20 px-2 py-0.5 rounded-lg text-xs font-bold">
                                                            {{ number_format($rating_5, 1) }}
                                                            <x-icons.star class="size-3" aria-hidden="true" />
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </header>

                                        <div class="mb-5">
                                            <p class="text-gray-900 dark:text-gray-100 text-[15px] sm:text-[17px] leading-relaxed whitespace-pre-line break-words"
                                                dir="auto">
                                                {{ $item->review }}
                                            </p>
                                        </div>

                                        <footer
                                            class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-gray-100 dark:border-darkbox-border">

                                            <div class="flex items-center gap-6 text-gray-500 dark:text-gray-400">
                                                <div class="hover:text-brand transition-colors">
                                                    @livewire('utils.like-button', ['model' => $item], key('feed-like-' . $item->id))
                                                </div>

                                                <div class="hover:text-red-500 transition-colors">
                                                    @livewire('utils.report-button', ['model' => $item], key('feed-report-' . $item->id))
                                                </div>
                                            </div>

                                            <a href="{{ route('games.show', $item->game->slug) }}"
                                                class="group flex items-center gap-2.5 px-3 py-1.5 bg-gray-50 dark:bg-darkbox-main/60 hover:bg-gray-100 dark:hover:bg-darkbox-main border border-gray-200 dark:border-darkbox-border rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 dark:focus:ring-offset-darkbox-card max-w-[50%] sm:max-w-[200px]"
                                                aria-label="Juego reseñado: {{ $item->game->title }}">

                                                <img src="{{ $item->game->cover_url }}" alt=""
                                                    loading="lazy" aria-hidden="true"
                                                    class="shrink-0 w-6 h-8 object-cover rounded shadow-sm group-hover:scale-105 transition-transform" />

                                                <span
                                                    class="text-xs font-bold text-gray-600 dark:text-gray-300 group-hover:text-brand transition-colors truncate">
                                                    {{ $item->game->title }}
                                                </span>
                                            </a>
                                        </footer>

                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{-- SCROLL INFINITO --}}
                    @if ($userReviews->isNotEmpty() && $userReviews->count() < $totalCount)
                        <div x-intersect="$wire.loadMore()" class="h-10 w-full mt-6" aria-hidden="true"></div>
                    @endif

                    <x-miscomponentes.loading-spinner variant="simple" wire:target="loadMore" />
                @endif
            </section>

            {{-- TENDENCIAS --}}
            <aside class="xl:col-span-4 flex flex-col gap-6" aria-labelledby="tendencias-heading">
                <section
                    class="bg-white dark:bg-darkbox-card border border-gray-100 dark:border-darkbox-border rounded-[2rem] p-6 sm:p-8 shadow-sm sticky top-24">
                    <header
                        class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-darkbox-border">
                        <div class="w-8 h-8 rounded-full bg-orange-50 dark:bg-orange-500/10 flex items-center justify-center text-orange-500 shrink-0"
                            aria-hidden="true">
                            <i class="fa-solid fa-fire text-sm"></i>
                        </div>
                        <h2 id="tendencias-heading"
                            class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest">
                            En Tendencia
                        </h2>
                    </header>

                    @if ($trending->isEmpty())
                        <div class="py-6 text-center">
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium leading-relaxed">
                                Aún no hay juegos destacando.<br>¡Pronto aparecerán aquí!
                            </p>
                        </div>
                    @else
                        <ol class="flex flex-col gap-4" aria-label="Top de juegos con más reseñas recientes">
                            @foreach ($trending as $trendingGame)
                                <li>
                                    <a href="{{ route('games.show', $trendingGame->slug) }}"
                                        class="group flex items-center gap-4 bg-transparent hover:bg-gray-50 dark:hover:bg-darkbox-main p-2.5 -mx-2.5 rounded-2xl transition-colors focus:outline-none focus:ring-2 focus:ring-brand focus:bg-gray-50 dark:focus:bg-darkbox-main">

                                        {{-- Número del ranking --}}
                                        <span class="text-lg font-black w-6 text-center shrink-0"
                                            aria-label="Posición {{ $loop->iteration }}">
                                            @if ($loop->iteration === 1)
                                                <span class="text-yellow-500 dark:text-yellow-400"><i
                                                        class="fa-solid fa-trophy text-sm"
                                                        aria-hidden="true"></i><span class="sr-only">1</span></span>
                                            @else
                                                <span
                                                    class="text-gray-400 dark:text-gray-600">{{ $loop->iteration }}</span>
                                            @endif
                                        </span>

                                        <img src="{{ $trendingGame->cover_url }}" alt="" loading="lazy"
                                            aria-hidden="true"
                                            class="w-12 h-16 object-cover rounded-xl shadow-sm border border-gray-200 dark:border-darkbox-border group-hover:shadow-md transition-shadow" />

                                        <div class="flex-1 min-w-0">
                                            <h3
                                                class="text-base font-bold text-gray-900 dark:text-white group-hover:text-brand transition-colors truncate">
                                                {{ $trendingGame->title }}
                                            </h3>
                                            <p
                                                class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider mt-1">
                                                {{ $trendingGame->reviews_count }}
                                                {{ $trendingGame->reviews_count === 1 ? 'Reseña' : 'Reseñas' }}
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    @endif
                </section>
            </aside>

        </div>
    </x-miscomponentes.page-layout>
</div>
