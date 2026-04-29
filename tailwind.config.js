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
                lightbox: {
                    main: "#F3F7FB", // Fondo Principal (claro, frío)
                    card: "#F9FBFD", // Tarjetas (claro, no blanco puro)
                    border: "#D7E3EF", // Bordes (claro, frío)
                    muted: "#52637A", // Texto secundario (claro)
                    text: "#0B1220", // Texto principal (claro)
                    soft: "#E8F4FA", // Superficies suaves (claro, tintado hacia brand)
                },
            },
        },
    },

    plugins: [forms, typography],
};
