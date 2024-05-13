import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: ['./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php', './storage/framework/views/*.php', './resources/views/**/*.blade.php',],
    theme: {
        extend: {
            colors: {
                'secondary': {
                    DEFAULT: '#030b14',
                    900: '#010204',
                    800: '#010509',
                    700: '#02070d',
                    600: '#030a12',
                    500: '#030b14',
                    400: '#103a6a',
                    300: '#1d68bf',
                    200: '#5699e6',
                    100: '#abccf2'
                }, 'primary': {
                    DEFAULT: '#fbf8f3',
                    900: '#4a3819',
                    800: '#947031',
                    700: '#caa35f',
                    600: '#e2cda9',
                    500: '#fbf8f3',
                    400: '#fcfaf6',
                    300: '#fdfbf8',
                    200: '#fdfcfa',
                    100: '#fefefd'
                }, 'accent': {
                    DEFAULT: '#ef53a2',
                    900: '#3b0520',
                    800: '#760b40',
                    700: '#b01060',
                    600: '#e91881',
                    500: '#ef53a2',
                    400: '#f275b4',
                    300: '#f597c6',
                    200: '#f9bad9',
                    100: '#fcdcec'
                }
            }, fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    }, plugins: [forms],
};
