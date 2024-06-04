import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: ['./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php', './storage/framework/views/*.php', './resources/views/**/*.blade.php',],
    theme: {
        extend: {
            colors: {
                'primary': {
                    DEFAULT: '#25132a',
                    950: '#190d1c',
                    900: '#25132A',
                    800: '#321938',
                    700: '#4B2654',
                    600: '#643371',
                    500: '#7C3F8D',
                    400: '#9F56B3',
                    300: '#AF72C0',
                    200: '#BF8ECC',
                    100: '#D7B9DF',
                    50: '#EEE2F3'
                }, 'secondary': {
                    DEFAULT: '#F2F3F4', 100: '#F2F3F4'
                }, 'accent': {
                    DEFAULT: '#FF7F50',
                    900: '#B83100',
                    800: '#F54100',
                    700: '#FF5A1F',
                    600: '#FF6933',
                    500: '#FF7F50',
                    400: '#FF9670',
                    300: '#FFA585',
                    200: '#FFB499',
                    100: '#FFD2C2',
                    50: '#FFF0EB'
                }
            }, fontFamily: {
                sans: ['Quicksand', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [forms],
};
