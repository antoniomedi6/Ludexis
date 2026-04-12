<div class="xl:col-span-4 flex flex-col h-full gap-8">
    <section
        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-8 flex flex-col shadow-xl transition-colors duration-300"
        aria-labelledby="social-feed-heading">
        <div class="flex items-center justify-between mb-8">
            <h2 id="social-feed-heading"
                class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest transition-colors duration-300">
                Feed Social
            </h2>
        </div>

        <div class="flex flex-col gap-8" role="feed">
            @forelse ($activities as $activity)

                @if ($activity['type'] === 'review')
                    <article class="flex gap-4 group" aria-labelledby="feed-user-{{ $loop->index }}">
                        <img src="{{ $activity['game']->cover_url }}" alt="Portada de {{ $activity['game']->title }}"
                            class="w-10 h-10 rounded-xl object-cover border border-gray-200 dark:border-gray-700 shrink-0 transition-colors duration-300"
                            loading="lazy" />
                        <div class="flex-1">
                            <p
                                class="text-sm text-gray-600 dark:text-gray-400 leading-snug transition-colors duration-300">
                                <strong id="feed-user-{{ $loop->index }}"
                                    class="text-gray-900 dark:text-white font-bold transition-colors">{{ $activity['user']->name }}</strong>
                                ha puntuado <strong
                                    class="text-gray-900 dark:text-white font-bold transition-colors duration-300">{{ $activity['game']->title }}</strong>
                            </p>

                            @php
                                $rating_5 = $activity['rating'] / 2;
                                $fullStars = floor($rating_5);
                                $hasHalf = $rating_5 - $fullStars >= 0.5;
                                $emptyStars = 5 - $fullStars - ($hasHalf ? 1 : 0);
                            @endphp
                            <div class="flex gap-0.5 text-cyan-500 mt-1.5 mb-2"
                                aria-label="Puntuación: {{ $rating_5 }} de 5 estrellas">
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <x-icons.star class="w-3.5 h-3.5 fill-current" aria-hidden="true" />
                                @endfor
                                @if ($hasHalf)
                                    <x-icons.star half class="w-3.5 h-3.5 fill-current" aria-hidden="true" />
                                @endif
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <x-icons.star class="w-3.5 h-3.5 opacity-30 fill-current" aria-hidden="true" />
                                @endfor
                            </div>

                            @if ($activity['review'])
                                <blockquote
                                    class="text-xs text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-950 p-3 rounded-lg border border-gray-200 dark:border-gray-800 transition-colors duration-300 line-clamp-2">
                                    {{ $activity['review'] }}
                                </blockquote>
                            @endif
                            <time datetime="{{ $activity['date'] }}"
                                class="text-xs text-gray-500 font-bold uppercase tracking-wider block mt-3">
                                {{ \Carbon\Carbon::parse($activity['date'])->diffForHumans() }}
                            </time>
                        </div>
                    </article>
                @elseif ($activity['type'] === 'wishlist')
                    <article class="flex gap-4 group" aria-labelledby="feed-user-{{ $loop->index }}">
                        <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800/30 flex items-center justify-center shrink-0 transition-colors duration-300"
                            aria-hidden="true">
                            <i
                                class="fa-solid fa-ghost text-purple-600 dark:text-purple-500 text-sm transition-colors duration-300"></i>
                        </div>
                        <div class="flex-1 flex flex-col justify-center">
                            <p
                                class="text-sm text-gray-600 dark:text-gray-400 leading-snug transition-colors duration-300">
                                <strong id="feed-user-{{ $loop->index }}"
                                    class="text-gray-900 dark:text-white font-bold transition-colors">{{ $activity['user']->name }}</strong>
                                añadió <strong
                                    class="text-gray-900 dark:text-white font-bold transition-colors duration-300">{{ $activity['game']->title }}</strong>
                                a sus pendientes
                            </p>
                            <time datetime="{{ $activity['date'] }}"
                                class="text-xs text-gray-500 font-bold uppercase tracking-wider block mt-2">
                                {{ \Carbon\Carbon::parse($activity['date'])->diffForHumans() }}
                            </time>
                        </div>
                    </article>
                @elseif ($activity['type'] === 'capture')
                    <article class="flex gap-4 group" aria-labelledby="feed-user-{{ $loop->index }}">
                        <img src="{{ $activity['game']->cover_url }}" alt="Portada de {{ $activity['game']->title }}"
                            class="w-10 h-10 rounded-xl object-cover border border-gray-200 dark:border-gray-700 shrink-0 transition-colors duration-300"
                            loading="lazy" />
                        <div class="flex-1">
                            <p
                                class="text-sm text-gray-600 dark:text-gray-400 leading-snug transition-colors duration-300">
                                <strong id="feed-user-{{ $loop->index }}"
                                    class="text-gray-900 dark:text-white font-bold transition-colors">{{ $activity['user']->name }}</strong>
                                subió una captura de <strong
                                    class="text-gray-900 dark:text-white font-bold">{{ $activity['game']->title }}</strong>.
                            </p>
                            <div class="mt-3 relative rounded-xl overflow-hidden border border-gray-200 dark:border-gray-800 aspect-video cursor-pointer transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500"
                                tabindex="0" role="button" aria-label="Ver captura en grande">
                                <img src="{{ Storage::url($activity['image_path']) }}"
                                    alt="Captura de pantalla de {{ $activity['game']->title }} subida por {{ $activity['user']->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                    loading="lazy" />
                            </div>

                            <time datetime="{{ $activity['date'] }}"
                                class="text-xs text-gray-500 font-bold uppercase tracking-wider block mt-3">
                                {{ \Carbon\Carbon::parse($activity['date'])->diffForHumans() }}
                            </time>
                        </div>
                    </article>
                @endif

            @empty
                <div class="flex flex-col items-center justify-center py-6 text-center" role="status">
                    <i class="fa-solid fa-wind text-gray-300 dark:text-gray-700 text-3xl mb-2" aria-hidden="true"></i>
                    <p class="text-sm text-gray-500 font-bold">Aún no hay actividad social.</p>
                </div>
            @endforelse
        </div>

        <a href="{{ route('social') }}"
            class="w-full mt-6 py-3 border text-center border-gray-200 dark:border-gray-800 rounded-xl text-xs font-black uppercase tracking-widest text-cyan-600 dark:text-cyan-500 bg-gray-50 hover:bg-gray-100 dark:bg-transparent dark:hover:bg-gray-800 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500">
            Ver toda la actividad
        </a>
    </section>
</div>
