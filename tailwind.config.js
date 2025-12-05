import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['IBM Plex Sans Arabic', ...defaultTheme.fontFamily.sans],
                arabic: ['IBM Plex Sans Arabic', 'sans-serif'],
            },
            colors: {
                primary: {
                    DEFAULT: '#003366',
                    50: '#e6f0ff',
                    100: '#cce0ff',
                    200: '#99c2ff',
                    300: '#66a3ff',
                    400: '#3385ff',
                    500: '#0066ff',
                    600: '#0052cc',
                    700: '#003d99',
                    800: '#002966',
                    900: '#001433',
                },
            },
        },
    },
    plugins: [],
};