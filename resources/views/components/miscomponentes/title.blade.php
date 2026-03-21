@props(['title1', 'title2'])

<h1
    class="text-4xl md:text-5xl font-black text-gray-900 dark:text-white tracking-tighter mb-2 transition-colors duration-300">
    {{ $title1 }}
    <span class="text-cyan-600 dark:text-cyan-500">{{ $title2 }}</span>
</h1>
