<div class="min-h-screen bg-[#0f1117] text-white font-sans relative">
    <div class="absolute top-0 w-full h-[60vh] z-0 overflow-hidden">
        <img src="https://images.igdb.com/igdb/image/upload/t_1080p/{{ $game->screenshots[0] ?? 'sc8c26' }}.jpg"
            class="w-full h-full object-cover opacity-30 blur-md scale-105"
            style="
        mask-image: linear-gradient(to bottom, black 40%, transparent);
        -webkit-mask-image: linear-gradient(
            to bottom,
            black 40%,
            transparent
        );
        " />
    </div>

    <main class="relative z-10 max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-8 flex flex-col gap-10">
                <div class="flex flex-col sm:flex-row gap-8 items-start">
                    <img src="{{ $game->cover_url }}"
                        class="w-48 rounded-2xl shadow-[0_0_30px_rgba(0,0,0,0.8)] border border-gray-700 shrink-0" />

                    <div class="flex-1 pt-2">
                        <div class="flex items-center gap-3 mb-2">
                            <span
                                class="bg-cyan-900/40 text-cyan-400 border border-cyan-800/50 px-3 py-1 rounded text-[10px] font-black uppercase tracking-widest">Lanzamiento:
                                {{ $game->first_release_date->year }}</span>
                            <span
                                class="text-gray-400 text-xs font-bold uppercase tracking-wider">{{ $game->companies->first()?->name ?? 'Desconocido' }}</span>
                        </div>
                        <h1 class="text-5xl md:text-6xl font-black text-white leading-tight tracking-tighter mb-4">
                            {{ $game->title }}
                        </h1>
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach ($game->genres as $genre)
                                <span
                                    class="text-gray-400 text-xs font-bold uppercase tracking-wider border border-gray-800 px-3 py-1 rounded-full">{{ $genre->name }}</span>
                            @endforeach
                        </div>

                        <div class="flex items-center gap-8">
                            <div>
                                <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mb-1">
                                    Nota Global
                                </p>
                                <div class="flex items-end gap-1">
                                    <span
                                        class="text-4xl font-black text-white leading-none">{{ $game->rating ?? '-' }}</span>
                                    <span class="text-sm text-cyan-500 font-bold mb-1"><i
                                            class="fa-solid fa-star"></i></span>
                                </div>
                            </div>
                            <div class="w-px h-10 bg-gray-800"></div>
                            <div>
                                <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mb-1">
                                    Tiempo Medio
                                </p>
                                <p class="text-2xl font-black text-white leading-none">
                                    @if ($game->avg_time === 0)
                                        No Registrado
                                    @else
                                        {{ $game->avg_time }}<span class="text-sm text-gray-500">h</span>
                                    @endif
                                </p>
                            </div>
                            <div class="w-px h-10 bg-gray-800"></div>
                            <div>
                                <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mb-1">
                                    Plataformas
                                </p>
                                <div class="flex gap-3 text-lg text-gray-400 mt-1">
                                    <i class="fa-brands fa-windows"></i>
                                    <i class="fa-brands fa-playstation"></i>
                                    <i class="fa-brands fa-xbox"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-[#1a1d27] to-[#0f1117] border border-gray-800 rounded-3xl p-8">
                    <h2 class="text-xs font-black text-cyan-500 uppercase tracking-widest mb-4">
                        Sinopsis
                    </h2>
                    <p class="text-gray-300 text-lg leading-relaxed">
                        {{ $game->synopsis }}
                    </p>
                </div>

                <div>
                    <h2 class="text-xl font-black text-white mb-6 flex items-center gap-3">
                        <i class="fa-solid fa-photo-film text-cyan-500"></i> Multimedia
                    </h2>

                    <div
                        class="aspect-video w-full rounded-2xl overflow-hidden border border-gray-800 mb-4 relative group">
                        <iframe class="absolute top-0 left-0 w-full h-full z-10" src="{{ $game->video_url }}"
                            frameborder="0" allowfullscreen></iframe>
                    </div>

                    <div class="grid grid-cols-4 gap-3">
                        @foreach (array_slice($game->screenshots, 0, 3) as $image)
                            <div
                                class="aspect-video rounded-xl overflow-hidden border border-gray-800 cursor-pointer hover:border-cyan-500 transition">
                                <img src="{{ "https://images.igdb.com/igdb/image/upload/t_screenshot_med/$image.jpg" }}"
                                    class="w-full h-full object-cover" />
                            </div>
                        @endforeach
                        <div
                            class="aspect-video rounded-xl overflow-hidden border border-gray-800 cursor-pointer hover:border-cyan-500 transition flex items-center justify-center bg-[#1a1d27]">
                            <span class="text-xs font-black uppercase tracking-widest text-cyan-500">+ Ver todas</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div
                    class="sticky top-24 bg-[#151821]/90 backdrop-blur-2xl border border-gray-700/50 rounded-3xl p-6 shadow-[0_20px_60px_rgba(0,0,0,0.5)]">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-800">
                        <div class="w-10 h-10 rounded-full bg-cyan-600 flex items-center justify-center text-white">
                            <i class="fa-solid fa-user-astronaut"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">
                                Tu Registro
                            </p>
                            <p class="text-sm font-black text-white">
                                Estado del Jugador
                            </p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <p class="text-[10px] text-gray-500 font-black uppercase tracking-widest mb-3">
                            Progreso Actual
                        </p>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="cursor-pointer relative">
                                <input type="radio" name="status" class="peer hidden" checked />
                                <div
                                    class="flex items-center gap-3 p-3 rounded-xl border border-gray-700 bg-[#0f1117] text-gray-400 peer-checked:bg-cyan-900/30 peer-checked:border-cyan-500 peer-checked:text-cyan-400 transition">
                                    <i class="fa-solid fa-gamepad text-lg"></i>
                                    <span class="text-xs font-black uppercase">Jugando</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="status" class="peer hidden" />
                                <div
                                    class="flex items-center gap-3 p-3 rounded-xl border border-gray-700 bg-[#0f1117] text-gray-400 peer-checked:bg-green-900/30 peer-checked:border-green-500 peer-checked:text-green-400 transition">
                                    <i class="fa-solid fa-check-double text-lg"></i>
                                    <span class="text-xs font-black uppercase">Completado</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="status" class="peer hidden" />
                                <div
                                    class="flex items-center gap-3 p-3 rounded-xl border border-gray-700 bg-[#0f1117] text-gray-400 peer-checked:bg-yellow-900/30 peer-checked:border-yellow-500 peer-checked:text-yellow-400 transition">
                                    <i class="fa-solid fa-pause text-lg"></i>
                                    <span class="text-xs font-black uppercase">Pausado</span>
                                </div>
                            </label>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="status" class="peer hidden" />
                                <div
                                    class="flex items-center gap-3 p-3 rounded-xl border border-gray-700 bg-[#0f1117] text-gray-400 peer-checked:bg-red-900/30 peer-checked:border-red-500 peer-checked:text-red-400 transition">
                                    <i class="fa-solid fa-skull text-lg"></i>
                                    <span class="text-xs font-black uppercase">Abandonado</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="mb-6 bg-[#0f1117] border border-gray-800 rounded-2xl p-5">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-500">Tu Nota</span>
                            <span class="text-[10px] font-bold text-cyan-400 uppercase tracking-widest">4 / 5</span>
                        </div>
                        <div class="flex justify-center gap-2 text-3xl">
                            <i class="fa-solid fa-star text-cyan-400 cursor-pointer hover:scale-110 transition"></i>
                            <i class="fa-solid fa-star text-cyan-400 cursor-pointer hover:scale-110 transition"></i>
                            <i class="fa-solid fa-star text-cyan-400 cursor-pointer hover:scale-110 transition"></i>
                            <i class="fa-solid fa-star text-cyan-400 cursor-pointer hover:scale-110 transition"></i>
                            <i
                                class="fa-solid fa-star text-gray-700 cursor-pointer hover:text-cyan-400 hover:scale-110 transition"></i>
                        </div>
                    </div>

                    <div class="mb-6">
                        <details class="group">
                            <summary
                                class="flex items-center gap-2 cursor-pointer text-sm font-bold text-gray-400 hover:text-cyan-400 transition list-none [&::-webkit-details-marker]:hidden">
                                <i class="fa-solid fa-pen-to-square"></i> Escribir una
                                reseña
                                <span
                                    class="text-[9px] font-black uppercase tracking-widest bg-[#0f1117] border border-gray-700 px-2 py-1 rounded ml-auto text-gray-500">Opcional</span>
                            </summary>
                            <div class="mt-4">
                                <textarea rows="3" placeholder="¿Qué te ha parecido el juego?..."
                                    class="w-full bg-[#0f1117] border border-gray-800 text-white rounded-xl p-4 text-sm font-medium focus:outline-none focus:border-cyan-500 transition resize-none placeholder-gray-600"></textarea>
                            </div>
                        </details>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
