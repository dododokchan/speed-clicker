import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    //base: "/build/", //本番デプロイ時に有効化
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
    /* //本番デプロイ時に有効化
    build: {
        manifest: true,
    },

    server: {
        https: true,
        origin: "https://speed-clicker.fly.dev",
    },
    //本番デプロイ時に有効化 */
});
