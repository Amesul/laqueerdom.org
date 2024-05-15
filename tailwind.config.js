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
                    900: '#030b14',
                    800: '#353c43',
                    700: '#4f545b',
                    600: '#686d72',
                    500: '#81858a',
                    400: '#9a9da1',
                    300: '#b3b6b9',
                    200: '#cdced0',
                    100: '#e6e7e8'
                }, 'primary': {
                    DEFAULT: '#fbf8f3',
                    900: '#323231',
                    800: '#4b4a49',
                    700: '#646361',
                    600: '#7e7c7a',
                    500: '#979592',
                    400: '#b0aeaa',
                    300: '#c9c6c2',
                    200: '#e2dfdb',
                    100: '#fbf8f3'
                }, 'accent': {
                    DEFAULT: '#ef53a2',
                    950: '#782a51',
                    900: '#8f3261',
                    800: '#a73a71',
                    700: '#bf4282',
                    600: '#d74b92',
                    500: '#ef53a2',
                    400: '#f275b5',
                    300: '#f598c7',
                    200: '#f9bada',
                    100: '#fdeef6'
                }
            }, fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [forms],
};
