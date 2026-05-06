<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-lightbox-card dark:bg-darkbox-main border border-lightbox-border dark:border-darkbox-border rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-lightbox-main dark:hover:bg-darkbox-card focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 focus:ring-offset-lightbox-card dark:focus:ring-offset-darkbox-main disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
