@if (isset($gameId))
    {{-- REVIEWS JUEGO ESPECIFICO --}}
    <div class="col-span-full space-y-4 w-full mt-8" aria-labelledby="opinions-heading">

        {{-- HEADER Y FILTROS --}}
        <div
            class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-gray-200 dark:border-darkbox-border pb-3">
            <div>
                <h2 id="opinions-heading"
                    class="text-xl font-black flex items-center gap-2 text-gray-900 dark:text-white transition-colors duration-300">
                    <i class="fa-solid fa-comment-dots text-cyan-500" aria-hidden="true"></i> Opiniones
                </h2>
                <span class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-1 block">
                    {{ $totalCount }} {{ $totalCount === 1 ? 'Reseña' : 'Reseñas' }}
                </span>
            </div>

            @if ($totalCount > 0 || $filter !== 'all')
                <div class="flex flex-wrap gap-2">
                    <div class="relative group">
                        <select wire:model.live="filter"
                            class="appearance-none text-xs font-bold bg-white dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border rounded-xl pl-4 pr-9 py-2 text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 shadow-sm transition-colors duration-300 outline-none cursor-pointer w-full">
                            <option value="all">Todas las notas</option>
                            <option value="positive">Positivas (7-10)</option>
                            <option value="mixed">Mixtas (4-6)</option>
                            <option value="negative">Negativas (1-3)</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 group-hover:text-cyan-500 transition-colors pointer-events-none"
                            aria-hidden="true"></i>
                    </div>

                    <div class="relative group">
                        <select wire:model.live="sort"
                            class="appearance-none text-xs font-bold bg-white dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border rounded-xl pl-4 pr-9 py-2 text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 shadow-sm transition-colors duration-300 outline-none cursor-pointer w-full">
                            <option value="newest">Más recientes</option>
                            <option value="highest">Mayor nota</option>
                            <option value="lowest">Menor nota</option>
                            <option value="oldest">Más antiguas</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 group-hover:text-cyan-500 transition-colors pointer-events-none"
                            aria-hidden="true"></i>
                    </div>
                </div>
            @endif
        </div>

        @if ($reviews->isEmpty())
            <div
                class="flex flex-col items-center justify-center py-8 px-4 bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-2xl shadow-sm text-center">
                <h3 class="text-sm font-black text-gray-900 dark:text-white mb-1">No se encontraron reseñas</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Prueba a cambiar los filtros o sé el
                    primero en opinar.</p>
            </div>
        @else
            <div class="space-y-4" role="feed" aria-label="Lista de opiniones">
                @foreach ($reviews as $item)
                    <article
                        class="bg-white dark:bg-darkbox-card p-4 md:p-5 rounded-2xl border shadow-sm flex flex-col gap-3 group transition-colors duration-300
                        {{ Auth::check() && Auth::id() === $item->user_id ? 'border-cyan-400 dark:border-cyan-600 ring-1 ring-cyan-500/10' : 'border-gray-200 dark:border-darkbox-border' }}">

                        <div class="flex justify-between items-start">
                            <div class="flex items-center gap-3">
                                <img src="{{ $item->user->profile_photo_url }}" alt="Avatar de {{ $item->user->name }}"
                                    loading="lazy"
                                    class="w-10 h-10 rounded-full object-cover border border-gray-200 dark:border-darkbox-border" />
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold text-sm text-gray-900 dark:text-white leading-none">
                                            {{ $item->user->name }}
                                        </h4>
                                        <span
                                            class="text-xs bg-cyan-50 dark:bg-cyan-900/30 text-cyan-700 dark:text-cyan-400 px-1.5 py-0.5 rounded font-black uppercase tracking-widest border border-cyan-200 dark:border-cyan-800/50 shadow-sm">
                                            {{ $item->user->role ?? 'Jugador' }}
                                        </span>
                                        @if (Auth::check() && Auth::id() === $item->user_id)
                                            <span
                                                class="text-[9px] bg-cyan-500 text-white px-1.5 py-0.5 rounded-sm font-black uppercase tracking-widest shadow-sm">
                                                Tu reseña
                                            </span>
                                        @endif
                                    </div>
                                    <div class="block mt-1 text-xs text-gray-500 font-bold uppercase tracking-widest">
                                        {{ $item->updated_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                @auth
                                    @if (Auth::id() === $item->user_id)
                                        @livewire('utils.review-owner-actions', ['review' => $item], key('review-owner-actions-preview-specific-' . $item->id))
                                    @endif
                                @endauth

                                <div class="flex items-center gap-1.5 bg-gray-50 dark:bg-darkbox-main px-2.5 py-1 rounded-lg border border-gray-200 dark:border-darkbox-border"
                                    aria-label="Nota: {{ $item->rating }}">
                                    <span class="text-sm font-black text-cyan-700 dark:text-cyan-400"
                                        aria-hidden="true">{{ $item->rating }}</span>
                                    <i class="fa-solid fa-star text-xs text-cyan-500" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>

                        <div class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                            {{ $item->review }}
                        </div>

                        <div class="mt-2 flex justify-start items-center gap-2 flex-wrap">
                            @auth
                                <div class="scale-90 origin-left">
                                    @livewire('utils.like-button', ['model' => $item], key('like-btn-specific-' . $item->id))
                                </div>
                            @endauth
                            <div class="scale-90 origin-left">
                                @livewire('utils.report-button', ['model' => $item], key('report-btn-specific-' . $item->id))
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- CARGAR MÁS --}}
            @if ($totalCount > $amount)
                <div class="flex justify-center mt-6">
                    <button type="button" wire:click="loadMore"
                        class="flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl border border-gray-200 dark:border-darkbox-border bg-white dark:bg-darkbox-card hover:bg-gray-50 dark:hover:bg-darkbox-main text-xs font-black uppercase tracking-widest text-cyan-600 dark:text-cyan-500 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 w-full sm:w-auto">
                        <span wire:loading.remove wire:target="loadMore">Cargar Más Reseñas</span>
                        <span wire:loading wire:target="loadMore"><x-icons.animate-spin class="size-4" />
                            Cargando...</span>
                    </button>
                </div>
            @endif
        @endif
    </div>
