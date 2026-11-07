<p align="center">
  <img src="public/images/logo.png" alt="Ludexis" width="160">
</p>

<h1 align="center">Ludexis</h1>

<p align="center">
  Red social y gestor de colecciones de videojuegos.<br>
  Organiza tu biblioteca, comparte lo que juegas y descubre qué juega tu gente.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?logo=php&logoColor=white" alt="PHP 8.2">
  <img src="https://img.shields.io/badge/Livewire-3-4E56A6?logo=livewire&logoColor=white" alt="Livewire 3">
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?logo=tailwindcss&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Alpine.js-8BC0D0?logo=alpinedotjs&logoColor=black" alt="Alpine.js">
  <img src="https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white" alt="MySQL">
</p>

---

## Sobre el proyecto

Ludexis es mi Proyecto Intermodular del Grado Superior en Desarrollo de Aplicaciones Web (2025-2026).

Hoy, quien juega a videojuegos tiene la información repartida en varias webs: una para llevar la colección, otra para leer reseñas y otra para hablar con amigos. Ludexis lo junta todo en un mismo sitio: llevas tu biblioteca, publicas reseñas y capturas, y sigues la actividad de otros jugadores.

## Capturas

<p align="center">
  <img src="docs/capturas/02-dashboard.jpg" alt="Dashboard" width="900">
</p>

| Ficha de juego | Catálogo |
| --- | --- |
| <img src="docs/capturas/06-ficha-de-juego.jpg" alt="Ficha de juego"> | <img src="docs/capturas/05-catalogo.jpg" alt="Catálogo"> |

| Mi biblioteca | Feed social |
| --- | --- |
| <img src="docs/capturas/04-mi-biblioteca.jpg" alt="Mi biblioteca"> | <img src="docs/capturas/07-feed-social.jpg" alt="Feed social"> |

| Galería | Perfil |
| --- | --- |
| <img src="docs/capturas/09-galeria.jpg" alt="Galería"> | <img src="docs/capturas/08-perfil.jpg" alt="Perfil"> |

## Funcionalidades

### Biblioteca y listas
- Biblioteca personal con el estado de cada juego (completado, pendiente, abandonado...) y las horas jugadas.
- Listas personalizadas para agrupar juegos como quieras.
- Selector de juego aleatorio entre tus pendientes, para cuando no sabes a qué jugar.

### Catálogo conectado a IGDB
- Catálogo con búsqueda, filtros por plataforma y género, y ordenación.
- Integración con la **API de IGDB**: si un juego no está en la base de datos local, se importa automáticamente con sus datos oficiales (portada, vídeo, desarrolladora, géneros, plataformas).
- Comando para importar los juegos más populares: `php artisan igdb:import-popular`.

### Parte social
- Sistema de seguidores, feed social y timeline cronológico con la actividad de tu red.
- Reseñas con "me gusta" y galería de capturas con filtro anti-spoilers obligatorio.
- Notificaciones dentro de la aplicación.
- Perfiles públicos o privados.

### Valoraciones contra el review bombing
La nota de cada juego es una media ponderada: el voto de cada usuario pesa según su rol (estándar **x1.0**, veterano **x1.5**, periodista **x3.0**), y la nota oficial de IGDB entra en el cálculo como referencia. Así unas pocas cuentas no pueden hundir o inflar la nota de un juego.

### Experiencia y rangos
Los usuarios ganan experiencia al publicar reseñas, subir capturas y recibir "me gusta", y suben de rango: Espectador, Explorador, Coleccionista, Completista y Veterano. Al llegar a Veterano, su voto pasa a pesar más.

### Cuentas y moderación
- Inicio de sesión con **Steam**, **Discord** y **Google** (Laravel Socialite), además del registro clásico.
- Autenticación en dos pasos (Jetstream).
- Sistema de reportes y panel de moderación para administradores.

## Stack

| Capa | Tecnologías |
| --- | --- |
| Backend | PHP 8.2, Laravel 12 (MVC), Jetstream, Sanctum |
| Frontend | Livewire 3, Alpine.js, JavaScript, Tailwind CSS, Vite |
| Base de datos | MySQL |
| Integraciones | API de IGDB, Laravel Socialite (Steam, Discord, Google) |
| Despliegue | Servidor propio: Orange Pi 5 Pro con Ubuntu 24.04, Nginx Proxy Manager y DuckDNS |

## Instalación en local

Requisitos: PHP 8.2+, Composer, Node.js y MySQL.

```bash
git clone https://github.com/antoniomedi6/Ludexis.git
cd Ludexis

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Configura en `.env` la conexión a MySQL y las credenciales de IGDB (`TWITCH_CLIENT_ID` y `TWITCH_CLIENT_SECRET`, que se obtienen gratis en la consola de desarrolladores de Twitch). Las de Steam, Discord y Google son opcionales y solo hacen falta para iniciar sesión con esas cuentas.

```bash
php artisan migrate --seed
php artisan igdb:import-popular 100   # opcional: importa 100 juegos populares

npm run dev
php artisan serve
```

La aplicación queda disponible en `http://localhost:8000`.

## Autor

**Antonio Medina Cazorla**, desarrollador web full stack (Almería).

- LinkedIn: [antoniomedinacazorla](https://www.linkedin.com/in/antoniomedinacazorla)
- GitHub: [antoniomedi6](https://github.com/antoniomedi6)
