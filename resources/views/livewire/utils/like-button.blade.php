<div>
    {{-- AUTHENTICATED_VIEW --}}
    @auth
        <button type="button" wire:click.prevent.stop="toggleLike" aria-pressed="{{ $isLiked ? 'true' : 'false' }}"
            aria-label="{{ $isLiked ? 'Quitar me gusta' : 'Dar me gusta' }}"
            class="group relative flex items-center gap-2 px-4 py-2 rounded-2xl border transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 shadow-sm
        {{ $isLiked
            ? 'bg-gradient-to-br from-cyan-900/40 to-gray-900 border-cyan-500/50 shadow-[0_0_15px_rgba(6,182,212,0.15)]'
            : 'bg-white dark:bg-darkbox-card border-gray-200 dark:border-gray-800 hover:border-cyan-500/40 hover:bg-cyan-50 dark:hover:bg-cyan-900/20' }}">

            <div class="relative flex items-center justify-center">
                <div class="absolute inset-0 bg-cyan-400 blur-md transition-opacity duration-300 {{ $isLiked ? 'opacity-40' : 'opacity-0' }}"
                    aria-hidden="true"></div>

                <i class="transition-all duration-300 group-active:scale-75 relative z-10 text-base
                {{ $isLiked
                    ? 'fa-solid fa-heart text-cyan-400 drop-shadow-[0_0_8px_rgba(6,182,212,0.8)]'
                    : 'fa-regular fa-heart text-gray-400 dark:text-gray-500 group-hover:text-cyan-500' }}"
                    aria-hidden="true"></i>
            </div>

            <span
                class="text-xs font-black tracking-widest uppercase transition-colors duration-300 relative z-10
            {{ $isLiked ? 'text-cyan-400' : 'text-gray-600 dark:text-gray-400 group-hover:text-cyan-600 dark:group-hover:text-cyan-400' }}">
                {{ $likesCount > 0 ? $likesCount : 'Like' }}
            </span>
        </button>

        {{-- GUEST_VIEW --}}
    @else
        <span
            class="group relative flex items-center gap-2 px-4 py-2 rounded-2xl border transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 shadow-sm bg-white dark:bg-darkbox-card border-gray-200 dark:border-gray-800">

            <div class="relative flex items-center justify-center">
                <div class="absolute inset-0 bg-cyan-400 blur-md transition-opacity duration-300 {{ $isLiked ? 'opacity-40' : 'opacity-0' }}"
                    aria-hidden="true"></div>

                <i class="transition-all duration-300 relative z-10 text-base
                {{ $isLiked
                    ? 'fa-solid fa-heart text-cyan-400 drop-shadow-[0_0_8px_rgba(6,182,212,0.8)]'
                    : 'fa-regular fa-heart text-gray-400 dark:text-gray-500 group-hover:text-cyan-500' }}"
                    aria-hidden="true"></i>
            </div>

            <span
                class="text-xs font-black tracking-widest uppercase transition-colors duration-300 relative z-10 text-gray-600 dark:text-gray-400">
                {{ $likesCount > 0 ? $likesCount : 'Like' }}
            </span>
        </span>
    @endauth
</div>
