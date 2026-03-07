<footer
    class="bg-white dark:bg-gray-950 border-t border-gray-200 dark:border-gray-800 transition-colors duration-300 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">

            <div class="space-y-4">
                <a href="{{ route('dashboard') }}"
                    class="text-2xl font-black text-indigo-600 dark:text-indigo-500 tracking-tighter transition-colors duration-300 block">
                    <div class="flex items-center">
                        <x-miscomponentes.application-logo-name />
                    </div>
                </a>
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed transition-colors duration-300">
                    Tu biblioteca definitiva. Descubre qué jugar, trackea tus horas exactas y lee reseñas ponderadas por
                    un sistema de reputación real.
                </p>
                <div class="flex space-x-4 pt-2">
                    <a href="#"
                        class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-300">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="#"
                        class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-300">
                        <i class="fa-brands fa-discord"></i>
                    </a>
                    <a href="#"
                        class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-300">
                        <i class="fa-brands fa-github"></i>
                    </a>
                </div>
            </div>

            <div>
                <h3
                    class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-4 transition-colors duration-300">
                    Explorar</h3>
                <ul class="space-y-3">
                    <li><a href="#"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition-colors duration-300">Catálogo
                            de Juegos</a></li>
                    <li><a href="#"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition-colors duration-300">Tendencias
                            de la Semana</a></li>
                    <li><a href="#"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition-colors duration-300">Mejores
                            Reseñas</a></li>
                    <li><a href="#"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition-colors duration-300">Ruleta
                            Rusa del Backlog</a></li>
                </ul>
            </div>

            <div>
                <h3
                    class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-4 transition-colors duration-300">
                    Soporte & Legal</h3>
                <ul class="space-y-3">
                    <li><a href="#"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition-colors duration-300">Centro
                            de Ayuda</a></li>
                    <li><a href="#"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition-colors duration-300">Términos
                            de Servicio</a></li>
                    <li><a href="#"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition-colors duration-300">Política
                            de Privacidad</a></li>
                    <li><a href="#"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition-colors duration-300">Sistema
                            de Reputación</a></li>
                </ul>
            </div>

            <div class="space-y-4">
                <h3
                    class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-4 transition-colors duration-300">
                    Únete a la Comunidad</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 transition-colors duration-300">
                    Recibe un resumen semanal con los lanzamientos más esperados.
                </p>
                <form class="flex gap-2">
                    <input type="email" placeholder="Tu correo electrónico"
                        class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-500 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors duration-300">
                    <button type="button"
                        class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg font-bold transition-colors duration-300 flex items-center justify-center">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>

        </div>

        <div
            class="pt-8 border-t border-gray-200 dark:border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4 transition-colors duration-300">
            <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">
                &copy; {{ date('Y') }} Ludexis. Todos los derechos reservados.
            </div>

            <div class="flex items-center gap-6">
                <span class="text-xs text-gray-500 dark:text-gray-400 font-medium flex items-center gap-1">
                    Datos proporcionados por <a href="https://www.igdb.com/" target="_blank"
                        class="text-indigo-600 dark:text-indigo-400 hover:underline font-bold">IGDB</a>
                </span>
                <span class="text-xs text-gray-500 dark:text-gray-400 font-medium flex items-center gap-1">
                    Hecho en Laravel & Livewire
                </span>
            </div>
        </div>
    </div>
</footer>
