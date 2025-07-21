import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },

            keyframes: {
                "run-in-place": {
                    "0%, 100%": { transform: "translateX(0)" },
                    "25%": { transform: "translateX(-3px)" },
                    "75%": { transform: "translateX(3px)" },
                },
            },
            animation: {
                "run-in-place": "run-in-place 0.4s steps(2) infinite",
            },
        },
    },

    plugins: [forms],
};
