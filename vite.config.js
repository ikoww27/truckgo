import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/components/map.js",
            ],
            refresh: true,
        }),
    ],

    build: {
        outDir: "public", // Tentukan direktori output sebagai 'public' atau sesuaikan dengan kebutuhan Anda
    },
});
