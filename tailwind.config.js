export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                primary: 'var(--color-primary)',
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
}
