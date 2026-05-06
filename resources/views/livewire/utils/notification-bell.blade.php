<div class="relative" wire:poll.visible.45s x-data="{ open: false }" @click.outside="open = false"
    @keydown.escape.window="open = false">
    {{-- DISPARADOR --}}
    <button type="button" @click="open = !open"
        class="relative flex items-center justify-center w-10 h-10 rounded-lg bg-lightbox-main dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 hover:bg-lightbox-soft dark:hover:bg-darkbox-card transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500"
        :aria-expanded="open ? 'true' : 'false'" aria-haspopup="true"
        aria-label="Actividad de seguimiento{{ $badgeCount > 0 ? ', ' . $badgeCount . ' solicitudes pendientes' : '' }}">
        <span class="sr-only">Abrir o cerrar panel de solicitudes y seguidores</span>
        <i class="fa-solid fa-bell text-lg" aria-hidden="true"></i>
        @if ($badgeCount > 0)
            <span
                class="absolute -top-1 -right-1 min-w-5 h-5 px-1 flex items-center justify-center rounded-full bg-cyan-600 text-white text-xs font-black leading-none"
                aria-hidden="true">{{ $badgeCount > 99 ? '99+' : $badgeCount }}</span>
        @endif
    </button>

    {{-- PANEL --}}
    <div x-show="open" x-cloak
        class="absolute right-0 top-full z-50 mt-2 flex w-80 max-w-[calc(100vw-2rem)] flex-col overflow-hidden rounded-xl border border-lightbox-border dark:border-darkbox-border bg-lightbox-card shadow-xl dark:bg-darkbox-card sm:w-96"
        role="dialog" aria-label="Solicitudes y seguidores recientes">
        <div class="shrink-0 border-b border-lightbox-border px-4 py-3 dark:border-darkbox-border">
            <h2 class="text-sm font-black tracking-tight text-lightbox-text dark:text-white">Seguimiento</h2>
        </div>

        <div class="max-h-80 divide-y divide-lightbox-border overflow-y-auto dark:divide-darkbox-border sm:max-h-96">
            @if ($pendingFollowers->isNotEmpty())
                <div class="p-3" role="region" aria-label="Solicitudes pendientes">
                    <h3 class="text-xs font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">Solicitudes</h3>
                    <ul class="flex flex-col gap-3" role="list">
                        @foreach ($pendingFollowers as $follower)
                            <li wire:key="pending-{{ $follower->id }}" class="flex gap-3">
                                <img src="{{ $follower->profile_photo_url }}" alt=""
                                    class="w-10 h-10 rounded-full object-cover shrink-0 border border-gray-200 dark:border-darkbox-border"
                                    width="40" height="40">
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm text-gray-900 dark:text-white leading-snug">
                                        <span class="font-black">{{ $follower->name }}</span>
                                        <span class="font-medium text-gray-600 dark:text-gray-400">quiere seguirte</span>
                                    </p>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        <button type="button" wire:click="acceptFollowRequest({{ $follower->id }})"
                                            class="px-3 py-1.5 rounded-lg text-xs font-black uppercase tracking-wide bg-cyan-600 hover:bg-cyan-500 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                            Aceptar
                                        </button>
                                        <button type="button" wire:click="rejectFollowRequest({{ $follower->id }})"
                                            class="px-3 py-1.5 rounded-lg text-xs font-black uppercase tracking-wide bg-gray-200 dark:bg-darkbox-main hover:bg-gray-300 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-darkbox-border focus:outline-none focus:ring-2 focus:ring-gray-400">
                                            Rechazar
                                        </button>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($recentFollowers->isNotEmpty())
                <div class="p-3" role="region" aria-label="Seguidores recientes">
                    <h3 class="text-xs font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 mb-2">Te siguen</h3>
                    <ul class="flex flex-col gap-2" role="list">
                        @foreach ($recentFollowers as $follower)
                            <li wire:key="recent-{{ $follower->id }}">
                                <a href="{{ route('profile', ['userId' => $follower->id]) }}" wire:navigate
                                    class="flex gap-3 items-center rounded-lg p-1 -m-1 hover:bg-lightbox-soft dark:hover:bg-darkbox-main/80 transition-colors outline-none focus-visible:ring-2 focus-visible:ring-cyan-500">
                                    <img src="{{ $follower->profile_photo_url }}" alt=""
                                        class="w-9 h-9 rounded-full object-cover shrink-0 border border-gray-200 dark:border-darkbox-border"
                                        width="36" height="36">
                                    <span class="text-sm text-gray-900 dark:text-white">
                                        <span class="font-black">{{ $follower->name }}</span>
                                        <span class="font-medium text-gray-600 dark:text-gray-400">te sigue</span>
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($pendingFollowers->isEmpty() && $recentFollowers->isEmpty())
                <p class="p-8 text-center text-sm text-gray-500 dark:text-gray-400">
                    Sin solicitudes ni actividad reciente de seguimiento.
                </p>
            @endif
        </div>
    </div>
</div>
