<x-app-layout>
    <div class="max-w-5xl mx-auto py-12 px-4 bg-[#0f1117] min-h-screen">
        <h1 class="text-4xl font-black text-white text-center uppercase tracking-tight drop-shadow-lg">
            Roadmap de Desarrollo
        </h1>

        <div class="relative mt-10">
            <div class="absolute left-1/2 transform -translate-x-1/2 w-px h-full bg-cyan-500/20"></div>

            @foreach ($commits as $index => $commit)
                <div class="relative z-10 grid grid-cols-2 gap-0 w-full mb-16">

                    @if ($index % 2 == 0)
                        <div class="pr-12 text-right">
                            <div
                                class="inline-block bg-[#1a1d27] p-6 rounded-xl border border-gray-800 shadow-2xl text-left max-w-md transition-colors duration-300 hover:border-cyan-500/50">
                                <span class="text-cyan-400 text-xs uppercase tracking-widest font-black block mb-3">
                                    {{ $commit['date'] }}
                                </span>
                                <div class="text-white font-medium leading-relaxed">
                                    {!! nl2br(str_replace(['.', ':'], [".\n", ":\n"], $commit['message'])) !!}
                                </div>
                            </div>
                        </div>
                        <div class="pl-12"></div>
                    @else
                        <div class="pr-12"></div>
                        <div class="pl-12 text-left">
                            <div
                                class="inline-block bg-[#1a1d27] p-6 rounded-xl border border-gray-800 shadow-2xl text-left max-w-md transition-colors duration-300 hover:border-cyan-500/50">
                                <span class="text-cyan-400 text-xs uppercase tracking-widest font-black block mb-3">
                                    {{ $commit['date'] }}
                                </span>
                                <div class="text-white font-medium leading-relaxed">
                                    {!! nl2br(str_replace(['.', ':'], [".\n", ":\n"], $commit['message'])) !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div
                        class="absolute left-1/2 top-10 transform -translate-x-1/2 w-4 h-4 rounded-full bg-cyan-500 border-4 border-[#0f1117] shadow-[0_0_15px_rgba(34,211,238,0.4)]">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
