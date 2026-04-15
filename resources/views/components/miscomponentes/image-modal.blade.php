<div x-data="{ open: false, imageUrl: '' }" @open-image-modal.window="imageUrl = $event.detail.url; open = true"
    @keydown.escape.window="open = false" x-show="open" style="display: none;"
    class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6" role="dialog" aria-modal="true"
    aria-label="Visor de imágenes">

    {{-- Fondo oscuro con desenfoque --}}
    <div x-show="open" x-transition.opacity.duration.300ms
        class="absolute inset-0 bg-gray-900/95 backdrop-blur-md cursor-pointer" @click="open = false"
        aria-hidden="true"></div>

    {{-- Contenedor de la imagen ampliada --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="relative w-full max-w-6xl mx-auto flex flex-col items-center z-10" @click.stop>

        <button type="button" @click="open = false"
            class="absolute -top-12 right-0 sm:-right-10 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-cyan-500 rounded-full p-2 transition-colors"
            aria-label="Cerrar visor">
            <i class="fa-solid fa-xmark text-3xl" aria-hidden="true"></i>
        </button>

        <img :src="imageUrl"
            class="w-full h-auto max-h-[85vh] object-contain rounded-xl shadow-2xl border border-gray-800/50"
            alt="Captura ampliada a máxima resolución" />
    </div>
</div>
