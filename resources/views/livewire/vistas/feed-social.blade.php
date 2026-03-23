<x-miscomponentes.page-layout title1="Ludexis" title2="Feed"
    subtitle="Descubre a qué están jugando tus amigos y comparte tus momentos.">
    <x-slot:aside>
        <div
            class="flex gap-2 bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-xl p-1 shrink-0">
            <button
                class="px-5 py-2.5 rounded-lg bg-gray-100 dark:bg-[#1a1d27] text-cyan-600 dark:text-cyan-400 font-black text-xs uppercase tracking-widest shadow">
                Global
            </button>
            <button
                class="px-5 py-2.5 rounded-lg text-gray-500 hover:text-gray-900 dark:hover:text-white font-black text-xs uppercase tracking-widest transition">
                Siguiendo
            </button>
        </div>
    </x-slot:aside>

    <x-slot>
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-10 w-full">
            <div class="xl:col-span-8 flex flex-col gap-8">
                <div class="flex flex-col gap-8">
                    @foreach ($userReviews as $item)
                        <article
                            class="bg-white dark:bg-[#151821]/80 backdrop-blur-xl border border-gray-200 dark:border-gray-800 rounded-[2rem] overflow-hidden shadow-xl hover:border-gray-300 dark:hover:border-gray-700 transition-colors">
                            <div class="p-6 flex items-start gap-4">
                                <img src="{{ $item->user->profile_photo_url }} "
                                    class="w-12 h-12 rounded-full object-cover border-2 border-white dark:border-[#1a1d27] shadow-lg shrink-0" />
                                <div class="flex-1 flex flex-col">
                                    <div class="flex items-center justify-between mb-1">
                                        <h3
                                            class="text-base font-bold text-gray-900 dark:text-white hover:text-cyan-600 dark:hover:text-cyan-400 cursor-pointer transition">
                                            {{ $item->user->name }}
                                        </h3>
                                        <span
                                            class="text-[10px] text-gray-400 dark:text-gray-500 font-bold uppercase tracking-wider">
                                            {{ $item->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2 mb-4">
                                        <span
                                            class="text-[10px] bg-cyan-50 dark:bg-cyan-900/30 text-cyan-600 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-500/30 px-2 py-0.5 rounded-md font-bold uppercase tracking-widest">
                                            Reseña
                                        </span>
                                    </div>

                                    <a href="{{ route('games.show', $item->game->slug) }}"
                                        class="bg-gray-50 dark:bg-[#0f1117] border border-gray-200 dark:border-gray-800 rounded-3xl p-5 mb-4 flex flex-col sm:flex-row gap-5 hover:border-cyan-500/50 dark:hover:border-cyan-500/50 transition-all duration-300 group shadow-sm hover:shadow-md cursor-pointer">

                                        <img src="{{ $item->game->cover_url }}"
                                            class="w-full sm:w-24 h-48 sm:h-36 object-cover rounded-xl shadow-lg shrink-0 group-hover:scale-[1.02] transition-transform duration-300" />

                                        <div class="flex flex-1 justify-between items-start">

                                            <div class="flex flex-col pr-4">
                                                <h4
                                                    class="text-xl font-black text-gray-900 dark:text-white leading-tight mb-2">
                                                    {{ $item->game->title }}
                                                </h4>
                                                <p class="text-sm text-gray-600 dark:text-gray-400 italic line-clamp-3">
                                                    "{{ $item->review }}"
                                                </p>
                                            </div>

                                            <div
                                                class="flex items-center gap-1 text-yellow-500 dark:text-yellow-400 text-xs bg-white dark:bg-[#151821] px-2.5 py-1.5 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm shrink-0 ml-2">
                                                @php
                                                    $stars = floor($item->rating / 2);
                                                    $hasHalf = $item->rating / 2 - $stars >= 0.5;
                                                @endphp

                                                @for ($i = 0; $i < $stars; $i++)
                                                    <x-icons.star class="w-3.5 h-3.5 text-cyan-500" />
                                                @endfor

                                                @if ($hasHalf)
                                                    <x-icons.star half class="w-3.5 h-3.5 text-cyan-500" />
                                                @endif

                                                <span
                                                    class="ml-1 font-bold text-gray-700 dark:text-gray-300">{{ number_format($item->rating / 2, 1) }}</span>
                                            </div>

                                        </div>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

            </div>

            <aside class="xl:col-span-4 flex flex-col gap-8">
                <div
                    class="bg-white dark:bg-[#151821]/80 backdrop-blur-2xl border border-gray-200 dark:border-gray-800 rounded-[2.5rem] p-8 shadow-xl dark:shadow-2xl">
                    <h2
                        class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-6 flex items-center gap-3">
                        <i class="fa-solid fa-fire text-orange-500"></i> Tendencias
                    </h2>
                    <div class="flex flex-col gap-4">
                        <div
                            class="flex items-center gap-4 cursor-pointer group bg-gray-50 dark:bg-[#0f1117] p-3 rounded-2xl border border-gray-200 dark:border-gray-800/50 transition-colors">
                            <span
                                class="text-xl font-black text-transparent bg-clip-text bg-gradient-to-b from-yellow-400 to-yellow-600 w-6 text-center">1</span>
                            <img src="https://images.igdb.com/igdb/image/upload/t_thumb/co889o.jpg"
                                class="w-10 h-14 object-cover rounded shadow border border-gray-200 dark:border-gray-700" />
                            <div class="flex-1 overflow-hidden">
                                <h4
                                    class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition truncate">
                                    Hollow Knight: Silksong
                                </h4>
                                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">12.5K Menciones
                                </p>
                            </div>
                        </div>
                        <div
                            class="flex items-center gap-4 cursor-pointer group p-3 rounded-2xl hover:bg-gray-50 dark:hover:bg-[#0f1117] transition">
                            <span class="text-lg font-black text-gray-400 dark:text-gray-500 w-6 text-center">2</span>
                            <img src="https://images.igdb.com/igdb/image/upload/t_thumb/co670h.jpg"
                                class="w-10 h-14 object-cover rounded shadow border border-gray-200 dark:border-gray-700" />
                            <div class="flex-1 overflow-hidden">
                                <h4
                                    class="text-sm font-bold text-gray-700 dark:text-gray-300 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition truncate">
                                    GTA VI
                                </h4>
                                <p
                                    class="text-[10px] text-gray-500 dark:text-gray-600 font-bold uppercase tracking-wider">
                                    8.2K Menciones</p>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </x-slot>
</x-miscomponentes.page-layout>
