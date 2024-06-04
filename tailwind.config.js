/** @type {import('tailwindcss').Config} */
module.exports = {
    mode: 'jit',
    purge: ["./resources/**/*.view.php"],
    content: ["./resources/**/*.view.php"],
    theme: {
        fontFamily: {
            'sans': ['Inter', 'system-ui'],
        },
        extend: {},
    },
    plugins: [],
}

