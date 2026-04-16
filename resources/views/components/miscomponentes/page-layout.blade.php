@props(['title1' => null, 'title2' => null, 'subtitle' => null, 'fullWidth' => false])

<div
    class="bg-gray-50 dark:bg-[#0f1117] text-gray-900 dark:text-gray-100 font-sans min-h-screen flex selection:bg-cyan-500 selection:text-white transition-colors duration-300">
    <div class="flex-1 flex flex-col h-full w-full">
        <x-miscomponentes.search-header />

        <main class="flex-1 overflow-y-auto px-4 md:px-8 py-8 relative hide-scrollbar w-full">
            <div class="{{ $fullWidth ? 'max-w-full' : 'max-w-[1400px]' }} mx-auto flex flex-col gap-8">

                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6">
                    <div>
                        @if ($title1 && $title2)
                            <x-miscomponentes.title :title1="$title1" :title2="$title2" />
                            @if ($subtitle)
                                <p
                                    class="text-gray-600 dark:text-gray-400 font-medium text-lg transition-colors duration-300">
                                    {{ $subtitle }}
                                </p>
                            @endif
                        @endif
                    </div>


                </div>
                @if (isset($aside))
                    <div class="flex sm:flex-row-reverse items-center gap-4">
                        {{ $aside }}
                    </div>
                @endif
                <div class="w-full">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
</div>
