import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    base: "/build/",
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/game.js",
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
    },
    server: {
        https: true,
        origin: "https://speed-clicker.fly.dev",
    },
});
