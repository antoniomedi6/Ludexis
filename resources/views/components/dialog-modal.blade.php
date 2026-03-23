@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="p-8 md:p-10 pb-6 md:pb-6">
        <div
            class="text-2xl font-black text-gray-900 dark:text-white tracking-tighter uppercase flex items-center gap-4">
            {{ $title }}
        </div>

        <div class="mt-6 text-sm font-bold text-gray-600 dark:text-gray-400 leading-relaxed">
            {{ $content }}
        </div>
    </div>

    <div
        class="flex flex-col-reverse md:flex-row justify-end gap-3 px-8 pb-8 md:px-10 md:pb-10 bg-transparent rounded-b-[2.5rem]">
        {{ $footer }}
    </div>
</x-modal>
