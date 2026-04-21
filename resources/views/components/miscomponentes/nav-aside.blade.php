<div x-data="{ showNav: window.innerWidth < 1024 ? false : localStorage.getItem('showNav') !== 'false' }" @toggle-nav.window="showNav = !showNav" x-init="$watch('showNav', value => { if (window.innerWidth >= 1024) localStorage.setItem('showNav', value) })"
    @resize.window="if(window.innerWidth < 1024) showNav = false">

    {{-- BACKDROP OPACIDAD PARA MÓVILES --}}
    <div x-show="showNav" @click="showNav = false"
        class="fixed inset-0 bg-[#0f1117]/80 backdrop-blur-sm z-40 lg:hidden transition-opacity" x-transition.opacity
        style="display: none;" aria-hidden="true"></div>

    <aside :class="showNav ? 'translate-x-0 w-64' : '-translate-x-full w-64 lg:translate-x-0 lg:w-24'"
        class="bg-white dark:bg-[#151821] border-r border-gray-200 dark:border-gray-800 flex flex-col justify-between z-50 h-screen transition-all duration-300 fixed lg:relative top-0 left-0 lg:shrink-0"
        aria-label="Navegación principal">

        <div class="w-full flex flex-col overflow-hidden h-full">

            <div class="p-6 border-b border-gray-100 dark:border-gray-800/60 flex shrink-0 transition-all duration-300"
                :class="showNav ? 'flex-row items-center justify-between' : 'flex-col items-center gap-6'">

                <a href="{{ route('dashboard') }}"
                    class="block shrink-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 rounded-lg"
                    aria-label="Ir a la página de inicio">
                    <div x-show="showNav" style="display: none;">
                        <x-miscomponentes.application-logo-name aria-hidden="true" />
                    </div>
                    <div x-show="!showNav" style="display: none;">
                        <x-icons.logo class="h-12" aria-hidden="true" />
                    </div>
                </a>

                {{-- BOTÓN REPLEGAR (OCULTO EN MÓVILES) --}}
                <button @click="showNav = !showNav"
                    class="hidden lg:flex items-center justify-center w-8 h-8 rounded-lg bg-gray-50 dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 hover:text-cyan-500 dark:hover:text-cyan-400 hover:border-cyan-300 dark:hover:border-cyan-500/50 hover:bg-cyan-50 dark:hover:bg-cyan-900/20 transition-all duration-300 shrink-0 shadow-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500"
                    :aria-expanded="showNav.toString()" aria-label="Alternar menú de navegación">
                    <div class="transition-transform duration-300 flex items-center justify-center"
                        :class="!showNav ? 'rotate-180' : ''" aria-hidden="true">
                        <x-icons.arrow-left class="size-4" />
                    </div>
                </button>
            </div>

            <div class="p-4 w-full flex-1 overflow-y-auto flex flex-col gap-6">

                <div class="flex flex-col w-full">
                    <span x-show="showNav" style="display: none;"
                        class="px-4 text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2 transition-opacity duration-300"
                        id="nav-mi-espacio">
                        Mi Espacio
                    </span>

                    <nav aria-labelledby="nav-mi-espacio"
                        class="space-y-1 w-full bg-gray-50/50 dark:bg-[#1a1d27]/40 p-2 rounded-2xl border border-gray-100 dark:border-gray-800/50">
                        <a href="{{ route('dashboard') }}" wire:navigate
                            class="flex items-center p-3 rounded-xl font-bold transition-all duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 {{ request()->routeIs('dashboard') ? 'bg-white dark:bg-[#202431] text-cyan-600 dark:text-cyan-400 shadow-sm border border-gray-200 dark:border-gray-700' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-white dark:hover:bg-[#202431] border border-transparent' }}"
                            :class="showNav ? 'gap-3 px-4' : 'justify-center'"
                            :aria-current="{{ request()->routeIs('dashboard') ? "'page'" : 'false' }}">
                            <x-icons.home class="size-5 shrink-0" aria-hidden="true" />
                            <span x-show="showNav" style="display: none;" class="whitespace-nowrap">Inicio</span>
                            <span class="sr-only" x-show="!showNav">Inicio</span>
                        </a>

                        <a href="{{ route('library') }}" wire:navigate
                            class="flex items-center p-3 rounded-xl font-bold transition-all duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 {{ request()->is('myLibrary') ? 'bg-white dark:bg-[#202431] text-cyan-600 dark:text-cyan-400 shadow-sm border border-gray-200 dark:border-gray-700' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-white dark:hover:bg-[#202431] border border-transparent' }}"
                            :class="showNav ? 'gap-3 px-4' : 'justify-center'"
                            :aria-current="{{ request()->is('myLibrary') ? "'page'" : 'false' }}">
                            <x-icons.gamepad class="size-5 shrink-0" aria-hidden="true" />
                            <span x-show="showNav" style="display: none;" class="whitespace-nowrap">Mi Biblioteca</span>
                            <span class="sr-only" x-show="!showNav">Mi Biblioteca</span>
                        </a>

                        <a href="{{ route('userLists') }}" wire:navigate
                            class="flex items-center p-3 rounded-xl font-bold transition-all duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 {{ request()->is('userLists*') ? 'bg-white dark:bg-[#202431] text-cyan-600 dark:text-cyan-400 shadow-sm border border-gray-200 dark:border-gray-700' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-white dark:hover:bg-[#202431] border border-transparent' }}"
                            :class="showNav ? 'gap-3 px-4' : 'justify-center'"
                            :aria-current="{{ request()->is('userLists*') ? "'page'" : 'false' }}">
                            <x-icons.list class="size-5 shrink-0" aria-hidden="true" />
                            <span x-show="showNav" style="display: none;" class="whitespace-nowrap">Mis Listas</span>
                            <span class="sr-only" x-show="!showNav">Mis Listas</span>
                        </a>


                        <a href="{{ route('timeline') }}" wire:navigate
                            class="flex items-center p-3 rounded-xl font-bold transition-all duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 {{ request()->is('timeline') ? 'bg-white dark:bg-[#202431] text-cyan-600 dark:text-cyan-400 shadow-sm border border-gray-200 dark:border-gray-700' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-white dark:hover:bg-[#202431] border border-transparent' }}"
                            :class="showNav ? 'gap-3 px-4' : 'justify-center'"
                            :aria-current="{{ request()->is('timeline') ? "'page'" : 'false' }}">
                            <x-icons.timeline aria-hidden="true" />
                            <span x-show="showNav" style="display: none;" class="whitespace-nowrap">Timeline</span>
                            <span class="sr-only" x-show="!showNav">Timeline</span>
                        </a>

                        <a href="{{ route('allGames') }}" wire:navigate
                            class="flex items-center p-3 rounded-xl font-bold transition-all duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 {{ request()->is('allGames', 'showGame.*') ? 'bg-white dark:bg-[#202431] text-cyan-600 dark:text-cyan-400 shadow-sm border border-gray-200 dark:border-gray-700' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-white dark:hover:bg-[#202431] border border-transparent' }}"
                            :class="showNav ? 'gap-3 px-4' : 'justify-center'"
                            :aria-current="{{ request()->is('allGames', 'showGame.*') ? "'page'" : 'false' }}">
                            <x-icons.catalog class="size-5 shrink-0" aria-hidden="true" />
                            <span x-show="showNav" style="display: none;" class="whitespace-nowrap">Explorar
                                Catálogo</span>
                            <span class="sr-only" x-show="!showNav">Explorar Catálogo</span>
                        </a>
                    </nav>
                </div>

                <div class="flex flex-col w-full">
                    <span x-show="showNav" style="display: none;"
                        class="px-4 text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2 transition-opacity duration-300"
                        id="nav-comunidad">
                        Comunidad
                    </span>

                    <nav aria-labelledby="nav-comunidad"
                        class="space-y-1 w-full bg-gray-50/50 dark:bg-[#1a1d27]/40 p-2 rounded-2xl border border-gray-100 dark:border-gray-800/50">
                        <a href="{{ route('social') }}" wire:navigate
                            class="flex items-center p-3 rounded-xl font-bold transition-all duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 {{ request()->is('feedSocial') ? 'bg-white dark:bg-[#202431] text-cyan-600 dark:text-cyan-400 shadow-sm border border-gray-200 dark:border-gray-700' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-white dark:hover:bg-[#202431] border border-transparent' }}"
                            :class="showNav ? 'gap-3 px-4' : 'justify-center'"
                            :aria-current="{{ request()->is('feedSocial') ? "'page'" : 'false' }}">
                            <x-icons.social aria-hidden="true" />
                            <span x-show="showNav" style="display: none;" class="whitespace-nowrap">Social</span>
                            <span class="sr-only" x-show="!showNav">Social</span>
                        </a>

                        <a href="{{ route('gallery') }}" wire:navigate
                            class="flex items-center p-3 rounded-xl font-bold transition-all duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 {{ request()->is('gallery') ? 'bg-white dark:bg-[#202431] text-cyan-600 dark:text-cyan-400 shadow-sm border border-gray-200 dark:border-gray-700' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-white dark:hover:bg-[#202431] border border-transparent' }}"
                            :class="showNav ? 'gap-3 px-4' : 'justify-center'"
                            :aria-current="{{ request()->is('gallery') ? "'page'" : 'false' }}">
                            <x-icons.gallery aria-hidden="true" />
                            <span x-show="showNav" style="display: none;" class="whitespace-nowrap">Galería</span>
                            <span class="sr-only" x-show="!showNav">Galería</span>
                        </a>
                    </nav>
                </div>

            </div>
        </div>

        @auth
            <div x-data="{ showProfileOptions: false }"
                class="relative w-full shrink-0 border-t border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-transparent transition-colors duration-300"
                @click.away="showProfileOptions = false" @keydown.escape.window="showProfileOptions = false">

                <div x-show="showProfileOptions" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-x-4 scale-95"
                    x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-x-0 scale-100"
                    x-transition:leave-end="opacity-0 -translate-x-4 scale-95" style="display: none;"
                    class="fixed bottom-6 w-48 bg-white dark:bg-[#151821] border border-gray-200 dark:border-gray-800 rounded-2xl shadow-[0_0_30px_rgba(0,0,0,0.5)] z-[100] transition-all duration-300"
                    :class="showNav ? 'left-4 lg:left-[17rem]' : 'left-4 lg:left-[7rem]'" role="menu"
                    aria-orientation="vertical" aria-labelledby="user-menu-button">

                    <div class="p-2 flex flex-col gap-1">
                        <a href="{{ route('profile', Auth::id()) }}" wire:navigate
                            class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-widest text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 hover:bg-gray-50 dark:hover:bg-[#1a1d27] transition-colors duration-300 w-full text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500"
                            role="menuitem">
                            <i class="fa-solid fa-user text-sm w-4 text-center" aria-hidden="true"></i>
                            {{ __('Mi Perfil') }}
                        </a>

                        <a href="{{ route('profile.show') }}" wire:navigate
                            class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-widest text-gray-600 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 hover:bg-gray-50 dark:hover:bg-[#1a1d27] transition-colors duration-300 w-full text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500"
                            role="menuitem">
                            <i class="fa-solid fa-gear text-sm w-4 text-center" aria-hidden="true"></i>
                            {{ __('Opciones') }}
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-widest text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors duration-300 w-full text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500"
                                role="menuitem">
                                <i class="fa-solid fa-right-from-bracket text-sm w-4 text-center" aria-hidden="true"></i>
                                {{ __('Cerrar Sesión') }}
                            </button>
                        </form>
                    </div>
                </div>

                <button @click="showProfileOptions = !showProfileOptions" id="user-menu-button" aria-haspopup="true"
                    :aria-expanded="showProfileOptions.toString()"
                    class="block p-6 w-full text-left hover:bg-gray-100 dark:hover:bg-[#1a1d27] transition-all duration-300 cursor-pointer group focus:outline-none focus-visible:ring-inset focus-visible:ring-2 focus-visible:ring-cyan-500"
                    :class="showProfileOptions ? 'bg-gray-100 dark:bg-[#1a1d27]' : ''"
                    aria-label="Opciones de usuario para {{ Auth::user()->name }}">

                    <div class="flex items-center"
                        :class="showNav ? 'gap-3 mb-4' : 'justify-center mb-0 lg:justify-center'">
                        <img src="{{ Auth::user()->profile_photo_path }}" alt="Avatar de {{ Auth::user()->name }}"
                            class="w-10 h-10 rounded-full">
                        <div x-show="showNav" style="display: none;" class="flex-1 overflow-hidden whitespace-nowrap">
                            <h2
                                class="font-bold text-sm leading-tight text-gray-900 dark:text-white truncate group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300">
                                {{ Auth::user()->name }}
                            </h2>
                            <span class="text-[10px] font-black text-cyan-600 dark:text-cyan-400 uppercase tracking-wider">
                                {{ Auth::user()->role ?? 'Default' }}
                            </span>
                        </div>
                    </div>

                    <div x-show="showNav" style="display: none;" class="space-y-1.5 whitespace-nowrap w-full"
                        aria-hidden="true">
                        <div class="flex justify-between text-[10px] text-gray-500 font-bold uppercase tracking-wider">
                            <span>XP: {{ Auth::user()->xp ?? 0 }}</span>
                        </div>
                        <div
                            class="w-full bg-gray-200 dark:bg-[#0f1117] rounded-full h-1.5 overflow-hidden border border-transparent dark:border-gray-800">
                            <div class="bg-gradient-to-r from-cyan-500 to-teal-400 h-full rounded-full transition-all duration-700"
                                style="width: {{ Auth::user()->xp ?? 45 }}%"></div>
                        </div>
                    </div>
                </button>
            </div>
        @endauth
    </aside>
</div>
