import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    DEFAULT: "#06B6D4", // Color Principal
                },
                darkbox: {
                    main: "#030712", // Fondo Principal
                    card: "#111827", // Tarjetas
                    border: "#1F2937", // Bordes
                },
                light: {
                    text: "#F3F4F6", // Textos principales
                },
            },
        },
    },

    plugins: [forms, typography],
};
