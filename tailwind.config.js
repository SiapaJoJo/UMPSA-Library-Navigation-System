import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';


export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
