import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                montserrat: ["Montserrat", ...defaultTheme.fontFamily.sans],
                roboto: ["Roboto", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                greyt: "#e7e7e7",
                topbord: "#bbbbcb",
                topback: "#ebebeb",
                toptext: "#53565a",
                lgrey: "#f5f5f5",
                footer: "#444",
                dark: "#1b1b1b",
                midgrey: "#6e6e6e",
                yellow: "#ffd700",
            },
            boxShadow: {
                custom: "0 4px 6px rgba(0, 0, 0, 0.1)",
            },
            fontSize: {
                xxs: "0.55rem",
            },
        },
    },

    plugins: [forms],
};
