/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                "purple-deep": {
                    900: "#4C1D95",
                    800: "#5B21B6",
                    700: "#6D28D9",
                    600: "#7C3AED",
                },
                "orange-vibrant": {
                    600: "#F97316",
                    500: "#FB923C",
                    400: "#FDBA74",
                },
                "red-accent": {
                    600: "#DC2626",
                    500: "#EF4444",
                    400: "#F87171",
                },
            },
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
            },
        },
    },
    plugins: [],
};
