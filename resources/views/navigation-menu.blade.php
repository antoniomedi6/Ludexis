<nav x-data="{ open: false }"
    class="fixed w-full top-0 left-0 z-50 bg-white/90 dark:bg-[#0f1117]/90 backdrop-blur-xl border-b border-gray-200 dark:border-gray-800 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center gap-8">

        <div class="flex items-center">
            <a href="{{ route('welcome') }}" wire:navigate
                class="text-2xl font-black text-cyan-600 dark:text-cyan-500 tracking-tighter shrink-0 transition-colors duration-300">
                <x-miscomponentes.application-logo-name />
            </a>
        </div>

        @livewire('utils.search-games')

        <div class="flex items-center gap-4 shrink-0">
            @guest
                @if (Route::has('login'))
                    <a href="{{ route('login') }}"
                        class="text-sm font-bold text-gray-600 dark:text-gray-300 hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors duration-300 hidden sm:block">
                        {{ __('Log in') }}
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-cyan-600 hover:bg-cyan-500 text-white text-sm font-black px-6 py-2.5 rounded-xl shadow-[0_5px_15px_rgba(6,182,212,0.2)] dark:shadow-[0_5px_15px_rgba(6,182,212,0.3)] transition-all duration-300 flex items-center gap-2 sm:flex hidden hover:-translate-y-1">
                        <i class="fa-solid fa-user-plus"></i> Regístrate
                    </a>
                @endif
            @endguest

            @auth
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex items-center gap-3 bg-gray-50 dark:bg-[#1a1d27]/80 border border-gray-200 dark:border-gray-800 hover:border-cyan-300 dark:hover:border-cyan-500/50 rounded-xl py-1.5 pl-1.5 pr-4 focus:outline-none transition-all duration-300 group shadow-sm">
                                    <img class="size-8 rounded-lg object-cover border border-gray-200 dark:border-gray-700 group-hover:border-cyan-500 transition-colors duration-300"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    <span
                                        class="text-xs font-black text-gray-700 dark:text-gray-200 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 uppercase tracking-widest transition-colors duration-300">{{ Auth::user()->name }}</span>
                                    <i
                                        class="fa-solid fa-chevron-down text-[10px] text-gray-400 dark:text-gray-500 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300"></i>
                                </button>
                            @else
                                <button type="button"
                                    class="flex items-center gap-3 bg-gray-50 dark:bg-[#1a1d27]/80 border border-gray-200 dark:border-gray-800 hover:border-cyan-300 dark:hover:border-cyan-500/50 rounded-xl px-4 py-2 focus:outline-none transition-all duration-300 group shadow-sm">
                                    <div
                                        class="size-6 rounded-lg bg-cyan-100 dark:bg-cyan-900/40 flex items-center justify-center border border-cyan-200 dark:border-cyan-800/50 shrink-0 transition-colors duration-300">
                                        <i
                                            class="fa-solid fa-user-astronaut text-[10px] text-cyan-600 dark:text-cyan-400"></i>
                                    </div>
                                    <span
                                        class="text-xs font-black text-gray-700 dark:text-gray-200 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 uppercase tracking-widest transition-colors duration-300">{{ Auth::user()->name }}</span>
                                    <i
                                        class="fa-solid fa-chevron-down text-[10px] text-gray-400 dark:text-gray-500 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors duration-300"></i>
                                </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <div
                                class="block px-4 py-2 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100 dark:border-gray-800 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-xl text-gray-500 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 hover:bg-gray-100 dark:hover:bg-[#1a1d27] focus:outline-none transition-colors duration-300">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden bg-white dark:bg-[#0f1117] border-t border-gray-200 dark:border-gray-800 transition-colors duration-300">
        <div class="pt-2 pb-3 space-y-1">
            @guest
                <a href="{{ route('login') }}"
                    class="block px-4 py-3 text-sm font-bold text-gray-600 dark:text-gray-300 hover:text-cyan-600 dark:hover:text-cyan-400 hover:bg-gray-50 dark:hover:bg-[#1a1d27] transition-colors duration-300">
                    {{ __('Log in') }}
                </a>
                <a href="{{ route('register') }}"
                    class="block px-4 py-3 text-sm font-bold text-cyan-600 dark:text-cyan-500 hover:text-cyan-700 dark:hover:text-cyan-400 hover:bg-cyan-50 dark:hover:bg-cyan-900/20 transition-colors duration-300">
                    <i class="fa-solid fa-user-plus mr-2"></i> Regístrate
                </a>
            @endguest
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-800">
                <div class="flex items-center px-4 mb-3">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 me-3">
                            <img class="size-10 rounded-xl object-cover border border-gray-200 dark:border-gray-700"
                                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="font-black text-base text-gray-900 dark:text-white">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-responsive-nav-link>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>

                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200 dark:border-gray-800 my-2"></div>

                        <div
                            class="block px-4 py-2 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">
                            {{ __('Manage Team') }}
                        </div>

                        <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                            :active="request()->routeIs('teams.show')">
                            {{ __('Team Settings') }}
                        </x-responsive-nav-link>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                {{ __('Create New Team') }}
                            </x-responsive-nav-link>
                        @endcan

                        @if (Auth::user()->allTeams()->count() > 1)
                            <div class="border-t border-gray-200 dark:border-gray-800 my-2"></div>

                            <div
                                class="block px-4 py-2 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" component="responsive-nav-link" />
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
        @endauth
    </div>
</nav>
