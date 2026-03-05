<div
    class="w-full max-w-sm bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-200 dark:border-gray-700 flex flex-col gap-4 transition-colors duration-300 shadow-sm dark:shadow-none">
    <div class="flex justify-between items-end">
        <h2
            class="text-sm font-black uppercase tracking-widest text-gray-900 dark:text-white flex items-center gap-2 transition-colors duration-300">
            <i class="fa-solid fa-camera-retro text-indigo-600 dark:text-indigo-400 transition-colors duration-300"></i>
            Capturas
        </h2>
        <span
            class="text-[10px] text-gray-500 dark:text-gray-400 font-bold transition-colors duration-300">Comunidad</span>
    </div>

    @if ($lastImages->isNotEmpty())
        <div
            class="relative w-full aspect-video rounded-xl overflow-hidden group cursor-pointer border border-gray-200 dark:border-gray-700 transition-colors duration-300">
            <img src="{{ Storage::url($lastImages->first()->image_path) }}"
                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-90"></div>
            <div class="absolute bottom-3 left-3 right-3 flex justify-between items-end">
                <div class="flex items-center gap-2">
                    <img src="{{ $lastImages->first()->user->profile_photo_url }}"
                        class="w-6 h-6 rounded-full border border-gray-400 dark:border-gray-500">
                    <span
                        class="text-xs font-bold text-white drop-shadow-md">{{ $lastImages->first()->user->name }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-2">
            @foreach ($lastImages->skip(1) as $item)
                <div
                    class="relative aspect-square rounded-lg overflow-hidden group border border-gray-200 dark:border-gray-700 cursor-pointer transition-colors duration-300">
                    <img src="{{ Storage::url($item->image_path) }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
            @endforeach
        </div>
    @endif

    <a href="#"
        class="w-full bg-gray-50 dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-700 text-indigo-600 dark:text-indigo-400 font-bold py-2.5 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 text-xs mt-1">
        Explorar galería completa <i class="fa-solid fa-arrow-right"></i>
    </a>
</div>
