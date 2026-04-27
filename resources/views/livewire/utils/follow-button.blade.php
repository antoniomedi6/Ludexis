<div class="inline-flex">
    @auth
        @if (Auth::id() !== $userId)
            <button type="button" wire:click="toggleFollow" wire:loading.attr="disabled"
                @class([
                    'font-black text-xs uppercase tracking-widest transition-all focus:outline-none focus:ring-2 active:scale-95 disabled:opacity-60 disabled:cursor-not-allowed',
                    'px-6 py-2.5 rounded-xl shadow-md' => ! $compact,
                    'px-3 py-1.5 rounded-lg shadow-sm' => $compact,
                    'bg-slate-700 hover:bg-slate-600 text-white focus:ring-slate-500' => $isFollowing,
                    'bg-slate-600 hover:bg-slate-500 dark:bg-slate-600 dark:hover:bg-slate-500 text-white focus:ring-slate-400' => ! $isFollowing && $hasRequestedToFollow,
                    'bg-cyan-600 hover:bg-cyan-500 text-white focus:ring-cyan-500' => ! $isFollowing && ! $hasRequestedToFollow,
                ])
                aria-pressed="{{ $isFollowing ? 'true' : 'false' }}"
                @if ($hasRequestedToFollow && ! $isFollowing)
                    aria-label="Solicitud de seguimiento pendiente; pulsar para cancelar"
                @endif>
                <span class="sr-only">
                    @if ($isFollowing)
                        Dejar de seguir a este usuario
                    @elseif ($hasRequestedToFollow)
                        Solicitud pendiente; pulsar para cancelar la solicitud
                    @else
                        Enviar solicitud o seguir a este usuario
                    @endif
                </span>

                @if ($isFollowing)
                    <i class="fa-solid fa-user-check {{ $compact ? 'mr-1' : 'mr-2' }}" aria-hidden="true"></i>
                    Siguiendo
                @elseif ($hasRequestedToFollow)
                    <i class="fa-solid fa-clock {{ $compact ? 'mr-1' : 'mr-2' }}" aria-hidden="true"></i>
                    Solicitud enviada
                @else
                    <i class="fa-solid fa-user-plus {{ $compact ? 'mr-1' : 'mr-2' }}" aria-hidden="true"></i>
                    Seguir
                @endif
            </button>
        @endif
    @endauth
</div>
