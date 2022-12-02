import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/adminApp.css",
                "resources/js/adminApp.js",
            ],
            refresh: true,
        }),
    ],
});
