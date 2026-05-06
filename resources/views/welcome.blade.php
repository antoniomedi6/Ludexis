<x-app-layout>
    <div
        class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 font-sans antialiased transition-colors duration-300 relative min-h-screen overflow-hidden">

        {{-- EFECTO BLUR FONDO --}}
        <div class="absolute top-0 left-0 md:left-1/4 w-[80vw] md:w-[50vw] h-[50vh] bg-cyan-300/30 dark:bg-cyan-900/20 blur-3xl rounded-full pointer-events-none z-0 transition-colors duration-300"
            aria-hidden="true">
        </div>

        <section
            class="relative border-b border-gray-200 dark:border-gray-800 overflow-hidden transition-colors duration-300 z-10"
            aria-labelledby="hero-heading">
            <div
                class="relative max-w-7xl mx-auto px-6 pt-32 pb-20 md:pt-40 md:pb-28 flex flex-col md:flex-row items-center justify-between gap-12">

                {{-- Textos --}}
                <div class="max-w-xl relative z-10">
                    <span
                        class="text-cyan-700 dark:text-cyan-500 font-black tracking-widest text-xs uppercase mb-4 block drop-shadow-sm">
                        Tu Biblioteca Definitiva
                    </span>
                    <h1 id="hero-heading"
                        class="text-5xl md:text-6xl font-black mb-6 leading-tight text-gray-900 dark:text-white drop-shadow-sm dark:drop-shadow-lg tracking-tighter">
                        Lleva el control de lo que juegas.
                    </h1>
                    <p class="text-lg md:text-xl text-gray-700 dark:text-gray-400 mb-10 font-medium leading-relaxed">
                        Explora nuestra base de datos, registra tus horas y lee reseñas ponderadas
                        sin review bombing.
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a type="button" href="{{ route('auth.steam.redirect') }}"
                            class="bg-[#171a21] hover:bg-[#2a475e] border border-transparent text-white font-black px-8 py-4 rounded-2xl shadow-lg dark:shadow-[0_10px_20px_rgba(0,0,0,0.5)] transition-all duration-300 flex items-center gap-3 text-sm uppercase tracking-widest hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-[#171a21]/50">
                            <i class="fa-brands fa-steam text-xl" aria-hidden="true"></i> Entrar con Steam
                        </a>
                        <a type="button" href="{{ route('auth.discord.redirect') }}"
                            class="bg-[#5865F2] hover:bg-[#4752C4] border border-transparent text-white font-black px-8 py-4 rounded-2xl shadow-lg dark:shadow-[0_10px_20px_rgba(0,0,0,0.5)] transition-all duration-300 flex items-center gap-3 text-sm uppercase tracking-widest hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-[#5865F2]/50">
                            <i class="fa-brands fa-discord text-xl" aria-hidden="true"></i> Entrar con Discord
                        </a>
                        <a type="button" href="{{ route('auth.google.redirect') }}"
                            class="bg-red-600 hover:bg-red-500 border border-transparent text-white font-black px-8 py-4 rounded-2xl shadow-lg dark:shadow-[0_10px_20px_rgba(0,0,0,0.5)] transition-all duration-300 flex items-center gap-3 text-sm uppercase tracking-widest hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-red-600/50">
                            <i class="fa-brands fa-google text-xl" aria-hidden="true"></i> Entrar con Google
                        </a>
                    </div>
                </div>

                {{-- Imágenes Decorativas --}}
                <div class="hidden md:flex gap-5 transform rotate-3 scale-105 relative z-10" aria-hidden="true">
                    <div
                        class="w-36 h-52 bg-white dark:bg-gray-900 rounded-2xl shadow-2xl overflow-hidden border-4 border-white dark:border-gray-800 transform -translate-y-6 transition-transform hover:scale-105 hover:-translate-y-8 duration-500">
                        <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/co1q1f.jpg"
                            alt="Portada de juego de ejemplo 1" class="w-full h-full object-cover" loading="lazy" />
                    </div>
                    <div
                        class="w-36 h-52 bg-white dark:bg-gray-900 rounded-2xl shadow-2xl overflow-hidden border-4 border-white dark:border-gray-800 z-10 transition-transform hover:scale-105 hover:-translate-y-2 duration-500">
                        <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/co1tmu.jpg"
                            alt="Portada de juego de ejemplo 2" class="w-full h-full object-cover" loading="lazy" />
                    </div>
                    <div
                        class="w-36 h-52 bg-white dark:bg-gray-900 rounded-2xl shadow-2xl overflow-hidden border-4 border-white dark:border-gray-800 transform translate-y-6 transition-transform hover:scale-105 hover:translate-y-4 duration-500">
                        <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/co1r7f.jpg"
                            alt="Portada de juego de ejemplo 3" class="w-full h-full object-cover" loading="lazy" />
                    </div>
                </div>
            </div>
        </section>

        {{-- CONTENIDO INFERIOR --}}
        <div class="relative max-w-7xl mx-auto px-6 py-16 space-y-20 z-10">
            @livewire('utils.tendencias')

            <section aria-label="Contenido destacado de la comunidad" class="grid lg:grid-cols-3 gap-10 items-start">
                @livewire('utils.preview-reviews')
                @livewire('utils.preview-images')
            </section>
        </div>
    </div>

</x-app-layout>
