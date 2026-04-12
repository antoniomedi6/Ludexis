<footer
    class="bg-gray-50 dark:bg-gray-950 border-t border-gray-200 dark:border-gray-800 transition-colors duration-300 pt-20 pb-10 relative overflow-hidden"
    aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Pie de página</h2>

    <div class="absolute bottom-0 right-0 w-[40vw] h-[40vh] bg-cyan-200/30 dark:bg-cyan-900/10 blur-3xl rounded-full pointer-events-none z-0 transition-colors duration-300"
        aria-hidden="true">
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mb-16">

            {{-- Bloque de Marca --}}
            <div class="space-y-6">
                <a href="{{ route('welcome') }}"
                    class="text-2xl font-black text-cyan-600 dark:text-cyan-500 tracking-tighter transition-colors duration-300 block focus:outline-none focus:ring-2 focus:ring-cyan-500 rounded-lg">
                    <div class="flex items-center">
                        <x-miscomponentes.application-logo-name />
                    </div>
                </a>
                <p
                    class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed font-medium transition-colors duration-300">
                    Tu biblioteca definitiva. Descubre qué jugar, trackea tus horas exactas y lee reseñas ponderadas por
                    un sistema de reputación real.
                </p>
                <div class="flex space-x-3 pt-2">
                    <a href="#" aria-label="Visitar nuestro repositorio en GitHub"
                        class="w-10 h-10 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-cyan-50 dark:hover:bg-gray-800 hover:border-cyan-200 dark:hover:border-cyan-800/50 hover:text-cyan-600 dark:hover:text-cyan-400 transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        <i class="fa-brands fa-github text-lg" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            {{-- Navegación Explorar --}}
            <div>
                <h3
                    class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-6 transition-colors duration-300">
                    Explorar
                </h3>
                <ul class="space-y-4" role="list">
                    <li>
                        <a href="{{ route('allGames') }}"
                            class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 focus:outline-none focus:underline">
                            <i class="fa-solid fa-chevron-right text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"
                                aria-hidden="true"></i>
                            Catálogo de Juegos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('social') }}"
                            class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 focus:outline-none focus:underline">
                            <i class="fa-solid fa-chevron-right text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"
                                aria-hidden="true"></i>
                            Mejores Reseñas
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Navegación Soporte --}}
            <div>
                <h3
                    class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-6 transition-colors duration-300">
                    Soporte & Legal
                </h3>
                <ul class="space-y-4" role="list">
                    <li>
                        <a href="#"
                            class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 focus:outline-none focus:underline">
                            <i class="fa-solid fa-chevron-right text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"
                                aria-hidden="true"></i>
                            Documentación
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- 
        <div class="pt-8 border-t border-gray-200 dark:border-gray-800 flex flex-col md:flex-row justify-between items-center gap-6 transition-colors duration-300">
            <div class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider">
                &copy; {{ date('Y') }} Ludexis. Todos los derechos reservados.
            </div>

            <div class="flex flex-wrap items-center justify-center gap-6">
                <span class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider flex items-center gap-1.5">
                    Datos por <a href="https://www.igdb.com/" target="_blank" aria-label="Visitar la web de IGDB" class="text-cyan-600 dark:text-cyan-500 hover:text-cyan-700 dark:hover:text-cyan-400 transition-colors focus:outline-none focus:underline">IGDB</a>
                </span>
                <span class="w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-700" aria-hidden="true"></span>
                <span class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider flex items-center gap-1.5">
                    Hecho en <i class="fa-brands fa-laravel text-red-500" aria-hidden="true"></i> Laravel
                </span>
            </div>
        </div>
        --}}
    </div>
</footer>
