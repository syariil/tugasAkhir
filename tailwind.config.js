/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                poppins: ["Poppins", "san sarif"],
                kodeMono: ["Kode Mono", "monospace"],
            },
            backgroundImage: {
                dashboard: "url('storage/image/logo.png')",
            },
        },
    },
    plugins: [require("flowbite/plugin"), require("tailwindcss-animated")],
};