@else
    {{-- REVIEWS GLOBALES --}}
    <div class="lg:col-span-2 space-y-6" aria-labelledby="featured-reviews-heading">
        <div class="col-span-full space-y-4 w-full mt-8">

            {{-- HEADER Y FILTROS --}}
            <div
                class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-gray-200 dark:border-darkbox-border pb-3">
                <div>
                    <h2 id="featured-reviews-heading"
                        class="text-2xl font-black flex items-center gap-2 text-gray-900 dark:text-white transition-colors duration-300">
                        <i class="fa-solid fa-star text-indigo-500" aria-hidden="true"></i> Reseñas Destacadas
                    </h2>
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-1 block">
                        {{ $totalCount }} {{ $totalCount === 1 ? 'Reseña' : 'Reseñas' }}
                    </span>
                </div>

                @if ($totalCount > 0 || $filter !== 'all')
                    <div class="flex flex-wrap gap-2">
                        <div class="relative group">
                            <select wire:model.live="filter"
                                class="appearance-none text-xs font-bold bg-white dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border rounded-xl pl-4 pr-9 py-2 text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-colors duration-300 outline-none cursor-pointer w-full">
                                <option value="all">Todas las notas</option>
                                <option value="positive">Positivas (7-10)</option>
                                <option value="mixed">Mixtas (4-6)</option>
                                <option value="negative">Negativas (1-3)</option>
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 group-hover:text-indigo-500 transition-colors pointer-events-none"
                                aria-hidden="true"></i>
                        </div>

                        <div class="relative group">
                            <select wire:model.live="sort"
                                class="appearance-none text-xs font-bold bg-white dark:bg-darkbox-main border border-gray-200 dark:border-darkbox-border rounded-xl pl-4 pr-9 py-2 text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-colors duration-300 outline-none cursor-pointer w-full">
                                <option value="newest">Más recientes</option>
                                <option value="highest">Mayor nota</option>
                                <option value="lowest">Menor nota</option>
                                <option value="oldest">Más antiguas</option>
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 group-hover:text-indigo-500 transition-colors pointer-events-none"
                                aria-hidden="true"></i>
                        </div>
                    </div>
                @endif
            </div>

            @if ($reviews->isEmpty())
                <div
                    class="flex flex-col items-center justify-center py-8 px-4 bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-2xl shadow-sm text-center">
                    <h3 class="text-sm font-black text-gray-900 dark:text-white mb-1">No se encontraron reseñas</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Prueba a cambiar los filtros
                        configurados.</p>
                </div>
            @else
                <div class="space-y-4" role="feed" aria-label="Lista de reseñas destacadas">
                    @foreach ($reviews as $item)
                        <article
                            class="bg-white dark:bg-darkbox-card p-6 rounded-2xl border shadow-md dark:shadow-lg hover:border-indigo-400 dark:hover:border-indigo-500/50 transition-all duration-300 flex flex-col sm:flex-row gap-6
                            {{ Auth::check() && Auth::id() === $item->user_id ? 'border-indigo-400 dark:border-indigo-600 ring-1 ring-indigo-500/10' : 'border-gray-200 dark:border-darkbox-border' }}">

                            <div
                                class="w-24 h-32 bg-gray-100 dark:bg-darkbox-main rounded-lg shrink-0 border border-gray-200 dark:border-darkbox-border overflow-hidden shadow-sm dark:shadow-md hidden sm:block">
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
                                            class="w-10 h-10 rounded-full object-cover border border-gray-200 dark:border-darkbox-border" />
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
                                                @if (Auth::check() && Auth::id() === $item->user_id)
                                                    <span
                                                        class="text-[9px] bg-indigo-500 text-white px-1.5 py-0.5 rounded-sm font-black uppercase tracking-widest shadow-sm">
                                                        Tu reseña
                                                    </span>
                                                @endif
                                            </div>
                                            <time datetime="{{ $item->updated_at }}"
                                                class="block mt-1 text-xs text-gray-500 font-bold uppercase tracking-widest">
                                                {{ $item->updated_at->diffForHumans() }}
                                            </time>
                                            <p
                                                class="text-xs text-gray-600 dark:text-gray-400 font-bold uppercase mt-0.5 transition-colors duration-300">
                                                Sobre <a href="{{ route('games.show', $item->game->slug) }}"
                                                    class="text-indigo-600 dark:text-indigo-300 hover:underline">{{ $item->game->title }}</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                            @if (Auth::id() === $item->user_id)
                                                @livewire('utils.review-owner-actions', ['review' => $item], key('review-owner-actions-preview-global-' . $item->id))
                                            @endif

                                        @if ($item->rating > 0)
                                            <div class="flex items-center gap-1.5 bg-gray-50 dark:bg-darkbox-main px-2.5 py-1 rounded-lg border border-gray-200 dark:border-darkbox-border"
                                                aria-label="Valoración: {{ $item->rating }}">
                                                <span class="text-sm font-black text-cyan-700 dark:text-cyan-400"
                                                    aria-hidden="true">{{ $item->rating }}</span>
                                                <i class="fa-solid fa-star text-xs text-cyan-500" aria-hidden="true"></i>
                                            </div>
                                        @endif
                                    </div>

                                </div>

                                <div class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                    {{ $item->review }}
                                </div>

                                <div class="mt-auto flex justify-start items-center gap-2 flex-wrap">
                                    @auth
                                        <div class="scale-90 origin-left">
                                            @livewire('utils.like-button', ['model' => $item], key('like-btn-global-' . $item->id))
                                        </div>
                                        <div class="scale-90 origin-left">
                                            @livewire('utils.report-button', ['model' => $item], key('report-btn-global-' . $item->id))
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- CARGAR MÁS --}}
                {{--
                @if ($totalCount > $amount)
                    <div class="flex justify-center mt-6">
                        <button type="button" wire:click="loadMore"
                            class="flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl border border-gray-200 dark:border-darkbox-border bg-white dark:bg-darkbox-card hover:bg-gray-50 dark:hover:bg-darkbox-main text-xs font-black uppercase tracking-widest text-indigo-600 dark:text-indigo-500 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full sm:w-auto">
                            <span wire:loading.remove wire:target="loadMore">Cargar Más Reseñas</span>
                            <span wire:loading wire:target="loadMore"><i class="fa-solid fa-circle-notch fa-spin"></i>
                                Cargando...</span>
                        </button>
                    </div>
                @endif
                 --}}
            @endif
        </div>
    </div>
@endif
