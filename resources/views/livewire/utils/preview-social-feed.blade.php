<div class="xl:col-span-4 flex flex-col h-full gap-8">
    <div
        class="bg-white dark:bg-[#151821]/80 backdrop-blur-2xl border border-gray-200 dark:border-gray-800 rounded-[2.5rem] p-8 flex flex-col shadow-xl dark:shadow-2xl transition-colors duration-300">
        <div class="flex items-center justify-between mb-8">
            <h2
                class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest transition-colors duration-300">
                Feed Social
            </h2>
        </div>

        <div class="flex flex-col gap-8">
            @forelse ($activities as $activity)

                @if ($activity['type'] === 'review')
                    <div class="flex gap-4 group">
                        <img src="{{ $activity['game']->cover_url }}"
                            class="w-10 h-10 rounded-xl object-cover border border-gray-200 dark:border-gray-700 shrink-0 transition-colors duration-300" />
                        <div class="flex-1">
                            <p
                                class="text-sm text-gray-600 dark:text-gray-400 leading-snug transition-colors duration-300">
                                <span
                                    class="text-gray-900 dark:text-white font-bold group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors cursor-pointer">{{ $activity['user']->name }}</span>
                                ha puntuado <span
                                    class="text-gray-900 dark:text-white font-bold cursor-pointer hover:underline transition-colors duration-300">{{ $activity['game']->title }}</span>
                            </p>

                            <div class="flex gap-0.5 text-cyan-500 mt-1.5 mb-2">
                                @php
                                    $rating_5 = $activity['rating'] / 2;
                                    $fullStars = floor($rating_5);
                                    $hasHalf = $rating_5 - $fullStars >= 0.5;
                                    $emptyStars = 5 - $fullStars - ($hasHalf ? 1 : 0);
                                @endphp
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <x-icons.star class="w-3.5 h-3.5 fill-current" />
                                @endfor
                                @if ($hasHalf)
                                    <x-icons.star half class="w-3.5 h-3.5 fill-current" />
                                @endif
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <x-icons.star class="w-3.5 h-3.5 opacity-30 fill-current" />
                                @endfor
                            </div>

                            @if ($activity['review'])
                                <p
                                    class="text-xs text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-[#0f1117] p-3 rounded-lg border border-gray-200 dark:border-gray-800 transition-colors duration-300 line-clamp-2">
                                    {{ $activity['review'] }}
                                </p>
                            @endif
                            <span
                                class="text-[10px] text-gray-500 font-bold uppercase tracking-wider block mt-3">{{ \Carbon\Carbon::parse($activity['date'])->diffForHumans() }}</span>
                        </div>
                    </div>
                @elseif ($activity['type'] === 'wishlist')
                    <div class="flex gap-4 group">
                        <div
                            class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800/30 flex items-center justify-center shrink-0 transition-colors duration-300">
                            <i
                                class="fa-solid fa-ghost text-purple-600 dark:text-purple-500 text-sm transition-colors duration-300"></i>
                        </div>
                        <div class="flex-1 flex flex-col justify-center">
                            <p
                                class="text-sm text-gray-600 dark:text-gray-400 leading-snug transition-colors duration-300">
                                <span
                                    class="text-gray-900 dark:text-white font-bold group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors cursor-pointer">{{ $activity['user']->name }}</span>
                                añadió <span
                                    class="text-gray-900 dark:text-white font-bold cursor-pointer hover:underline transition-colors duration-300">{{ $activity['game']->title }}</span>
                                a sus pendientes
                            </p>
                            <span
                                class="text-[10px] text-gray-500 font-bold uppercase tracking-wider block mt-2">{{ \Carbon\Carbon::parse($activity['date'])->diffForHumans() }}</span>
                        </div>
                    </div>
                @elseif ($activity['type'] === 'capture')
                    <div class="flex gap-4 group">
                        <img src="{{ $activity['game']->cover_url }}"
                            class="w-10 h-10 rounded-xl object-cover border border-gray-200 dark:border-gray-700 shrink-0 transition-colors duration-300" />
                        <div class="flex-1">
                            <p
                                class="text-sm text-gray-600 dark:text-gray-400 leading-snug transition-colors duration-300">
                                <span
                                    class="text-gray-900 dark:text-white font-bold group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors cursor-pointer">{{ $activity['user']->name }}</span>
                                subió una captura de <span
                                    class="text-gray-900 dark:text-white font-bold cursor-pointer hover:underline">{{ $activity['game']->title }}</span>.
                            </p>
                            <div
                                class="mt-3 relative rounded-xl overflow-hidden border border-gray-200 dark:border-gray-800 aspect-video cursor-pointer transition-colors duration-300">
                                <img src="{{ Storage::url($activity['image_path']) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
                            </div>

                            <span
                                class="text-[10px] text-gray-500 font-bold uppercase tracking-wider block mt-3">{{ \Carbon\Carbon::parse($activity['date'])->diffForHumans() }}</span>
                        </div>
                    </div>
                @endif

            @empty
                <div class="flex flex-col items-center justify-center py-6 text-center">
                    <i class="fa-solid fa-wind text-gray-300 dark:text-gray-700 text-3xl mb-2"></i>
                    <p class="text-sm text-gray-500 font-bold">Aún no hay actividad social.</p>
                </div>
            @endforelse
        </div>

        <a href="{{ route('social') }}"
            class="w-full mt-6 py-3 border text-center border-gray-200 dark:border-gray-800 rounded-xl text-xs font-black uppercase tracking-widest text-cyan-600 dark:text-cyan-500 bg-gray-50 hover:bg-gray-100 dark:bg-transparent dark:hover:bg-[#1a1d27] transition-colors duration-300">
            Ver toda la actividad
        </a>
    </div>
</div>
