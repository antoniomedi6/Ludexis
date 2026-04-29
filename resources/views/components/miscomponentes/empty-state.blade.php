@props([
    'title',
    'content' => null,
    'icon' => null,
    'iconClass' => null,
])

<div {{ $attributes->class('flex flex-col items-center justify-center py-24 sm:py-32 px-6 border-2 border-dashed border-lightbox-border dark:border-darkbox-border rounded-3xl bg-lightbox-soft/60 dark:bg-darkbox-card/20 text-center transition-colors') }}
    role="status">
    @if ($icon)
        <div class="mb-6 bg-lightbox-card dark:bg-darkbox-main w-24 h-24 flex items-center justify-center rounded-full shadow-sm ring-1 ring-lightbox-border dark:ring-darkbox-border"
            aria-hidden="true">
            <i class="{{ $icon }} {{ $iconClass ?? 'text-4xl text-gray-300 dark:text-gray-600' }}"></i>
        </div>
    @endif

    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-3">{{ $title }}</h3>

    @if ($content)
        <p class="text-base text-gray-500 dark:text-gray-400 font-medium max-w-md mx-auto">{{ $content }}</p>
    @endif

    @isset($actions)
        {{ $actions }}
    @endisset
</div>
