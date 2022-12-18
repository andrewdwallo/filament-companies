const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/andrewdwallo/filament-companies/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
                gray: colors.slate,
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
