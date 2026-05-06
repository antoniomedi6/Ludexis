<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <div
            class="px-4 py-5 sm:p-6 bg-lightbox-card dark:bg-darkbox-card border border-lightbox-border dark:border-darkbox-border shadow-xl sm:rounded-[2rem] text-lightbox-text dark:text-gray-300 font-medium transition-colors duration-300">
            {{ $content }}
        </div>
    </div>
</div>
