<button x-data="{ show: false }" x-on:scroll.window="show = window.pageYOffset > 400" x-show="show"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-10"
    x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-10"
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    class="fixed bottom-8 right-8 z-50 p-3.5 bg-[#1a1d27]/80 backdrop-blur-md border border-cyan-500/50 hover:border-cyan-400 text-cyan-500 hover:text-cyan-400 rounded-full shadow-[0_0_15px_rgba(34,211,238,0.15)] hover:shadow-[0_0_20px_rgba(34,211,238,0.3)] hover:-translate-y-1 transition-all duration-300 group focus:outline-none"
    aria-label="Volver arriba" style="display: none;">
    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
        class="transition-transform duration-300 group-hover:-translate-y-1">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M6 15l6 -6l6 6" />
    </svg>
</button>
