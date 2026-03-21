<x-miscomponentes.page-layout title1="Galería de la" title2="Comunidad" subtitle="Todas las capturas de la comunidad">
    <x-slot:aside>
        <x-miscomponentes.filters :filter="false" :orderBy="true">
            <x-slot:options>
                <option value="created_at">Más recientes</option>
            </x-slot:options>
        </x-miscomponentes.filters>
    </x-slot:aside>
    <x-slot>
        <div class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 2xl:columns-5 gap-6">

            @foreach ($images as $item)
                <div x-data="{ loaded: false }"
                    class="relative group rounded-3xl overflow-hidden bg-[#1a1d27] border border-gray-800 cursor-pointer shadow-lg break-inside-avoid mb-6">
                    <div x-show="!loaded"
                        class="w-full h-[350px] bg-[#151821] animate-pulse flex items-center justify-center">
                        <i class="fa-solid fa-gamepad text-gray-800 text-4xl"></i>
                    </div>

                    @if ($item->is_spoiler)
                        <div x-show="loaded"
                            class="absolute inset-0 z-20 bg-[#0f1117]/90 backdrop-blur-xl flex flex-col items-center justify-center p-6 text-center transition-opacity duration-500 group-hover:opacity-0 m-2 rounded-xl border-2 border-dashed border-gray-700">
                            <i class="fa-solid fa-eye-slash text-cyan-500 text-3xl mb-3"></i>
                            <h4 class="font-black text-white uppercase tracking-tighter text-lg">Spoiler
                            </h4>
                            <p class="text-[10px] text-gray-400 font-bold mt-1 uppercase tracking-widest">
                                Haz clic para revelar</p>
                        </div>
                    @endif

                    <img src="{{ Storage::url($item->image_path) }}" @load="loaded = true" x-show="loaded" x-cloak
                        x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0 blur-md scale-105"
                        x-transition:enter-end="opacity-100 blur-0 scale-100"
                        class="w-full h-auto block transition-transform duration-700 group-hover:scale-105" />

                    <div x-show="loaded" x-cloak
                        class="absolute inset-0 flex flex-col justify-between p-5 opacity-0 group-hover:opacity-100 bg-gradient-to-t from-[#0f1117] via-[#0f1117]/40 to-transparent transition-opacity duration-300 @if ($item->is_spoiler) z-10 @endif">
                        <div class="flex justify-end">
                            <button
                                class="w-10 h-10 rounded-full bg-[#0f1117]/80 backdrop-blur text-gray-300 hover:text-red-500 hover:bg-white flex items-center justify-center transition shadow-sm">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </div>
                        <div>
                            <span
                                class="bg-cyan-900/80 backdrop-blur border border-cyan-500/50 text-cyan-300 text-[10px] font-black uppercase tracking-widest px-2.5 py-1 rounded-lg mb-3 inline-block shadow-sm">
                                {{ $item->game->title ?? 'Juego Desconocido' }}
                            </span>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    @if ($item->user->profile_photo_path)
                                        <img src="{{ Storage::url($item->user->profile_photo_path) }}"
                                            class="w-8 h-8 rounded-full border border-gray-600 object-cover" />
                                    @else
                                        <div
                                            class="w-8 h-8 rounded-full bg-cyan-600 flex items-center justify-center font-black text-xs text-white border border-gray-600">
                                            {{ strtoupper(substr($item->user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span
                                        class="font-bold text-sm text-white drop-shadow-md">{{ $item->user->name }}</span>
                                </div>
                                <div class="flex gap-3 text-xs font-bold text-white drop-shadow-md">
                                    <span class="flex items-center gap-1.5">
                                        <i class="fa-solid fa-heart text-red-500"></i>
                                        {{ $item->likes_count ?? 0 }}
                                    </span>
                                    <span class="flex items-center gap-1.5">
                                        <i class="fa-solid fa-comment"></i>
                                        {{ $item->comments_count ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </x-slot>
</x-miscomponentes.page-layout>
