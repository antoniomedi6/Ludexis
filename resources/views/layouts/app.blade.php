<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="font-sans antialiased bg-white dark:bg-darkbox-main overflow-hidden text-gray-900 dark:text-gray-100">
    <x-banner />

    <div class="flex h-screen w-full bg-white dark:bg-darkbox-main overflow-hidden">

        @auth
            <x-miscomponentes.nav-aside />
        @endauth

        <div class="flex-1 flex flex-col h-full overflow-hidden relative transition-all duration-300">
            @guest
                @livewire('navigation-menu')
            @endguest

            {{-- <x-miscomponentes.roadmap-link /> --}}

            @if (isset($header))
                <header>
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="flex-1 h-full overflow-y-auto relative">
                {{ $slot }}

                <x-miscomponentes.footer />

            </main>
        </div>
    </div>
    @stack('modals')
    @livewireScripts

    {{-- <x-miscomponentes.auth-modal /> --}}

    {{-- NOTIFICACIONES --}}
    <x-miscomponentes.alert />

    {{-- MODAL DE IMAGENES SIMPLE --}}
    <x-miscomponentes.image-modal />

    {{-- MODAL DE DETALLE DE IMAGEN --}}
    @livewire('utils.image-detail-modal')
</body>

</html>
