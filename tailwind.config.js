const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./node_modules/tw-elements/dist/js/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            animation: {
                "progress": "progress 1s ease-in-out infinite",
                "bounce01": "bounce 2s infinite",
                "bounce02": "bounce 2.1s infinite",
                "bounce03": "bounce 2.2s infinite",
                "bounce04": "bounce 2.3s infinite",
                "bounce05": "bounce 2.4s infinite",
                "bounce06": "bounce 2.5s infinite",
                // "ping01": "ping01 1s cubic-bezier(0, 0, 1, 1) infinite",
                // "ping02": "ping01 1s cubic-bezier(0, 0, 0.22, 1) infinite",
                // "ping03": "ping01 1s cubic-bezier(0, 0, 0.24, 1) infinite",
                // "ping04": "ping01 1s cubic-bezier(0, 0, 0.26, 1) infinite",
                // "ping05": "ping01 1s cubic-bezier(0, 0, 0.28, 1) infinite",
                // "ping06": "ping01 1s cubic-bezier(0, 0, 0.3, 1) infinite",
            },
            keyframes: {
                progress: {
                    "0%": {width: '0%', marginLeft: '0%'},
                    "20%": {marginLeft: '0%'},
                    "100%": {width: '50%', marginLeft: '100%'},
                },
                // ping01: {
                //     "75%, 100%": {transform: 'scale(1.05)', opacity: '0'},
                // }
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("tw-elements/dist/plugin"),
    ],
};
