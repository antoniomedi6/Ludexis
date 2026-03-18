<svg {{ $attributes->merge(['class' => 'lucide lucide-gamepad-icon lucide-gamepad']) }}
    xmlns="http://www.w3.org/2000/svg" width="124" height="124" viewBox="0 0 24 24">
    <defs>
        <mask id="gamepad-mask">
            <rect width="24" height="24" fill="white" />
            <g stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="6" x2="10" y1="12" y2="12" />
                <line x1="8" x2="8" y1="10" y2="14" />
                <line x1="15" x2="15.01" y1="13" y2="13" />
                <line x1="18" x2="18.01" y1="11" y2="11" />
            </g>
        </mask>
    </defs>
    <rect width="20" height="12" x="2" y="6" rx="2" fill="currentColor" stroke="currentColor"
        stroke-width="2" mask="url(#gamepad-mask)" />
</svg>
