<section aria-labelledby="recent-activity-heading">
    {{-- CABECERA --}}
    <h2 id="recent-activity-heading"
        class="text-sm font-black text-gray-600 dark:text-gray-400 uppercase tracking-widest mb-6 transition-colors duration-300">
        Tu Actividad Reciente
    </h2>

    {{-- LISTA DE ACTIVIDADES --}}
    <div class="flex flex-col gap-3" role="feed" aria-label="Actividad reciente">
        @forelse ($activities as $item)
            @php
                $statusData = match ($item->action_type) {
                    'completed' => ['icon' => 'fa-check', 'wrap' => 'bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 border-green-200 dark:border-green-500/20', 'label' => 'Completado'],
                    'finish' => ['icon' => 'fa-flag-checkered', 'wrap' => 'bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 border-green-200 dark:border-green-500/20', 'label' => 'Finalizado'],
                    'playing' => ['icon' => 'fa-gamepad', 'wrap' => 'bg-cyan-50 dark:bg-cyan-500/10 text-cyan-600 dark:text-cyan-400 border-cyan-200 dark:border-cyan-500/20', 'label' => 'Jugando'],
                    'paused' => ['icon' => 'fa-pause', 'wrap' => 'bg-yellow-50 dark:bg-yellow-500/10 text-yellow-700 dark:text-yellow-400 border-yellow-200 dark:border-yellow-500/20', 'label' => 'Pausado'],
                    'pending' => ['icon' => 'fa-clock', 'wrap' => 'bg-yellow-50 dark:bg-yellow-500/10 text-yellow-700 dark:text-yellow-400 border-yellow-200 dark:border-yellow-500/20', 'label' => 'Pendiente'],
                    'abandoned' => ['icon' => 'fa-ban', 'wrap' => 'bg-red-50 dark:bg-red-500/10 text-red-700 dark:text-red-400 border-red-200 dark:border-red-500/20', 'label' => 'Abandonado'],
                    'multiplayer' => ['icon' => 'fa-users', 'wrap' => 'bg-purple-50 dark:bg-purple-500/10 text-purple-700 dark:text-purple-400 border-purple-200 dark:border-purple-500/20', 'label' => 'Multijugador'],
                    default => ['icon' => 'fa-bolt', 'wrap' => 'bg-gray-50 dark:bg-darkbox-main text-gray-700 dark:text-gray-300 border-gray-200 dark:border-darkbox-border', 'label' => $item->action_type],
                };
            @endphp

            <a href="{{ route('games.show', $item->game->slug) }}"
                class="block focus:outline-none focus:ring-2 focus:ring-cyan-500 rounded-2xl group"
                aria-label="Ver {{ $item->game->title }}">
                <article
                    class="bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-2xl p-4 flex flex-col sm:flex-row gap-4 items-start sm:items-center transition-all duration-300 group-hover:border-cyan-400 dark:group-hover:border-cyan-500/50 shadow-sm group-hover:shadow-md">
                    
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 border text-xl transition-colors duration-300 {{ $statusData['wrap'] }}"
                        aria-hidden="true">
                        <i class="fa-solid {{ $statusData['icon'] }}"></i>
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-600 dark:text-gray-400 transition-colors duration-300 truncate">
                            <span class="text-gray-900 dark:text-white font-bold text-base transition-colors duration-300 group-hover:text-cyan-600 dark:group-hover:text-cyan-400">
                                {{ $item->game->title }}
                            </span>
                            <span class="font-bold text-gray-400 dark:text-gray-600 mx-1">·</span>
                            <span class="font-bold">{{ $statusData['label'] }}</span>
                        </p>
                    </div>

                    <time datetime="{{ $item->created_at }}"
                        class="text-xs text-gray-400 dark:text-gray-500 font-bold uppercase tracking-widest shrink-0 transition-colors duration-300 mt-2 sm:mt-0">
                        {{ $item->created_at->diffForHumans() }}
                    </time>
                </article>
            </a>
        @empty
            {{-- EMPTY_STATE --}}
            <div class="flex flex-col items-center justify-center py-12 text-center bg-white dark:bg-darkbox-card border border-gray-200 dark:border-darkbox-border rounded-2xl shadow-sm" role="status"
                aria-label="Sin actividad reciente">
                <i class="fa-solid fa-wind text-gray-300 dark:text-gray-600 text-4xl mb-3" aria-hidden="true"></i>
                <p class="text-sm text-gray-500 dark:text-gray-400 font-bold">Aún no hay actividad reciente.</p>
            </div>
        @endforelse
    </div>

    {{-- BOTÓN FOOTER --}}
    <a href="{{ route('timeline') }}"
        class="w-full mt-6 py-3 border text-center border-gray-200 dark:border-darkbox-border rounded-xl text-xs font-black uppercase tracking-widest text-cyan-600 dark:text-cyan-500 bg-white dark:bg-darkbox-card hover:bg-gray-50 dark:hover:bg-darkbox-main transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 inline-flex items-center justify-center gap-2 shadow-sm"
        aria-label="Ver toda tu actividad">
        Ver toda mi actividad
        <i class="fa-solid fa-arrow-right-long transition-transform group-hover:translate-x-1" aria-hidden="true"></i>
    </a>
</section>