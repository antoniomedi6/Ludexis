<div
    class="h-20 flex items-center justify-between px-4 md:px-8 shrink-0 z-30 sticky top-0 bg-white/80 dark:bg-[#0f1117]/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 transition-colors duration-300">

    {{-- BOTÓN HAMBURGUESA (MÓVIL) --}}
    <button @click="$dispatch('toggle-nav')"
        class="lg:hidden flex items-center justify-center w-10 h-10 rounded-lg bg-gray-50 dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors mr-4 focus:outline-none focus:ring-2 focus:ring-cyan-500"
        aria-label="Abrir menú de navegación principal">
        <i class="fa-solid fa-bars text-lg" aria-hidden="true"></i>
    </button>

    {{-- CONTENEDOR BUSCADOR --}}
    <div class="flex-1 max-w-2xl relative flex justify-end md:justify-start">
        @livewire('utils.search-games')
    </div>
</div>
