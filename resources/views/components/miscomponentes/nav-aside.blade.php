<aside x-data="{ showNav: localStorage.getItem('showNav') !== 'false' }" x-init="$watch('showNav', value => localStorage.setItem('showNav', value))" :class="showNav ? 'w-64' : 'w-24'"
    class="bg-white dark:bg-[#151821] border-r border-gray-200 dark:border-gray-800 flex flex-col justify-between shrink-0 z-50 h-screen transition-all duration-300 relative overflow-hidden">

    <div class="w-full overflow-hidden">

        <div class="p-6 border-b border-gray-100 dark:border-gray-800/60 flex transition-all duration-300"
            :class="showNav ? 'flex-row items-center justify-between' : 'flex-col items-center gap-6'">

            <a href="{{ route('dashboard') }}" class="block shrink-0">
                <div x-show="showNav" style="display: none;">
                    <x-miscomponentes.application-logo-name />
                </div>
                <div x-show="!showNav" style="display: none;">
                    <x-icons.logo class="h-12" />
                </div>
            </a>

            <button @click="showNav = !showNav"
                class="flex items-center justify-center w-8 h-8 rounded-lg bg-gray-50 dark:bg-[#1a1d27] border border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 hover:text-cyan-500 dark:hover:text-cyan-400 hover:border-cyan-300 dark:hover:border-cyan-500/50 hover:bg-cyan-50 dark:hover:bg-cyan-900/20 transition-all duration-300 shrink-0 shadow-sm"
                title="Alternar menú">
                <div class="transition-transform duration-300 flex items-center justify-center"
                    :class="!showNav ? 'rotate-180' : ''">
                    <x-icons.arrow-left class="size-4" />
                </div>
            </button>
        </div>

        <div class="p-6 w-full pt-6">
            <nav class="space-y-2 w-full">
                <a href="{{ route('dashboard') }}" wire:navigate
                    class="flex items-center p-3 rounded-xl font-bold transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-cyan-50 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-[#1a1d27] border border-transparent' }}"
                    :class="showNav ? 'gap-3 px-4' : 'justify-center'">
                    <x-icons.home class="size-5 shrink-0" />
                    <span x-show="showNav" style="display: none;" class="whitespace-nowrap">Inicio</span>
                </a>

                <a href="{{ route('library') }}" wire:navigate
                    class="flex items-center p-3 rounded-xl font-bold transition-all duration-300 {{ request()->is('myLibrary') ? 'bg-cyan-50 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-[#1a1d27] border border-transparent' }}"
                    :class="showNav ? 'gap-3 px-4' : 'justify-center'">
                    <x-icons.gamepad class="size-5 shrink-0" />
                    <span x-show="showNav" style="display: none;" class="whitespace-nowrap">Mi Biblioteca</span>
                </a>

                <a href="/listas" wire:navigate
                    class="flex items-center p-3 rounded-xl font-bold transition-all duration-300 {{ request()->is('listas*') ? 'bg-cyan-50 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-[#1a1d27] border border-transparent' }}"
                    :class="showNav ? 'gap-3 px-4' : 'justify-center'">
                    <x-icons.list class="size-5 shrink-0" />
                    <span x-show="showNav" style="display: none;" class="whitespace-nowrap">Mis Listas</span>
                </a>

                <a href="{{ route('allGames') }}" wire:navigate
                    class="flex items-center p-3 rounded-xl font-bold transition-all duration-300 {{ request()->is('allGames', 'showGame.*') ? 'bg-cyan-50 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-[#1a1d27] border border-transparent' }}"
                    :class="showNav ? 'gap-3 px-4' : 'justify-center'">
                    <x-icons.catalog class="size-5 shrink-0" />
                    <span x-show="showNav" style="display: none;" class="whitespace-nowrap">Explorar Catálogo</span>
                </a>
            </nav>
        </div>
    </div>

    @auth
        <div
            class="p-6 border-t border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-transparent transition-colors duration-300 w-full overflow-hidden mt-auto">
            <div class="flex items-center" :class="showNav ? 'gap-3 mb-4' : 'justify-center mb-0'">
                <div
                    class="w-10 h-10 bg-gradient-to-tr from-cyan-500 to-teal-500 rounded-full flex justify-center items-center font-black shadow-md border-2 border-white dark:border-[#151821] text-white shrink-0 uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>

                <div x-show="showNav" style="display: none;" class="flex-1 overflow-hidden whitespace-nowrap">
                    <h2 class="font-bold text-sm leading-tight text-gray-900 dark:text-white truncate">
                        {{ Auth::user()->name }}</h2>
                    <span
                        class="text-[10px] font-black text-cyan-600 dark:text-cyan-400 uppercase tracking-wider">{{ Auth::user()->rank ?? 'Veterano' }}</span>
                </div>
            </div>

            <div x-show="showNav" style="display: none;" class="space-y-1.5 whitespace-nowrap w-full">
                <div class="flex justify-between text-[10px] text-gray-500 font-bold uppercase tracking-wider">
                    <span>XP: {{ Auth::user()->xp ?? 450 }}</span>
                    <span>Nv. {{ Auth::user()->level ?? 12 }}</span>
                </div>
                <div
                    class="w-full bg-gray-200 dark:bg-[#0f1117] rounded-full h-1.5 overflow-hidden border border-transparent dark:border-gray-800">
                    <div class="bg-gradient-to-r from-cyan-500 to-teal-400 h-full rounded-full transition-all duration-700"
                        style="width: {{ Auth::user()->xp_percentage ?? 45 }}%"></div>
                </div>
            </div>
        </div>
    @endauth
</aside>
