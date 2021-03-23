const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                serif: ['Roboto Slab', ...defaultTheme.fontFamily.serif],

            },
            colors:{
                logo:{
                    primary: '#42A626',
                    light: '#A8D99A',
                    dark: '#141F05',
                    darker: '#090D02',
                    secondary:'#ABBF11',
                    terciary: '#D2D90B',
                    gray: '#F2F2F2'
                }
            },
            height: {
                'screen-75' : "75vh"
            },
            maxHeight: {
                'screen-75' : "75vh"
            }
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
        backgroundColor: ['responsive', 'hover', 'focus', 'disabled', 'checked'],
        textColor:['responsive', 'hover', 'focus', 'disabled', 'checked']
    },

    plugins: [
        require('@tailwindcss/ui'),
        require('tailwind-scrollbar'),
        require('@tailwindcss/custom-forms')
    ],
};
