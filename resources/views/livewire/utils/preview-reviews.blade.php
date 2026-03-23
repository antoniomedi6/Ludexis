<div class="lg:col-span-2 space-y-6">
    <div class="flex justify-between items-end mb-2">
        <h2
            class="text-2xl font-black flex items-center gap-2 text-gray-900 dark:text-white transition-colors duration-300">
            <i class="fa-solid fa-star text-indigo-500"></i> Reseñas Destacadas
        </h2>
    </div>

    @foreach ($lastReviews as $item)
        <div
            class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-md dark:shadow-lg hover:border-indigo-400 dark:hover:border-indigo-500/50 transition-all duration-300 flex flex-col sm:flex-row gap-6">

            <div
                class="w-24 h-32 bg-gray-100 dark:bg-gray-900 rounded-lg shrink-0 border border-gray-200 dark:border-gray-600 overflow-hidden shadow-sm dark:shadow-md hidden sm:block">
                <a href="{{ route('games.show', $item->game->slug) }}">
                    <img src="{{ $item->game->cover_url }}"
                        class="w-full h-full object-cover hover:scale-105 transition duration-500"
                        alt="Portada de {{ $item->game->title }}" />
                </a>
            </div>

            <div class="flex-1">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex gap-3 items-center">

                        <img src="{{ $item->user->profile_photo_url }}" alt="{{ $item->user->name }}"
                            class="w-8 h-8 rounded-full border border-indigo-500 object-cover" />

                        <div>
                            <div class="flex items-center gap-2">
                                <h4
                                    class="font-bold text-sm text-gray-900 dark:text-white transition-colors duration-300">
                                    {{ $item->user->name }}</h4>
                                <span
                                    class="text-[9px] bg-indigo-100 text-indigo-700 dark:bg-indigo-600 dark:text-white px-1.5 py-0.5 rounded font-black uppercase shadow-sm transition-colors duration-300">
                                    {{ $item->user->role }}
                                </span>
                            </div>
                            <p
                                class="text-[10px] text-gray-500 dark:text-gray-400 font-bold uppercase mt-0.5 transition-colors duration-300">
                                Sobre <span class="text-indigo-600 dark:text-indigo-300">{{ $item->game->title }}</span>
                            </p>
                        </div>
                    </div>

                    <span
                        class="text-xl font-black text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 px-3 py-1 rounded-lg border border-indigo-200 dark:border-indigo-500/30 transition-colors duration-300">
                        {{ $item->rating }}
                    </span>
                </div>

                <p class="text-sm text-gray-700 dark:text-gray-300 italic transition-colors duration-300">
                    "{{ $item->review }}"
                </p>
            </div>
        </div>
    @endforeach
</div>
