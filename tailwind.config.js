import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#2e31ea',
                    50: '#eff0ff',
                    100: '#e0e1ff',
                    200: '#c1c4ff',
                    300: '#9499ff',
                    400: '#6260ff',
                    500: '#3a36fc',
                    600: '#2e31ea', // Design primary
                    700: '#2622d0',
                    800: '#201da6',
                    900: '#1e1b85',
                    950: '#13114d',
                },
                "background-light": "#f6f6f8",
                "background-dark": "#111121",
                "surface-dark": "#1e293b",
                "card-dark": "#292938",
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Lexend', 'Outfit', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
