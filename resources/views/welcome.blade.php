<x-app-layout>
    <div
        class="bg-gray-50 dark:bg-[#0f1117] text-gray-900 dark:text-gray-100 font-sans antialiased transition-colors duration-300 relative min-h-screen overflow-hidden">

        <div
            class="absolute top-0 left-0 md:left-1/4 w-[80vw] md:w-[50vw] h-[50vh] bg-cyan-300/30 dark:bg-cyan-900/20 blur-[120px] md:blur-[150px] rounded-full pointer-events-none z-0 transition-colors duration-300">
        </div>

        <div
            class="relative border-b border-gray-200 dark:border-gray-800 overflow-hidden transition-colors duration-300 z-10">
            <div class="absolute inset-0 bg-cover bg-center opacity-10 dark:opacity-20"
                style="background-image: url('https://images.igdb.com/igdb/image/upload/t_1080p/sc7fwa.jpg');"></div>
            <div
                class="absolute inset-0 bg-gradient-to-r from-gray-50 via-gray-50/90 to-transparent dark:from-[#0f1117] dark:via-[#0f1117]/90 dark:to-transparent transition-colors duration-300">
            </div>

            <div
                class="relative max-w-7xl mx-auto px-6 py-20 md:py-28 flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="max-w-xl relative z-10">
                    <span
                        class="text-cyan-600 dark:text-cyan-500 font-black tracking-widest text-xs uppercase mb-4 block drop-shadow-sm">
                        Tu Biblioteca Definitiva
                    </span>
                    <h1
                        class="text-5xl md:text-6xl font-black mb-6 leading-tight text-gray-900 dark:text-white drop-shadow-sm dark:drop-shadow-lg tracking-tighter">
                        Lleva el control de lo que juegas.
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400 mb-10 font-medium leading-relaxed">
                        Explora nuestra base de datos sincronizada con IGDB, registra tus horas y lee reseñas ponderadas
                        sin review bombing.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <button
                            class="bg-[#171a21] hover:bg-[#2a475e] border border-transparent text-white font-black px-8 py-4 rounded-2xl shadow-[0_10px_20px_rgba(23,26,33,0.2)] dark:shadow-[0_10px_20px_rgba(0,0,0,0.5)] transition-all duration-300 flex items-center gap-3 text-sm uppercase tracking-widest hover:-translate-y-1">
                            <i class="fa-brands fa-steam text-xl"></i> Entrar con Steam
                        </button>
                        <button
                            class="bg-[#5865F2] hover:bg-[#4752C4] border border-transparent text-white font-black px-8 py-4 rounded-2xl shadow-[0_10px_20px_rgba(88,101,242,0.2)] dark:shadow-[0_10px_20px_rgba(0,0,0,0.5)] transition-all duration-300 flex items-center gap-3 text-sm uppercase tracking-widest hover:-translate-y-1">
                            <i class="fa-brands fa-discord text-xl"></i> Entrar con Discord
                        </button>
                    </div>
                </div>

                <div class="hidden md:flex gap-5 transform rotate-3 scale-105 relative z-10">
                    <div
                        class="w-36 h-52 bg-white dark:bg-[#1a1d27] rounded-2xl shadow-2xl overflow-hidden border-4 border-white dark:border-gray-800 transform -translate-y-6 transition-transform hover:scale-105 hover:-translate-y-8 duration-500">
                        <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/co4ksi.jpg"
                            class="w-full h-full object-cover" />
                    </div>
                    <div
                        class="w-36 h-52 bg-white dark:bg-[#1a1d27] rounded-2xl shadow-2xl overflow-hidden border-4 border-white dark:border-gray-800 z-10 transition-transform hover:scale-105 hover:-translate-y-2 duration-500">
                        <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/co1tmu.jpg"
                            class="w-full h-full object-cover" />
                    </div>
                    <div
                        class="w-36 h-52 bg-white dark:bg-[#1a1d27] rounded-2xl shadow-2xl overflow-hidden border-4 border-white dark:border-gray-800 transform translate-y-6 transition-transform hover:scale-105 hover:translate-y-4 duration-500">
                        <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/co1r7f.jpg"
                            class="w-full h-full object-cover" />
                    </div>
                </div>
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-16 space-y-20 z-10">
            @livewire('utils.tendencias')

            <section class="grid lg:grid-cols-3 gap-10">
                <div class="flex justify-between items-end mb-2">
                    <h2
                        class="text-2xl font-black flex items-center gap-2 text-gray-900 dark:text-white transition-colors duration-300">
                        <i class="fa-solid fa-star text-indigo-500"></i> Reseñas Destacadas
                    </h2>
                </div>
                @livewire('utils.preview-reviews')

                <div class="space-y-10">
                    @livewire('utils.preview-images')
                </div>
            </section>
        </div>
    </div>
    <x-miscomponentes.footer />
</x-app-layout>
