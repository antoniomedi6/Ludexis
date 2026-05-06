<div class="w-full max-w-sm bg-white dark:bg-gray-900 p-5 rounded-2xl border border-gray-200 dark:border-gray-800 flex flex-col gap-4 transition-colors duration-300 shadow-sm dark:shadow-none"
    aria-labelledby="preview-images-heading">

    {{-- CABECERA --}}
    <div class="flex justify-between items-end">
        <h2 id="preview-images-heading"
            class="text-sm font-black uppercase tracking-widest text-gray-900 dark:text-white flex items-center gap-2 transition-colors duration-300">
            <i class="fa-solid fa-camera-retro text-cyan-600 dark:text-cyan-400 transition-colors duration-300"
                aria-hidden="true"></i>
            Capturas
        </h2>
        <span class="text-xs text-gray-500 dark:text-gray-400 font-bold transition-colors duration-300">Comunidad</span>
    </div>

    @if ($images->isNotEmpty())
        {{-- IMAGEN PRINCIPAL --}}
        <div x-data @click="$dispatch('open-image-detail', { imageId: {{ $images->first()->id }} })"
            @keydown.enter="$dispatch('open-image-detail', { imageId: {{ $images->first()->id }} })" role="button"
            tabindex="0" aria-label="Ver captura destacada de {{ $images->first()->user->name }}"
            class="relative w-full aspect-video rounded-xl overflow-hidden group cursor-pointer border border-gray-200 dark:border-gray-800 hover:border-cyan-500/50 dark:hover:border-cyan-500/50 transition-colors duration-300 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-cyan-500">

            <img src="{{ Storage::url($images->first()->image_path) }}"
                alt="Captura de pantalla destacada de la comunidad"
                class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy">

            <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-300"
                aria-hidden="true"></div>

            <div class="absolute bottom-3 left-3 right-3 flex justify-between items-end z-10">
                <div class="flex items-center gap-2">
                    <img src="{{ $images->first()->user->profile_photo_url }}"
                        alt="Avatar de {{ $images->first()->user->name }}"
                        class="w-6 h-6 rounded-full border border-gray-400 dark:border-gray-600" loading="lazy">
                    <span
                        class="text-xs font-bold text-white drop-shadow-md group-hover:text-cyan-300 transition-colors duration-300">
                        {{ $images->first()->user->name }}
                    </span>
                </div>
            </div>
        </div>

        {{-- GRID DE MINIATURAS --}}
        <div class="grid grid-cols-3 gap-2" role="list">
            @foreach ($images->skip(1) as $item)
                <div role="listitem">
                    <div x-data @click="$dispatch('open-image-detail', { imageId: {{ $item->id }} })"
                        @keydown.enter="$dispatch('open-image-detail', { imageId: {{ $item->id }} })" role="button"
                        tabindex="0" aria-label="Ver captura adicional de la comunidad"
                        class="relative aspect-square rounded-lg overflow-hidden group border border-gray-200 dark:border-gray-800 hover:border-cyan-500/50 dark:hover:border-cyan-500/50 cursor-pointer transition-colors duration-300 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        <img src="{{ Storage::url($item->image_path) }}" alt="Captura de pantalla de la comunidad"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                            loading="lazy">
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- ESTADO VACIO --}}
        <div class="flex flex-col items-center justify-center py-10 px-4 bg-gray-50 dark:bg-gray-950 border-2 border-gray-200 dark:border-gray-800 rounded-xl transition-colors duration-300"
            role="status">
            <i class="fa-regular fa-images text-3xl text-gray-300 dark:text-gray-700 mb-3" aria-hidden="true"></i>
            <span class="text-xs font-bold text-gray-500 dark:text-gray-400 text-center block">
                {{ $gameSlug ? 'Aún no hay capturas de este juego.' : 'Aún no hay capturas.' }}
            </span>
            <span class="text-xs text-gray-400 dark:text-gray-600 mt-1 block text-center">¡Sé el primero en compartir
                una!</span>
        </div>
    @endif

    {{-- ENLACE --}}
    <a href="{{ $gameSlug ? route('gallery', $gameSlug) : route('gallery') }}"
        class="group w-full bg-gray-50 dark:bg-gray-950 hover:bg-cyan-50 dark:hover:bg-cyan-900/20 border border-gray-200 dark:border-gray-800 hover:border-cyan-200 dark:hover:border-cyan-800/50 text-cyan-700 dark:text-cyan-400 font-bold py-2.5 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 text-xs mt-1 focus:outline-none focus:ring-2 focus:ring-cyan-500">
        Explorar galería completa
        <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"
            aria-hidden="true"></i>
    </a>
</div>
