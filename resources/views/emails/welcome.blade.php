<x-mail::message>
    # Hola, {{ $userName }}

    Bienvenido a Ludexis. Ya puedes empezar a gestionar tu biblioteca y llevar el control de tus partidas.

    <x-mail::button :url="route('home')">
        Explorar Catálogo
    </x-mail::button>

    Un saludo,<br>
    El equipo de {{ config('app.name') }}
</x-mail::message>
