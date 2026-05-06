<footer
    class="bg-gray-50 dark:bg-gray-950 border-t border-gray-200 dark:border-gray-800 transition-colors duration-300 pt-20 pb-10 relative overflow-hidden"
    aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Pie de página</h2>

    <div class="absolute bottom-0 right-0 w-1/2 h-1/2 bg-cyan-200/30 dark:bg-cyan-900/10 blur-3xl rounded-full pointer-events-none z-0 transition-colors duration-300"
        aria-hidden="true">
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

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
            </div>

            {{-- Navegación Explorar --}}
            <nav aria-label="Explorar">
                <h3
                    class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-6 transition-colors duration-300">
                    Explorar
                </h3>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('allGames') }}"
                            class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-950">
                            <i class="fa-solid fa-chevron-right text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"
                                aria-hidden="true"></i>
                            Catálogo de Juegos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery') }}"
                            class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-950">
                            <i class="fa-solid fa-chevron-right text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"
                                aria-hidden="true"></i>
                            Galería
                        </a>
                    </li>
                </ul>
            </nav>

            {{-- Navegación Soporte --}}
            @auth
                <nav aria-label="Comunidad">
                    <h3
                        class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-6 transition-colors duration-300">
                        Comunidad
                    </h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('social') }}"
                                class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-950">
                                <i class="fa-solid fa-chevron-right text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"
                                    aria-hidden="true"></i>
                                Feed Social
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('timeline') }}"
                                class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-950">
                                <i class="fa-solid fa-chevron-right text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"
                                    aria-hidden="true"></i>
                                Timeline
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile', auth()->id()) }}"
                                class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-950">
                                <i class="fa-solid fa-chevron-right text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"
                                    aria-hidden="true"></i>
                                Mi perfil
                            </a>
                        </li>
                    </ul>
                </nav>
            @endauth

            @guest
                <nav aria-label="Crear cuenta">
                    <h3
                        class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-6 transition-colors duration-300">
                        Únete
                    </h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('register') }}"
                                class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-950">
                                <i class="fa-solid fa-chevron-right text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"
                                    aria-hidden="true"></i>
                                Crear cuenta
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}"
                                class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-950">
                                <i class="fa-solid fa-chevron-right text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"
                                    aria-hidden="true"></i>
                                Iniciar sesión
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('password.request') }}"
                                class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-950">
                                <i class="fa-solid fa-chevron-right text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"
                                    aria-hidden="true"></i>
                                Recuperar contraseña
                            </a>
                        </li>
                    </ul>
                </nav>
            @endguest

            {{-- CUENTA --}}
            @auth
                <nav aria-label="Biblioteca">
                    <h3
                        class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-6 transition-colors duration-300">
                        Biblioteca
                    </h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-950">
                                <i class="fa-solid fa-chevron-right text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"
                                    aria-hidden="true"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('library') }}"
                                class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-950">
                                <i class="fa-solid fa-chevron-right text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"
                                    aria-hidden="true"></i>
                                Mi Biblioteca
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('userLists') }}"
                                class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-950">
                                <i class="fa-solid fa-chevron-right text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"
                                    aria-hidden="true"></i>
                                Mis Listas
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.show') }}"
                                class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-950">
                                <i class="fa-solid fa-chevron-right text-xs opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 mr-2 text-cyan-600 dark:text-cyan-500"
                                    aria-hidden="true"></i>
                                Ajustes de cuenta
                            </a>
                        </li>
                    </ul>
                </nav>
            @endauth

            @guest
                <nav aria-label="Entrar con">
                    <h3
                        class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-widest mb-6 transition-colors duration-300">
                        Entrar con
                    </h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('auth.steam.redirect') }}"
                                class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-950"
                                aria-label="Iniciar sesión con Steam">
                                <i class="fa-brands fa-steam text-sm opacity-80 mr-2" aria-hidden="true"></i>
                                Steam
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('auth.discord.redirect') }}"
                                class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-950"
                                aria-label="Iniciar sesión con Discord">
                                <i class="fa-brands fa-discord text-sm opacity-80 mr-2" aria-hidden="true"></i>
                                Discord
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('auth.google.redirect') }}"
                                class="group flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-950"
                                aria-label="Iniciar sesión con Google">
                                <i class="fa-brands fa-google text-sm opacity-80 mr-2" aria-hidden="true"></i>
                                Google
                            </a>
                        </li>
                    </ul>
                </nav>
            @endguest
        </div>

        {{-- FOOTER BAR --}}
        <div
            class="pt-8 border-t border-gray-200 dark:border-gray-800 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 transition-colors duration-300">
            <div class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider">
                &copy; {{ date('Y') }} Ludexis. Todos los derechos reservados.
            </div>
            <div class="flex flex-wrap items-center gap-4 md:gap-6">
                <span class="w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-700" aria-hidden="true"></span>

                <a href="https://github.com/antoniomedi6" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider hover:text-cyan-700 dark:hover:text-cyan-300 transition-colors focus:outline-none focus:underline"
                    aria-label="Repositorio del proyecto en GitHub">
                    <i class="fa-brands fa-github text-sm" aria-hidden="true"></i>
                    GitHub
                    <span class="sr-only">(se abre en una pestaña nueva)</span>
                </a>
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
