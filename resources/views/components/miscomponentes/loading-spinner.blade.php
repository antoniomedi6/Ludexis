<div wire:loading.flex
    {{ $attributes->merge(['class' => 'fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[100] flex-col justify-center items-center gap-4 bg-[#0f1117]/90 px-8 py-6 rounded-2xl border border-cyan-500/20 shadow-[0_0_30px_rgba(6,182,212,0.15)] pointer-events-none backdrop-blur-md']) }}>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" class="w-16 h-16">
        <radialGradient id="a12" cx=".66" fx=".66" cy=".3125" fy=".3125"
            gradientTransform="scale(1.5)">
            <stop offset="0" stop-color="#20C7E1"></stop>
            <stop offset=".3" stop-color="#20C7E1" stop-opacity=".9"></stop>
            <stop offset=".6" stop-color="#20C7E1" stop-opacity=".6"></stop>
            <stop offset=".8" stop-color="#20C7E1" stop-opacity=".3"></stop>
            <stop offset="1" stop-color="#20C7E1" stop-opacity="0"></stop>
        </radialGradient>
        <circle transform-origin="center" fill="none" stroke="url(#a12)" stroke-width="30" stroke-linecap="round"
            stroke-dasharray="200 1000" stroke-dashoffset="0" cx="100" cy="100" r="70">
            <animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="1.6" values="360;0"
                keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform>
        </circle>
        <circle transform-origin="center" fill="none" opacity=".2" stroke="#20C7E1" stroke-width="30"
            stroke-linecap="round" cx="100" cy="100" r="70"></circle>
    </svg>

    <span class="text-cyan-500 font-black text-sm uppercase tracking-widest animate-pulse">Cargando...</span>
</div>
