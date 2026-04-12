<div
    class="min-h-screen flow-root bg-gray-50 dark:bg-[#0f1117] text-gray-900 dark:text-gray-100 font-sans relative transition-colors duration-300">

    {{-- FONDO DIFUMINADO --}}
    <div class="absolute top-0 w-full h-[60vh] z-0 overflow-hidden bg-white dark:bg-[#0f1117] transition-colors duration-300 pointer-events-none select-none"
        aria-hidden="true">
        <img src="https://images.igdb.com/igdb/image/upload/t_1080p/{{ $game->screenshots[0] ?? 'sc8c26' }}.jpg"
            class="w-full h-full object-cover opacity-10 dark:opacity-30 blur-md scale-105 transition-opacity duration-300 pointer-events-none select-none"
            style="mask-image: linear-gradient(to bottom, black 40%, transparent); -webkit-mask-image: linear-gradient(to bottom, black 40%, transparent);"
            draggable="false" alt="" />
    </div>

    {{-- BUSCADOR SUPERIOR --}}
    <section
        class="h-20 flex items-center justify-between px-8 shrink-0 bg-white/80 dark:bg-[#0f1117]/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 transition-colors duration-300 z-50 relative">
        @livewire('utils.search-games')
    </section>

    {{-- CONTENEDOR PRINCIPAL --}}
    <section class="relative z-10 max-w-7xl mx-auto px-6 pt-32 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

            <div class="lg:col-span-8 flex flex-col gap-10">

                <div class="flex flex-col sm:flex-row gap-8 items-start">
                    <img src="{{ $game->cover_url }}"
                        class="w-48 rounded-2xl shadow-xl dark:shadow-[0_20px_40px_rgba(0,0,0,0.5)] border border-gray-200 dark:border-gray-700 shrink-0 transition-colors duration-300"
                        alt="Portada del juego {{ $game->title }}" />

                    <div class="flex-1 pt-2">
                        <div class="flex items-center gap-3 mb-3">
                            <span
                                class="bg-cyan-50 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest transition-colors duration-300">
                                Lanzamiento: <time
                                    datetime="{{ $game->first_release_date }}">{{ $game->first_release_date->year }}</time>
                            </span>
                            <span
                                class="text-gray-600 dark:text-gray-400 text-xs font-bold uppercase tracking-wider transition-colors duration-300">
                                {{ $game->companies->first()?->name ?? 'Desconocido' }}
                            </span>
                        </div>

                        <h1
                            class="text-5xl md:text-6xl font-black text-gray-900 dark:text-white leading-tight tracking-tighter mb-5 transition-colors duration-300 drop-shadow-sm">
                            {{ $game->title }}
                        </h1>

                        <div class="flex flex-wrap gap-2 mb-8" aria-label="Géneros del juego">
                            @foreach ($game->genres as $genre)
                                <span
                                    class="text-gray-600 dark:text-gray-300 text-[10px] font-bold uppercase tracking-wider border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#1a1d27] px-3 py-1.5 rounded-xl transition-colors duration-300 shadow-sm dark:shadow-none">
                                    {{ $genre->name }}
                                </span>
                            @endforeach
                        </div>

                        <div class="flex items-start gap-8">
                            <div>
                                <p
                                    class="text-[10px] text-gray-500 dark:text-gray-500 font-black uppercase tracking-widest mb-1 transition-colors duration-300">
                                    Nota Global
                                </p>
                                <div class="flex items-end gap-1 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 rounded-lg p-1 -m-1"
                                    tabindex="0"
                                    aria-label="Nota global del juego: {{ $game->rating ?? 'Sin nota' }} de 100">
                                    <span
                                        class="text-4xl font-black text-gray-900 dark:text-white leading-none transition-colors duration-300">{{ $game->rating ?? '-' }}</span>
                                    <span
                                        class="text-sm text-cyan-600 dark:text-cyan-500 font-bold mb-1 transition-colors duration-300"
                                        aria-hidden="true">
                                        <x-icons.star class="size-8" />
                                    </span>
                                </div>
                            </div>

                            <div class="w-px h-12 bg-gray-200 dark:bg-gray-800 transition-colors duration-300 mt-1"
                                aria-hidden="true"></div>

                            <div>
                                <p
                                    class="text-[10px] text-gray-500 dark:text-gray-500 font-black uppercase tracking-widest mb-1 transition-colors duration-300">
                                    Tiempo Medio
                                </p>
                                <div class="flex items-end gap-3">
                                    <span
                                        class="text-4xl font-black text-gray-900 dark:text-white leading-none transition-colors duration-300">
                                        {{ $averageHours }}<span class="text-xl text-gray-400"
                                            aria-label="horas">h</span>
                                    </span>

                                    @if ($totalRecords > 0)
                                        <div title="Media basada en {{ $totalRecords }} {{ $totalRecords === 1 ? 'jugador' : 'jugadores' }}"
                                            class="flex items-center gap-1.5 text-gray-400 dark:text-gray-500 mb-1 cursor-help hover:text-cyan-500 dark:hover:text-cyan-400 transition-colors duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 rounded p-1 -m-1"
                                            tabindex="0"
                                            aria-label="Media basada en {{ $totalRecords }} {{ $totalRecords === 1 ? 'jugador' : 'jugadores' }}">
                                            <i class="fa-solid fa-users text-xs" aria-hidden="true"></i>
                                            <span class="text-xs font-bold">{{ $totalRecords }}</span>
                                        </div>
                                    @else
                                        <span
                                            class="text-[10px] font-bold text-gray-400 dark:text-gray-600 mb-1 uppercase tracking-widest transition-colors duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 rounded p-1 -m-1"
                                            title="Aún no hay suficientes partidas registradas" tabindex="0"
                                            aria-label="Aún no hay suficientes partidas registradas">
                                            --
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="w-px h-12 bg-gray-200 dark:bg-gray-800 transition-colors duration-300 mt-1"
                                aria-hidden="true"></div>

                            <div>
                                <p class="text-[10px] text-gray-500 dark:text-gray-500 font-black uppercase tracking-widest mb-1 transition-colors duration-300"
                                    id="plataformas-label">
                                    Plataformas
                                </p>
                                <div class="flex gap-3 text-xl text-gray-600 dark:text-gray-400 mt-1 transition-colors duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 rounded p-1 -m-1"
                                    aria-labelledby="plataformas-label" tabindex="0">
                                    <span class="sr-only">Disponible en PC, PlayStation y Xbox</span>
                                    <i class="fa-brands fa-windows hover:text-gray-900 dark:hover:text-white transition-colors"
                                        aria-hidden="true" title="PC"></i>
                                    <i class="fa-brands fa-playstation hover:text-[#00439c] transition-colors"
                                        aria-hidden="true" title="PlayStation"></i>
                                    <i class="fa-brands fa-xbox hover:text-[#107c10] transition-colors"
                                        aria-hidden="true" title="Xbox"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SINOPSIS --}}
                <div
                    class="bg-white dark:bg-gradient-to-br dark:from-[#1a1d27] dark:to-[#0f1117] border border-gray-200 dark:border-gray-800 rounded-[2rem] p-8 shadow-sm transition-colors duration-300">
                    <h2
                        class="text-xs font-black text-cyan-600 dark:text-cyan-500 uppercase tracking-widest mb-4 transition-colors duration-300">
                        Sinopsis
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed transition-colors duration-300">
                        {{ $game->synopsis }}
                    </p>
                </div>

                {{-- MULTIMEDIA --}}
                <div>
                    <section aria-label="Multimedia del juego">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                            <h2
                                class="text-xl font-black text-gray-900 dark:text-white flex items-center gap-3 transition-colors duration-300">
                                <i class="fa-solid fa-photo-film text-cyan-600 dark:text-cyan-500 transition-colors duration-300"
                                    aria-hidden="true"></i>
                                Multimedia
                            </h2>
                            <button
                                class="bg-cyan-50 hover:bg-cyan-100 dark:bg-cyan-900/40 dark:hover:bg-cyan-800/60 text-cyan-700 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50 px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition-colors duration-300 flex items-center justify-center gap-2 shadow-sm">
                                <i class="fa-solid fa-cloud-arrow-up" aria-hidden="true"></i> Subir Captura
                            </button>
                        </div>

                        <div
                            class="aspect-video w-full rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 mb-4 relative shadow-sm transition-colors duration-300 bg-gray-100 dark:bg-[#1a1d27]">
                            <iframe class="absolute top-0 left-0 w-full h-full z-10" src="{{ $game->video_url }}"
                                frameborder="0" allowfullscreen title="Tráiler de {{ $game->title }}"></iframe>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4" aria-label="Galería de imágenes">
                            @foreach (array_slice($game->screenshots, 0, 3) as $image)
                                <div
                                    class="aspect-video rounded-xl overflow-hidden border border-gray-200 dark:border-gray-800 cursor-pointer hover:border-cyan-500 dark:hover:border-cyan-500 transition-colors relative group shadow-sm">
                                    <img src="{{ "https://images.igdb.com/igdb/image/upload/t_screenshot_med/$image.jpg" }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        alt="Captura de pantalla de {{ $game->title }}" loading="lazy" />
                                    <div class="absolute top-2 right-2">
                                        <span
                                            class="bg-white/90 dark:bg-[#1a1d27]/90 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 px-2 py-1 rounded text-[8px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300">Oficial</span>
                                    </div>
                                </div>
                            @endforeach
                            <div
                                class="aspect-video rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-100 dark:bg-[#1a1d27] hover:bg-gray-200 dark:hover:bg-gray-800 cursor-pointer transition-colors flex items-center justify-center shadow-sm group">
                                <a href="{{ route('gallery', $game->slug) }}"
                                    class="flex items-center justify-center w-full h-full"
                                    aria-label="Ver todas las imágenes en la galería">
                                    <span
                                        class="text-[10px] md:text-xs font-black uppercase tracking-widest text-cyan-600 dark:text-cyan-500 flex items-center gap-2 transition-colors duration-300">
                                        <i class="fa-solid fa-images text-lg group-hover:scale-110 transition-transform"
                                            aria-hidden="true"></i>
                                        Ver todas
                                    </span>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <div class="lg:col-span-4">
                {{-- GAMEREGISTRYCARD --}}
                @auth
                    @livewire('utils.game-registry-card', ['gameId' => $game->id])
                    @livewire('utils.review-modal')
                @endauth

                <div class="mt-14">
                    @livewire('utils.preview-images', ['gameSlug' => $game->slug])
                </div>
            </div>

        </div>

        {{-- REVIEWS --}}
        <div class="w-full max-w-5xl mx-auto mt-16">
            @livewire('utils.preview-reviews', ['gameId' => $game->id])
        </div>

    </section>
</div>
