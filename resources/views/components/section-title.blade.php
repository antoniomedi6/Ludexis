<div class="md:col-span-1 flex justify-between">
    <div class="px-4 sm:px-0">
        <h3 class="text-lg font-black text-lightbox-text dark:text-white uppercase tracking-tighter leading-tight">
            {{ $title }}
        </h3>

        <p class="mt-1 text-sm text-lightbox-muted dark:text-gray-400 font-medium">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>
