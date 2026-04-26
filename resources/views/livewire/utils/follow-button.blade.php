<div class="inline-flex">
    @auth
        @if (Auth::id() !== $userId)
            <button type="button" wire:click="toggleFollow" wire:loading.attr="disabled"
                @class([
                    'font-black text-xs uppercase tracking-widest transition-all focus:outline-none focus:ring-2 active:scale-95 disabled:opacity-60 disabled:cursor-not-allowed',
                    'px-6 py-2.5 rounded-xl shadow-md' => ! $compact,
                    'px-3 py-1.5 rounded-lg shadow-sm' => $compact,
                    'bg-slate-700 hover:bg-slate-600 text-white focus:ring-slate-500' => $isFollowing,
                    'bg-cyan-600 hover:bg-cyan-500 text-white focus:ring-cyan-500' => ! $isFollowing,
                ])
                aria-pressed="{{ $isFollowing ? 'true' : 'false' }}">
                <span class="sr-only">Botón para seguir o dejar de seguir</span>

                @if ($isFollowing)
                    <i class="fa-solid fa-user-check {{ $compact ? 'mr-1' : 'mr-2' }}" aria-hidden="true"></i>
                    Siguiendo
                @else
                    <i class="fa-solid fa-user-plus {{ $compact ? 'mr-1' : 'mr-2' }}" aria-hidden="true"></i>
                    {{ $hasRequestedToFollow ? 'Solicitud enviada' : 'Seguir' }}
                @endif
            </button>
        @endif
    @endauth
</div>
