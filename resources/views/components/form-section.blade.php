@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit="{{ $submit }}">
            <div
                class="px-4 py-5 bg-lightbox-card dark:bg-darkbox-card border border-lightbox-border dark:border-darkbox-border sm:p-6 shadow-xl text-lightbox-text dark:text-gray-300 transition-colors duration-300 {{ isset($actions) ? 'sm:rounded-t-[2rem]' : 'sm:rounded-[2rem]' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div
                    class="flex items-center justify-end px-4 py-3 bg-lightbox-soft dark:bg-darkbox-main border border-t-0 border-lightbox-border dark:border-darkbox-border text-end sm:px-6 shadow-xl sm:rounded-b-[2rem] transition-colors duration-300">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
