import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                'hanken-grotesk': ["Hanken Grotesk", "sans-serif"],
            },
            typography: {
                DEFAULT: {
                    css: {
                        '.line-clamp-3': {
                            overflow: 'hidden',
                            display: '-webkit-box',
                            WebkitBoxOrient: 'vertical',
                            WebkitLineClamp: '3',
                        },
                        '.line-clamp-none': {
                            overflow: 'visible',
                            display: 'block',
                            WebkitBoxOrient: 'unset',
                            WebkitLineClamp: 'unset',
                        },
                    },
                },
            },
        },
    },

    plugins: [forms, require('@tailwindcss/typography')],
};
