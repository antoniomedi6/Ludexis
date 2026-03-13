<div class="bg-[#0f1117] min-h-screen pb-20 font-sans text-gray-200">
    <div class="max-w-7xl mx-auto px-6 lg:px-10 pt-8 md:pt-12">

        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-start">

            <main class="flex-1 w-full order-2 lg:order-1">
                <div class="flex items-center gap-2 text-xs font-bold text-gray-500 mb-6 uppercase tracking-widest">
                    <a href="{{ route('allGames') }}" class="hover:text-cyan-400 transition">Catálogo</a>
                    <i class="fa-solid fa-chevron-right text-[8px]"></i>
                    <span class="text-gray-300">Juegos</span>
                    <i class="fa-solid fa-chevron-right text-[8px]"></i>
                    <span class="text-cyan-500">{{ $game->title }}</span>
                </div>

                <h1
                    class="text-4xl md:text-5xl font-black text-white pb-3 border-b-2 border-gray-800 mb-6 tracking-tight">
                    {{ $game->title }}
                </h1>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div
                        class="bg-[#151821] border border-gray-800 rounded-lg p-4 flex flex-col items-center justify-center">
                        <div class="text-2xl font-black text-cyan-400">{{ $game->rating }}</div>
                        <div class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mt-1">Nota Ludexis
                        </div>
                    </div>
                    <div
                        class="bg-[#151821] border border-gray-800 rounded-lg p-4 flex flex-col items-center justify-center">
                        <div class="text-2xl font-black text-teal-400">{{ $game->community_avg_time }}</div>
                        <div class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mt-1">Tiempo Medio
                            Hasta Finalización
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <section>
                        <p class="text-gray-300 leading-relaxed text-base md:text-lg">
                            {{ $game->synopsis }}
                        </p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-black text-white pb-2 border-b border-gray-800 mb-4">
                            Multimedia
                        </h2>
                        <div
                            class="aspect-video w-full bg-[#151821] rounded-lg overflow-hidden border border-gray-800 mb-4">
                            <iframe class="w-full h-full" src="{{ $game->video_url }}" frameborder="0"
                                allowfullscreen></iframe>
                        </div>
                        {{-- IMÁGENES --}}
                        {{--
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            <div
                                class="aspect-video bg-[#1a1d27] rounded-lg overflow-hidden border border-gray-800 cursor-pointer hover:border-cyan-500 transition">
                                <img src="https://images.igdb.com/igdb/image/upload/t_720p/sc7fwa.jpg"
                                    class="w-full h-full object-cover" />
                            </div>
                            <div
                                class="relative aspect-video bg-[#1a1d27] rounded-lg overflow-hidden border border-gray-800 cursor-pointer hover:border-cyan-500 transition">
                                <img src="https://images.igdb.com/igdb/image/upload/t_720p/sc7fwb.jpg"
                                    class="w-full h-full object-cover blur-md" />
                                <div class="absolute inset-0 flex items-center justify-center bg-black/40">
                                    <span
                                        class="text-[9px] font-black uppercase text-white bg-red-600 px-2 py-1 rounded">Spoiler</span>
                                </div>
                            </div>
                            <div
                                class="aspect-video bg-[#1a1d27] rounded-lg overflow-hidden border border-gray-800 cursor-pointer hover:border-cyan-500 transition hidden sm:block">
                                <img src="https://images.igdb.com/igdb/image/upload/t_720p/sc7fwc.jpg"
                                    class="w-full h-full object-cover" />
                            </div>
                        </div> 
                        --}}
                    </section>
                </div>

            </main>

            <aside class="w-full lg:w-80 shrink-0 space-y-6 order-1 lg:order-2 lg:sticky lg:top-10">

                <div class="space-y-4">
                    <div
                        class="w-48 sm:w-56 lg:w-full mx-auto aspect-[3/4] rounded-xl shadow-2xl border border-gray-800 overflow-hidden bg-[#151821]">
                        <img src="{{ $game->cover_url }}" class="w-full h-full object-cover" alt="Carátula" />
                    </div>

                    {{-- TU REGISTRO || CAMBIAR DISEÑO --}}
                    {{--
                    <div class="bg-[#151821] rounded-xl border border-gray-800 shadow-xl overflow-hidden">
                        <div
                            class="bg-cyan-600/10 py-2 px-4 border-b border-gray-800/50 flex justify-between items-center">
                            <h2
                                class="text-[10px] font-black uppercase tracking-widest text-cyan-400 flex items-center gap-2">
                                <i class="fa-solid fa-gamepad"></i> Tu Registro
                            </h2>
                            <span class="text-[9px] text-gray-500 font-bold uppercase">En Biblioteca</span>
                        </div>

                        <div class="p-4 space-y-5">

                            <div class="flex gap-3">
                                <div class="flex-1 relative">
                                    <select
                                        class="w-full bg-[#0f1117] border border-gray-700 rounded-lg pl-3 pr-8 py-2.5 text-xs font-bold text-white focus:outline-none focus:border-cyan-500 transition appearance-none cursor-pointer">
                                        <option>No en biblioteca</option>
                                        <option selected>🎮 Jugando</option>
                                        <option>⏳ Pendiente</option>
                                        <option>✅ Completado</option>
                                    </select>
                                    <i
                                        class="fa-solid fa-chevron-down absolute right-3 top-3.5 text-gray-500 pointer-events-none text-[10px]"></i>
                                </div>

                                <div
                                    class="w-24 relative flex items-center bg-[#0f1117] border border-gray-700 rounded-lg px-3">
                                    <input type="number" min="0" value="45"
                                        class="w-full bg-transparent text-white text-xs font-black text-center focus:outline-none" />
                                    <span class="text-[9px] font-bold text-gray-500 ml-1">hrs</span>
                                </div>
                            </div>

                            <div class="bg-[#0f1117]/50 rounded-lg border border-gray-800/50 p-3 text-center">
                                <label
                                    class="text-[9px] font-black text-gray-500 uppercase tracking-widest block mb-2">Tu
                                    Valoración</label>

                                <div class="flex justify-center items-center gap-1.5 text-xl cursor-pointer group">
                                    <i class="fa-solid fa-star text-cyan-400 hover:text-cyan-300 transition-colors"></i>
                                    <i class="fa-solid fa-star text-cyan-400 hover:text-cyan-300 transition-colors"></i>
                                    <i class="fa-solid fa-star text-cyan-400 hover:text-cyan-300 transition-colors"></i>
                                    <i class="fa-solid fa-star text-cyan-400 hover:text-cyan-300 transition-colors"></i>
                                    <i
                                        class="fa-regular fa-star text-gray-600 hover:text-cyan-300 transition-colors"></i>
                                </div>

                                <div class="text-[10px] text-cyan-500 font-bold mt-2 uppercase tracking-widest">
                                    ¡Me Encanta! (8/10)
                                </div>
                            </div>

                            <button
                                class="w-full bg-cyan-600 hover:bg-cyan-500 text-white font-black py-3 rounded-lg shadow-lg shadow-cyan-900/20 transition-all duration-300 flex items-center justify-center gap-2 text-xs uppercase tracking-tighter">
                                Actualizar Registro
                            </button>
                        </div>
                    </div>
                    --}}
                </div>

                <div class="bg-[#151821] border border-gray-800 rounded-xl overflow-hidden shadow-lg">
                    <div class="bg-[#1a1d27] py-3 px-4 border-b border-gray-800 text-center">
                        <h2 class="font-black text-white text-base tracking-tight uppercase">Ficha Técnica</h2>
                    </div>

                    <div class="flex flex-col text-[13px]">
                        <div class="flex justify-between items-center py-3 px-4 border-b border-gray-800/50">
                            <span
                                class="font-bold text-gray-500 uppercase text-[10px] tracking-widest shrink-0">Estudio</span>
                            <span class="text-cyan-400 font-black text-right truncate ml-4">
                                {{ $game->companies->first()?->name ?? 'Desconocido' }}
                            </span>
                        </div>

                        <div
                            class="flex justify-between items-center py-3 px-4 border-b border-gray-800/50 bg-[#1a1d27]/20">
                            <span
                                class="font-bold text-gray-500 uppercase text-[10px] tracking-widest shrink-0">Fecha</span>
                            <span class="text-gray-300 font-bold text-right ml-4">
                                {{ $game->first_release_date?->format('d M Y') ?? 'TBA' }}
                            </span>
                        </div>

                        <div class="flex flex-col gap-2 py-3 px-4 border-b border-gray-800/50">
                            <span class="font-bold text-gray-500 uppercase text-[10px] tracking-widest">Géneros</span>
                            <div class="flex flex-wrap gap-1.5">
                                @forelse ($game->genres as $genre)
                                    <span
                                        class="text-gray-400 text-[10px] bg-gray-800 px-2 py-1 rounded font-black border border-gray-700">
                                        {{ $genre->name }}
                                    </span>
                                @empty
                                    <span class="text-gray-600 text-[10px] italic">No definidos</span>
                                @endforelse
                            </div>
                        </div>

                        <div class="flex flex-col gap-1 py-3 px-4 bg-[#1a1d27]/20">
                            <span class="font-bold text-gray-500 uppercase text-[10px] tracking-widest">Sistemas</span>
                            <span class="text-gray-300 font-bold leading-relaxed text-xs">
                                @forelse ($game->platforms as $platform)
                                    {{ $platform->name }}@if (!$loop->last)
                                        ,
                                    @endif
                                @empty
                                    <span class="text-gray-600 italic">No definidos</span>
                                @endforelse
                            </span>
                        </div>
                    </div>
                </div>

                <button
                    class="w-full bg-[#1a1d27] hover:bg-gray-800 border border-gray-700 text-gray-400 font-bold py-3 rounded-xl transition flex items-center justify-center gap-2 text-xs uppercase tracking-widest">
                    <i class="fa-solid fa-list-ul text-cyan-500"></i> Añadir a lista
                </button>

            </aside>
        </div>
    </div>
</div>
