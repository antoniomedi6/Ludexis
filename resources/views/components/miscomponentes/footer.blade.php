<footer
    class="bg-gray-50 dark:bg-[#0f1117] border-t border-gray-200 dark:border-gray-800 transition-colors duration-300 pt-20 pb-10 relative overflow-hidden">
    <div
        class="absolute bottom-0 right-0 w-[40vw] h-[40vh] bg-cyan-200/30 dark:bg-cyan-900/10 blur-[150px] rounded-full pointer-events-none z-0 transition-colors duration-300">
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

            <div class="space-y-6">
                <a href="{{ route('welcome') }}"
                    class="text-2xl font-black text-cyan-600 dark:text-cyan-500 tracking-tighter transition-colors duration-300 block">
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
                    <a href="#"
                        class="w-10 h-10 rounded-xl bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-cyan-50 dark:hover:bg-[#1a1d27] hover:border-cyan-200 dark:hover:border-cyan-800/50 hover:text-cyan-600 dark:hover:text-cyan-400 transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1">
                        <i class="fa-brands fa-twitter text-lg"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-xl bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-cyan-50 dark:hover:bg-[#1a1d27] hover:border-cyan-200 dark:hover:border-cyan-800/50 hover:text-cyan-600 dark:hover:text-cyan-400 transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1">
                        <i class="fa-brands fa-discord text-lg"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-xl bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-cyan-50 dark:hover:bg-[#1a1d27] hover:border-cyan-200 dark:hover:border-cyan-800/50 hover:text-cyan-600 dark:hover:text-cyan-400 transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1">
                        <i class="fa-brands fa-github text-lg"></i>
                    </a>
                </div>
            </div>

            <div>
                <h3
                    class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-6 transition-colors duration-300">
                    Explorar
                </h3>
                <ul class="space-y-4">
                    <li>
                        <a href="#"
                            class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300">
                            <i
                                class="fa-solid fa-chevron-right text-[10px] opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"></i>
                            Catálogo de Juegos
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300">
                            <i
                                class="fa-solid fa-chevron-right text-[10px] opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"></i>
                            Tendencias de la Semana
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300">
                            <i
                                class="fa-solid fa-chevron-right text-[10px] opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"></i>
                            Mejores Reseñas
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300">
                            <i
                                class="fa-solid fa-chevron-right text-[10px] opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"></i>
                            Ruleta Rusa del Backlog
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h3
                    class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-6 transition-colors duration-300">
                    Soporte & Legal
                </h3>
                <ul class="space-y-4">
                    <li>
                        <a href="#"
                            class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300">
                            <i
                                class="fa-solid fa-chevron-right text-[10px] opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"></i>
                            Centro de Ayuda
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300">
                            <i
                                class="fa-solid fa-chevron-right text-[10px] opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"></i>
                            Términos de Servicio
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300">
                            <i
                                class="fa-solid fa-chevron-right text-[10px] opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"></i>
                            Política de Privacidad
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300">
                            <i
                                class="fa-solid fa-chevron-right text-[10px] opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"></i>
                            Sistema de Reputación
                        </a>
                    </li>
                </ul>
            </div>

            <div class="space-y-6">
                <h3
                    class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-4 transition-colors duration-300">
                    Únete a la Comunidad
                </h3>
                <p
                    class="text-sm font-medium text-gray-600 dark:text-gray-400 transition-colors duration-300 leading-relaxed">
                    Recibe un resumen semanal con los lanzamientos más esperados.
                </p>
                <form class="flex gap-2">
                    <input type="email" placeholder="Tu correo electrónico"
                        class="w-full bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white placeholder-gray-500 rounded-xl px-4 py-3 text-sm font-medium focus:outline-none focus:border-cyan-500 dark:focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors duration-300 shadow-inner">
                    <button type="button"
                        class="bg-cyan-600 hover:bg-cyan-500 text-white px-5 py-3 rounded-xl font-black transition-all duration-300 flex items-center justify-center shadow-[0_5px_15px_rgba(6,182,212,0.2)] dark:shadow-[0_5px_15px_rgba(6,182,212,0.3)] hover:-translate-y-1">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>

        </div>

        <div
            class="pt-8 border-t border-gray-200 dark:border-gray-800 flex flex-col md:flex-row justify-between items-center gap-6 transition-colors duration-300">
            <div class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider">
                &copy; {{ date('Y') }} Ludexis. Todos los derechos reservados.
            </div>

            <div class="flex flex-wrap items-center justify-center gap-6">
                <span
                    class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider flex items-center gap-1.5">
                    Datos por <a href="https://www.igdb.com/" target="_blank"
                        class="text-cyan-600 dark:text-cyan-500 hover:text-cyan-700 dark:hover:text-cyan-400 transition-colors">IGDB</a>
                </span>
                <span class="w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-700"></span>
                <span
                    class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider flex items-center gap-1.5">
                    Hecho en <i class="fa-brands fa-laravel text-red-500"></i> Laravel
                </span>
            </div>
        </div>
    </div>
</footer>
