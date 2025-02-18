import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import motion from 'tailwindcss-motion';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                title: ['Sora', ...defaultTheme.fontFamily.sans],
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                shimmer: {
                    '0%, 90%, 100%': {
                        'background-position': 'calc(-100% - var(--shimmer-width)) 0',
                    },
                    '30%, 60%': {
                        'background-position': 'calc(100% + var(--shimmer-width)) 0',
                    },
                },
            },
            animation: {
                shimmer: 'shimmer 8s infinite',
            },
        },
    },
    plugins: [
        forms,
        motion,
    ],
};
