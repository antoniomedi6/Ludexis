<svg {{ $attributes->merge(['class' => 'lucide lucide-compass-icon lucide-compass']) }}
    xmlns="http://www.w3.org/2000/svg" width="124" height="124" viewBox="0 0 24 24">
    <defs>
        <mask id="compass-mask">
            <rect width="24" height="24" fill="white" />
            <path d="m16.24 7.76-1.804 5.411a2 2 0 0 1-1.265 1.265L7.76 16.24l1.804-5.411a2 2 0 0 1 1.265-1.265z"
                fill="black" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </mask>
    </defs>
    <circle cx="12" cy="12" r="10" fill="currentColor" mask="url(#compass-mask)" />
</svg>
