const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            height: {
                '100': '28rem',
            },
            boxShadow: {
                '3xl': 'rgba(0, 0, 0, 0.35) 0px 5px 15px',
            },
            left: {
                '1/5': '20%'
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
