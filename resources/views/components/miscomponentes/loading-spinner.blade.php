@props(['variant' => 'modal'])

<div wire:loading.flex
    {{ $attributes->merge(['class' => $variant === 'modal' ? 'fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[100] flex-col justify-center items-center gap-4 bg-[#0f1117]/90 px-8 py-6 rounded-2xl border border-cyan-500/20 shadow-[0_0_30px_rgba(6,182,212,0.15)] pointer-events-none backdrop-blur-md' : 'inline-flex justify-center items-center pointer-events-none']) }}>

    <svg viewBox="0 0 150 150" style="color:#20b7cf;" class="{{ $variant === 'simple' ? 'w-20 h-25 pt-5' : 'w-24 h-24' }}">
        <style>
            @keyframes loader2022 {
                50% {
                    transform: rotate(360deg);
                }
            }

            .ccc2002 {
                fill: none;
                stroke-width: 5;
                stroke-linecap: round;
                animation-name: loader2022;
                animation-duration: 4s;
                animation-iteration-count: infinite;
                animation-timing-function: ease-in-out;
                transform-origin: 50% 50%;
            }

            .ccc2002:nth-child(1) {
                stroke: currentColor;
                stroke-dasharray: 50;
                animation-delay: -0.2s;
                opacity: 25%;
            }

            .ccc2002:nth-child(2) {
                stroke: currentColor;
                stroke-dasharray: 100;
                opacity: 50%;
                animation-delay: -0.4s;
            }

            .ccc2002:nth-child(3) {
                stroke: currentColor;
                stroke-dasharray: 180;
                opacity: 75%;
                animation-delay: -0.6s;
            }

            .ccc2002:nth-child(4) {
                stroke: currentColor;
                stroke-dasharray: 350;
                stroke-dashoffset: -100;
                opacity: 100%;
                animation-delay: -0.8s;
            }
        </style>

        <circle class="ccc2002" cx="75" cy="75" r="20" />
        <circle class="ccc2002" cx="75" cy="75" r="35" />
        <circle class="ccc2002" cx="75" cy="75" r="50" />
        <circle class="ccc2002" cx="75" cy="75" r="65" />
    </svg>

    @if ($variant === 'modal')
        <span
            class="text-cyan-500 font-black text-sm uppercase tracking-widest animate-pulse">{{ $slot }}</span>
    @endif
</div>
