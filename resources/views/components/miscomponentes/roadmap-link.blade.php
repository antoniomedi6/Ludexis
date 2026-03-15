<div class="relative mt-10 w-full max-w-5xl mx-auto px-4">
    @if (Route::currentRouteNamed('roadmap'))
        <a href="{{ route('welcome') }}" class="group">
            <div
                class="absolute top-0 right-4 z-49 
                    rounded-xl border-2 border-gray-800 bg-[#1A1D27] 
                    px-8 py-3 text-white shadow-2xl
                    transition-all duration-300 
                    hover:border-cyan-500 hover:bg-[#1a1d27] hover:-translate-y-1">

                <div class="flex items-center gap-3">
                    <span class="relative flex h-3 w-3">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-cyan-500"></span>
                    </span>

                    <span class="text-xs uppercase tracking-widest font-black">
                        Volver a Inicio
                    </span>
                </div>
            </div>
        </a>
    @else
        <a href="{{ route('roadmap') }}" class="group">
            <div
                class="absolute top-0 right-4 z-49 
                    rounded-xl border-2 border-gray-800 bg-[#1A1D27] 
                    px-8 py-3 text-white shadow-2xl
                    transition-all duration-300 
                    hover:border-cyan-500 hover:bg-[#1a1d27] hover:-translate-y-1">

                <div class="flex items-center gap-3">
                    <span class="relative flex h-3 w-3">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-cyan-500"></span>
                    </span>

                    <span class="text-xs uppercase tracking-widest font-black">
                        Consultar Roadmap
                    </span>
                </div>
            </div>
        </a>
    @endif
</div>
