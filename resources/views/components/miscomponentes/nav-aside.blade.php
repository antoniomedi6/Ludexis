<aside
    class="w-64 bg-white dark:bg-[#151821] border-r border-gray-200 dark:border-gray-800 flex flex-col justify-between shrink-0 z-50 h-screen fixed top-0 left-0 transition-colors duration-300">
    <div>
        <div class="p-6">
            <a href="{{ route('dashboard') }}">
                <x-miscomponentes.application-logo-name />
            </a>
            <nav class="space-y-2 mt-6">
                <a href="{{ route('dashboard') }}" wire:navigate
                    class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-cyan-50 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50 shadow-sm dark:shadow-[0_0_15px_rgba(6,182,212,0.1)]' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-[#1a1d27] border border-transparent' }} rounded-xl font-bold transition-all duration-300">
                    <i class="fa-solid fa-house w-5"></i> Inicio
                </a>

                <a href="{{ route('library') }}" wire:navigate
                    class="flex items-center gap-3 px-4 py-3 {{ request()->is('library') ? 'bg-cyan-50 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50 shadow-sm dark:shadow-[0_0_15px_rgba(6,182,212,0.1)]' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-[#1a1d27] border border-transparent' }} rounded-xl font-bold transition-all duration-300">
                    <i class="fa-solid fa-gamepad w-5"></i> Mi Biblioteca
                </a>

                <a href="/listas" wire:navigate
                    class="flex items-center gap-3 px-4 py-3 {{ request()->is('listas*') ? 'bg-cyan-50 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50 shadow-sm dark:shadow-[0_0_15px_rgba(6,182,212,0.1)]' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-[#1a1d27] border border-transparent' }} rounded-xl font-bold transition-all duration-300">
                    <i class="fa-solid fa-list w-5"></i> Mis Listas
                </a>

                <a href="/allGames" wire:navigate
                    class="flex items-center gap-3 px-4 py-3 {{ request()->is('allGames', 'showGame.*') ? 'bg-cyan-50 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-400 border border-cyan-200 dark:border-cyan-800/50 shadow-sm dark:shadow-[0_0_15px_rgba(6,182,212,0.1)]' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-[#1a1d27] border border-transparent' }} rounded-xl font-bold transition-all duration-300">
                    <i class="fa-solid fa-compass w-5"></i> Explorar Catálogo
                </a>
            </nav>
        </div>
    </div>

    @auth
        <div
            class="p-6 border-t border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-transparent transition-colors duration-300">
            <div class="flex items-center gap-3 mb-4">
                <div
                    class="w-10 h-10 bg-gradient-to-tr from-cyan-500 to-teal-500 dark:from-cyan-600 dark:to-teal-600 rounded-full flex justify-center items-center font-black shadow-md border-2 border-white dark:border-[#0f1117] text-white shrink-0 transition-colors duration-300">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1 overflow-hidden">
                    <h2
                        class="font-bold text-sm leading-tight text-gray-900 dark:text-white truncate transition-colors duration-300">
                        {{ Auth::user()->name }}</h2>
                    <span
                        class="text-[10px] font-black text-cyan-600 dark:text-cyan-400 uppercase tracking-wider transition-colors duration-300">
                        {{ Auth::user()->rank ?? 'Veterano' }}
                    </span>
                </div>
            </div>

            <div class="space-y-1.5">
                <div
                    class="flex justify-between text-[10px] text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider transition-colors duration-300">
                    <span>XP: {{ Auth::user()->xp ?? 450 }}</span>
                    <span>Nv. {{ Auth::user()->level ?? 12 }}</span>
                </div>
                <div
                    class="w-full bg-gray-200 dark:bg-[#0f1117] rounded-full h-1.5 border border-gray-300 dark:border-gray-800 transition-colors duration-300 overflow-hidden">
                    <div class="bg-gradient-to-r from-cyan-500 to-teal-400 h-full rounded-full transition-all duration-700 shadow-sm"
                        style="width: {{ Auth::user()->xp_percentage ?? 45 }}%"></div>
                </div>
            </div>
        </div>
    @endauth
</aside>
