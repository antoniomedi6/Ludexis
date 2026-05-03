# LUDEXIS 🎮

Proyecto de desarrollo web para 2º DAW creado por Antonio Medina Cazorla. 

LUDEXIS es una plataforma enfocada a los videojuegos que funciona a la vez como red social y como gestor de colecciones. El objetivo es centralizar en un único sitio lo que ahora mismo está disperso en varias webs: organizar tus juegos y compartir la experiencia.

## 🚀 Funcionalidades Principales

* **Gestión de Biblioteca y Listas:** Organiza tus juegos, indica su estado (completado, pendiente, abandonado) y registra las horas que le has dedicado.
* **Aspecto Social y Privacidad:** Sistema de seguidores. Puedes ver el *Timeline* cronológico de la actividad de tu red y compartir imágenes en una galería que cuenta con filtro anti-spoilers obligatorio.
* **Sistema Anti-Review Bombing:** Para evitar notas falsas, el peso de los votos cambia según tu rol: Usuario Estándar (x1.0), Veterano (x1.5) o Periodista (x3.0).
* **Herramientas Útiles:** Incluye funciones como un botón para elegir un juego aleatorio de tus pendientes.

## 💻 Stack Tecnológico

* **Backend:** PHP utilizando el framework Laravel bajo la arquitectura MVC.
* **Frontend:** Tailwind CSS para el diseño responsive. Livewire, Alpine.js y JavaScript puro para darle reactividad a la web sin necesidad de recargar la página.
* **Base de Datos:** MySQL.
* **Integraciones (APIs):** Conexión con la API de IGDB para importar automáticamente los datos oficiales de los videojuegos y Laravel Socialite para el inicio de sesión con Steam.
* **Despliegue:** Alojado en Orange Pi 5 Pro con Ubuntu 24.04.4 LTS, utilizando Ngnix Proxy Manager y DuckdDns.
