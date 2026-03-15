<x-app-layout>
    <div
        class="bg-gray-50 dark:bg-[#0f1117] text-gray-900 dark:text-gray-100 font-sans antialiased transition-colors duration-300">
        <header
            class="relative bg-white dark:bg-[#0f1117] border-b border-gray-200 dark:border-gray-800 overflow-hidden transition-colors duration-300">
            <div class="absolute inset-0 bg-cover bg-center opacity-10 dark:opacity-20"
                style="background-image: url('https://images.igdb.com/igdb/image/upload/t_1080p/sc7fwa.jpg');"></div>
            <div
                class="absolute inset-0 bg-gradient-to-r from-white via-white/90 to-transparent dark:from-[#0f1117] dark:via-[#0f1117]/90 dark:to-transparent">
            </div>

            <div
                class="relative max-w-7xl mx-auto px-6 py-16 flex flex-col md:flex-row items-center justify-between gap-10">
                <div class="max-w-xl">
                    <span
                        class="text-cyan-600 dark:text-cyan-400 font-black tracking-widest text-xs uppercase mb-3 block">
                        Tu Biblioteca Definitiva
                    </span>
                    <h1
                        class="text-4xl md:text-5xl font-black mb-4 leading-tight text-gray-900 dark:text-white drop-shadow-sm dark:drop-shadow-lg">
                        Lleva el control de lo que juegas.
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 font-medium">
                        Explora nuestra base de datos sincronizada con IGDB, registra tus horas y lee reseñas ponderadas
                        sin review bombing.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <button
                            class="bg-[#171a21] hover:bg-[#2a475e] border border-transparent dark:border-gray-800 text-white font-black px-6 py-3 rounded-xl shadow-lg transition flex items-center gap-3">
                            <i class="fa-brands fa-steam text-xl"></i> Entrar con Steam
                        </button>
                        <button
                            class="bg-[#5865F2] hover:bg-[#4752C4] border border-transparent dark:border-[#5865F2] text-white font-black px-6 py-3 rounded-xl shadow-lg transition flex items-center gap-3">
                            <i class="fa-brands fa-discord text-xl"></i> Entrar con Discord
                        </button>
                    </div>
                </div>

                <div class="hidden md:flex gap-4 transform rotate-3 scale-105">
                    <div
                        class="w-32 h-48 bg-gray-200 dark:bg-[#1a1d27] rounded-lg shadow-2xl overflow-hidden border-2 border-white dark:border-gray-800 transform -translate-y-4">
                        <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/co4ksi.jpg"
                            class="w-full h-full object-cover" />
                    </div>
                    <div
                        class="w-32 h-48 bg-gray-200 dark:bg-[#1a1d27] rounded-lg shadow-2xl overflow-hidden border-2 border-white dark:border-gray-800 z-10">
                        <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/co1tmu.jpg"
                            class="w-full h-full object-cover" />
                    </div>
                    <div
                        class="w-32 h-48 bg-gray-200 dark:bg-[#1a1d27] rounded-lg shadow-2xl overflow-hidden border-2 border-white dark:border-gray-800 transform translate-y-4">
                        <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/co1r7f.jpg"
                            class="w-full h-full object-cover" />
                    </div>
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-6 py-12 space-y-16">
            @livewire('utils.tendencias')

            <section class="grid lg:grid-cols-3 gap-8">
                @livewire('utils.preview-reviews')

                <div class="space-y-6">
                    {{--                     <div
                        class="bg-gradient-to-br from-cyan-600 to-teal-700 dark:from-cyan-900/40 dark:to-teal-900/40 dark:bg-[#1a1d27] p-8 rounded-2xl border border-cyan-400/50 dark:border-cyan-500/30 shadow-xl text-center transition-colors duration-300">
                        <i class="fa-solid fa-layer-group text-4xl text-cyan-100 dark:text-cyan-400 mb-4"></i>
                        <h3 class="text-xl font-black text-white mb-2">
                            Construye tu Backlog
                        </h3>
                        <p class="text-sm text-cyan-50 dark:text-gray-300 mb-6">
                            Crea listas, guarda tus horas y utiliza nuestra Ruleta Rusa para decidir qué jugar hoy.
                        </p>
                        <a href="{{ route('register') }}"
                            class="block w-full text-center bg-white text-cyan-900 hover:bg-cyan-50 font-black py-3 rounded-xl shadow-lg transition">
                            Crear Cuenta Gratis
                        </a>
                    </div> --}}

                    @livewire('utils.preview-images')
                </div>
            </section>
        </div>
    </div>
    <x-miscomponentes.footer />
</x-app-layout>
