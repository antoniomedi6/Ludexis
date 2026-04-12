<button type="button" wire:click="toggleLike" aria-pressed="{{ $isLiked ? 'true' : 'false' }}"
    aria-label="{{ $isLiked ? 'Quitar me gusta' : 'Dar me gusta' }}"
    class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 group {{ $isLiked ? 'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800/50' : 'bg-gray-50 dark:bg-gray-950 border-gray-200 dark:border-gray-800 hover:border-red-200 dark:hover:border-red-800/50 hover:bg-red-50 dark:hover:bg-red-900/10' }}">

    <div class="relative flex items-center justify-center">
        <i class="fa-heart text-sm transition-transform duration-300 group-active:scale-75 {{ $isLiked ? 'fa-solid text-red-500' : 'fa-regular text-gray-500 dark:text-gray-400 group-hover:text-red-400' }}"
            aria-hidden="true"></i>
    </div>

    <span
        class="text-xs font-black transition-colors duration-300 {{ $isLiked ? 'text-red-600 dark:text-red-400' : 'text-gray-600 dark:text-gray-400 group-hover:text-red-500 dark:group-hover:text-red-400' }}">
        {{ $likesCount > 0 ? $likesCount : 'Like' }}
    </span>
</button>
