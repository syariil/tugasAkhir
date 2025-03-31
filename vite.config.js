import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    // define: {
    //     "window.Alphine": "Alphine",
    // },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});
