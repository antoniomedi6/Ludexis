@props(['game', 'status' => 'pending', 'rating' => 0, 'hours' => 0, 'action' => null])

@php
    $isAbandoned = $status === 'abandoned';
    $isPending = $status === 'pending';
@endphp

<div
    class="relative group rounded-3xl overflow-hidden bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-xl dark:shadow-none hover:border-cyan-300 dark:hover:border-cyan-500/50 transition-all duration-500 flex flex-col h-full {{ $isAbandoned || $isPending ? 'opacity-80 hover:opacity-100' : '' }}">

    <a href="{{ route('games.show', $game->slug) }}" wire:navigate class="z-10 flex flex-col flex-1 w-full">

        <div
            class="relative aspect-[4/3] w-full overflow-hidden shrink-0 border-b border-gray-200 dark:border-gray-800 bg-gray-900">
            <img src="{{ $game->cover_url }}"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 {{ $isAbandoned ? 'filter grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100' : '' }}"
                loading="lazy" alt="Portada de {{ $game->title }}" />

            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 to-transparent opacity-80"></div>

            <div class="absolute top-4 left-4 z-10">
                @if ($status === 'finish')
                    <span
                        class="bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 border border-green-200 dark:border-green-800/50 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                        <i class="fa-solid fa-flag-checkered"></i> Finalizado
                    </span>
                @elseif ($status === 'completed')
                    <span
                        class="bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 border border-purple-200 dark:border-purple-800/50 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                        <x-icons.completed class="size-4" /> 100%
                    </span>
                @elseif ($status === 'playing')
                    <span
                        class="bg-cyan-50 dark:bg-cyan-900/30 text-cyan-600 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                        <x-icons.playing class="size-4" /> Jugando
                    </span>
                @elseif ($status === 'abandoned')
                    <span
                        class="bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800/50 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                        <x-icons.abandoned class="size-4" /> Abandonado
                    </span>
                @elseif ($status === 'pending')
                    <span
                        class="bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800/50 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                        <x-icons.pending class="size-4" /> Pendiente
                    </span>
                @elseif ($status === 'paused')
                    <span
                        class="bg-yellow-50 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800/50 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                        <x-icons.paused class="size-4" /> En Pausa
                    </span>
                @elseif ($status === 'multiplayer')
                    <span
                        class="bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-800/50 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm transition-colors duration-300 flex items-center gap-1.5">
                        <x-icons.multiplayer class="size-4" /> Multiplayer
                    </span>
                @endif
            </div>

            <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end z-10">
                <x-miscomponentes.star-rating :value10="$rating"
                    class="text-cyan-500 dark:text-cyan-400 drop-shadow-md" />
                <span
                    class="bg-white/90 dark:bg-[#1a1d27]/90 backdrop-blur-md text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider shadow-sm transition-colors duration-300">
                    PC
                </span>
            </div>
        </div>

        <div class="p-5 flex-1 flex flex-col justify-between text-center sm:text-left gap-2">
            <h3
                class="text-base font-black text-gray-900 dark:text-white leading-tight group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300 line-clamp-2">
                {{ $game->title }}
            </h3>
            <p
                class="text-xs font-bold uppercase tracking-wider flex items-center justify-center sm:justify-start gap-1.5 transition-colors duration-300 
                {{ $status === 'finish' || $status === 'completed' ? 'text-green-600 dark:text-green-500' : '' }}
                {{ $status === 'playing' ? 'text-cyan-600 dark:text-cyan-500' : '' }}
                {{ $status === 'abandoned' ? 'text-red-600 dark:text-red-500' : '' }}
                {{ $status === 'pending' || $status === 'paused' ? 'text-yellow-600 dark:text-yellow-500' : '' }}
                {{ $status === 'multiplayer' ? 'text-blue-600 dark:text-blue-500' : '' }}">
                <i class="fa-regular fa-clock"></i>
                {{ $hours }} hrs
            </p>
        </div>
    </a>

    @if ($action)
        <div class="absolute top-4 right-4 z-20">
            {{ $action }}
        </div>
    @endif
</div>
