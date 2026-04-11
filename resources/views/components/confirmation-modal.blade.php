@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
        <div class="shrink-0 flex items-center justify-center w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/30">
            <svg class="w-8 h-8 text-red-600 dark:text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
        </div>

        <div class="mt-3 text-center sm:mt-0 sm:text-left flex-1">
            <h3 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-2">
                {{ $title }}
            </h3>

            <div class="text-sm font-medium text-gray-600 dark:text-gray-400 leading-relaxed">
                {{ $content }}
            </div>
        </div>
    </div>

    <div
        class="mt-8 flex flex-col-reverse sm:flex-row justify-end gap-3 pt-6 border-t border-gray-100 dark:border-gray-800/80">
        {{ $footer }}
    </div>
</x-modal>
