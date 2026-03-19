<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <div
            class="px-4 py-5 sm:p-6 bg-[#151821] border border-gray-800 shadow-xl sm:rounded-[2rem] text-gray-400 font-medium">
            {{ $content }}
        </div>
    </div>
</div>
