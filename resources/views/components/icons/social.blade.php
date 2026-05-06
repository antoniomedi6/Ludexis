<svg {{ $attributes->merge(['class' => 'icon icon-tabler icons-tabler-filled icon-tabler-social']) }}
    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
    <defs>
        <mask id="social-network-mask">
            <rect width="100%" height="100%" fill="white" />

            <path d="M7.5 7.5l9 9" stroke="black" stroke-width="2.5" stroke-linecap="round" />
            <path d="M16.5 7.5l-9 9" stroke="black" stroke-width="2.5" stroke-linecap="round" />
            <circle cx="7.5" cy="7.5" r="2.5" fill="black" />
            <circle cx="16.5" cy="16.5" r="2.5" fill="black" />
            <circle cx="16.5" cy="7.5" r="2.5" fill="black" />
            <circle cx="7.5" cy="16.5" r="2.5" fill="black" />
        </mask>
    </defs>

    <path
        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"
        mask="url(#social-network-mask)" />
</svg>
